<?php
/**
 * Display links to active Gravity Forms third-party add-ons/ plugins/ extensions settings' pages
 *
 * @package    Gravity Forms Toolbar
 * @subpackage Plugin/Extension Support
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright 2012, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://genesisthemes.de/en/wp-plugins/gravity-forms-toolbar/
 * @link       http://twitter.com/deckerweb
 *
 * @since 1.0.0
 */

/**
 * Pronamic iDEAL settings pages (free, by Pronamic)
 *
 * @since 1.0.0
 */
if ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'pronamic-ideal/pronamic-ideal.php' ) ) || class_exists( 'Pronamic_IDeal_IDeal' ) ) {

	/** Entry at "Add-Ons" level submenu */
	if ( current_user_can( 'gravityforms_ideal' ) || current_user_can( 'gform_full_access' ) ) {
		$menu_items['gftpaopideal'] = array(
			'parent' => $gfaddonsinstalled,
			'title'  => __( 'iDEAL Feeds', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_pronamic_ideal' ),
			'meta'   => array( 'target' => '', 'title' => __( 'iDEAL Feeds', 'gravity-forms-toolbar' ) )
		);
		$menu_items['gftpaopideal-newfeed'] = array(
			'parent' => $gftpaopideal,
			'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_pronamic_ideal&view=edit' ),
			'meta'   => array( 'target' => '', 'title' => __( 'Add new Feed', 'gravity-forms-toolbar' ) )
		);
		$menu_items['gftpaopideal-settings'] = array(
			'parent' => $gftpaopideal,
			'title'  => __( 'Pronamic iDEAL Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_settings&addon=iDEAL' ),
			'meta'   => array( 'target' => '', 'title' => __( 'Pronamic iDEAL Settings', 'gravity-forms-toolbar' ) )
		);
	}  // end-if cap check

	/** Entries at "Extensions" level submenu */
	if ( current_user_can( 'pronamic_ideal' ) && 
		( current_user_can( 'gravityforms_ideal' ) || current_user_can( 'gform_full_access' ) ) ) {
		$menu_items['extpideal'] = array(
			'parent' => $extensions,
			'title'  => __( 'Pronamic iDEAL Payment Gateway', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=pronamic_ideal' ),
			'meta'   => array( 'target' => '', 'title' => __( 'Pronamic iDEAL Payment Gateway', 'gravity-forms-toolbar' ) )
		);
		$menu_items['ext-pideal-feeds'] = array(
			'parent' => $extpideal,
			'title'  => __( 'iDEAL Feeds', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_pronamic_ideal' ),
			'meta'   => array( 'target' => '', 'title' => __( 'iDEAL Feeds', 'gravity-forms-toolbar' ) )
		);
		$menu_items['ext-pideal-newfeed'] = array(
			'parent' => $extpideal,
			'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_pronamic_ideal&view=edit' ),
			'meta'   => array( 'target' => '', 'title' => __( 'Add new Feed', 'gravity-forms-toolbar' ) )
		);
		$menu_items['ext-pideal-gfsettings'] = array(
			'parent' => $extpideal,
			'title'  => __( 'Pronamic iDEAL Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=gf_settings&addon=iDEAL' ),
			'meta'   => array( 'target' => '', 'title' => __( 'Pronamic iDEAL Settings', 'gravity-forms-toolbar' ) )
		);
		$menu_items['ext-pideal-payments'] = array(
			'parent' => $extpideal,
			'title'  => __( 'Payments', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=pronamic_ideal_payments' ),
			'meta'   => array( 'target' => '', 'title' => __( 'Payments', 'gravity-forms-toolbar' ) )
		);
		$menu_items['ext-pideal-settings'] = array(
			'parent' => $extpideal,
			'title'  => __( 'Settings', 'gravity-forms-toolbar' ),
			'href'   => admin_url( 'admin.php?page=pronamic_ideal_settings' ),
			'meta'   => array( 'target' => '', 'title' => __( 'Settings', 'gravity-forms-toolbar' ) )
		);

		/** Pages Generator */
		if ( current_user_can( 'pronamic_ideal_pages_generator' ) ) {
			$menu_items['ext-pideal-pages-generator'] = array(
				'parent' => $extpideal,
				'title'  => __( 'Pages Generator', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=pronamic_ideal_pages_generator' ),
				'meta'   => array( 'target' => '', 'title' => __( 'Pages Generator', 'gravity-forms-toolbar' ) )
			);
		}  // end-if cap check

		/** Variants */
		if ( current_user_can( 'pronamic_ideal_variants' ) ) {
			$menu_items['ext-pideal-variants'] = array(
				'parent' => $extpideal,
				'title'  => __( 'Variants', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=pronamic_ideal_variants' ),
				'meta'   => array( 'target' => '', 'title' => __( 'Variants', 'gravity-forms-toolbar' ) )
			);
		}  // end-if cap check

		/** Documentation */
		if ( current_user_can( 'pronamic_ideal_documentation' ) ) {
			$menu_items['ext-pideal-documentation'] = array(
				'parent' => $extpideal,
				'title'  => __( 'Pronamic iDEAL Documentation', 'gravity-forms-toolbar' ),
				'href'   => admin_url( 'admin.php?page=pronamic_ideal_documentation' ),
				'meta'   => array( 'target' => '', 'title' => __( 'Pronamic iDEAL Documentation', 'gravity-forms-toolbar' ) )
			);
		}  // end-if cap check

	}  // pronamic cap check

}  // end-if Pronamic iDEAL


/**
 * Gravity Forms Stripe Add-On (free, by Naomi C. Bush)
 *
 * @since 1.4.0
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'gravity-forms-stripe/stripe.php' ) ) || class_exists( 'GFStripe' ) ) && ( current_user_can( 'gravityforms_stripe' ) || current_user_can( 'gform_full_access' ) ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items['gftpaostripe'] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Stripe Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_stripe' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Stripe Feeds', 'gravity-forms-toolbar' ) )
	);
	$menu_items['gftpaostripe-newfeed'] = array(
		'parent' => $gftpaostripe,
		'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_stripe&view=edit&id=0' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Add new Feed', 'gravity-forms-toolbar' ) )
	);
	$menu_items['gftpaostripe-settings'] = array(
		'parent' => $gftpaostripe,
		'title'  => __( 'Stripe Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Stripe' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Stripe Settings', 'gravity-forms-toolbar' ) )
	);

	/** Entry at "Extensions" level submenu */
	$menu_items['ext-gfstripe'] = array(
		'parent' => $extensions,
		'title'  => __( 'Stripe Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Stripe' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Stripe Add-On Settings', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF Stripe


/**
 * Gravity Forms Directory & Addons (free, by Katz Web Services, Inc.)
 *
 * @since 1.0.0
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'gravity-forms-addons/gravity-forms-addons.php' ) ) || class_exists( 'GFDirectory' ) ) && ( current_user_can( 'gravityforms_directory' ) || current_user_can( 'gform_full_access' ) ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items['gftpaogfd'] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Gravity Forms Directory & Addons', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Directory+%26+Addons' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Gravity Forms Directory & Addons', 'gravity-forms-toolbar' ) )
	);

	/** Entry at "Extensions" level submenu */
	$menu_items['ext-gfdirectory'] = array(
		'parent' => $extensions,
		'title'  => __( 'Gravity Forms Directory & Addons', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Directory+%26+Addons' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Gravity Forms Directory & Addons', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF Directory


/**
 * Gravity Forms Salesforce Add-on (free, by Katz Web Services, Inc.)
 *
 * @since 1.0.0
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'gravity-forms-salesforce/salesforce.php' ) ) || class_exists( 'GFSalesforce' ) ) && ( current_user_can( 'gravityforms_salesforce' ) || current_user_can( 'gform_full_access' ) ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items['gftpaogfsf'] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Gravity Forms Salesforce Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_salesforce' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Gravity Forms Salesforce Add-On', 'gravity-forms-toolbar' ) )
	);

	/** Entry at "Extensions" level submenu */
	$menu_items['ext-gfsalesforce'] = array(
		'parent' => $extensions,
		'title'  => __( 'Gravity Forms Salesforce Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_salesforce' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Gravity Forms Salesforce Add-On', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF Salesforce


/**
 * Gravity Forms Contact Form 7 Importer (free, by Katz Web Services, Inc.)
 *
 * @since 1.0.0
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'contact-form-7-gravity-forms/contact-form-7-gravity-forms.php' ) ) || class_exists( 'GFCF7_Import' ) ) && ( current_user_can( 'administrator' ) || current_user_can( 'gform_full_access' ) ) ) {

	/** Entry at "Extensions" level submenu */
	$menu_items['ext-gfcf7import'] = array(
		'parent' => $extensions,
		'title'  => __( 'Contact Form 7 Gravity Forms Importer', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gfcf7' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Contact Form 7 Gravity Forms Importer', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF CF7-Importer


/**
 * Gravity Forms ShootQ Add-On (free, by pussycatdev)
 *
 * @since 1.1.0
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'gravity-forms-shootq-add-on/shootq.php' ) ) || class_exists( 'GFShootQ' ) ) && ( current_user_can( 'gravityforms_shootq' ) || current_user_can( 'gform_full_access' ) ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items['gftpaoshootq'] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'ShootQ Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_shootq' ),
		'meta'   => array( 'target' => '', 'title' => __( 'ShootQ Feeds', 'gravity-forms-toolbar' ) )
	);
	$menu_items['gftpaoshootq-newfeed'] = array(
		'parent' => $gftpaoshootq,
		'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_shootq&view=edit&id=0' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Add new Feed', 'gravity-forms-toolbar' ) )
	);
	$menu_items['gftpaoshootq-settings'] = array(
		'parent' => $gftpaoshootq,
		'title'  => __( 'ShootQ Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=ShootQ' ),
		'meta'   => array( 'target' => '', 'title' => __( 'ShootQ Settings', 'gravity-forms-toolbar' ) )
	);

	// Entry at "Extensions" level submenu
	$menu_items['ext-gfshootq'] = array(
		'parent' => $extensions,
		'title'  => __( 'ShootQ Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=ShootQ' ),
		'meta'   => array( 'target' => '', 'title' => __( 'ShootQ Add-On Settings', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF ShootQ


/**
 * Gravity Forms Constant Contact Add-On (free, by Katz Web Services, Inc.)
 *
 * @since 1.4.0
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'gravity-forms-constant-contact/constantcontact.php' ) ) || class_exists( 'GFConstantContact' ) ) && ( current_user_can( 'gravityforms_constantcontact' ) || current_user_can( 'gform_full_access' ) ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items['gftpaoconstantcontact'] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Constant Contact Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_constantcontact' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Constant Contact Feeds', 'gravity-forms-toolbar' ) )
	);
	$menu_items['gftpaoconstantcontact-newfeed'] = array(
		'parent' => $gftpaoconstantcontact,
		'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_constantcontact&view=edit&id=0' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Add new Feed', 'gravity-forms-toolbar' ) )
	);
	$menu_items['gftpaoconstantcontact-settings'] = array(
		'parent' => $gftpaoconstantcontact,
		'title'  => __( 'Constant Contact Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Constant+Contact' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Constant Contact Settings', 'gravity-forms-toolbar' ) )
	);

	/** Entry at "Extensions" level submenu */
	$menu_items['ext-gfconstantcontact'] = array(
		'parent' => $extensions,
		'title'  => __( 'Constant Contact Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Constant+Contact' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Constant Contact Add-On Settings', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF iContact


/**
 * Gravity Forms iContact Add-On (free, by Katz Web Services, Inc.)
 *
 * @since 1.1.0
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'gravity-forms-icontact/icontact.php' ) ) || class_exists( 'GFiContact' ) ) && ( current_user_can( 'gravityforms_icontact' ) || current_user_can( 'gform_full_access' ) ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items['gftpaoicontact'] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'iContact Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_icontact' ),
		'meta'   => array( 'target' => '', 'title' => __( 'iContact Feeds', 'gravity-forms-toolbar' ) )
	);
	$menu_items['gftpaoicontact-newfeed'] = array(
		'parent' => $gftpaoicontact,
		'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_icontact&view=edit&id=0' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Add new Feed', 'gravity-forms-toolbar' ) )
	);
	$menu_items['gftpaoicontact-settings'] = array(
		'parent' => $gftpaoicontact,
		'title'  => __( 'iContact Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=iContact' ),
		'meta'   => array( 'target' => '', 'title' => __( 'iContact Settings', 'gravity-forms-toolbar' ) )
	);

	/** Entry at "Extensions" level submenu */
	$menu_items['ext-gficontact'] = array(
		'parent' => $extensions,
		'title'  => __( 'iContact Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=iContact' ),
		'meta'   => array( 'target' => '', 'title' => __( 'iContact Add-On Settings', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF iContact


/**
 * Gravity Forms Mad Mimi Add-On (free, by Katz Web Services, Inc.)
 *
 * @since 1.1.0
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'gravity-forms-mad-mimi/madmimi.php' ) ) || class_exists( 'GFMadMimi' ) ) && ( current_user_can( 'gravityforms_madmimi' ) || current_user_can( 'gform_full_access' ) ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items['gftpaomadmimi'] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Mad Mimi Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_madmimi' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Mad Mimi Feeds', 'gravity-forms-toolbar' ) )
	);
	$menu_items['gftpaomadmimi-newfeed'] = array(
		'parent' => $gftpaomadmimi,
		'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_madmimi&view=edit&id=0' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Add new Feed', 'gravity-forms-toolbar' ) )
	);
	$menu_items['gftpaomadmimi-settings'] = array(
		'parent' => $gftpaomadmimi,
		'title'  => __( 'Mad Mimi Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Mad+Mimi' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Mad Mimi Settings', 'gravity-forms-toolbar' ) )
	);

	/** Entry at "Extensions" level submenu */
	$menu_items['ext-gfmadmimi'] = array(
		'parent' => $extensions,
		'title'  => __( 'Mad Mimi Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Mad+Mimi' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Mad Mimi Add-On Settings', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF Mad Mimi


/**
 * Gravity Forms ExactTarget Add-On (free, by Katz Web Services, Inc.)
 *
 * @since 1.1.0
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'gravity-forms-exacttarget/exacttarget.php' ) ) || class_exists( 'GFExactTarget' ) ) && ( current_user_can( 'gravityforms_exacttarget' ) || current_user_can( 'gform_full_access' ) ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items['gftpaoexacttarget'] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'ExactTarget Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_exacttarget' ),
		'meta'   => array( 'target' => '', 'title' => __( 'ExactTarget Feeds', 'gravity-forms-toolbar' ) )
	);
	$menu_items['gftpaoexacttarget-newfeed'] = array(
		'parent' => $gftpaoexacttarget,
		'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_exacttarget&view=edit&id=0' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Add new Feed', 'gravity-forms-toolbar' ) )
	);
	$menu_items['gftpaoexacttarget-settings'] = array(
		'parent' => $gftpaoexacttarget,
		'title'  => __( 'ExactTarget Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=ExactTarget' ),
		'meta'   => array( 'target' => '', 'title' => __( 'ExactTarget Settings', 'gravity-forms-toolbar' ) )
	);

	/** Entry at "Extensions" level submenu */
	$menu_items['ext-gfexacttarget'] = array(
		'parent' => $extensions,
		'title'  => __( 'ExactTarget Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=ExactTarget' ),
		'meta'   => array( 'target' => '', 'title' => __( 'ExactTarget Add-On Settings', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF ExactTarget


/**
 * Gravity Forms Infusionsoft Add-On (free, by Katz Web Services, Inc.)
 *
 * @since 1.5.0
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'infusionsoft/infusionsoft.php' ) ) || class_exists( 'GFInfusionsoft' ) ) && ( current_user_can( 'gravityforms_infusionsoft' ) || current_user_can( 'gform_full_access' ) ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items['gftpaoinfusionsoft'] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Infusionsoft Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_infusionsoft' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Infusionsoft Feeds', 'gravity-forms-toolbar' ) )
	);
	$menu_items['gftpaoinfusionsoft-newfeed'] = array(
		'parent' => $gftpaoinfusionsoft,
		'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_infusionsoft&view=edit&id=0' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Add new Feed', 'gravity-forms-toolbar' ) )
	);
	$menu_items['gftpaoinfusionsoft-settings'] = array(
		'parent' => $gftpaoinfusionsoft,
		'title'  => __( 'Infusionsoft Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Infusionsoft' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Infusionsoft Settings', 'gravity-forms-toolbar' ) )
	);

	/** Entry at "Extensions" level submenu */
	$menu_items['ext-gfinfusionsoft'] = array(
		'parent' => $extensions,
		'title'  => __( 'Infusionsoft Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Infusionsoft' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Infusionsoft Add-On Settings', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF Infusionsoft


/**
 * Gravity Forms YMLP Add-On (free, by Katz Web Services, Inc.)
 *
 * @since 1.5.1
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'ymlp/ymlp.php' ) ) || class_exists( 'GFYMLP' ) ) && ( current_user_can( 'gravityforms_ymlp' ) || current_user_can( 'gform_full_access' ) ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items['gftpaoymlp'] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'YMLP Feeds', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_ymlp' ),
		'meta'   => array( 'target' => '', 'title' => __( 'YMLP Feeds', 'gravity-forms-toolbar' ) )
	);
	$menu_items['gftpaoymlp-newfeed'] = array(
		'parent' => $gftpaoymlp,
		'title'  => __( 'Add new Feed', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_ymlp&view=edit&id=0' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Add new Feed', 'gravity-forms-toolbar' ) )
	);
	$menu_items['gftpaoymlp-settings'] = array(
		'parent' => $gftpaoymlp,
		'title'  => __( 'YMLP Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=YMLP' ),
		'meta'   => array( 'target' => '', 'title' => __( 'YMLP Settings', 'gravity-forms-toolbar' ) )
	);

	/** Entry at "Extensions" level submenu */
	$menu_items['ext-gfymlp'] = array(
		'parent' => $extensions,
		'title'  => __( 'YMLP Add-On Settings', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Infusionsoft' ),
		'meta'   => array( 'target' => '', 'title' => __( 'YMLP Add-On Settings', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF YMLP


/**
 * Gravity to Solve360 (free, by Steve Barnett)
 *
 * @since 1.4.0
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'gravity-to-solve360/gravity-to-solve360.php' ) ) || function_exists( 'gts360' ) ) && current_user_can( 'manage_options' ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items['extgfsolve360'] = array(
		'parent' => $extensions,
		'title'  => __( 'Gravity to Solve360', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'tools.php?page=gravity-to-solve360' ),
		'meta'   => array( 'target' => '', 'title' => _x( 'Gravity to Solve360 Export', 'Translators: For the tooltip', 'gravity-forms-toolbar' ) )
	);
	$menu_items['extgfsolve360-options'] = array(
		'parent' => $extgfsolve360,
		'title'  => __( 'Options', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'options-general.php?page=gravity-to-solve360-options' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Options', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF Solve360


/**
 * Gravity Forms Survey Funnel Add-On (free, by Pronamic)
 *
 * @since 1.5.0
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'gravity-forms-survey-funnel/gravityforms-surveyfunnel.php' ) ) || class_exists( 'Gravity_Forms_Survey_Funnel' ) ) && current_user_can( 'manage_options' ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items['gftpaogfsf'] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Survey Funnel Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'options-general.php?page=gravityforms-surveyfunnel-survey-settings' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Survey Funnel Add-On', 'gravity-forms-toolbar' ) )
	);

	/** Entry at "Extensions" level submenu */
	$menu_items['ext-gfsurveyfunnel'] = array(
		'parent' => $extensions,
		'title'  => __( 'Survey Funnel Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'options-general.php?page=gravityforms-surveyfunnel-survey-settings' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Survey Funnel Add-On', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF Survey Funnel


/**
 * Gravity Forms HubSpot Add-On (free, by Dan Zappone)
 *
 * @since 1.4.0
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'hubspot-for-gravity-forms/gf-hubspot.php' ) ) || class_exists( 'GFHubspot' ) ) && ( current_user_can( 'gravityforms_hubspot' ) || current_user_can( 'administrator' ) || current_user_can( 'gform_full_access' ) ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items['gftpaogfhs'] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'HubSpot Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_hubspot' ),
		'meta'   => array( 'target' => '', 'title' => __( 'HubSpot Add-On', 'gravity-forms-toolbar' ) )
	);

	/** Entry at "Extensions" level submenu */
	$menu_items['ext-gfhubspot'] = array(
		'parent' => $extensions,
		'title'  => __( 'HubSpot Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_hubspot' ),
		'meta'   => array( 'target' => '', 'title' => __( 'HubSpot Add-On', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF HubSpot


/**
 * Gravity Forms Fat Zebra Add-On (free, by Matthew Savage)
 *
 * @since 1.5.0
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'gravityforms-fatzebra/fatzebra.php' ) ) || defined( 'GRAVITYFORMS_FATZEBRA_PATH' ) ) && ( current_user_can( 'administrator' ) || current_user_can( 'gform_full_access' ) ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items['gftpaogffatzebra'] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Fat Zebra Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Fat+Zebra+%28Payments%29' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Fat Zebra Add-On', 'gravity-forms-toolbar' ) )
	);

	/** Entry at "Extensions" level submenu */
	$menu_items['ext-gffatzebra'] = array(
		'parent' => $extensions,
		'title'  => __( 'Fat Zebra Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_settings&addon=Fat+Zebra+%28Payments%29' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Fat Zebra Add-On', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF Fat Zebra


/**
 * Gravity Forms CapsuleCRM Add-On (free, by Alinea.im)
 *
 * @since 1.4.0
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'gravity-forms-capsulecrm-add-on/capsulecrm.php' ) ) || class_exists( 'GFCapsuleCRM' ) ) && ( current_user_can( 'gravityforms_capsulecrm' ) || current_user_can( 'administrator' ) || current_user_can( 'gform_full_access' ) ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items['gftpaogfcapsule'] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'CapsuleCRM Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_capsulecrm' ),
		'meta'   => array( 'target' => '', 'title' => __( 'CapsuleCRM Add-On', 'gravity-forms-toolbar' ) )
	);

	/** Entry at "Extensions" level submenu */
	$menu_items['ext-gfcapsule'] = array(
		'parent' => $extensions,
		'title'  => __( 'CapsuleCRM Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_capsulecrm' ),
		'meta'   => array( 'target' => '', 'title' => __( 'CapsuleCRM Add-On', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF CapsuleCRM


/**
 * GravityForms eWAY (free, by WebAware)
 *
 * @since 1.4.0
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'gravityforms-eway/gravityforms-eway.php' ) ) || defined( 'GFEWAY_PLUGIN_ROOT' ) ) && current_user_can( 'manage_options' ) ) {

	/** Entry at "Add-Ons" level submenu */
	$menu_items['gftpaogfeway'] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'eWAY Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gfeway-options' ),
		'meta'   => array( 'target' => '', 'title' => __( 'eWAY Add-On', 'gravity-forms-toolbar' ) )
	);

	/** Entry at "Extensions" level submenu */
	$menu_items['ext-gfeway'] = array(
		'parent' => $extensions,
		'title'  => __( 'eWAY Add-On', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gfeway-options' ),
		'meta'   => array( 'target' => '', 'title' => __( 'eWAY Add-On', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF eWAY


/**
 * PixCaptcha Image Captcha for Gravity Forms (free, by Picatcha, Inc.)
 *
 * @since 1.4.0
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'picatcha-for-gravity-forms/picatcha_gforms.php' ) ) || function_exists( 'add_pixcaptcha_field' ) ) && ( current_user_can( 'edit_posts' ) || current_user_can( 'gform_full_access' ) ) ) {
	/** Entry at "Extensions" level submenu */
	$menu_items['ext-picatchagf'] = array(
		'parent' => $extensions,
		'title'  => __( 'PixCaptcha Image Captcha', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=picatcha_submenu' ),
		'meta'   => array( 'target' => '', 'title' => __( 'PixCaptcha Image Captcha', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF Picatcha


/**
 * Gravity Forms SMS Notifications (free, by Mediaburst)
 *
 * @since 1.4.0
 */
if ( ( ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'gravity-forms-sms-notifications/gravityforms-sms.php' ) ) || class_exists( 'GravityFormsSMS' ) ) && ( current_user_can( 'manage_options' ) || current_user_can( 'gform_full_access' ) ) ) {
	/** Entry at "Extensions" level submenu */
	$menu_items['ext-picatchagf'] = array(
		'parent' => $extensions,
		'title'  => __( 'SMS Notifications (Mediaburst)', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=sms_notifications' ),
		'meta'   => array( 'target' => '', 'title' => _x( 'SMS Notifications by Mediaburst', 'Translators: For the tooltip', 'gravity-forms-toolbar' ) )
	);
}  // end-if GF SMS Notifications


/**
 * Placing of "Purchase more official Add-Ons" as very last entry of "Add-On" first-level menu
 *
 * @since 1.0.0
 */
if ( current_user_can( 'gravityforms_view_addons' ) || current_user_can( 'gravityforms_addon_browser' ) || current_user_can( 'gform_full_access' ) ) {
	$menu_items['gfaddonsinstalled-purchase'] = array(
		'parent' => $gfaddonsinstalled,
		'title'  => __( 'Purchase more Add-Ons', 'gravity-forms-toolbar' ),
		'href'   => admin_url( 'admin.php?page=gf_addons' ),
		'meta'   => array( 'target' => '', 'title' => __( 'Purchase more Add-Ons', 'gravity-forms-toolbar' ) )
	);
}  // end-if purchase more add-ons
