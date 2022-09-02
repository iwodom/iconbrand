<?php
add_theme_support( 'post-thumbnails' );
add_post_type_support( 'page', 'excerpt' );
add_filter( 'wpcf7_autop_or_not', '__return_false' );


// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
  global $wp_version;
  if ( $wp_version !== '4.7.1' ) {
     return $data;
  }
  $filetype = wp_check_filetype( $filename, $mimes );
  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];
}, 10, 4 );
function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );
function fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );

function wporg_block_wrapper( $block_content, $block ) {
  if ( $block['blockName'] === 'core/paragraph' ) {
      $content = '<div class="wp-block-paragraph">';
      $content .= $block_content;
      $content .= '</div>';
      return $content;
  } elseif ( $block['blockName'] === 'core/heading' ) {
      $content = '<div class="wp-block-heading">';
      $content .= $block_content;
      $content .= '</div>';
      return $content;
  } elseif ( $block['blockName'] === 'core/list' ) {
      $content = '<div class="wp-block-list">';
      $content .= $block_content;
      $content .= '</div>';
      return $content;
  }
  return $block_content;
}
add_filter( 'render_block', 'wporg_block_wrapper', 10, 2 );


if ( function_exists( 'add_image_size' ) ) {
add_image_size( 'article', 770, 770, true ); //(cropped)
add_image_size( 'section', 200, 200, false ); //(scaled)
add_image_size( 'background', 1920, 1080, false ); //(scaled)
add_image_size( 'laptop', 1300, 1300, false ); //(scaled)
add_image_size( 'tablet', 800, 800, false ); //(scaled)
add_image_size( 'phone', 400, 400, false ); //(scaled)
}

// Favicon
// add a favicon to your
// function blog_favicon() {
// 	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('wpurl').'/favicon.ico" />';
// }
// add_action('wp_head', 'blog_favicon');

// category id in body and post class
function category_id_class($classes) {
	global $post;
	foreach((get_the_category($post->ID)) as $category)
		$classes [] = 'cat-' . $category->cat_ID . '-id';
		return $classes;
}
add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class');


@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );
//Register Navigations
add_action( 'init', 'my_custom_menus' );
function my_custom_menus() {
    register_nav_menus(
        array(
            'primary-menu' => __( 'Primary Menu' ),
            'secondary-menu' => __( 'Secondary Menu' ),
            'lang' => __( 'Języki' )
        )
    );
}
// Stylesheet and Script

function style_script() {
  wp_enqueue_style( 'plugin-css', get_template_directory_uri() . '/dist/css/plugin.min.css', '', filemtime(get_stylesheet_directory() . '/dist/css/plugin.min.css' ) );
  wp_enqueue_style( 'style', get_template_directory_uri() . '/dist/css/main.css', '', filemtime(get_stylesheet_directory() . '/dist/css/main.min.css' ));
  wp_enqueue_style( 'styleWordpress', get_template_directory_uri() . '/style.css', '', filemtime(get_stylesheet_directory() . '/style.css' ));
  wp_enqueue_style( 'googlefonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700,800', '', '', true  );
    // Scripts
  wp_deregister_script('jquery-script');
    wp_deregister_script('jquery');
    // wp_register_script('jquery', '//code.jquery.com/jquery-3.2.1.min.js', array(), null);
    // wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), null);
    wp_register_script('jquery', get_template_directory_uri() . '/dist/js/jquery-3.6.0.min.js', array(), null);
    wp_enqueue_script('jquery');

  // wp_enqueue_script( 'script', get_template_directory_uri() . '/dist/js/scripts.js', array( 'jquery' ), filemtime(get_stylesheet_directory() . '/dist/js/scripts.js' ), false );

    wp_localize_script( 'script', 'rest_url', array(
      'root' => esc_url_raw( rest_url() ),
      'theme' => get_bloginfo( 'template_url' ),
      'ajax' => admin_url( 'admin-ajax.php' ),
  ) );

}
add_action( 'wp_enqueue_scripts', 'style_script' );


if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Header',
		'menu_title'	=> 'Nagłówek',
		'menu_slug' 	=> 'header',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
		));
		acf_add_options_page(array(
		'page_title' 	=> 'Footer',
		'menu_title'	=> 'Stopka',
		'menu_slug' 	=> 'footer',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
		));

}
// require get_template_directory().'/inc/jsdefer.php';
// require get_template_directory().'/inc/wpHtmlCompression.php';
// require get_template_directory().'/inc/ajax.php';
// require get_template_directory().'/inc/breadcrumb.php';
// require get_template_directory().'/inc/pagination.php';
// require get_template_directory().'/inc/sitemap.php';

