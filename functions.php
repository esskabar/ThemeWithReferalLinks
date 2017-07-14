<?php

define( 'TEMPLATE_DIRECTORY_URI', get_stylesheet_directory_uri() );
define( 'TEMPLATE_DIRECTORY', get_stylesheet_directory() );

 remove_action('template_redirect', 'redirect_canonical');


/**
 * Enqueues scripts and styles.
 */
function iflmylife_scripts() {

    // Theme stylesheet.

    wp_enqueue_style( 'iflmylife-style-main', TEMPLATE_DIRECTORY_URI.'/style.css');
    wp_enqueue_style( 'font-awesome.min.css', TEMPLATE_DIRECTORY_URI.'/font-awesome.min.css');

	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
    wp_enqueue_script( 'jquery' );
	
    wp_enqueue_script('script', TEMPLATE_DIRECTORY_URI.'/scripts/main.js',true);

    wp_enqueue_script('rating-js', TEMPLATE_DIRECTORY_URI.'/scripts/rating.js',true);
    wp_enqueue_style( 'rating-css', TEMPLATE_DIRECTORY_URI.'/rating.css');?>
    <script>
        var ajaxurl = "<?php echo admin_url('admin-ajax.php') ?>";
    </script>
<?php
}
add_action( 'wp_enqueue_scripts', 'iflmylife_scripts' );


// Register Custom Post Type
function custom_post_type() {

    $labels = array(
        'name'                  => _x( 'Casino', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Casino', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Casino', 'text_domain' ),
        'name_admin_bar'        => __( 'Casino', 'text_domain' ),
        'archives'              => __( 'Item Archives', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
        'all_items'             => __( 'All Items', 'text_domain' ),
        'add_new_item'          => __( 'Add New Item', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Item', 'text_domain' ),
        'edit_item'             => __( 'Edit Item', 'text_domain' ),
        'update_item'           => __( 'Update Item', 'text_domain' ),
        'view_item'             => __( 'View Item', 'text_domain' ),
        'search_items'          => __( 'Search Item', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
        'items_list'            => __( 'Items list', 'text_domain' ),
        'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Casino', 'text_domain' ),
        'description'           => __( 'Post Type Description', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'casino', $args );

}
add_action( 'init', 'custom_post_type', 0 );



add_action('init', 'my_custom_init');
function my_custom_init() {
    // 'portfolio' is my post type, you replace it with yours
    post_type_supports( 'casino', 'thumbnail' );
}

add_theme_support( 'post-thumbnails' );
add_image_size( 'thumb-small', 200, 150, true );

function my_breadcrumbs() {

    /* === OPTIONS === */
    $text['home']     = 'Home'; // text for the 'Home' link
    $text['category'] = 'Archive by Category "%s"'; // text for a category page
    $text['search']   = 'Search Results for "%s" Query'; // text for a search results page
    $text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
    $text['author']   = 'Articles Posted by %s'; // text for an author page
    $text['404']      = 'Error 404'; // text for the 404 page

    $show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
    $show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
    $show_title     = 1; // 1 - show the title for the links, 0 - don't show
    $delimiter      = ' &raquo; '; // delimiter between crumbs
    $before         = '<span class="current">'; // tag before the current crumb
    $after          = '</span>'; // tag after the current crumb
    /* === END OF OPTIONS === */

    global $post;
    $home_link    = home_url('/');
    $link_before  = '<span typeof="v:Breadcrumb">';
    $link_after   = '</span>';
    $link_attr    = ' rel="v:url" property="v:title"';
    $link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
//    $parent_id    = $parent_id_2 = $post->post_parent;
    $frontpage_id = get_option('page_on_front');

    if (is_home() || is_front_page()) {

        if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';

    } else {

        echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
        if ($show_home_link == 1) {
            echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
            if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
        }

        if ( is_category() ) {
            $this_cat = get_category(get_query_var('cat'), false);
            if ($this_cat->parent != 0) {
                $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
            }
            if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

        } elseif ( is_search() ) {
            echo $before . sprintf($text['search'], get_search_query()) . $after;

        } elseif ( is_day() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
            echo $before . get_the_time('d') . $after;

        } elseif ( is_month() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo $before . get_the_time('F') . $after;

        } elseif ( is_year() ) {
            echo $before . get_the_time('Y') . $after;

        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
                if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
                if ($show_current == 1) echo $before . get_the_title() . $after;
            }

        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;

        } elseif ( is_attachment() ) {
            $parent = get_post($parent_id);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            $cats = get_category_parents($cat, TRUE, $delimiter);
            $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
            $cats = str_replace('</a>', '</a>' . $link_after, $cats);
            if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
            echo $cats;
            printf($link, get_permalink($parent), $parent->post_title);
            if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

        } elseif ( is_page() && !$parent_id ) {
            if ($show_current == 1) echo $before . get_the_title() . $after;

        } elseif ( is_page() && $parent_id ) {
            if ($parent_id != $frontpage_id) {
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    if ($parent_id != $frontpage_id) {
                        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    }
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs)-1) echo $delimiter;
                }
            }
            if ($show_current == 1) {
                if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
                echo $before . get_the_title() . $after;
            }

        } elseif ( is_tag() ) {
            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . sprintf($text['author'], $userdata->display_name) . $after;

        } elseif ( is_404() ) {
            echo $before . $text['404'] . $after;
        }

        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo __('Page') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }

        echo '</div><!-- .breadcrumbs -->';

    }
}



