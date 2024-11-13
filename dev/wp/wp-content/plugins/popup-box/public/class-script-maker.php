<?php

namespace PopupBox;

defined( 'ABSPATH' ) || exit;

class Script_Maker {
	private array $script;
	/**
	 * @var mixed
	 */
	private $param;
	/**
	 * @var mixed
	 */
	private $id;

	public function __construct( $id, $param ) {
		$this->id     = $id;
		$this->param  = $param;
		$this->script = [];
	}


	public function init(): array {

		$this->script['selector'] = '#ds-popup-' . absint( $this->id );

		$this->main_settings();
		$this->popup_style();
		$this->overlay();
		$this->content_style();
		$this->close_btn_style();
		$this->mobile_style();

		return $this->script;
	}

	private function main_settings(): void {
		$id    = $this->id;
		$param = $this->param;

		// Block Page
		if ( ! empty( $param['block_page'] ) ) {
			$this->script['block_page'] = true;
		}


		// Triggers
		if ( $param['triggers'] !== 'click' ) {
			$this->script['open_popup'] = $param['triggers'];
		}
		if ( ( $param['triggers'] === 'auto' ) && ! empty( $param['delay'] ) ) {
			$this->script['open_delay'] = $param['delay'];
		}

		if ( $param['triggers'] === 'scrolled' && ! empty( $param['distance'] ) ) {
			$this->script['open_distance'] = $param['distance'];
		}

		// Elements for Open & Close
		$this->script['open_popupTrigger'] = 'ds-open-popup-' . $id;

		// Set Cookie
		if ( ! empty( $param['cookie_checkbox'] ) ) {
			$this->script['cookie_enable'] = true;
			$this->script['cookie_name']   = 'ds-popup-' . $id;
			$this->script['cookie_days']   = $param['cookie'];
		}


		// Close by clicking Esc
		if ( empty( $param['close_Esc'] ) ) {
			$this->script['popup_esc'] = false;
		}

		// Popup z-index
		if ( $param['zindex'] !== '999' ) {
			$this->script['popup_zindex'] = $param['zindex'];
		}

	}

	private function popup_style(): void {
		$id    = $this->id;
		$param = $this->param;

		// Popup Animation
		if ( $param['popup_animation'] !== 'fadeIn' ) {
			$this->script['popup_animation'] = $param['popup_animation'];
		}

		// Popup width & height
		$width                     = ( $param['width_unit'] === 'auto' ) ? 'auto' : $param['width'] . $param['width_unit'];
		$height                    = ( $param['height_unit'] === 'auto' ) ? 'auto' : $param['height'] . $param['height_unit'];
		$this->script['popup_css'] = array(
			'width'  => $width,
			'height' => $height,
		);

		// Popup background
		if ( ! empty( $param['background_img_checkbox'] ) ) {
			$this->script['popup_css']['background-color'] = $param['background'];
			$this->script['popup_css']['background-image'] = 'url(' . $param['background_img'] . ')';
			$this->script['popup_css']['background-size']  = 'cover';
		} else {
			$this->script['popup_css']['background'] = $param['background'];
		}


		// Popup Location
		if ( $param['location'] !== '-center' ) {
			$this->script['popup_position'] = $param['location'];
		}

		switch ( $param['location'] ) {
			case '-topCenter':
				$unit                               = isset( $param['top_unit'] ) ? $param['top_unit'] : 'px';
				$this->script['popup_css']['top']   = $param['top'] . $unit;
				$this->script['popup_css']['right'] = '0';
				break;
			case '-bottomCenter':
				$unit                                = isset( $param['bottom_unit'] ) ? $param['bottom_unit'] : 'px';
				$this->script['popup_css']['bottom'] = $param['bottom'] . $unit;
				$this->script['popup_css']['right']  = '0';
				break;
			case '-left':
				$unit                              = isset( $param['left_unit'] ) ? $param['left_unit'] : 'px';
				$this->script['popup_css']['left'] = $param['left'] . $unit;
				break;
			case '-right':
				$unit                               = isset( $param['right_unit'] ) ? $param['right_unit'] : 'px';
				$this->script['popup_css']['right'] = $param['right'] . $unit;
				break;
			case '-topLeft':
				$top_unit                          = isset( $param['top_unit'] ) ? $param['top_unit'] : 'px';
				$left_unit                         = isset( $param['left_unit'] ) ? $param['left_unit'] : 'px';
				$this->script['popup_css']['top']  = $param['top'] . $top_unit;
				$this->script['popup_css']['left'] = $param['left'] . $left_unit;
				break;
			case '-bottomLeft':
				$bottom_unit                         = isset( $param['bottom_unit'] ) ? $param['bottom_unit'] : 'px';
				$left_unit                           = isset( $param['left_unit'] ) ? $param['left_unit'] : 'px';
				$this->script['popup_css']['bottom'] = $param['bottom'] . $bottom_unit;
				$this->script['popup_css']['left']   = $param['left'] . $left_unit;
				break;
			case '-topRight':
				$top_unit                           = isset( $param['top_unit'] ) ? $param['top_unit'] : 'px';
				$right_unit                         = isset( $param['right_unit'] ) ? $param['right_unit'] : 'px';
				$this->script['popup_css']['top']   = $param['top'] . $top_unit;
				$this->script['popup_css']['right'] = $param['right'] . $right_unit;
				break;
			case '-bottomRight':
				$bottom_unit                         = isset( $param['bottom_unit'] ) ? $param['bottom_unit'] : 'px';
				$right_unit                          = isset( $param['right_unit'] ) ? $param['right_unit'] : 'px';
				$this->script['popup_css']['bottom'] = $param['bottom'] . $bottom_unit;
				$this->script['popup_css']['right']  = $param['right'] . $right_unit;
				break;
		}

		// Popup padding
		$this->script['popup_css']['padding'] = $param['padding'] . 'px';

		// Popup border radius
		if ( ! empty( $param['radius'] ) ) {
			$this->script['popup_css']['border-radius'] = $param['radius'] . 'px';
		}

		// Popup shasow
		if ( ! empty( $param['shadow_checkbox'] ) ) {
			$this->script['popup_css']['box-shadow'] = '0 0 ' . $param['shadow'] . 'px ' . $param['shadow_color'];
		}
	}

