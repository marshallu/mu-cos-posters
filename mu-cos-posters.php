<?php
/**
 * MU COS Posters
 *
 * College of Science printed posters cost calculator.
 *
 * @package  MU COS Posters
 *
 * Plugin Name:  MU COS Posters
 * Plugin URI: https://www.marshall.edu
 * Description: College of Science printed posters cost calculator.
 * Version: 1.0
 * Author: Christopher McComas
 */

/**
 * The shortcode to display the poster cost calculator.
 *
 * @param array  $atts The array of attributes included with the shortcode.
 * @param string $content The HTML string for the shortcode.
 * @return string
 */
function mucos_poster_calculator_shortcode( $atts, $content = null ) {
	$data = shortcode_atts(
		array(
			'class'    => '',
		),
		$atts
	);

	$html  = '<div
		x-data="{
			\'height\': 36,
			\'width\': 48,
			\'estimates\': \'\',
			\'updating\': false,
			updateEstimates() {
				this.updating = true;
				fetch(\'https://netapps.marshall.edu/cosweb/posters/getPrices.php?w=\' + this.width + \'&h=\' + this.height + \'\')
				.then( data => { return data.json(); } )
				.then( programJson => { this.estimates = programJson.estimates; this.height = programJson.height; this.width = programJson.width; this.updating = false; } )
			}
		}"
		x-init="updateEstimates()"
	>';
	$html .= '<form x-on:submit.prevent="updateEstimates()" class="cositc-poster-estimate-calculator">';
	$html .= '<div class="form-row">';
	$html .= '<label class="mr-2" for="cositc-poster-width">Poster width:</label>';
	$html .= '<input x-on:change="updateEstimates()" x-bind:disable="updating" class="text-input w-16" type="number" x-model="width">';
	$html .= '<span class="ml-2">inches</span>';
	$html .= '</div>';
	$html .= '<div class="mt-3">';
	$html .= '<label class="mr-2" for="cositc-poster-height">Poster height:</label>';
	$html .= '<input x-on:change="updateEstimates()" x-bind:disable="updating" class="text-input w-16" type="number" x-model="height">';
	$html .= '<span class="ml-2">inches</span>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '<div>';
	$html .= '<table class="table w-full table-bordered table-striped" x-cloak>';
	$html .= '<thead>';
	$html .= '<tr>';
	$html .= '<th>Media</th>';
	$html .= '<th>Cost</th>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';
	$html .= '<template x-for="estimate in estimates">';
	$html .= '<tr>';
	$html .= '<td x-text="estimate.media"></td>';
	$html .= '<td x-text="`$${estimate.cost}`"></td>';
	$html .= '</tr>';
	$html .= '</template>';
	$html .= '</tbody>';
	$html .= '</table>';
	$html .= '</div>';
	$html .= '</div>';
	return $html;
}
add_shortcode( 'mucos-poster-calculator-new', 'mucos_poster_calculator_shortcode' );

/**
 * Proper way to enqueue scripts and styles
 */
function mu_cos_posts_enqueue_scrips() {
	wp_enqueue_style( 'mu-cos-posters', plugin_dir_url( __FILE__ ) . 'css/mu-cos-posters.css', '', true );
}
add_action( 'wp_enqueue_scripts', 'mu_cos_posts_enqueue_scrips' );
