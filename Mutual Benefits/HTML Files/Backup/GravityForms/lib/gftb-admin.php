<?php
/**
 * Helper functions for the admin - plugin links.
 *
 * @package    Gravity Forms Toolbar
 * @subpackage Admin
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright 2012, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://genesisthemes.de/en/wp-plugins/gravity-forms-toolbar/
 * @link       http://twitter.com/deckerweb
 *
 * @since 1.0.0
 */

/**
 * Setting internal plugin helper links constants.
 *
 * @since 1.5.0
 */
define( 'GFTB_URL_TRANSLATE',		'http://translate.wpautobahn.com/projects/genesis-plugins-deckerweb/gravity-forms-toolbar' );
define( 'GFTB_URL_WPORG_FAQ',		'http://wordpress.org/extend/plugins/gravity-forms-toolbar/faq/' );
define( 'GFTB_URL_WPORG_FORUM',		'http://wordpress.org/support/plugin/gravity-forms-toolbar' );
define( 'GFTB_URL_WPORG_PROFILE',	'http://profiles.wordpress.org/daveshine/' );
define( 'GFTB_URL_SUGGESTIONS',		'http://twitter.com/deckerweb' );
define( 'GFTB_URL_SNIPPETS',		'https://gist.github.com/2732242' );
define( 'GFTB_PLUGIN_LICENSE', 		'GPLv2+' );
if ( get_locale() == 'de_DE' || get_locale() == 'de_AT' || get_locale() == 'de_CH' || get_locale() == 'de_LU' ) {
	define( 'GFTB_URL_DONATE', 	'http://genesisthemes.de/spenden/' );
	define( 'GFTB_URL_PLUGIN',	'http://genesisthemes.de/plugins/gravity-forms-toolbar/' );
} else {
	define( 'GFTB_URL_DONATE', 	'http://genesisthemes.de/en/donate/' );
	define( 'GFTB_URL_PLUGIN',	'http://genesisthemes.de/en/wp-plugins/gravity-forms-toolbar/' );
}


/**
 * Add "Settings" link to plugin page
 *
 * @since 1.4.0
 *
 * @param  $gftb_links
 * @param  $gftb_settings_link
 *
 * @return strings settings link
 */
function ddw_gftb_settings_page_link( $gftb_links ) {

	/** Plugin's settings page link */
	$gftb_settings_link = sprintf( '<a href="%s" title="%s">%s</a>' , admin_url( 'options-general.php?page=ddw_gftb_options_page' ) , __( 'Go to the settings page', 'gravity-forms-toolbar' ) , __( 'Settings', 'gravity-forms-toolbar' ) );

	/** Set the order of the links */
	array_unshift( $gftb_links, $gftb_settings_link );

	/** Display plugin settings links */
	return $gftb_links;

}  // end of function ddw_gftb_settings_page_link


add_filter( 'plugin_row_meta', 'ddw_gftb_plugin_links', 10, 2 );
/**
 * Add various support links to plugin page
 *
 * @since 1.0.0
 *
 * @param  $gftb_links
 * @param  $gftb_file
 *
 * @return strings plugin links
 */
function ddw_gftb_plugin_links( $gftb_links, $gftb_file ) {

	/** Capability check */
	if ( ! current_user_can( 'install_plugins' ) ) {

		return $gftb_links;

	}  // end-if cap check

	/** List additional links only for this plugin */
	if ( $gftb_file == GFTB_PLUGIN_BASEDIR . '/gravity-forms-toolbar.php' ) {

		$gftb_links[] = '<a href="' . esc_url_raw( GFTB_URL_WPORG_FAQ ) . '" target="_new" title="' . __( 'FAQ', 'gravity-forms-toolbar' ) . '">' . __( 'FAQ', 'gravity-forms-toolbar' ) . '</a>';
		$gftb_links[] = '<a href="' . esc_url_raw( GFTB_URL_WPORG_FORUM ) . '" target="_new" title="' . __( 'Support', 'gravity-forms-toolbar' ) . '">' . __( 'Support', 'gravity-forms-toolbar' ) . '</a>';
		$gftb_links[] = '<a href="' . esc_url_raw( GFTB_URL_TRANSLATE ) . '" target="_new" title="' . __( 'Translations', 'gravity-forms-toolbar' ) . '">' . __( 'Translations', 'gravity-forms-toolbar' ) . '</a>';
		$gftb_links[] = '<a href="' . esc_url_raw( GFTB_URL_DONATE ) . '" target="_new" title="' . __( 'Donate', 'gravity-forms-toolbar' ) . '"><strong>' . __( 'Donate', 'gravity-forms-toolbar' ) . '</strong></a>';

	}  // end-if plugin links

	/** Output the links */
	return $gftb_links;

}  // end of function ddw_gftb_plugin_links


