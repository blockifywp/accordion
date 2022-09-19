<?php
/**
 * Plugin Name: Blockify Accordion
 * Plugin URI:  https://blockifywp.com/blocks/accordion
 * Description: Lightweight, customizable accordion block for WordPress.
 * Author:      Blockify
 * Author URI:  https://blockifywp.com/
 * Version:     0.0.1
 * License:     GPLv2-or-Later
 * Text Domain: blockify
 */

declare( strict_types=1 );

namespace Blockify\Accordion;

const NS = __NAMESPACE__ . '\\';
const DS = DIRECTORY_SEPARATOR;

use DOMElement;
use function add_action;
use function register_block_type;
use function str_contains;
use function defined;
use function libxml_clear_errors;
use function libxml_use_internal_errors;
use function mb_convert_encoding;
use DOMDocument;

add_action( 'init', NS . 'register' );
/**
 * Registers the block.
 *
 * @since 0.0.1
 *
 * @since 1.0.0
 *
 * @return void
 */
function register() : void {
	register_block_type( __DIR__ . '/build' );

	add_filter( 'block_categories_all', fn( array $categories ) : array => array_merge(
		$categories,
		[
			[
				'slug'  => 'blockify',
				'title' => __( 'Blockify', 'blockify' ),
			],
		]
	) );
}

add_filter( 'render_block_blockify/accordion', NS . 'render_accordion_block', 10, 2 );
/**
 * Modifies front end HTML output of block.
 *
 * @since 0.0.3
 *
 * @param string $content
 * @param array  $block
 *
 * @return string
 */
function render_accordion_block( string $content, array $block ): string {
	$dom = dom( $content );

	/**
	 * @var $div DOMElement
	 */
	$div = $dom->getElementsByTagName( 'div' )->item( 0 );

	$div->setAttribute( 'class', 'wp-block-blockify-accordion' );

	return $dom->saveHTML();
}


add_filter( 'render_block', NS . 'render_accordion_item_block', 10, 2 );
/**
 * Modifies front end HTML output of child blocks.
 *
 * @since 0.0.2
 *
 * @param string $content
 * @param array  $block
 *
 * @return string
 */
function render_accordion_item_block( string $content, array $block ): string {
	if ( 'blockify/accordion-item' !== $block['blockName'] ) {
		return $content;
	}

	if ( isset( $block['attrs']['className'] ) && str_contains( $block['attrs']['className'], 'is-style-open' ) ) {
		$dom = dom( $content );

		/** @var DOMElement $details */
		$details = $dom->firstChild;

		$details->setAttribute( 'open', '' );

		$content = $dom->saveHTML();
	}

	return $content;
}

/**
 * Returns a formatted DOMDocument object from a given string.
 *
 * @since 0.0.2
 *
 * @param string $html
 *
 * @return string
 */
function dom( string $html ): DOMDocument {
	$dom = new DOMDocument();

	if ( ! $html ) {
		return $dom;
	}

	$libxml_previous_state   = libxml_use_internal_errors( true );
	$dom->preserveWhiteSpace = true;

	if ( defined( 'LIBXML_HTML_NOIMPLIED' ) && defined( 'LIBXML_HTML_NODEFDTD' ) ) {
		$options = LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD;
	} else if ( defined( 'LIBXML_HTML_NOIMPLIED' ) ) {
		$options = LIBXML_HTML_NOIMPLIED;
	} else if ( defined( 'LIBXML_HTML_NODEFDTD' ) ) {
		$options = LIBXML_HTML_NODEFDTD;
	} else {
		$options = 0;
	}

	$dom->loadHTML( mb_convert_encoding( $html, 'HTML-ENTITIES', 'UTF-8' ), $options );

	$dom->formatOutput = true;

	libxml_clear_errors();
	libxml_use_internal_errors( $libxml_previous_state );

	return $dom;
}
