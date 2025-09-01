<?php
/**
 * Template part for displaying posts in a single post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lawfiz
 */
?>
 <article id="post-<?php the_ID(); ?>" <?php post_class();?>>
    <div class="blog-post">
        <div class="image">
            <?php
                if(has_post_thumbnail()) {
                    the_post_thumbnail('full');
                }
            ?>
        </div>
        <div class="content">
            <div class="title">
                <h1 class="entry-title">
                    <?php the_title(); ?>
                </h1>
            </div> 

             <?php
                if(get_theme_mod('lawfiz_enable_single_post_meta_author',true) || get_theme_mod('lawfiz_enable_single_post_meta_date',true) || get_theme_mod('lawfiz_enable_single_post_meta_comments',true)) {
                    ?>
                        <div class="meta">
                            <?php
                                if(true===get_theme_mod('lawfiz_enable_single_post_meta_author',true)) :
                                    ?>
                                        <span class="meta-item author"><i class="bi bi-person"></i> <a class="author-post-url" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php the_author() ?></a>
                                        </span>
                                    <?php
                                endif;

                                if(true===get_theme_mod('lawfiz_enable_single_post_meta_date',true)) :
                                    ?>
                                        <span class="meta-item date"><i class="bi bi-calendar-check"></i> <?php the_time(get_option('date_format')) ?>
                                        </span>
                                    <?php
                                endif;

                                if(true===get_theme_mod('lawfiz_enable_single_post_meta_comments',true)) :
                                    ?>
                                    <span class="meta-item comments"><i class="bi bi-chat-dots"></i> <a class="post-comments-url" href="<?php the_permalink() ?>#comments"><?php comments_number('0','1','%'); ?></a>
                                        </span>
                                    <?php
                                endif; 
                            ?>
                        </div>
                    <?php   
                }
            ?>             
              
            <?php
                the_content();
                wp_link_pages(array(
                    'before'       => '<div class="page-link">' . esc_html__('pages','lawfiz'),
                    'after'        => '</div>',
                    'link_before'  => '<span>',
                    'link_after'   => '</span>',
                ));
            ?>
            <?php
                if(has_tag() && get_theme_mod('lawfiz_enable_single_post_tags',true) ){
                    ?>
                        <div class="post-tags">
                            <i class="bi bi-tags"></i> <?php the_tags(); ?>
                        </div>
                    <?php
                }
            ?>
            <div class="clearfix"></div>
            <?php
                if(true===get_theme_mod('lawfiz_enable_single_post_cat',true)) {
                    ?>
                        <div class="post-categories">
                            <?php $cat = esc_html(get_theme_mod('lawfiz_single_post_category_text',esc_html__('Category:','lawfiz')));?>
                            <span><i class="bi bi-folder"></i> <?php echo $cat ?></span>&nbsp;<?php the_category(); ?>
                        </div>  
                    <?php   
                }
            ?>
           
        </div>
    </div>
 </article>
 <?php esc_html(lawfiz_single_post_after_content($post->ID)); ?>
