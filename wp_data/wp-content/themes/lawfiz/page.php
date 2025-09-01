<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lawfiz
 */

get_header();
lawfiz_before_title();
if(true===get_theme_mod( 'lawfiz_enable_page_title',true)) :
	do_action('lawfiz_get_page_title',false,false,false,false);
endif;
lawfiz_after_title();

?>

<div id="primary" class="<?php echo esc_attr(get_theme_mod('lawfiz_select_header_styles','style1')); ?> content-area">
    <main id="main" class="site-main" role="main">
        <div class="content-inner">
            <?php
                $elementor_page = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );
                if ( (bool)$elementor_page ) {
                    ?><div class="containerno"><?php  
                } 
                else {
                    ?><div class="container"><?php
                }
            ?>
            <div class="row">
                <div class="col-md-12">
                    <?php
                        while(have_posts() ) : the_post();
                            get_template_part( 'template-parts/page/content', 'page' );
                            // If comments are open or we have at least one comment, load up the comment template.
                            if(comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                        endwhile; //End of the loop.
                    ?>
                </div>
            </div></div>
        </div>     
    </main>
</div>

<?php
get_footer();