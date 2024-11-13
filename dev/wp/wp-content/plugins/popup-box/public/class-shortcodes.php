<?php

namespace PopupBox;

defined( 'ABSPATH' ) || exit;

class WOWP_Shortcodes {
	public function __construct() {
		add_shortcode( 'videoBox', array( $this, 'video_shortcode' ) );
		add_shortcode( 'buttonBox', array( $this, 'button_shortcode' ) );
		add_shortcode( 'iframeBox', array( $this, 'iframe_shortcode' ) );
	}

	function video_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'id'     => '',
			'from'   => 'youtube',
			'width'  => '560',
			'height' => '315',
		), $atts, 'videoBox' );

		if ( empty( $atts['id'] ) ) {
			return false;
		}

		if ( $atts['from'] === 'youtube' ) {
			$url = 'https://www.youtube.com/embed/';
		} elseif ( $atts['from'] === 'vimeo' ) {
			$url = 'https://player.vimeo.com/video/';
		}

		$video = '<iframe width="' . absint( $atts['width'] ) . '" height="' . absint( $atts['height'] ) . '" src="' . esc_url( $url ) . esc_attr( $atts['id'] ) . '" allow=autoplay frameborder="0" ></iframe>';

		return $video;
	}

	function button_shortcode( $atts, $content ) {
		$atts = shortcode_atts( array(
			'type'      => 'close',
			'link'      => '',
			'target'    => '_blank',
			'color'     => 'white',
			'bgcolor'   => 'mediumaquamarine',
			'size'      => 'normal',
			'fullwidth' => 'no',
		), $atts, 'buttonBox' );

		$size      = 'is-' . $atts['size'];
		$button    = '';
		$fullwidth = ( $atts['fullwidth'] === 'yes' ) ? 'is-fullwidth' : '';
		if ( $atts['type'] === 'close' ) {
			$button = '<button class="ds-button ds-close-popup ' . esc_attr( $size ) . ' ' . esc_attr( $fullwidth ) . '" style="color:' . esc_attr( $atts['color'] ) . '; background:' . esc_attr( $atts['bgcolor'] ) . '">' . esc_html( $content ) . '</button>';
		} elseif ( $atts['type'] === 'link' ) {
			$button = '<a href="' . esc_url( $atts['link'] ) . '" target="' . esc_attr( $atts['target'] ) . '" class="ds-button ' . esc_attr( $size ) . ' ' . esc_attr( $fullwidth ) . '" style="color:' . esc_attr( $atts['color'] ) . '; background:' . esc_attr( $atts['bgcolor'] ) . '">' . esc_attr( $content ) . '</a>';
		}

		return $button;
	}

	function iframe_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'link'   => '',
			'width'  => '560',
			'height' => '450',
			'attr'   => '',
		), $atts, 'iframeBox' );

		$iframe = '<iframe width="' . esc_attr( $atts['width'] ) . '" height="' . esc_attr( $atts['height'] ) . '" src="' . esc_url( $atts['link'] ) . '" ' . wp_kses_post( $atts['attr'] ) . '></iframe>';

		return $iframe;
	}

}

new WOWP_Shortcodes;
