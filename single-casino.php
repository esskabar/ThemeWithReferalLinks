<?php
/*
Template Name: Single Casino
*/


?>

    <?php get_header(); ?>
<body <?php body_class(); ?>>



<div class="wrapper">
    <div class="header-image">
    </div>
    <div class="container">
        <header class="header-navigation">
            <?php

            $casinos = get_posts(array('post_type' => 'casino', 'posts_per_page' => -1));

            $last = count($casinos)-1;


            if($casinos[$last]->ID == get_the_ID()) {
                $prev_post = $casinos[0];
            } else {
                $prev_post = get_previous_post();
            } ?>
            <a href="<?php echo $prev_post->guid ?>" class="arrow-block left-arrow">
                <div class="nav-arrow-label">Previous:</div>
                <div class="nav-arrow-text"><?php echo ($prev_post->post_title) ?></div>
            </a>
            <div class="center-part">
                <a target="_self" href="<?php  echo get_site_url();?>" class="logo-header logo-half">
                    <img src="<?php echo TEMPLATE_DIRECTORY_URI; ?>/images/tentop-logo.png" alt="Topten - Home Page" width="182">
                </a>
                <div class="breadcrumbs">
                    <p class="single-bread single-bread--active"><?php if (function_exists('my_breadcrumbs')) my_breadcrumbs(); ?></p>
                </div>
            </div>
            <?php if($casinos[0]->ID == get_the_ID()) {
                    $next_post = $casinos[$last];
                } else {
                    $next_post = get_next_post();
            } ?>
            <a href="<?php echo $next_post->guid ?>" class="arrow-block right-arrow">
                <div class="nav-arrow-label">Next:</div>
                <div class="nav-arrow-text"><?php echo ($next_post->post_title) ?></div>
            </a>
        </header>
        <section>
            <div class="casino-main-block">
                <div class="narrow-column narrow-center-aligned">
                    <a href="<?php echo '/go/'.sanitize_title( $post->post_title ); ?>"><h1><?php the_field('title_list'); ?></h1></a>
                    <img src="<?php the_field('image_review_single_casino'); ?>">
                    <div class="star-container">
                        <?php
                        //$after_img_rate = //get_field('after_image_star_rate');

                        $bonus_rat = get_field('bonuses_star_raiing');
                        $sofware_rat = get_field('software_star_raiting');
                        $mob_support_rat = get_field('mobile_support_star_raiting');
                        $cust_serv_rat = get_field('customer_service_star_raiting');
                        $sle_rat = get_field('slot_house_edge_star_raiting');

                        $total_rate = ($bonus_rat+$sofware_rat+$mob_support_rat+$cust_serv_rat+$sle_rat)/5;

                        echo do_shortcode('[usr '.$total_rate.' text="true" tooltip="true" img="08.png" size=17]')?>
                    </div>
                    <a href="<?php echo '/go/'.sanitize_title( $post->post_title ); ?>" target="_self" class="cta-container cta-container-wide">
                        <div class="cta-button">Play Now</div>
                    </a>
                    <div class="welcome-bonus-container">
                        <div class="label">Welcome Bonus:</div>
                        <div class="bonus"><?php the_field('welcome_bonus_single_casino'); ?></div>
                    </div>
                </div>
                <?php
                $image = get_field('first_image_gallery');
                ?>
                <div class="screenshot-gallery" itemscope="" itemtype="http://schema.org/ImageGallery" data-pswp-uid="1">
                    <figure class="screenshot-main" itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                        <a href="<?php echo $image['url']; ?>" itemprop="contentUrl" data-size="1920x1280">
                            <img src="<?php echo $image['sizes']['large']; ?>" itemprop="thumbnail" alt="Image description">
                        </a>
                        <figcaption itemprop="caption description"></figcaption>
                    </figure>
                    <?php  $image_second = get_field('second_image_gallery');?>
                    <figure itemprop="associatedMedia" itemscope="contentUrl" itemtype="http://schema.org/ImageObject">
                        <a href="<?php echo $image_second['url']; ?>" itemprop="contentUrl" data-size="1920x1280">
                            <img src="<?php echo $image_second['sizes']['medium']; ?>" itemprop="thumbnail" alt="Image description">

                        </a>
                        <figcaption itemprop="caption description"></figcaption>
                    </figure>
                    <?php  $image_third = get_field('third_image_gallery');?>
                    <figure itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                        <a href="<?php echo $image_third['url']; ?>" itemprop="contentUrl" data-size="1920x1280">
                            <img src="<?php echo $image_third['sizes']['medium']; ?>" itemprop="thumbnail" alt="Image description">
                        </a>
                        <figcaption itemprop="caption description"></figcaption>
                    </figure>
                    <?php  $image_four = get_field('four_image_gallery');?>
                    <figure itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                        <a href="<?php echo $image_four['url']; ?>" itemprop="contentUrl" data-size="1920x1280">
                            <img src="<?php echo $image_four['sizes']['medium']; ?>" itemprop="thumbnail" alt="Image description">

                        </a>
                        <figcaption itemprop="caption description"></figcaption>
                    </figure>
                    <?php  $img_five = get_field('five_image_gallery');?>
                    <figure itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                        <a href="<?php echo $img_five['url']; ?>" itemprop="contentUrl" data-size="1920x1280">
                            <img src="<?php echo $img_five['sizes']['medium']; ?>" itemprop="thumbnail" alt="Image description">
                        </a>
                        <figcaption itemprop="caption description"></figcaption>
                    </figure>
                </div>
                <div class="narrow-column">
                    <div class="info-block">
                        <div class="info-line">
                            <div class="label">Name:</div>
                            <div class="content"><?php the_field('title_list'); ?></div>
                        </div>
                        <div class="info-line">
                            <div class="label">Website:</div>
                            <div class="content"><a href="<?php echo '/go/'.sanitize_title( $post->post_title ); ?>">Click here</a></div>
                            <?php var_dump( $post->post_title);?>
                        </div>
                        <div class="info-line">
                            <div class="label">Active Since:</div>
                            <div class="content"><?php the_field('active_since_single_casino'); ?></div>
                        </div>
                        <div class="info-line">
                            <div class="label">Support:</div>
                            <div class="content"><?php the_field('support_single_casino'); ?></div>
                        </div>
                        <div class="info-line info-line-block">
                            <div class="label">Payment methods:</div>
                            <div class="payment-methods">
                                <div class="single-payment payment-visa"></div>
                                <div class="single-payment payment-visa-debit"></div>
                                <div class="single-payment payment-mastercard"></div>
                                <div class="single-payment payment-wire-transfer"></div>
                                <div class="single-payment payment-skrill"></div>
                                <div class="single-payment payment-more"></div>
                            </div>
                        </div>
                    </div>

                    <div class="info-block">
                        <div class="review-row">
                            <div class="label">Bonuses:</div>
                            <div class="content">
                                <div class="star-container">
                                    <?php

                                    echo do_shortcode('[usr '.$bonus_rat.' text="true" tooltip="true"]')?>
                                </div>
                            </div>
                        </div>
                        <div class="review-row">
                            <div class="label">Software:</div>
                            <div class="content">
                                <div class="star-container">
                                    <?php

                                    echo do_shortcode('[usr '.$sofware_rat.' text="true" tooltip="true"]')?>
                                </div>
                            </div>
                        </div>
                        <div class="review-row">
                            <div class="label">Mobile Support:</div>
                            <div class="content">
                                <div class="star-container">
                                    <?php

                                    echo do_shortcode('[usr '.$mob_support_rat.' text="true" tooltip="true"]')?>
                                </div>
                            </div>
                        </div>
                        <div class="review-row">
                            <div class="label">Customer Service:</div>
                            <div class="content">
                                <div class="star-container">
                                    <?php

                                    echo do_shortcode('[usr '.$cust_serv_rat.' text="true" tooltip="true"]')?>
                                </div>
                            </div>
                        </div>
                        <div class="review-row">
                            <div class="label">Slot House Edge:</div>
                            <div class="content">
                                <div class="star-container">
                                    <?php

                                    echo do_shortcode('[usr '.$sle_rat.' text="true" tooltip="true"]')?>
                                </div>
                            </div>
                        </div>
                        <div class="review-overall">
                            <div class="label">Overall Rating:</div>
                            <div class="value"><?php

                                echo $total_rate ;

                                ?></div>
                        </div>
                    </div>
                    <?php if(!isset($_COOKIE['post-'.get_the_ID()])) : ?>
                    <a href="#" class="cta-container cta-container-wide rate-btn">
                        <div class="cta-button">Rate it!</div>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <p class="introduction">
                <?php the_field('review_title_class_introduction'); ?>
            </p>
            <div class="two-column-layout">
                <div class="wide-column">
                    <?php the_field('reviwes_notification_class'); ?>
                    <h3>Similar casinos</h3>
                    <p>
                        Below you can find links to similar casinos:
                    </p>
                    <div class="similar-casinos-block">
                        <?php
                        $args=array('post_type'=>'casino', 'orderby'=>'rand', 'posts_per_page'=>'3');
                        $testimonials=new WP_Query($args);
                        while ($testimonials->have_posts()) : $testimonials->the_post();
                            ?>
                            <a href="<?php the_permalink() ?>" class="similar-casino-single">
                                <?php the_post_thumbnail( 'full' ); ?>
                                <div class="label"><?php the_field('title_list'); ?></div>
                                <div class="bonus-text"><?php the_field('welcome_bonus_single_casino'); ?></div>
                            </a>
                        <p><?php the_excerpt(); ?></p>
                        <?php
                        endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                </div>
                <div class="narrow-column">
                    <div class="info-panel">
                        <h4>Guts Customer Support</h4>
                        <div class="info-block">
                            <div class="label">Available Languages:</div>
                            <div class="content"><?php the_field('availebel_languages'); ?></div>
                        </div>

                        <div class="info-block">
                            <div class="label">Email Address:</div>
                            <div class="content"><a href="mailto:support@betsafe.com"><?php the_field('email_address_single_casino'); ?></a></div>
                        </div>

                        <div class="info-block">
                            <div class="label">Phone:</div>
                            <div class="content"><a href="<?php the_field('phone_number_single_casino'); ?>"><?php the_field('phone_number_single_casino'); ?></a></div>
                        </div>

                        <div class="info-block">
                            <div class="label">Live Chat Available:</div>
                            <div class="content"><?php the_field('live_chat_availebel_single_casino'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="popup"><a class="close-popup">X</a>
        <h3>Set you rates</h3>
        <form name="rate_it" class="rate-form">
            <label>Bonuses: </label>
            <div class="bonuses-container">
                <input type="radio" name="bonuses" class="rating" value="1" />
                <input type="radio" name="bonuses" class="rating" value="2" />
                <input type="radio" name="bonuses" class="rating" value="3" />
                <input type="radio" name="bonuses" class="rating" value="4" />
                <input type="radio" name="bonuses" class="rating" value="5" />
            </div>
            <br/>
            <label>Software: </label>
            <div class="software-container">
                <input type="radio" name="software" class="rating" value="1" />
                <input type="radio" name="software" class="rating" value="2" />
                <input type="radio" name="software" class="rating" value="3" />
                <input type="radio" name="software" class="rating" value="4" />
                <input type="radio" name="software" class="rating" value="5" />
            </div>
            <br/>
            <label>Mobile Support: </label>
            <div class="mobile-support-container">
                <input type="radio" name="mobile_support" class="rating" value="1" />
                <input type="radio" name="mobile_support" class="rating" value="2" />
                <input type="radio" name="mobile_support" class="rating" value="3" />
                <input type="radio" name="mobile_support" class="rating" value="4" />
                <input type="radio" name="mobile_support" class="rating" value="5" />
            </div>
            <br/>
            <label>Customer Service: </label>
            <div class="customer-service-container">
                <input type="radio" name="customer_service" class="rating" value="1" />
                <input type="radio" name="customer_service" class="rating" value="2" />
                <input type="radio" name="customer_service" class="rating" value="3" />
                <input type="radio" name="customer_service" class="rating" value="4" />
                <input type="radio" name="customer_service" class="rating" value="5" />
            </div>
            <br/>
            <label>Slot House Edge: </label>
            <div class="slot-house-edge-container">
                <input type="radio" name="slot_house_edg" class="rating" value="1" />
                <input type="radio" name="slot_house_edg" class="rating" value="2" />
                <input type="radio" name="slot_house_edg" class="rating" value="3" />
                <input type="radio" name="slot_house_edg" class="rating" value="4" />
                <input type="radio" name="slot_house_edg" class="rating" value="5" />
            </div>
<input type="hidden" value="<?php the_ID() ?>" name="post_id" />
            <br/>
            <button class="cta-container cta-container-wide">Rate!</button>
        </form>
    </div>
<?php get_footer(); ?>