add_action( 'load-settings_page_ddw_gftb_options_page', 'ddw_gftb_gravityforms_help_tab' );
/**
 * Create and display plugin help tab.
 *
 * @since 1.5.0
 *
 * @global mixed $gftb_gravityforms_screen
 */
function ddw_gftb_gravityforms_help_tab() {

	global $gftb_gravityforms_screen;

	$gftb_gravityforms_screen = get_current_screen();

	/** Display help tabs only for WordPress 3.3 or higher */
	if ( ! class_exists( 'WP_Screen' )
		|| ! $gftb_gravityforms_screen
		|| ! GFTB_DISPLAY
	) {
		return;
	}

	/** Add the help tab */
	$gftb_gravityforms_screen->add_help_tab( array(
		'id'       => 'gftb-gravityforms-help',
		'title'    => __( 'Gravity Forms Toolbar', 'gravity-forms-toolbar' ),
		'callback' => 'ddw_gftb_gravityforms_help_tab_content',
	) );

	/** Add help sidebar */
	$gftb_gravityforms_screen->set_help_sidebar(
		'<p><strong>' . __( 'More about the plugin author', 'gravity-forms-toolbar' ) . '</strong></p>' .
		'<p>' . __( 'Social:', 'gravity-forms-toolbar' ) . '<br /><a href="http://twitter.com/deckerweb" target="_blank" title="@ Twitter">Twitter</a> | <a href="http://www.facebook.com/deckerweb.service" target="_blank" title="@ Facebook">Facebook</a> | <a href="http://deckerweb.de/gplus" target="_blank" title="@ Google+">Google+</a> | <a href="' . esc_url_raw( ddw_gftb_plugin_get_data( 'AuthorURI' ) ) . '" target="_blank" title="@ deckerweb.de">deckerweb</a></p>' .
		'<p><a href="' . esc_url_raw( GFTB_URL_WPORG_PROFILE ) . '" target="_blank" title="@ WordPress.org">@ WordPress.org</a></p>'
	);

}  // end of function ddw_gftb_gravityforms_help_tab


/**
 * Create and display plugin help tab content.
 *
 * @since 1.5.0
 */
