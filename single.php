<?php

get_header();

global $bpxl_story_options;



if ( class_exists( 'ReduxFramework' ) ) {

    $bpxl_cover = $bpxl_story_options['bpxl_single_cover_image'];

    $bpxl_single_meta = $bpxl_story_options['bpxl_single_meta'];

    $bpxl_post_author = $bpxl_story_options['bpxl_single_post_meta_options']['1'];

    $bpxl_post_date = $bpxl_story_options['bpxl_single_post_meta_options']['2'];

    $bpxl_post_cats = $bpxl_story_options['bpxl_single_post_meta_options']['3'];

    $bpxl_post_tags = $bpxl_story_options['bpxl_single_post_meta_options']['4'];

    $bpxl_post_read_time = $bpxl_story_options['bpxl_single_post_meta_options']['5'];

    $bpxl_post_comments = $bpxl_story_options['bpxl_single_post_meta_options']['6'];

    $bpxl_post_subscribe_button = $bpxl_story_options['bpxl_single_post_meta_options']['7'];

    $bpxl_breadcrumbs = $bpxl_story_options['bpxl_breadcrumbs'];

    $bpxl_single_featured = $bpxl_story_options['bpxl_single_featured'];

    $bpxl_show_share_buttons = $bpxl_story_options['bpxl_show_share_buttons'];

    $bpxl_single_layout = $bpxl_story_options['bpxl_single_layout'];

    $bpxl_single_enabled_elements = $bpxl_story_options['bpxl_single_post_layout']['enabled'];

} else {

    $bpxl_cover = '0';

    $bpxl_single_meta = '1';

    $bpxl_post_author = '1';

    $bpxl_post_date = '1';

    $bpxl_post_cats = '1';

    $bpxl_post_tags = '1';

    $bpxl_post_read_time = '1';

    $bpxl_post_comments = '1';

    $bpxl_post_subscribe_button = '1';

    $bpxl_breadcrumbs = '1';

    $bpxl_single_featured = '1';

    $bpxl_show_share_buttons = '0';

    $bpxl_single_layout = 'flayout';

    $bpxl_single_enabled_elements = array('post-content' => 'Post Content', 'post-navigation' => 'Post Navigation', 'author-box' => 'Author Box', 'related-posts' => 'Related Posts');

}



if ( function_exists( 'rwmb_meta' ) ) {

    $bpxl_cover_single = rwmb_meta( 'bpxl_post_cover_show', $args = array('type' => 'checkbox'), $post->ID );

    $bpxl_single_layout_meta = rwmb_meta( 'bpxl_layout', $args = array('type' => 'image_select'), get_the_ID() );

} else {

    $bpxl_cover_single = '0';

    $bpxl_single_layout_meta = '';

}