// Widget
register_sidebar( array (
'name' => __( 'Widget'),
'id' => 'lang-widget',
'before_widget' => '',
'after_widget' => '',
'before_title' => '',
'after_title' => '',
) );
register_sidebar( array (
'name' => __( 'Polylang Mobile'),
'id' => 'polylang-mobile',
'before_widget' => '',
'after_widget' => '',
'before_title' => '',
'after_title' => '',
) );



// ACF Gutenberg block
add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'case_studies',
            'title'             => __('Case studies'),
            'description'       => __('Blok wyśiwetlający case studies'),
            'render_template'   => 'parts/blocks/case_studies/case_studies.php',
            'enqueue_style' => get_template_directory_uri() . 'dist/css/parts/blocks/case_studies/case_studies.css',
            'category'          => 'layout',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'Case studies', 'Case', 'studies'),
            'mode' => 'edit',
            'enqueue_assets' => function(){
              wp_enqueue_style( 'block-testimonial', get_template_directory_uri() . '/dist/css/parts/blocks/case_studies/case_studies.css' );
              wp_enqueue_script( 'block-testimonial', get_template_directory_uri() . '/dist/js/scripts.js', array('jquery'), '', true );
          },

        ));
    }
}

// Skróty
function tempDir() {
    return get_template_directory_uri();
}

function imageDir( $string ) {
    return tempDir() . '/img/' . $string;
}


function fileDir() {
    return get_template_directory();
}
/**
 *  Podpinanie fancybox pod gutenberg gallery
 */
 add_filter('the_content', 'aggiungi_fancybox');

function aggiungi_fancybox($content) {
       global $post;
       $pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
       $replacement = '<a$1href=$2$3.$4$5 data-fancybox="gallery" title="'.$post->post_title.'"$6>';
       $content = preg_replace($pattern, $replacement, $content);
       return $content;
}
/**
 *  Podpinanie fancybox pod galerie
 */

    function get_id($inc = false) {
      static $id;
        if ($inc) {
          $id++;
        }
      return $id;
    }

    function replace($link) {
      $id = get_id();
      return str_replace('<a href=', '<a data-fancybox="Gallery-'.$id.'" href=', $link);
    }

    add_filter(
      'post_gallery',
      function() {
        get_id(true);
        add_filter('wp_get_attachment_link','replace');
      }
    );

    function taco_gallery_default_settings( $settings ) {
    $settings['galleryDefaults']['link'] = 'file';
    return $settings;
}
add_filter( 'media_view_settings', 'taco_gallery_default_settings');

function phone_to_link( $string ) {
    $string = str_replace( '+', '00', $string );
    $string = str_replace( '-', '', $string );
    $string = str_replace( ' ', '', $string );
    $string = str_replace( '.', '', $string );
    return $string;
}
//<a href="tel:php echo esc_html(phone_to_link( $number_tel ) ); "> </a>


// LOGIN PAGE
function my_custom_login_logo() {
  echo '<style type="text/css">
body {
 background-image: linear-gradient(to top, #537895 0%, #09203f 100%)
}
.login h1 a {
 height: 95px!important;
 width: 94px!important;
 background-position: center center;
 background-repeat: no-repeat;
 background-size: contain;
background-image: url( https://webgo.dev/wp-content/uploads/2020/12/logo-webgo@2.png )!important;
  margin-bottom: 10px;
  filter: drop-shadow(0px 0px 7px #ededed);
}
.login h1:after {
 content: "Strony internetowe, identyfikacja wizualna firmy, kampanie marketingowe Google AdWords.";
 display:block;
 color: #FFF;
 font-size: 13px;
}
.login h1 {
 border-bottom: 1px solid #bdbdbd;
 padding-bottom: 20px;
}
.login form {
 background-color: rgba( 255,255,255,0.10 );
}
.login form .input, .login form input[type=checkbox], .login input[type=text] {
 background-color: rgba( 0,0,0,0 );
 color: #FFF;
 border: 1px solid ( 255,255,255,0.4 );
}
.login label{
 color: #FFF;
}
.login #backtoblog a, .login #nav a  {
 color: #FFF;
}
#login form p {
 text-align: center;
}
.login #login_error, .login .message, .login .success {
 color: #FFF;
 background-color: rgba( 255,255,255,0.14 );
}
a {
 color: #FFF;
 text-decoration: underline!important;
 }

  </style>';
}

add_action('login_head', 'my_custom_login_logo');

add_filter( 'login_headerurl', 'custom_loginlogo_url' );

function custom_loginlogo_url($url) {

  return 'http://www.webgo.dev';

}