function ddw_gftb_gravityforms_help_tab_content() {

	echo '<h3>' . __( 'Plugin', 'gravity-forms-toolbar' ) . ': ' . __( 'Gravity Forms Toolbar', 'gravity-forms-toolbar' ) . ' <small>v' . esc_attr( ddw_gftb_plugin_get_data( 'Version' ) ) . '</small></h3>' .		
		'<ul>' . 
			'<li><a href="' . esc_url_raw( GFTB_URL_SUGGESTIONS ) . '" target="_new" title="' . __( 'Suggest new resource items or Add-Ons/ plugins for support', 'gravity-forms-toolbar' ) . '">' . __( 'Suggest new resource items or Add-Ons/ plugins for support', 'gravity-forms-toolbar' ) . '</a></li>' .
			'<li><a href="' . esc_url_raw( GFTB_URL_SNIPPETS ) . '" target="_new" title="' . __( 'Code snippets for customizing &amp; branding', 'gravity-forms-toolbar' ) . '">' . __( 'Code snippets for customizing &amp; branding', 'gravity-forms-toolbar' ) . '</a></li>';

		/** Optional: recommended plugins */
		if ( ! class_exists( 'GFCPTAddon' ) ||
			! class_exists( 'GFReadyClassesAddon' ) ||
			! function_exists( 'gfe_init' ) /* ! class_exists( 'GFEntryDetail' ) */
		) {

			echo '<li><em>' . __( 'Other, recommended Gravity Forms plugins', 'gravity-forms-toolbar' ) . '</em>:';

			if ( ! class_exists( 'GFCPTAddon' ) ) {

				echo '<br />&raquo; <a href="http://wordpress.org/extend/plugins/gravity-forms-custom-post-types/" target="_new" title="Gravity Forms + Custom Post Types">Gravity Forms + Custom Post Types</a> &mdash; ' . __( 'map forms that create posts to a custom post type, also map dropdown select, radio buttons list and checkboxes lists to a custom taxonomy', 'gravity-forms-toolbar' );

			}  // end-if plugin check

			if ( ! class_exists( 'GFReadyClassesAddon' ) ) {

				echo '<br />&raquo; <a href="http://wordpress.org/extend/plugins/gravity-forms-css-ready-selector/" target="_new" title="Gravity Forms CSS Ready Class Selector">Gravity Forms CSS Ready Class Selector</a> &mdash; ' . __( 'easily select a CSS "Ready Class" for your fields within Gravity Forms', 'gravity-forms-toolbar' );

			}  // end-if plugin check

			if ( ! function_exists( 'gfe_init' ) ) {

				echo '<br />&raquo; <a href="http://wordpress.org/extend/plugins/gravity-forms-pdf-extended/" target="_new" title="Gravity Forms PDF Extended">Gravity Forms PDF Extended</a> &mdash; ' . __( 'save/view/download a PDF from the front- and back-end, and automate PDF creation on form submission', 'gravity-forms-toolbar' );

			}  // end-if plugin check

			echo '</li>';

		}  // end-if plugins check

	echo '<li><em>' . __( 'Miscellaneous', 'gravity-forms-toolbar' ) . ':</em>' .
		'<br /><a href="http://friendfeed.com/gravityforms-news" target="_new" title="' . __( 'Gravity Forms News Planet', 'gravity-forms-toolbar' ) . '">' . __( 'Gravity Forms News Planet (official and community news via FriendFeed service)', 'gravity-forms-toolbar' ) .
		'</li>';

	echo '</ul>' .
		'<p><strong>' . __( 'Important plugin links:', 'gravity-forms-toolbar' ) . '</strong>' . 
		'<br /><a href="' . esc_url_raw( GFTB_URL_PLUGIN ) . '" target="_new" title="' . __( 'Plugin website', 'gravity-forms-toolbar' ) . '">' . __( 'Plugin website', 'gravity-forms-toolbar' ) . '</a> | <a href="' . esc_url_raw( GFTB_URL_WPORG_FAQ ) . '" target="_new" title="' . __( 'FAQ', 'gravity-forms-toolbar' ) . '">' . __( 'FAQ', 'gravity-forms-toolbar' ) . '</a> | <a href="' . esc_url_raw( GFTB_URL_WPORG_FORUM ) . '" target="_new" title="' . _x( 'Support', 'Translators: Plugin support links', 'gravity-forms-toolbar' ) . '">' . _x( 'Support', 'Translators: Plugin support links', 'gravity-forms-toolbar' ) . '</a> | <a href="' . esc_url_raw( GFTB_URL_TRANSLATE ) . '" target="_new" title="' . __( 'Translations', 'gravity-forms-toolbar' ) . '">' . __( 'Translations', 'gravity-forms-toolbar' ) . '</a> | <a href="' . esc_url_raw( GFTB_URL_DONATE ) . '" target="_new" title="' . __( 'Donate', 'gravity-forms-toolbar' ) . '"><strong>' . __( 'Donate', 'gravity-forms-toolbar' ) . '</strong></a></p>' .
		'<p><a href="http://www.opensource.org/licenses/gpl-license.php" target="_new" title="' . esc_attr( GFTB_PLUGIN_LICENSE ). '">' . esc_attr( GFTB_PLUGIN_LICENSE ). '</a> &copy; ' . date( 'Y' ) . ' <a href="' . esc_url_raw( ddw_gftb_plugin_get_data( 'AuthorURI' ) ) . '" target="_new" title="' . esc_attr__( ddw_gftb_plugin_get_data( 'Author' ) ) . '">' . esc_attr__( ddw_gftb_plugin_get_data( 'Author' ) ) . '</a></p>';

}  // end of function ddw_gftb_gravityforms_help_tab_content
