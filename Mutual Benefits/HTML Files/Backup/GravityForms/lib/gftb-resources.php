<?php
/**
 * Display the resource links for the "Gravity Forms Group".
 *
 * @package    Gravity Forms Toolbar
 * @subpackage Resources
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright 2012, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://genesisthemes.de/en/wp-plugins/gravity-forms-toolbar/
 * @link       http://twitter.com/deckerweb
 *
 * @since 1.0.0
 */

/**
 * Resource links collection.
 *
 * @since 1.0.0
 */
$menu_items_help = array(
	/** Support section */
	'gfsupport' => array(
		'parent' => $gfgroup_check_item,
		'title'  => __( 'Support Forums', 'gravity-forms-toolbar' ),
		'href'   => 'http://www.gravityhelp.com/forums/',
		'meta'   => array( 'title' => __( 'Support Forums', 'gravity-forms-toolbar' ) )
	),
	'gfsearch' => array(
		'parent' => $gfsupport,
		'title'  => __( 'Advanced Forum Search', 'gravity-forms-toolbar' ),
		'href'   => 'http://www.gravityhelp.com/forums/search.php?q=',
		'meta'   => array( 'title' => __( 'Advanced Forum Search', 'gravity-forms-toolbar' ) )
	),

	/**
	 * Here 2 more items hook in (parent = $gfsupport) - we have to move them to end
	 * to be able to run conditional queries and changing their position
	 *
	 * @since 1.1.0
	 */

	/** Documentation section */
	'gfdocs' => array(
		'parent' => $gfgroup_check_item,
		'title'  => __( 'Documentation', 'gravity-forms-toolbar' ),
		'href'   => 'http://www.gravityhelp.com/documentation/',
		'meta'   => array( 'title' => __( 'Documentation', 'gravity-forms-toolbar' ) )
	),
	'gfdocs-css' => array(
		'parent' => $gfdocs,
		'title'  => __( 'Visual CSS Guide', 'gravity-forms-toolbar' ),
		'href'   => 'http://www.gravityhelp.com/gravity-forms-css-visual-guide/',
		'meta'   => array( 'title' => __( 'Visual CSS Guide', 'gravity-forms-toolbar' ) )
	),
	'gfdocs-css-targeting' => array(
		'parent' => $gfdocs,
		'title'  => __( 'CSS: Targeting Specific Elements', 'gravity-forms-toolbar' ),
		'href'   => 'http://www.rocketgenius.com/gravity-forms-css-targeting-specific-elements/',
		'meta'   => array( 'title' => __( 'CSS: Targeting Specific Elements', 'gravity-forms-toolbar' ) )
	),
	'gfdocs-plugin-cssselector' => array(
		'parent' => $gfdocs,
		'title'  => __( 'CSS Plugin: CSS Ready Class Selector', 'gravity-forms-toolbar' ),
		'href'   => 'http://wordpress.org/extend/plugins/gravity-forms-css-ready-selector/',
		'meta'   => array( 'title' => __( 'CSS Plugin: CSS Ready Class Selector', 'gravity-forms-toolbar' ) )
	),
	'gfdocs-eventscalendar' => array(
		'parent' => $gfdocs,
		'title'  => __( 'Gravity Forms + Events Calendar Submissions', 'gravity-forms-toolbar' ),
		'href'   => 'http://creativeslice.com/tutorials/gravity-forms-events-calendar-submissions/',
		'meta'   => array( 'title' => _x( 'Gravity Forms + Events Calendar Submissions (creativeslice.com)', 'Translators: For the tooltip', 'gravity-forms-toolbar' ) )
	),
	'gfdocs-gwztutorials' => array(
		'parent' => $gfdocs,
		'title'  => __( 'Tutorials (Gravity Wiz)', 'gravity-forms-toolbar' ),
		'href'   => 'http://gravitywiz.com/category/tutorials/',
		'meta'   => array( 'title' => _x( 'Tutorials (Gravity Wiz)', 'Translators: For the tooltip', 'gravity-forms-toolbar' ) )
	),
	'gfdocs-gwzsnippets' => array(
		'parent' => $gfdocs,
		'title'  => __( 'Snippets (Gravity Wiz)', 'gravity-forms-toolbar' ),
		'href'   => 'http://gravitywiz.com/category/snippets/',
		'meta'   => array( 'title' => _x( 'Snippets (Gravity Wiz)', 'Translators: For the tooltip', 'gravity-forms-toolbar' ) )
	),
	'gfdocs-wpstutorials-wpssnippets' => array(
		'parent' => $gfdocs,
		'title'  => __( 'Dev Tutorials &amp; Code Snippets', 'gravity-forms-toolbar' ),
		'href'   => 'http://wpsmith.net/tag/gravity-forms/',
		'meta'   => array( 'title' => _x( 'Dev Tutorials &amp; Code Snippets (wpsmith.net)', 'Translators: For the tooltip', 'gravity-forms-toolbar' ) )
	),

	/** FAQ section */
	'gffaq' => array(
		'parent' => $gfgroup_check_item,
		'title'  => __( 'FAQ', 'gravity-forms-toolbar' ),
		'href'   => 'http://www.gravityhelp.com/frequently-asked-questions/',
		'meta'   => array( 'title' => __( 'FAQ', 'gravity-forms-toolbar' ) )
	),
	'gffaq-installation' => array(
		'parent' => $gffaq,
		'title'  => __( 'Installation', 'gravity-forms-toolbar' ),
		'href'   => 'http://www.gravityhelp.com/frequently-asked-questions/faq-installation/',
		'meta'   => array( 'title' => __( 'Installation', 'gravity-forms-toolbar' ) )
	),
	'gffaq-usinggf' => array(
		'parent' => $gffaq,
		'title'  => __( 'Using Gravity Forms', 'gravity-forms-toolbar' ),
		'href'   => 'http://www.gravityhelp.com/frequently-asked-questions/faq-using-gravity-forms/',
		'meta'   => array( 'title' => __( 'Using Gravity Forms', 'gravity-forms-toolbar' ) )
	),
	'gffaq-format' => array(
		'parent' => $gffaq,
		'title'  => __( 'Formatting &amp; Styling', 'gravity-forms-toolbar' ),
		'href'   => 'http://www.gravityhelp.com/frequently-asked-questions/faq-styling-formatting/',
		'meta'   => array( 'title' => __( 'Formatting &amp; Styling', 'gravity-forms-toolbar' ) )
	),
	'gffaq-notifications' => array(
		'parent' => $gffaq,
		'title'  => __( 'Notifications', 'gravity-forms-toolbar' ),
		'href'   => 'http://www.gravityhelp.com/frequently-asked-questions/faq-notifications/',
		'meta'   => array( 'title' => __( 'Notifications', 'gravity-forms-toolbar' ) )
	),
	'gffaq-general' => array(
		'parent' => $gffaq,
		'title'  => __( 'General Questions', 'gravity-forms-toolbar' ),
		'href'   => 'http://www.gravityhelp.com/frequently-asked-questions/faq-general-questions/',
		'meta'   => array( 'title' => __( 'General Questions', 'gravity-forms-toolbar' ) )
	),

	/** Gravity Forms HQ section */
	'gfsites' => array(
		'parent' => $gfgroup_check_item,
		'title'  => __( 'Gravity Forms HQ', 'gravity-forms-toolbar' ),
		'href'   => 'http://www.gravityforms.com/',
		'meta'   => array( 'title' => __( 'Gravity Forms HQ', 'gravity-forms-toolbar' ) )
	),
	'gffeatures' => array(
		'parent' => $gfsites,
		'title'  => __( 'Feature List & Demonstration', 'gravity-forms-toolbar' ),
		'href'   => 'http://www.gravityforms.com/features/form-builder/',
		'meta'   => array( 'title' => __( 'Feature List & Demonstration', 'gravity-forms-toolbar' ) )
	),
	'gfblog' => array(
		'parent' => $gfsites,
		'title'  => __( 'Official Blog', 'gravity-forms-toolbar' ),
		'href'   => 'http://www.gravityhelp.com/',
		'meta'   => array( 'title' => __( 'Official Blog', 'gravity-forms-toolbar' ) )
	),
	'gfaddons-web' => array(
		'parent' => $gfsites,
		'title'  => __( 'Official Add-Ons Info', 'gravity-forms-toolbar' ),
		'href'   => 'http://www.gravityforms.com/add-ons/',
		'meta'   => array( 'title' => __( 'Official Add-Ons Info', 'gravity-forms-toolbar' ) )
	),
	'gfplugins' => array(
		'parent' => $gfsites,
		'title'  => __( 'More free plugins/extensions at WP.org', 'gravity-forms-toolbar' ),
		'href'   => 'http://wordpress.org/extend/plugins/search.php?q=gravity+forms',
		'meta'   => array( 'title' => __( 'More free plugins/extensions at WP.org', 'gravity-forms-toolbar' ) )
	),
	'gfffnews' => array(
		'parent' => $gfsites,
		'title'  => __( 'Gravity Forms News Planet', 'gravity-forms-toolbar' ),
		'href'   => 'http://friendfeed.com/gravityforms-news',
		'meta'   => array( 'title' => __( 'Gravity Forms News Planet (official and community news via FriendFeed service)', 'gravity-forms-toolbar' ) )
	),
);

$menu_items = $menu_items_help;