if (have_posts()) : the_post();



    if( $bpxl_single_meta == '0' && $bpxl_show_share_buttons == '0' ) { } else { ?>

        <div class="post-meta-top clearfix">

            <div class="container">

                <?php if( $bpxl_single_meta == '1' ) {

                    if($bpxl_post_author == '1') { ?>

                        <div class="post-author-single">

                            <?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '38' );  } ?>

                            <span class="post-author"><?php the_author_posts_link(); ?></span>

                        </div>

                    <?php }

                    if($bpxl_post_date == '1') { ?>

                        <div class="posted-on">

                            <span class="post-date"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php _e( 'on', 'storyblog' ); echo '&nbsp;'; the_time(get_option( 'date_format' )); ?></time></span>

                        </div>

                    <?php }

                }

                if( $bpxl_show_share_buttons == '1' ) { ?>

                    <div class="share-icon">

                        <div class="share-button">

                            <i class="fa fa-share-square-o"></i> <span><?php _e( 'Share Story','storyblog' ); ?></span>

                        </div>

                        <?php get_template_part('template-parts/share-buttons'); ?>

                    </div>

                <?php }

                if( $bpxl_single_meta == '1' ) {

                    if($bpxl_post_subscribe_button == '1') { ?>

                        <div class="subscribe-icon">

                            <a href="<?php bloginfo('rss2_url'); ?>"><i class="fa fa-rss"></i> <span><?php _e( 'Subscribe','storyblog' ); ?></span></a>

                        </div>

                    <?php }

                } ?>

            </div>

        </div>

    <?php }



    if( $bpxl_breadcrumbs == '1' ) { ?>

        <div class="breadcrumbs">

            <div class="container">

                <?php bpxl_breadcrumb(); ?>

            </div>

        </div>

    <?php }



    if( $bpxl_single_featured == '1' ) {

        if( $bpxl_cover_single == '1' || $bpxl_cover == '1' ) {

            if( $bpxl_cover_single == '1' || empty( $bpxl_cover_single ) ) { ?>

                <div class="cover-box">

                    <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

                    <div data-type="background" data-speed="3" class="cover-image" style="background-image: url( <?php echo esc_url( $url ); ?>);">

                        <div class="cover-heading">

                            <div class="cover-text">

                                <?php

                                    if($bpxl_single_meta == '1') {

                                        if($bpxl_post_cats == '1') { ?>

                                            <div class="post-cats uppercase">

                                                <?php

                                                    // Categories

                                                    $categories = get_the_category();

                                                    $separator = '';

                                                    $output = '';

                                                    if( $categories ) {

                                                        foreach( $categories as $category ) {

                                                            $output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( esc_html__( 'View all posts in %s','storyblog' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;

                                                        }

                                                        echo trim( $output, $separator );

                                                    }

                                                ?>

                                            </div><?php

                                        }

                                    }

                                ?>

                                <header>

                                    <h2 class="title single-title">

                                        <?php the_title(); ?>

                                    </h2>

                                </header><!--.header-->

                                <?php if( $bpxl_single_meta == '1' ) { ?>

                                    <div class="post-meta">

                                      <span class="post-date"><?php echo get_the_date( 'Y년 m월 d일' ); ?></span>
                                      <div class="author-head post-meta-author_">by <span><?php echo get_the_author_meta('display_name'); ?></span></div>
                                        <?php

                                            if($bpxl_post_read_time == '1') { ?>

                                                <span class='read-time'><?php echo esc_attr( bpxl_estimated_reading_time() ); ?></span>

                                            <?php }

                                            if($bpxl_post_comments == '1') { ?>

                                                <span class="post-comments"><?php comments_popup_link( __( 'Leave a Comment', 'storyblog' ), __( '1 Comment', 'storyblog' ), __( '% Comments', 'storyblog' ), 'comments-link', __( 'Comments are off', 'storyblog' )); ?></span>

                                            <?php }

                                            edit_post_link( __( 'Edit', 'storyblog' ), '<span class="edit-link"><i class="fa fa-pencil-square-o"></i> ', '</span>' ); ?>

                                    </div>

                                <?php } ?>

                            </div><!--.cover-text-->

                        </div><!--.cover-heading-->

                    </div>

                </div><!--.cover-box-->

                <?php

            }

        }

    }

    ?>

    <div class="main-wrapper">

		<div class="main-content <?php bpxl_layout_class(); ?>">

			<div class="content-area single-content-area">

                <div id="content" class="content content-single">

                    <?php

                        rewind_posts(); while (have_posts()) : the_post();



                        foreach( $bpxl_single_enabled_elements as $bpxl_single_element_key => $bpxl_single_element ) {

                            get_template_part( 'template-parts/'.$bpxl_single_element_key );

                        }



                        // Comments

                        if ( comments_open() || get_comments_number() ) {

                            comments_template();

                        }



                        endwhile;



                        else :

                            // If no content, include the "No posts found" template.

                            get_template_part( 'template-parts/post-formats/content', 'none' );



                        endif;

                    ?>

                </div>

                <?php

                    if( !empty($bpxl_single_layout_meta) ) {

                        if ( $bpxl_single_layout_meta == 'cslayout' || $bpxl_single_layout_meta == 'sclayout' ) {

                            get_sidebar();

                        } else { }

                    } else if( $bpxl_single_layout != 'flayout' ) {

                        get_sidebar();

                    } else { }

                ?>

			</div>

		</div><!--.main-content-->

<?php get_footer();?>
