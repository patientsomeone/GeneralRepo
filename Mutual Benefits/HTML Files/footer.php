</section>
<footer>
<?php if(get_option('footer_disable')!="true") {?>
<div class="footer_widgets">
		<?php  get_template_part('lib/includes/bottom_footer_section'); ?>
</div>
<?php } ?>
 <div class="clear"></div>
		
        <div class="one_half">
		<div class="copyright">
			<p><?php echo get_option('kaya_footercopyright') ? get_option('kaya_footercopyright') :'Copyright &copy; 2012 Kayapati. All rights reserved.'; ?></p>
        </div>
        </div>
        <div class="one_half_last">
        <div class="footer_menu">
      <?php if(!function_exists('dynamic_sidebar')|| !dynamic_sidebar('bottom_footer_right_section')) :?>
		<?php 
		
       if ( has_nav_menu('secondary') ) {
    // User has assigned menu to this location;
    // output it
    wp_nav_menu( array( 
        'theme_location' => 'secondary', 
        'menu_class' => 'nav', 
        'container' => '' 
    ) );
}
		
		//wp_nav_menu(array('menu_class' => 'footermenu', 'theme_location' => 'secondary'));
		?></div>
		<?php endif ?>  
        </div>
      
        
		</footer>
		</div>
		</section>  
		
        <p id="back-top">
		<a href="#top"><span></span></a>
	</p>
     <div class="clear"></div>

   
<?php  $kaya_google_analytics=get_option('kaya_google_analytics');
        if ($kaya_google_analytics) { 	
        	echo stripslashes($kaya_google_analytics); 					
        } else { ?>
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>