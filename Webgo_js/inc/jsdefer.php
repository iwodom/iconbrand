<?php

/* Dodawanie tagu defer podczas ładowania skryptów */
function bezzo_script_tag_defer( $tag, $handle ) {
    if ( is_admin() ) {
        return $tag;
    }
    if ( strpos( $tag, '/wp-includes/js/jquery/jquery' ) ) {
        return $tag;
    }
    if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE 9.' ) !==false ) {
        return $tag;
    }
    else {
        return str_replace( ' src',' defer src', $tag );
    }
}
add_filter( 'script_loader_tag', 'bezzo_script_tag_defer', 10, 2 );