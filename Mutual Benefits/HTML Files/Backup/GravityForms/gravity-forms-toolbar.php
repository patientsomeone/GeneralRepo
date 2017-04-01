<?php 
/**
 * Main plugin file.
 * This plugin adds useful admin links and resources for Gravity Forms to the WordPress Toolbar / Admin Bar.
 *
 * @package   Gravity Forms Toolbar
 * @author    David Decker
 * @link      http://twitter.com/deckerweb
 * @author    Milan Petrovic
 * @link      http://twitter.com/milangd
 * @copyright Copyright 2012, David Decker - DECKERWEB
 *
 * @credits   Inspired and based on the plugin "WooThemes Admin Bar Addition" by Remkus de Vries @defries.
 * @link      http://remkusdevries.com/
 * @link      http://twitter.com/defries
 *
 * Plugin Name: Gravity Forms Toolbar
 * Plugin URI: http://genesisthemes.de/en/wp-plugins/gravity-forms-toolbar/
 * Description: This plugin adds useful admin links and resources for Gravity Forms to the WordPress Toolbar / Admin Bar.
 * Version: 1.5.1
 * Author: David Decker - DECKERWEB / Milan Petrovic - Dev4Press
 * Author URI: http://deckerweb.de/
 * License: GPLv2 or later
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 * Text Domain: gravity-forms-toolbar
 * Domain Path: /languages/
 *
 * Copyright 2012 David Decker - DECKERWEB
 *
 *     This file is part of Gravity Forms Toolbar,
 *     a plugin for WordPress.
 *
 *     Gravity Forms Toolbar is free software:
 *     You can redistribute it and/or modify it under the terms of the
 *     GNU General Public License as published by the Free Software
 *     Foundation, either version 2 of the License, or (at your option)
 *     any later version.
 *
 *     Gravity Forms Toolbar is distributed in the hope that
 *     it will be useful, but WITHOUT ANY WARRANTY; without even the
 *     implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR
 *     PURPOSE. See the GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with WordPress. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Setting constants
 *
 * @since 1.0.0
 */
/** Plugin directory */
define( 'GFTB_PLUGIN_DIR', dirname( __FILE__ ) );

/** Plugin base directory */
define( 'GFTB_PLUGIN_BASEDIR', dirname( plugin_basename( __FILE__ ) ) );


add_action( 'init', 'ddw_gftb_init' );
/**
 * Load the text domain for translation of the plugin.
 * Load admin settings & helper functions - only within 'wp-admin'.
 * 
 * @since 1.0.0
 */
function ddw_gftb_init() {

	/** First look in WordPress' "languages" folder = custom & update-secure! */
	load_plugin_textdomain( 'gravity-forms-toolbar', false, GFTB_PLUGIN_BASEDIR . '/../../languages/gravity-forms-toolbar/' );

	/** Then look in plugin's "languages" folder = default */
	load_plugin_textdomain( 'gravity-forms-toolbar', false, GFTB_PLUGIN_BASEDIR . '/languages/' );

	/** If 'wp-admin' include admin functions */
	if ( is_admin() ) {

		/** Admin settings */
		require_once( GFTB_PLUGIN_DIR . '/admin/admin.php' );

		/** Plugin links */
		require_once( GFTB_PLUGIN_DIR . '/lib/gftb-admin.php' );
	}

	/** Add "Settings Page" link to plugin page - only within 'wp-admin' */
	if ( is_admin() && ( current_user_can( 'gravityforms_edit_forms' ) || current_user_can( 'gform_full_access' ) ) ) {
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ) , 'ddw_gftb_settings_page_link' );
	}

	/** Define constants and set defaults for removing all or certain sections */
	if ( ! defined( 'GFTB_DISPLAY' ) ) {
		define( 'GFTB_DISPLAY', TRUE );
	}

	if ( ! defined( 'GFTB_ADDONS_DISPLAY' ) ) {
		define( 'GFTB_ADDONS_DISPLAY', TRUE );
	}

	if ( ! defined( 'GFTB_EXTENSIONS_DISPLAY' ) ) {
		define( 'GFTB_EXTENSIONS_DISPLAY', TRUE );
	}

	if ( ! defined( 'GFTB_RESOURCES_DISPLAY' ) ) {
		define( 'GFTB_RESOURCES_DISPLAY', TRUE );
	}

	if ( ! defined( 'GFTB_DE_DISPLAY' ) ) {
		define( 'GFTB_DE_DISPLAY', TRUE );
	}

	if ( ! defined( 'GFTB_NL_DISPLAY' ) ) {
		define( 'GFTB_NL_DISPLAY', TRUE );
	}

}  // end of function ddw_gftb_init


