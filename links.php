<?php


$name_casino = get_query_var( 'name_casino' );


$row_with_name_casino = tlw_get_row_with_name_casino( $name_casino );


if (  is_string( $row_with_name_casino ) && $row_with_name_casino != '' ) {
    header( 'HTTP/1.1 301 Moved Permanently' );
    header( 'Location: ' . $row_with_name_casino);
    exit();

} else {
    global $wp_query;
    $wp_query->set_404();
    status_header( 404 );
    get_template_part( 404 );
    exit();
}

function tlw_get_row_with_name_casino($name_casino)
{


    $args = array(
        'name' => $name_casino,
        'post_type' => 'casino',
        'post_status' => 'publish',
        'numberposts' => 1
    );
    $my_posts = get_posts($args);
    if ($my_posts) :
        $post_id = $my_posts[0]->ID;
    endif;
    $link = get_field('play_list_button', $post_id);


    return $link;


}