	private function overlay(): void {
		$param = $this->param;

		if ( empty( $param['overlay_checkbox'] ) ) {
			$this->script['overlay_isVisible'] = false;
		} else {
			if ( $param['overlay_animation'] !== 'fadeIn' ) {
				$this->script['overlay_animation'] = $param['overlay_animation'];
			}
			$this->script['overlay_css'] = array(
				'background' => $param['overlay'],
			);
			if ( empty( $param['close_overlay'] ) ) {
				$this->script['overlay_closesPopup'] = false;
			}
		}
	}

	private function content_style(): void {
		$param = $this->param;

		$this->script['content_css'] = array(
			'font-family' => $param['content_font'],
			'font-size'   => $param['content_size'] . 'px',
			'padding'     => $param['content_padding'] . 'px',
		);
		// Content Border
		if ( $param['border_style'] !== 'none' ) {
			$this->script['content_css']['border'] = $param['border_width'] . 'px ' . $param['border_style'] . ' ' . $param['border_color'];
			if ( ! empty( $param['border_radius'] ) ) {
				$this->script['content_css']['border-radius'] = $param['border_radius'] . 'px';
			}
		}
	}

	private function close_btn_style(): void {
		$param = $this->param;

			if ( $param['close'] !== '-text' ) {
				$this->script['close_type'] = $param['close'];
			}
			$this->script['close_content'] = $param['close_text'];
			$this->script['close_css']     = array(
				'font-size'  => $param['close_size'] . 'px',
				'color'      => $param['close_color'],
				'background' => $param['close_background'],
			);

			if ( $param['close_location'] !== '-topRight' ) {
				$this->script['close_position'] = $param['close_location'];
			}
			if ( ! empty( $param['close_place'] ) ) {
				$this->script['close_outer'] = true;
			}

	}

	private function mobile_style(): void {
		$param = $this->param;
		if ( empty( $param['mobile_checkbox'] ) ) {
			$this->script['mobile_show'] = false;
		} else {
			if ( $param['mobile'] !== '480' ) {
				$this->script['mobile_breakpoint'] = $param['mobile'] . 'px';
			}
			$this->script['mobile_css'] = array(
				'width' => $param['mobile_width'] . $param['mobile_width_unit'],
			);
		}
	}

}