/**
 * Get default plugin options.
 *
 * @since 1.2.0
 *
 * @return array 
 */
function ddw_gftb_default_options() {

	return array(
		'help_and_support'    => true,
		'extensions'          => true,
		'forms_details'       => true,
		'add_ons'             => true,
		'update_notification' => true,
		'unread_notification' => true,
		'toolbar_admin'       => true,
		'toolbar_frontend'    => true
	);

}  // end of function ddw_gftb_default_options


/**
 * Get current plugin options.
 *
 * @since 1.2.0
 *
 * @return array 
 */
function ddw_gftb_get_options() {
	$from_db = get_option( 'ddw_gftb' );
	$default = ddw_gftb_default_options();
	return wp_parse_args( $from_db, $default );
}


add_action( 'admin_bar_menu', 'ddw_gftb_admin_bar_menu', 98 );
/**
 * Add new menu items to the WordPress Toolbar / Admin Bar.
 * 
 * @since 1.0.0
 *
 * @global mixed $wp_admin_bar
 */
function ddw_gftb_admin_bar_menu() {

	global $wp_admin_bar;

	/**
	 * Allows for filtering the general user role/capability to display main & sub-level items
	 *
	 * Default capability: 'gravityforms_edit_forms' or 'gform_full_access' (set by Gravity Forms plugin itself!)
	 *
	 * @since 1.4.0
	 */
	$gftb_init_cap_check = current_user_can( 'gravityforms_edit_forms' ) ? 'gravityforms_edit_forms' : 'gform_full_access';

	$gftb_filter_capability = apply_filters( 'gftb_filter_capability_all', $gftb_init_cap_check );

	/**
	 * Required Gravity Forms/ WordPress cabability to display new admin bar entry
	 * Only showing items if toolbar / admin bar is activated and user is logged in!
	 *
	 * @since 1.3.0
	 */
	if ( ! is_user_logged_in()
		|| ! is_admin_bar_showing()
		|| ! current_user_can( $gftb_filter_capability )	// allows for custom filtering the required role/capability
		|| ! GFTB_DISPLAY	// allows for custom disabling
	) {
		return;
	}

	/** Defaults for plugin's options */
        $options = ddw_gftb_get_options();

	if ( ( is_admin() && ! $options['toolbar_admin'] ) || ( ! is_admin() && ! $options['toolbar_frontend'] ) ) {
		return;
	}

        $update = $options['update_notification'] ? ddw_gftb_update_available() : false;

        $forms = array();
        $count = 0;

        if ( class_exists( 'RGForms' )
		&& $options['forms_details']
		&& ( current_user_can( 'gform_full_access' ) || current_user_can( 'gravityforms_edit_forms' ) )
	) {
		$forms = RGFormsModel::get_form_summary();
        }

	/** Set unique prefix */
	$prefix = 'ddw-gravityforms-';
	
	/** Create parent menu item references */
	$gravitybar = $prefix . 'toolbar';			// root level
	$gfsupport = $prefix . 'gfsupport';				// sub level: support
	$gfdocs = $prefix . 'gfdocs';					// sub level: documentation
	$gffaq = $prefix . 'gffaq';					// sub level: faq
	$gfsites = $prefix . 'gfsites';					// sub level: gf websites
	$gfsettings = $prefix . 'gfsettings';				// sub level: main settings
	$gfforms = $prefix . 'gfforms';					// sub level: forms
	$gfentries = $prefix . 'gfentries';				// sub level: entries
	$gfimportexport = $prefix . 'gfimportexport';			// sub level: import/export
	$gfaddonsinstalled = $prefix . 'gfaddonsinstalled';		// sub level: add-ons (dummy)
		$gfaoauthorizenet = $prefix . 'gfaoauthorizenet';		// third level add-on: authorize.net
		$gfaoaweber = $prefix . 'gfaoaweber';				// third level add-on: aweber
		$gfaocampaignmonitor = $prefix . 'gfaocampaignmonitor';		// third level add-on: campaign monitor
		$gfaofreshbooks = $prefix . 'gfaofreshbooks';			// third level add-on: freshbooks
		$gfaomailchimp = $prefix . 'gfaomailchimp';			// third level add-on: mailchimp
		$gfaopaypal = $prefix . 'gfaopaypal';				// third level add-on: payal
		$gfaopaypalpro = $prefix . 'gfaopaypalpro';			// third level add-on: payal pro
		$gfaotwilio = $prefix . 'gfaotwilio';				// third level add-on: twilio
		$gfaouserreg = $prefix . 'gfaouserreg';				// third level add-on: user reg.
		$gftpaopideal = $prefix . 'gftpaopideal';			// third level third-party add-on: pronamic ideal
		$gftpaostripe = $prefix . 'gftpaostripe';			// third level third-party add-on: stripe
		$gftpaoshootq = $prefix . 'gftpaoshootq';			// third level third-party add-on: shootq
		$gftpaoconstantcontact = $prefix . 'gftpaoconstantcontact';	// third level third-party add-on: constant contact
		$gftpaoicontact = $prefix . 'gftpaoicontact';			// third level third-party add-on: icontact
		$gftpaomadmimi = $prefix . 'gftpaomadmimi';			// third level third-party add-on: madmimi
		$gftpaoexacttarget = $prefix . 'gftpaoexacttarget';		// third level third-party add-on: exacttarget
		$gftpaoinfusionsoft = $prefix . 'gftpaoinfusionsoft';		// third level third-party add-on: infusionsoft
		$gftpaoymlp = $prefix . 'gftpaoymlp';				// third level third-party add-on: ymlp
	$extensions = $prefix . 'extensions';				// sub level: extensions (very last main entry)
		$extpideal = $prefix . 'extpideal';				// third level third-party add-on: pronamic ideal
		$extgfsolve360 = $prefix . 'extgfsolve360';			// third level third-party add-on: solve360
	$gfgroup = $prefix . 'gfgroup';					// sub level: gf group (resources)

	/**
	 * Check for WordPress version to add parent ids for resource links group
	 * Check against WP 3.3+ only function 'wp_editor' - if true use "$wcgroup" as parent (WP 3.3+ style)
	 * otherwise use "$gravitybar" as parent (WP 3.1/3.2 style)
	 *
	 * @since 1.3.0
	 *
	 * @param $wcgroup_check_item
	 */
	if ( function_exists( 'wp_editor' ) ) {
		$gfgroup_check_item = $gfgroup;
	} else {
		$gfgroup_check_item = $gravitybar;
	}

	/** Display these items also when Gravity Forms plugin is not installed*/
        $menu_items = array();

		/** Display items depending on plugin setting */
		if ( $options['help_and_support'] && GFTB_RESOURCES_DISPLAY ) {

			/** Include plugin file with resources links */
			require_once( GFTB_PLUGIN_DIR . '/lib/gftb-resources.php' );

		}  // end-if help & support items


	/**
	 * Display these support links only for users who can view Gravity Forms Settings
	 * Hook in as children of "Support" entry
	 *
	 * @since 1.1.0
	 */
	if ( current_user_can( 'gravityforms_view_settings' ) || current_user_can( 'gform_full_access' ) ) {
		/** User profile at Gravity Help */
		$menu_items['gfuprofile'] = array(
			'parent' => $gfsupport,
			'title'  => __( 'Your User Profile at Gravity Help', 'gravity-forms-toolbar' ),
			'href'   => 'http://www.gravityhelp.com/forums/profile/',
			'meta'   => array( 'title' => __( 'Your User Profile at Gravity Help', 'gravity-forms-toolbar' ) )
		);
		/** Priority support at Gravity Help */
		$menu_items['gfpriority'] = array(
			'parent' => $gfsupport,
			'title'  => __( 'Priority Support (Dev License Only)', 'gravity-forms-toolbar' ),
			'href'   => 'http://www.gravityhelp.com/priority-support/',
			'meta'   => array( 'title' => __( 'Priority Support (Dev License Only)', 'gravity-forms-toolbar' ) )
		);
	}  // end-if children of support entry


	/** Display links to language packs only for these locales: de_DE, de_AT, de_CH, de_LU */
	if ( GFTB_DE_DISPLAY && ( get_locale() == 'de_DE' || get_locale() == 'de_AT' || get_locale() == 'de_CH' || get_locale() == 'de_LU' ) ) {
		$menu_items['languages-de'] = array(
			'parent' => $gfgroup_check_item,
			'title'  => __( 'German language files', 'gravity-forms-toolbar' ),
			'href'   => 'http://deckerweb.de/material/sprachdateien/gravityforms-und-addons/',
			'meta'   => array( 'title' => __( 'German language files for Gravity Forms and Add-Ons', 'gravity-forms-toolbar' ) )
		);
	}  // end-if German locale


	/** Display links to language plugin only for this locale: nl, nl_NL - and when NL plugin not active */
	if ( GFTB_NL_DISPLAY && ( ( get_locale() == 'nl' || get_locale() == 'nl_NL' ) && !class_exists( 'GravityFormsNL' ) ) ) {
		$menu_items['languages-nl'] = array(
			'parent' => $gfgroup_check_item,
			'title'  => __( 'Dutch language plugin', 'gravity-forms-toolbar' ),
			'href'   => 'http://wordpress.org/extend/plugins/gravityforms-nl/',
			'meta'   => array( 'title' => __( 'Dutch language plugin', 'gravity-forms-toolbar' ) )
		);
	}  // end-if Dutch locale


	/** Show these items only if Gravity Forms main plugin is actually installed */
	if ( class_exists( 'RGForms' ) ) {

		/** Main Settings */
		if ( current_user_can( 'gravityforms_view_settings' ) || current_user_can( 'gform_full_access' ) ) {

			$menu_items['gfsettings'] = array(
				'parent' => $gravitybar,
				'title'  => __( 'Plugin Settings', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=gf_settings' ),
				'meta'   => array( 'target' => '', 'title' => _x( 'Plugin Settings', 'Translators: For the tooltip', 'gravity-forms-toolbar' ) )
			);
			$menu_items['gfs-toolbar'] = array(
				'parent' => $gfsettings,
				'title'  => __( 'Toolbar Menu', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'options-general.php?page=ddw_gftb_options_page' ),
				'meta'   => array( 'target' => '', 'title' => _x( 'Toolbar Menu', 'Translators: For the tooltip', 'gravity-forms-toolbar' ) )
			);
			$menu_items['gfs-widgets'] = array(
				'parent' => $gfsettings,
				'title'  => __( 'Manage Widgets', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'widgets.php' ),
				'meta'   => array( 'target' => '', 'title' => __( 'Manage Widgets', 'gravity-forms-toolbar' ) )
			);

			/** Check for "Members" plugin + appropiate capabilities, then display settings if activated */
			if ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'members/members.php' ) ) && current_user_can( 'edit_roles' ) ) {
				$menu_items['gfs-pmembers'] = array(
					'parent' => $gfsettings,
					'title'  => __( 'Adjust User Roles &amp; Capabilities (Plugin: Members)', 'gravity-forms-toolbar' ),
					'href'   => admin_url( 'users.php?page=roles' ),
					'meta'   => array( 'target' => '', 'title' => __( 'Adjust User Roles &amp; Capabilities (Plugin: Members)', 'gravity-forms-toolbar' ) )
				);
			}  // end-if members plugin check

		}  // end-if main settings

		/** Edit Forms */
		if ( current_user_can( 'gravityforms_edit_forms' ) || current_user_can( 'gform_full_access' ) ) {
			$menu_items['gfforms'] = array(
				'parent' => $gravitybar,
				'title'  => __( 'Edit Forms', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=gf_edit_forms' ),
				'meta'   => array( 'target' => '', 'title' => __( 'Edit Forms', 'gravity-forms-toolbar' ) )
			);
		}

		/** Add New Forms */
		if ( current_user_can( 'gravityforms_create_form' ) || current_user_can( 'gform_full_access' ) ) {
			$menu_items['gff-add-form'] = array(
				'parent' => $gfforms,
				'title'  => __( 'Add new Form', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=gf_new_form' ),
				'meta'   => array( 'target' => '', 'title' => __( 'Add new Form', 'gravity-forms-toolbar' ) )
			);
		}

		/**
		 * Dynamically add existing Forms and/or Entries at their sub-levels
		 *
		 * @since 1.2.0
		 */
                if ( ! empty( $forms ) ) {
                        $class_first = 'ddw_gftb-first-form';
			foreach ( $forms as $form ) {
				$view_title = $form['title'];
				if ( $form['unread_count'] > 0 ) {
					$count+= $form['unread_count'];
					$view_title.= ' ('.$form['unread_count'].')';
				}

				/** Hook in existing Forms at "Form" entry */
				$menu_items['gff-edit-form-'.$form['id']] = array(
					'parent' => $gfforms,
					'title'  => $form['title'],
					'href'   => admin_url( 'admin.php?page=gf_edit_forms&id='.$form['id'] ),
					'meta'   => array( 'class' => $class_first, 'target' => '', 'title' => $form['title'] )
				);

				/** Hook in existing Form Entries at "Entries" entry */
				$menu_items['gff-view-form-entries-'.$form['id']] = array(
					'parent' => $gfentries,
					'title'  => $view_title,
					'href'   => admin_url( 'admin.php?page=gf_entries&view=entries&id='.$form['id'] ),
					'meta'   => array( 'class' => $class_first, 'target' => '', 'title' => $form['title'] )
				);

				$class_first = '';

                        }  // end foreach

                }  // end-if !empty forms


		/** View Entries */
		if ( current_user_can( 'gravityforms_view_entries' ) || current_user_can( 'gform_full_access' ) ) {
			$menu_items['gfentries'] = array(
				'parent' => $gravitybar,
				'title'  => __( 'View Entries', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=gf_entries' ),
				'meta'   => array( 'target' => '', 'title' => __( 'View Entries', 'gravity-forms-toolbar' ) )
			);
		}  // end-if view entries


		/** Import & Export stuff */
		if ( current_user_can( 'gravityforms_export_entries' ) || current_user_can( 'gform_full_access' ) ) {
			$menu_items['gfimportexport'] = array(
				'parent' => $gravitybar,
				'title'  => __( 'Import & Export', 'gravity-forms-toolbar' ),
				'href'   => '#',
				'meta'   => array( 'target' => '', 'title' => __( 'Import & Export', 'gravity-forms-toolbar' ) )
			);
			$menu_items['gfie-entries-export'] = array(
				'parent' => $gfimportexport,
				'title'  => __( 'Export Entries', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=gf_export' ),
				'meta'   => array( 'target' => '', 'title' => __( 'Export Entries', 'gravity-forms-toolbar' ) )
			);
			$menu_items['gfie-forms-export'] = array(
				'parent' => $gfimportexport,
				'title'  => __( 'Export Forms', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=gf_export&view=export_form' ),
				'meta'   => array( 'target' => '', 'title' => __( 'Export Forms', 'gravity-forms-toolbar' ) )
			);
			$menu_items['gfie-forms-import'] = array(
				'parent' => $gfimportexport,
				'title'  => __( 'Import Forms', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=gf_export&view=import_form' ),
				'meta'   => array( 'target' => '', 'title' => __( 'Import Forms', 'gravity-forms-toolbar' ) )
			);
		}  // end-if import/export


		/** Official Add-Ons */
		if ( $options['add_ons'] && GFTB_ADDONS_DISPLAY ) {

			/** Include plugin file with add-on support links */
			require_once( GFTB_PLUGIN_DIR . '/lib/gftb-addons.php' );
//

		}  // end of Add-On level entry - back to more main level entries:


		/** Updates */
		if ( current_user_can( 'gravityforms_view_updates' ) || current_user_can( 'gform_full_access' ) ) {
                        $update_title = $update ? __( 'Update Is Available', 'gravity-forms-toolbar' ) : __( 'Check for Update', 'gravity-forms-toolbar' );
                        $update_class = $update ? 'ddw_gftb-update-available' : '';

			$menu_items['gfupdates'] = array(
				'parent' => $gravitybar,
				'title'  => $update_title,
				'href'   => admin_url( 'admin.php?page=gf_update' ),
				'meta'   => array(  'class' => $update_class, 'target' => '', 'title' => $update_title )
			);
		}  // end-if updates


		/** Help (for all capabalities) */
		$menu_items['gfhelp'] = array(
			'parent' => $gravitybar,
			'title'  => __( 'Help &amp; Links', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_help' ),
			'meta'   => array( 'target' => '', 'title' => __( 'Help &amp; Links', 'gravity-forms-toolbar' ) )
		);
         

		/**
		 * Display last main item in the menu for active extensions/plugins
		 * ATTENTION: This is where plugins/extensions hook in on the sub-level hierarchy
		 *
		 * @since 1.0.0
		 */       
                if ( $options['extensions'] && GFTB_EXTENSIONS_DISPLAY ) {
                    $menu_items['extensions'] = array(
                            'parent' => $gravitybar,
                            'title'  => __( 'Active Extensions', 'gravity-forms-toolbar' ),
                            'href'   => is_network_admin() ? network_admin_url( 'plugins.php' ) : admin_url( 'plugins.php' ),
                            'meta'   => array( 'target' => '', 'title' => __( 'Active Extensions', 'gravity-forms-toolbar' ) )
                    );
                }  // end-if extensions

		/**
		 * Action Hook 'gftb_custom_extension_items'
		 * allows for hooking other extension-related items in
		 *
		 * @since 1.4.0
		 */
		do_action( 'gftb_custom_extension_items' );

	}  // end-if for Gravity Forms admin pages


	/**
	 * Display links to active plugins/extensions settings' pages
	 *
	 * @since 1.0.0
	 */
		/** Include plugin file with plugin support links */
		require_once( GFTB_PLUGIN_DIR . '/lib/gftb-plugins.php' );


	/** Allow menu items to be filtered, but pass in parent menu item IDs */
	$menu_items = (array) apply_filters( 'ddw_gftb_menu_items', $menu_items,
									$prefix,
									$gravitybar,
									$gfsupport,
									$gfdocs,
									$gffaq,
									$gfsites,
									$gfsettings,
									$gfforms,
									$gfentries,
									$gfimportexport,
									$gfaddonsinstalled,
										$gfaoauthorizenet,
										$gfaoaweber,
										$gfaocampaignmonitor,
										$gfaofreshbooks,
										$gfaomailchimp,
										$gfaopaypal,
										$gfaopaypalpro,
										$gfaotwilio,
										$gfaouserreg,
										$gftpaopideal,
										$gftpaostripe,
										$gftpaoshootq,
										$gftpaoconstantcontact,
										$gftpaoicontact,
										$gftpaomadmimi,
										$gftpaoexacttarget,
										$gftpaoinfusionsoft,
										$gftpaoymlp,
									$extensions,
									$extpideal,
									$extgfsolve360,
									$gfgroup
	);  // end of array


	/** Top level title, unread entries count display/styling, plus update info/check */
	/** Main item menu title */
        $menu_item_title = apply_filters( 'gftb_filter_main_item', __( 'Gravity Forms', 'gravity-forms-toolbar' ) );

	/** Filter the main item name's tooltip */
	$gftb_main_item_title_tooltip = apply_filters( 'gftb_filter_main_item_tooltip', _x( 'Gravity Forms', 'Translators: Main item - for the tooltip', 'gravity-forms-toolbar' ) );

	/** Filter the main item icon's class/display */
	$gftb_main_item_icon_display = apply_filters( 'gftb_filter_main_item_icon_display', 'icon-gravityforms' );

	/** CSS styling */
        $css = 'background: none repeat scroll 0 0 #EEEEEE; border-radius: 10px 10px 10px 10px; color: #333333; display: inline; font-size: 10px; font-weight: bold; padding: 2px 5px; text-shadow: none;';

	/** Menu URL */
        $menu_item_url = admin_url( 'admin.php?page=gf_edit_forms' );

	/** Logic for unread entries */
	if ( $options['unread_notification'] && $count > 0 ) {
			$to_add = sprintf( ' <span style="%s">%s</span>', $css, $count );
			$menu_item_title.= '<span title="' . __( 'Unread Entries', 'gravity-forms-toolbar' ) . '">' . $to_add . '</span>';
        	}

	/** Logic for updates */
	if ( $update ) {
			$to_add = sprintf( ' <span style="%s">U</span>', $css );
			$menu_item_title.= '<span title="' . __( 'Update Is Available', 'gravity-forms-toolbar' ) . '">' . $to_add . '</span>';
                        $menu_item_url = admin_url( 'admin.php?page=gf_update' );
	}


	/** Add the Gravity Forms top-level menu item */
	$wp_admin_bar->add_menu( array(
		'id'    => $gravitybar,
		'title' => $menu_item_title,
		'href'  => $menu_item_url,
		'meta'  => array(
					'class' => esc_attr( $gftb_main_item_icon_display ),
					'title' => esc_attr__( $gftb_main_item_title_tooltip )
				)
	) );


	/** Loop through the menu items */
	foreach ( $menu_items as $id => $menu_item ) {
		
		/** Add in the item ID */
		$menu_item['id'] = $prefix . $id;

		/** Add meta target to each item where it's not already set, so links open in new window/tab */
		if ( ! isset( $menu_item['meta']['target'] ) )		
			$menu_item['meta']['target'] = '_blank';

		/** Add class to links that open up in a new window/tab */
		if ( '_blank' === $menu_item['meta']['target'] ) {
			if ( ! isset( $menu_item['meta']['class'] ) )
				$menu_item['meta']['class'] = '';
			$menu_item['meta']['class'] .= $prefix . 'gftb-new-tab';
		}

		/** Add menu items */
		$wp_admin_bar->add_menu( $menu_item );

	}  // end foreach


	/**
	 * Action Hook 'gftb_custom_main_items'
	 * allows for hooking other main items in
	 *
	 * @since 1.4.0
	 */
	do_action( 'gftb_custom_main_items' );


	/**
	 * Check for WordPress version to add resource links group
	 * Check against WP 3.3+ only function "wp_editor" - if true display group styling
	 * otherwise display links in WP 3.1/3.2 style
	 *
	 * @since 1.3.0
	 */
	if ( function_exists( 'wp_editor' ) ) {

		$wp_admin_bar->add_group( array(
			'parent' => $gravitybar,
			'id'     => $gfgroup,
			'meta'   => array( 'class' => 'ab-sub-secondary' )
		) );

	} else {

		$wp_admin_bar->add_menu( array(
			'parent' => $gravitybar,
			'id'     => $gfgroup
		) );

	}  // end-if wp version check


	/**
	 * Action Hook 'gftb_custom_group_items'
	 * allows for hooking other Gravity Forms Group items in
	 *
	 * @since 1.4.0
	 */
	do_action( 'gftb_custom_group_items' );

}  // end of main function


add_action( 'wp_head', 'ddw_gftb_admin_style' );
add_action( 'admin_head', 'ddw_gftb_admin_style' );
/**
 * Add the styles for new WordPress Toolbar / Admin Bar entry
 * 
 * @since 1.0.0
 */
function ddw_gftb_admin_style() {

	/** No styles if admin bar is disabled or user is not logged in or items are disabled via constant */
	if ( ! is_admin_bar_showing()
		|| ! is_user_logged_in()
		|| ! GFTB_DISPLAY
	) {
		return;
	}

	/**
	 * Add CSS styles to wp_head/admin_head
	 * Check against WP 3.3+ only function 'wp_editor'
	 */
	/** Styles for WordPress 3.3 or higher */
	$gftb_main_icon = apply_filters( 'gftb_filter_main_icon', plugins_url( 'gravity-forms-toolbar/images/gravityforms-icon.png', dirname( __FILE__ ) ) );

	if ( function_exists( 'wp_editor' ) ) {

		?>
		<style type="text/css">
			#wpadminbar.nojs .ab-top-menu > li.menupop.icon-gravityforms:hover > .ab-item,
			#wpadminbar .ab-top-menu > li.menupop.icon-gravityforms.hover > .ab-item,
			#wpadminbar.nojs .ab-top-menu > li.menupop.icon-gravityforms > .ab-item,
			#wpadminbar .ab-top-menu > li.menupop.icon-gravityforms > .ab-item {
	      			background-image: url(<?php echo $gftb_main_icon; ?>);
				background-repeat: no-repeat;
				background-position: 0.85em 50%;
				padding-left: 30px;
			}
			#wp-admin-bar-ddw-gravityforms-gfaddonsinstalled .ab-item {
				color: #21759b !important;
			}
		        li.ddw_gftb-first-form,
			#wp-admin-bar-ddw-gravityforms-extensions {
	    			border-top: 1px solid;
			}
			#wp-admin-bar-ddw-gravityforms-languages-de > a:before,
			#wp-admin-bar-ddw-gravityforms-languages-nl > a:before {
				color: #ff9900;
				content: '• ';
			}
		        #wp-admin-bar-ddw-gravityforms-toolbar-default li:first-child {
		            border-top: none !important;
		        }
                	.ddw_gftb-update-available a {
				font-weight: bold !important;
			}
		</style>
		<?php

	/** Styles for WordPress prior 3.3 */
	} else {

		?>
		<style type="text/css">
			#wpadminbar .icon-gravityforms > a {
				background: url(<?php echo $gftb_main_icon; ?>) no-repeat 0.85em 50% transparent;
				padding-left: 30px;
			}
			#wp-admin-bar-ddw-gravityforms-gfaddonsinstalled .ab-item {
				color: #21759b !important;
			}
		        li.ddw_gftb-first-form,
			#wp-admin-bar-ddw-gravityforms-gfsettings,
			#wp-admin-bar-ddw-gravityforms-extensions {
	    			border-top: 1px solid;
			}
			#wp-admin-bar-ddw-gravityforms-languages-de a:link,
			#wp-admin-bar-ddw-gravityforms-languages-nl a:link {
				background: #f5f5f5;
			}
			#wp-admin-bar-ddw-gravityforms-languages-de a:link,
			#wp-admin-bar-ddw-gravityforms-languages-nl a:link {
				background: inherit;
			}
		        #wp-admin-bar-ddw-gravityforms-toolbar-default li:first-child {
		            border-top: none !important;
		        }
                	.ddw_gftb-update-available a {
				font-weight: bold !important;
			}
		</style>
		<?php

	}  // end if else WP check

}  // end of function ddw_gftb_admin_style