// rewrite rule
function tlw_rewrite_rule() {
    global $wp_rewrite;

    add_rewrite_rule('go/([^/]*)/?', 'index.php?go=true&name_casino=$matches[1]', 'top');
    tlw_flush_rules();
// $wp_rewrite->flush_rules(true);  // This should really be done in a plugin activation
}
function tlw_flush_rules(){
    $rules = get_option( 'rewrite_rules' );

    if ( ! isset( $rules['go/([^/]*)/?'] ) ) {
        global $wp_rewrite;
        $wp_rewrite->flush_rules(true);
    }
}
function custom_rewrite_basic(){
    tlw_rewrite_rule();
}
//Query Vars
function tlw_register_query_var( $vars ) {
    $vars[] = 'go';
    $vars[] = 'name_casino';

    return $vars;

}
//Template Include
function twl_template_include($template)
{
    global $wp_query; //Load $wp_query object

    $page_value = $wp_query->query_vars['go']; //Check for query var "links"

    if ($page_value && $page_value == "true") { //Verify "links" exists and value is "true".
        if ( $new_template = locate_template( array( 'links.php' ) ) )
            $template = $new_template ;
    }

    return $template; //Load normal template when $page_value != "true" as a fallback

}
//Query Vars
add_filter( 'query_vars', 'tlw_register_query_var' );

//Template Include
add_filter('template_include', 'twl_template_include', 1, 1);

add_action('init', 'custom_rewrite_basic');

add_action('wp_ajax_nopriv_rate_casino', 'rate_casino');
add_action('wp_ajax_rate_casino', 'rate_casino');

function rate_casino() {
    $votes_num = (int)get_post_meta($_POST['post_id'], 'total_voices_list', true);

    $bonus = (float)get_post_meta($_POST['post_id'], 'bonuses_star_raiing', true);
    $soft = (float)get_post_meta($_POST['post_id'], 'software_star_raiting', true);
    $mobile = (float)get_post_meta($_POST['post_id'], 'mobile_support_star_raiting', true);
    $customer = (float)get_post_meta($_POST['post_id'], 'customer_service_star_raiting', true);
    $slot = (float)get_post_meta($_POST['post_id'], 'slot_house_edge_star_raiting', true);

    update_post_meta($_POST['post_id'], 'bonuses_star_raiing', round(((($votes_num*$bonus)+$_POST['bonus']))/($votes_num+1), 1));
    update_post_meta($_POST['post_id'], 'software_star_raiting', round(((($votes_num*$soft)+$_POST['soft']))/($votes_num+1), 1));
    update_post_meta($_POST['post_id'], 'mobile_support_star_raiting', round(((($votes_num*$mobile)+$_POST['mobile']))/($votes_num+1), 1));
    update_post_meta($_POST['post_id'], 'customer_service_star_raiting', round(((($votes_num*$customer)+$_POST['customer']))/($votes_num+1), 1));
    update_post_meta($_POST['post_id'], 'slot_house_edge_star_raiting', round(((($votes_num*$slot)+$_POST['slot']))/($votes_num+1), 1));

    update_post_meta($_POST['post_id'], 'total_voices_list', $votes_num+1);
var_dump($_POST['bonus']);
    setcookie('post-'.$_POST['post_id'], 'rated', time()+(86400*7), '/');
    exit;
}
