<?php
/**
 * Burst Pro - Duplicate Post Integration
 *
 * @return string[]
 */
function burst_exclude_post_meta( array $meta_keys ): array {
	$meta_keys[] = 'burst_total_pageviews_count';
	return $meta_keys;
}
add_filter( 'duplicate_post_excludelist_filter', 'burst_exclude_post_meta' );

/**
 * Burst Pro - Integrations Test for CI Environment
 */
if ( defined( 'BURST_CI_ACTIVE' ) ) {
	add_action(
		'init',
		function (): void {
			// intentionally added log here for the test.
            // phpcs:ignore
            error_log('Burst - Yoast Duplicate Post integration loaded in CI environment INIT.');
		},
		20
	);
}