/**
 * Gravity Forms version compare for update check
 *
 * @since 1.3.0
 *
 * @return version string
 */
function ddw_gftb_update_available() {

	/** Check if Gravity Forms is active - class 'GFCommon' available */
	if ( class_exists( 'GFCommon' ) ) {

		$version_info = GFCommon::get_version_info();

		return version_compare( GFCommon::$version, $version_info["version"], '<' );

	}  // end-if class check

}  // end of function ddw_gftb_update_available


/**
 * Helper functions for custom branding of the plugin
 *
 * @since 1.4.0
 */
	/** Include plugin file with special custom stuff */
	require_once( GFTB_PLUGIN_DIR . '/lib/gftb-branding.php' );


/**
 * Returns current plugin's header data in a flexible way.
 *
 * @since 1.5.0
 *
 * @uses get_plugins()
 *
 * @param $gftb_plugin_value
 * @param $gftb_plugin_folder
 * @param $gftb_plugin_file
 *
 * @return string Plugin data.
 */
function ddw_gftb_plugin_get_data( $gftb_plugin_value ) {

	if ( ! function_exists( 'get_plugins' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}

	$gftb_plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$gftb_plugin_file = basename( ( __FILE__ ) );

	return $gftb_plugin_folder[ $gftb_plugin_file ][ $gftb_plugin_value ];

}  // end of function ddw_gftb_plugin_get_data
