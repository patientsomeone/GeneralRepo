<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta name="google-site-verification" content="KKHFuL8iSgiVHD4RLTUbTtuD8Lrz-9-9vK1LIWX298U" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	?>
</title>
<?php $favicon=get_option('favicon') ? get_option('favicon') : ''; ?>
<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php 
wp_enqueue_style('css_responsive');
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	 
 ?>
<?php 
$google_bodyfont=get_option('google_bodyfont')?get_option('google_bodyfont'):'';
$google_generaltitlefont=get_option('google_generaltitlefont')?get_option('google_generaltitlefont'):'Domine';
$google_menufont=get_option('google_menufont')?get_option('google_menufont'):'Open Sans';

$gbodyfont = str_replace( ' ', '+', $google_bodyfont); 
$generaltitlefont = str_replace( ' ', '+', $google_generaltitlefont); 
$gmenufont = str_replace( ' ', '+', $google_menufont); 

if($google_bodyfont !="") { ?>
	    <link href='http://fonts.googleapis.com/css?family=<?php echo $google_bodyfont; ?>:400,700,300 &subset=latin,cyrillic' rel='stylesheet' type='text/css' />
<?php } ?>

<?php if($google_generaltitlefont !="") { ?>
    <link href='http://fonts.googleapis.com/css?family=<?php echo $google_generaltitlefont; ?>:400,700,300 &subset=latin,cyrillic' rel='stylesheet' type='text/css' />
<?php } ?>

<?php if($google_menufont !="") { ?>
    <link href='http://fonts.googleapis.com/css?family=<?php echo $google_menufont; ?>:400,700,300 &subset=latin,cyrillic' rel='stylesheet' type='text/css' />
	

<?php }

?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

<!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/ie8_down.css" />
<![endif]-->


<?php
if(get_option('custom_css') !='')
{
echo '<style>';
echo get_option('custom_css');
echo '</style>';
}
wp_head();
?>



</head>

<body <?php body_class(); ?>>
<div class="top_border_left">
</div>
<section id="page_wrap">

<section id="container">


<!--Start header_wrapper -->
<div id="logo"> <!--Logo Start  -->
<!--Start logo  -->
	<?php  $logo=get_option('logo'); ?>
    <?php if($logo) { ?>
    <a href="<?php echo home_url(); ?> "> <img src="<?php echo $logo; ?>" alt="<?php the_title(); ?>"  /> </a>
    <?php }else{ ?>
    <a href="<?php echo home_url(); ?> "> <img src="<?php echo get_template_directory_uri()?>/images/logo.png" alt="<?php the_title(); ?>" /> </a>
    <?php } ?>
</div><!--End Logo -->
<div class="contact_info">
<?php 
$mailid=get_option('mailid') ? get_option('mailid') : '';
if($mailid){
?>
<div class="mail_box"><h4>Our Mail: </h4><span><h4><?php echo $mailid; ?></h4></span></div>
<?php } ?>
<div class="clear"></div>
<?php $callus=get_option('callus') ? get_option('callus') : ''; 
if($callus){
?>
<div class="call_box"><h4>Call Us: </h4><span><h4><?php echo $callus; ?></h4><br>
<div style="text-align:center"><a href="get-a-quote"><img src="http://mutualbenefitsinc.com/wp-content/uploads/2013/02/GetAQuote.png" width="135" height="35" alt="Get A Quote"></a></div>
</span></div>
<?php } ?>
</div>

<!--navigation start -->
<nav>
	 <?php
		// wp_nav_menu( array( 'container_class' =>'menu', 'container_id' => 'myslidemenu','menu_id'=> 'menu','menu' => 'topmenu', 'theme_location' => 'primary' ) );
		wp_nav_menu(array('echo' => true,'container_class' => 'menu','theme_location' => 'primary','container_id' => 'myslidemenu', 'menu_id'=> 'menu','menu' => 'topmenu'));
		?>
</nav>
<div class="clear"></div>
<!--end navigation -->        