<?php
namespace Burst\Admin\Statistics;

use Burst\Traits\Helper;
use Burst\Traits\Save;

defined( 'ABSPATH' ) || die();

if ( ! class_exists( 'summary' ) ) {
	class Summary {
		use Helper;
		use Save;

		public bool $is_high_traffic;

		/**
		 * Summary constructor.
		 */
		public function init(): void {
			add_action( 'burst_every_hour', [ $this, 'update_summary_table_today' ] );
			add_action( 'burst_weekly', [ $this, 'update_is_high_traffic' ] );
			add_filter( 'burst_do_action', [ $this, 'refresh_data' ], 10, 3 );

			if ( defined( 'BURST_RESTART_SUMMARY_UPGRADE' ) && BURST_RESTART_SUMMARY_UPGRADE ) {
				$this->restart_update_summary_table_alltime();
			}
		}



		/**
		 * Refresh the summary data
		 *
		 * @return string[]
		 */
		public function refresh_data( array $output, string $action, array $data ): array {
			// fix phpcs warning.
			unset( $data );
			if ( ! $this->user_can_manage() ) {
				return $output;
			}

			if ( $action === 'refresh_data' ) {
				$this->update_summary_table();
				$output['success'] = true;
			}

			return $output;
		}

		/**
		 * Check if all items are summary data
		 */
		public function is_summary_data( array $items, array $filters, int $start, int $end ): bool {
			if ( ! empty( $filters ) ) {
				return false;
			}

			// if the difference between start and end is below x months, we don't use summary data.
			$three_months = 3 * MONTH_IN_SECONDS;
			$range        = $end - $start;
			if ( $range < $three_months ) {
				return false;
			}

			// if end is today, we can't be sure that the data is complete, so we don't use summary data.
			$today_end = Statistics::convert_date_to_unix( gmdate( 'Y-m-d' ) . ' 23:59:59' );
			if ( $end === $today_end ) {
				return false;
			}

			$summary_items = [
				'page_url',
				'sessions',
				'pageviews',
				'bounce_rate',
				'visitors',
				'first_time_visitors',
				'bounces',
				'avg_time_on_page',
			];
			foreach ( $items as $item ) {
				if ( ! in_array( $item, $summary_items, true ) ) {
					return false;
				}
			}
			return true;
		}

		/**
		 * Restart the summary table update
		 */
		public function restart_update_summary_table_alltime(): void {
			global $wpdb;

			$table_names = [ $wpdb->prefix . 'burst_summary' ];

			foreach ( $table_names as $table_name ) {
				if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) === $table_name ) {
					$wpdb->query( "TRUNCATE TABLE $table_name" );
				}
			}

			update_option( 'burst_db_upgrade_summary_table', true, false );
			delete_option( 'burst_summary_table_upgrade_days_offset' );
		}

		/**
		 * Check if the summary upgrade has been completed
		 */
		public function upgrade_completed(): bool {
			if ( ! self::is_high_traffic() ) {
				return false;
			}

			// if option set to never use summary tables, return false for upgrade completed.
			if ( defined( 'BURST_DONT_USE_SUMMARY_TABLE' ) ) {
				return false;
			}

			if ( $this->get_option_bool( 'disable_summary' ) ) {
				return false;
			}

			return ! get_option( 'burst_db_upgrade_summary_table' );
		}

		/**
		 * Once a week, update the status of the site, if it is high traffic or not. If over 100K hits in the last month, it is considered high traffic.
		 * In that case, summary tables will be used to speed up the dashboard.
		 */
		public function update_is_high_traffic(): void {
			global $wpdb;

			$start_of_last_month = strtotime( 'first day of last month midnight' );
			$end_of_last_month   = strtotime( 'last day of last month 23:59:59' );
			$sql                 = $wpdb->prepare( "select count(*) from {$wpdb->prefix}burst_statistics where time>=%s and time<=%s", $start_of_last_month, $end_of_last_month );
			$count               = (int) $wpdb->get_var( $sql );
			$is_high_traffic     = $count > apply_filters( 'burst_high_traffic_treshold', 100000 );
			update_option( 'burst_is_high_traffic_site', $is_high_traffic, false );
		}

		/**
		 * Check if the site is considered high traffic
		 */
		public static function is_high_traffic(): bool {
			return get_option( 'burst_is_high_traffic_site' );
		}

		/**
		 * Check if the cron has run the last 24 hours
		 */
		public function cron_active(): bool {
			$now           = time();
			$last_cron_hit = get_option( 'burst_last_cron_hit', 0 );
			$diff          = $now - $last_cron_hit;

			$cron_active = $diff <= DAY_IN_SECONDS;
			if ( $cron_active ) {
				\Burst\burst_loader()->admin->tasks->dismiss_task( 'cron' );
			}
			return $cron_active;
		}

		/**
		 * Upgrade the data to summary table, progressing over all days until the last one is completed
		 */
		public function upgrade_summary_table_alltime(): void {
			global $wpdb;
			// 1644260876.
			$first_statistics_date_unix = $wpdb->get_var( "select min(time) from {$wpdb->prefix}burst_statistics" );
			// convert unix to date and back to unix, to ensure that the date is at the start of the day, for comparison purposes.
			// 2022-02-07.
			$first_statistics_date = Statistics::convert_unix_to_date( $first_statistics_date_unix );
			// calculate days offset from first_statistics_date to today.
			$first_statistics_date_unix = strtotime( $first_statistics_date );
			$today                      = Statistics::convert_unix_to_date( strtotime( 'today' ) );
			$max_days_offset            = ( strtotime( $today ) - $first_statistics_date_unix ) / DAY_IN_SECONDS;
			// round to integer.
			$max_days_offset = round( $max_days_offset, 0 );
			// if the offset is negative, set it to 0.
			$max_days_offset     = $max_days_offset < 0 ? 0 : $max_days_offset;
			$current_days_offset = (int) get_option( 'burst_summary_table_upgrade_days_offset', 0 );
			// check if the oldest summary date is more recent than the oldest statistics date.
			// we ensure that it will always run for today, by running if offset = 0.
			if ( $max_days_offset >= $current_days_offset ) {
				for ( $i = 0; $i < 30; $i++ ) {
					$success = $this->update_summary_table( $current_days_offset );
					// if failed, exit, and try again later.
					if ( ! $success ) {
						return;
					}
					// if successful, increment days offset.
					++$current_days_offset;
				}

				update_option( 'burst_summary_table_upgrade_days_offset', $current_days_offset, false );
				// schedule next run.
				wp_schedule_single_event( time() + MINUTE_IN_SECONDS, 'burst_upgrade_iteration' );

			} else {
				// completed.
				delete_option( 'burst_db_upgrade_summary_table' );
			}
		}

		/**
		 * Run scheduled to update today's summary data
		 */
		public function update_summary_table_today(): void {
			if ( ! $this->cron_active() ) {
				$this->update_option( 'disable_summary', true );
			}
			update_option( 'burst_last_cron_hit', time(), false );
			// we want to update for yesterday at least once on the next day, to ensure completeness. If completed, continue with normal update process.
			if ( ! $this->summary_table_updated_yesterday() ) {
				$this->update_summary_table( 1 );
			}

			// update for today.
			$this->update_summary_table();
		}

		/**
		 * Check if yesterday's summary was marked as completed
		 */
		private function summary_table_updated_yesterday(): bool {
			global $wpdb;
			$yesterday = Statistics::convert_unix_to_date( strtotime( 'yesterday' ) );
			$completed = $wpdb->get_var( $wpdb->prepare( "select completed from {$wpdb->prefix}burst_summary where date = %s", $yesterday ) );
			return (bool) $completed;
		}


		/**
		 * Generate the SQL query for the summary table
		 *
		 * @phpcsSuppress SlevomatCodingStandard.TypeHints.ReturnTypeHint
		 * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint
		 * @param int        $date_start
		 * @param int        $date_end
		 * @param array      $select_array
		 * @param string     $group_by
		 * @param string     $order_by
		 * @param int        $limit
		 * @param array|bool $date_modifiers
		 * @return string
		 */
		public function summary_sql( int $date_start, int $date_end, array $select_array, string $group_by = '', string $order_by = '', int $limit = 0, $date_modifiers = false ): string {
			$date_start = Statistics::convert_unix_to_date( $date_start );
			$date_end   = Statistics::convert_unix_to_date( $date_end );

			global $wpdb;

			$select    = [];
			$select[]  = $date_modifiers ? "DATE_FORMAT(date, '{$date_modifiers['sql_date_format']}') as period" : 'page_url';
			$sql_array = [
				'bounce_rate'         => 'sum(bounces) / count(sessions) * 100 as bounce_rate',
				'pageviews'           => 'sum(pageviews) as pageviews',
				'visitors'            => 'sum(visitors) as visitors',
				'sessions'            => 'sum(sessions) as sessions',
				'first_time_visitors' => 'sum(first_time_visitors) as first_time_visitors',
				'bounces'             => 'sum(bounces) as bounces',
				'avg_time_on_page'    => 'AVG(avg_time_on_page) as avg_time_on_page',
			];

			foreach ( $select_array as $select_item ) {
				if ( isset( $sql_array[ $select_item ] ) ) {
					$select[] = $sql_array[ $select_item ];
				}
			}

			$sql        = implode( ', ', $select );
			$date_start = esc_sql( $date_start );
			$date_end   = esc_sql( $date_end );
			$sql        = "select $sql from {$wpdb->prefix}burst_summary where date>='$date_start' AND date<='$date_end'";

			// page_urls include unique visitors, which overlap with the same unique visitors from other page_urls.
			// we can't just sum up all unique visitors from all page_urls, so if the page_url is not a selector, we get the day total.
			if ( ! in_array( 'page_url', $select_array, true ) ) {
				$sql .= " AND page_url='burst_day_total'";
			} else {
				$sql .= " AND page_url!='burst_day_total'";
			}

			if ( ! empty( $group_by ) ) {
				$sql .= ' group by ' . $group_by;
			}

			if ( ! empty( $order_by ) ) {
				$sql .= ' order by ' . $order_by;
			}

			if ( $limit > 0 ) {
				$sql .= ' LIMIT ' . $limit;
			}
			return $sql;
		}

		/**
		 * Update the summary table for one day.
		 */
		public function update_summary_table( int $days_offset = 0 ): bool {
			if ( get_transient( 'burst_updating_summary_table' ) ) {
				return false;
			}
			set_transient( 'burst_updating_summary_table', 5 * MINUTE_IN_SECONDS );
			global $wpdb;
			$today = Statistics::convert_unix_to_date( strtotime( 'today' ) );
			// deduct days offset in days.
			if ( $days_offset > 0 ) {
				$today = Statistics::convert_unix_to_date( strtotime( $today . ' -' . $days_offset . ' days' ) );
			}
			// get start of today in unix.
			$date_start = Statistics::convert_date_to_unix( $today . ' 00:00:00' );
			// get end of today in unix.
			$date_end = Statistics::convert_date_to_unix( $today . ' 23:59:59' );
			// get today's date.
			// get the summary from the statistics table.
			$select_sql = \Burst\burst_loader()->admin->statistics->get_sql_table_enhanced(
				[
					'date_start' => $date_start,
					'date_end'   => $date_end,
					'select'     => [
						'pageviews',
						'visitors',
						'first_time_visitors',
						'page_url',
						'bounces',
						'sessions',
						'avg_time_on_page',
					],
					'filters'    => [],
					'group_by'   => 'page_url',
				]
			);
			// if this is the update for yesterday or before, mark it as completed.
			$completed  = $days_offset !== 0 ? 1 : 0;
			$update_sql = $wpdb->prepare(
				"INSERT INTO {$wpdb->prefix}burst_summary (date, page_url, sessions, pageviews, visitors, first_time_visitors, bounces, avg_time_on_page, completed)
							SELECT
							    %s AS date,
							    source.page_url,
							    source.sessions,
							    source.pageviews,
							    source.visitors,
							    source.first_time_visitors,
							    source.bounces,
							    source.avg_time_on_page,
								%s AS completed
							FROM (
							    $select_sql
							) AS source
							ON DUPLICATE KEY UPDATE
							    date = date,
							    page_url = source.page_url,
							    sessions = source.sessions,
							    pageviews = source.pageviews,
							    visitors = source.visitors,
							    first_time_visitors = COALESCE(source.first_time_visitors, 0),
							    bounces = source.bounces,
							    avg_time_on_page = source.avg_time_on_page,
							    completed = completed;",
				$today,
				$completed
			);
			$wpdb->query( $update_sql );

			// we also create the day total for this day.
			$select_sql = \Burst\burst_loader()->admin->statistics->get_sql_table_enhanced(
				[
					'date_start' => $date_start,
					'date_end'   => $date_end,
					'select'     => [
						'pageviews',
						'visitors',
						'first_time_visitors',
						'bounces',
						'sessions',
						'avg_time_on_page',
					],
					'filters'    => [],
				]
			);
			$update_sql = $wpdb->prepare(
				"INSERT INTO {$wpdb->prefix}burst_summary (date, page_url, sessions, pageviews, visitors, first_time_visitors, bounces, avg_time_on_page, completed)
							SELECT
							    %s AS date,
							    'burst_day_total' as page_url,
							    source.sessions,
							    source.pageviews,
							    source.visitors,
							    source.first_time_visitors,
							    source.bounces,
							    source.avg_time_on_page,
								%s AS completed
							FROM (
							    $select_sql
							) AS source
							ON DUPLICATE KEY UPDATE
							    date = date,
							    page_url = page_url,
							    sessions = source.sessions,
							    pageviews = source.pageviews,
							    visitors = source.visitors,
							    first_time_visitors = COALESCE(source.first_time_visitors, 0),
							    bounces = source.bounces,
							    avg_time_on_page = COALESCE(source.avg_time_on_page, 0),
							    completed = completed;",
				$today,
				$completed
			);

			$wpdb->query( $update_sql );

			delete_transient( 'burst_updating_summary_table' );
			return true;
		}
	}
}
