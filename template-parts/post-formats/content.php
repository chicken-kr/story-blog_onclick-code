<?php

    global $bpxl_story_options;

    if ( class_exists( 'ReduxFramework' ) ) {

        $bpxl_post_meta = $bpxl_story_options['bpxl_post_meta'];

        $bpxl_post_author = $bpxl_story_options['bpxl_post_meta_options']['1'];

        $bpxl_post_date = $bpxl_story_options['bpxl_post_meta_options']['2'];

        $bpxl_post_cats = $bpxl_story_options['bpxl_post_meta_options']['3'];

        $bpxl_post_read_time = $bpxl_story_options['bpxl_post_meta_options']['4'];

        $bpxl_home_content = $bpxl_story_options['bpxl_home_content'];

    } else {

        $bpxl_post_meta = '1';

        $bpxl_post_author = '1';

        $bpxl_post_date = '1';

        $bpxl_post_cats = '1';

        $bpxl_post_read_time = '1';

        $bpxl_home_content = '1';

    }

    $bpxl_cover_bg_color = rwmb_meta( 'bpxl_post_bg_color', $args = array('type' => 'color'), get_the_ID() );

    $bpxl_cover_opacity = rwmb_meta( 'bpxl_post_opacity', $args = array('type' => 'number'), get_the_ID() );



    if ( empty ( $bpxl_cover_opacity ) ) {

        $bpxl_cover_opacity = 60;

    }



    if ( $bpxl_cover_bg_color ) { ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-grid' ); ?> style="cursor:pointer;background-color: <?php echo $bpxl_cover_bg_color; ?>" onclick="location.href='<?php echo get_post_permalink($post->ID); ?>'">

    <?php } else { ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-grid' ); ?> style="cursor:pointer;" onclick="location.href='<?php echo get_post_permalink($post->ID); ?>'">

    <?php }

    if ( has_post_thumbnail() ) {

        $bpxl_post_coverurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

        <div class="post-cover" style="background-image: url(<?php echo esc_url( $bpxl_post_coverurl ); ?>); opacity: <?php echo absint( $bpxl_cover_opacity) / 100; ?>" ></div>

    <?php }

    if( $bpxl_post_meta == '1' ) { ?>

        <div class="post-meta-thumb">

            <?php

                if( $bpxl_post_author == '1' ) { ?>

                    <div class="post-avtar">

                        <?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '50' );  } ?>

                        <span class="post-author"><?php _e( 'by','storyblog'); ?> <?php the_author_posts_link(); ?></span>

                    </div>

                    <?php

                }

                if( $bpxl_post_date == '1' ) { ?>

                    <span class="posted-on">

                        <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" title="<?php the_time('F j, Y'); ?>">

                            <span class="post-day"><?php the_time('d'); ?></span>

                        <span class="post-month"><?php the_time('F'); ?> <?php the_time('Y'); ?></span>

                        </time>

                    </span>

                    <?php

                }

            ?>

        </div>

        <?php

    } ?>

    <div class="post-inner">

        <?php

        if ( $bpxl_post_cats == '1' ) { ?>

            <div class="post-cats uppercase">

                <?php

                    // Categories

                    $categories = get_the_category();

                    $separator = '';

                    $output = '';

                    if ( $categories ) {

                        foreach( $categories as $category ) {

                            $output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( esc_html__( 'View all posts in %s','storyblog' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;

                        }

                        echo trim( $output, $separator );

                    }

                ?>

            </div>

            <?php

        }



        get_template_part('template-parts/post-header');



        if ( is_search() ) { ?>

            <div class="post-content entry-summary">

                <?php the_excerpt(); ?>

            </div><!-- .entry-summary -->

            <?php

        } else {

            if( $bpxl_home_content == '1' ) { ?>

                <div class="post-content entry-content">

                    <?php the_excerpt(); ?>

                </div><!--post-content-->

                <?php

            }

        }



        if ( $bpxl_post_read_time == '1' ) { ?>

            <div class='read-time'><?php echo esc_attr( bpxl_estimated_reading_time() ); ?></div>

            <?php

        }



        edit_post_link( __( 'Edit', 'storyblog' ), '<div class="edit-link"><i class="fa fa-pencil-square-o"></i> ', '</div>' ); ?>

    </div><!--.post-inner-->

</article><!--.post-box-->
