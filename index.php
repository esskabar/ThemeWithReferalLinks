<?php
/**
 * Template Name: List Casino
 *
 * @package WordPress
 * @subpackage Custom Themes
 */




get_header(); ?>
    <div class="wrapper">
    <div class="header-image">
    </div>
    <div class="container">
        <header id="header">
            <a target="_self" href="<?php  echo get_site_url();?>" class="logo-header">
                <img src="<?php echo TEMPLATE_DIRECTORY_URI; ?>/images/tentop-logo.png" alt="Topten - Home Page">
            </a>

            <h1 class="header-title">Find the Best Online Casinos to Play</h1>

            <p class="header-message">Searching for a proper place to play is challenging. But with the help of our
                service you can stop worry about quality of the service and focus on what is the most important -
                getting fun!</p>

        </header>
        <!-- / header -->
        <div id="leaderboard" class="leaderboard">
            <div data-reactroot="" class="leaderboard">

                                <?php

                                $args = array(
                                    'post_type' => 'casino',
                                    'posts_per_page' => 10,
                                    'order' => 'ASC',
                                );

                                $query = new WP_Query($args);

                                if ($query->have_posts()) {
                                    $item =0;
                                    while ($query->have_posts()) {
                                        $query->the_post();
                                        ?>

                            <div class="single-item">
                                <div class="logo-container"><a href="<?php echo '/go/'.sanitize_title( $post->post_title ); ?>" class="logo logo-guts <?php  if($item==0){

                                        echo "badge-green";

                                              }elseif($item==1){

                                                 echo "badge-orange";

                                                     }?>"><?php the_post_thumbnail( 'full' ); ?></a></div>
                                                        <div class="info-container">
                                                            <div class="bonus-description">
                                                                <header>
                                                                    <div class="casino-name"><a href="<?php echo '/go/'.sanitize_title( $post->post_title ); ?>" target="_self" class="number"><?php the_field('title_list'); ?></a>

                                                                        <div class="star-container">
                                                                            <?php
                                                                            $list_star = get_field('star_rate_list');
                                                                            $list_rate = get_field('total_voices_list');

                                                                           // $total_rate = ($bonus_rat+$sofware_rat+$mob_support_rat+$cust_serv_rat+$sle_rat)/5;

                                                                            echo do_shortcode('[usr '.$list_star.' text="true" tooltip="true" img="08.png" size=17]')?>
                                                                            <span><?php echo $list_rate ;?> votes</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="casino-bonus"><?php the_field('price_list'); ?></div>
                                                                </header>
                                                                <p><?php the_field('excerpt_list_archive'); ?></p>
                                                            </div>
                                                            <div class="button-container"><a href="<?php the_permalink(); ?>" target="<?php the_permalink(); ?>" class="review-container">
                                                                    <div class="cta-button">Read review</div>
                                                                </a>
                                                                <a href="<?php echo '/go/'.sanitize_title( $post->post_title ); ?>" target="" class="cta-container">
                                                                    <div class="cta-button">Play Now</div>
                                                                </a>
                                                            </div>
                                                        </div>
                                </div>
                                    <?php
                                    $item++;
                        }

                    } else {

                    }
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
     <?php get_footer(); ?>