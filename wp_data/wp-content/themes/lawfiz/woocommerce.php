<?php
/**
 * @package lawfiz
 */

get_header();

?>
<div class="page-title">
    <?php lawfiz_before_title_content(); ?>
	<?php
	if(true===get_theme_mod( 'lawfiz_enable_page_title',true)) :
	do_action('lawfiz_get_shop_page_title');
endif;
	?>
    <?php lawfiz_after_title_content(); ?>
</div>
<div class="woo-wrapper">
	<div id="primary" class="content-area">
	    <main id="main" class="site-main lawfiz-main" role="main">
	    	<div class="container">
	    		<div class="page-content-area">
			        <?php
			            get_template_part( 'template-parts/shop/content', 'woocommerce' );           
			        ?>
		    	</div>
		    </div>
	    </main><!-- #main -->
	</div><!-- #primary -->
</div>

<?php
	get_footer();
?>