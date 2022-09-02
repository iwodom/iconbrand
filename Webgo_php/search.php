<?php get_header();
    $search=$_GET['search'];
?>
<section class="news_hero">
  <div class="container">
    <div class="row">
      <div class="col-md-9 news_slider">
        <?php
        $featured_posts = get_field('popular');
        if( $featured_posts ): ?>
        <div class="swiper-container swiper_popular">
          <div class="swiper-wrapper">
            <?php foreach( $featured_posts as $post ):
              $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                setup_postdata($post); ?>
                <div class="swiper-slide">
                    <a href="<?php the_permalink(); ?>" style="background-image: url('<?php echo $thumb['0'];?>')">
                      <div class="content">
                        <div class="cat_container">
                          <?php
                          $category_detail=get_the_category(get_the_ID());//$post->ID
                           foreach($category_detail as $cd){
                             $color = get_field( 'color', 'term_'.$cd->cat_ID);
                             if( !empty( $color ) ) {
                               $colorHex = $color;
                             } else {
                               $colorHex = '#003276';
                             }
                             ?>
                             <div class="single_cat" style="background-color: <?php echo $colorHex ?>">
                               <?php echo $cd->cat_name; ?>
                             </div>
                           <?php }
                          ?>
                        </div>
                        <div class="content_left">
                          <h3><?php the_title(); ?></h3>
                        </div>
                        <div class="content_right">
                          <div class="user">
                            <?php
                            $post_date = get_the_date( 'd.m.Y', get_the_ID() );
                            global $post;
                            $author_id = $post->post_author;
                            $author_badge = get_field('img_user', 'user_'. $author_id );
                            ?>
                            <div class="row">
                              <div class="col-6 img">
                                <img src="<?php echo $author_badge['url']?>" alt="">
                              </div>
                              <div class="col-6 date">
                                <p class="user_name"><?php echo get_the_author_meta( 'nicename', $author_id ); ?></p>
                                <p class="post_date"><?php echo $post_date; ?></p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php
        wp_reset_postdata(); ?>
    <?php endif; ?>

      </div>
      <div class="col-md-3 popular_post">
        <div class="popular_title">
          <h2>Popularne:</h2>
        </div>
        <?php
        $featured_posts = get_field('popular');
        if( $featured_posts ): $popularCount = -1;?>
            <ul class="popular_list">
            <?php foreach( $featured_posts as $post ):
              $popularCount++;
                // Setup this post for WP functions (variable must be named $post).
                setup_postdata($post);
                if( $popularCount == 0 ) {
                  $classActive = 'active';
                } else {
                  $classActive = '';
                }
                ?>
                <li class="popular_<?php echo $popularCount ?> <?php echo $classActive ?>">
                    <a href="<?php echo $popularCount ?>">
                      <div class="cat_container">
                        <?php
                        $category_detail=get_the_category(get_the_ID());//$post->ID
                         foreach($category_detail as $cd){
                           $color = get_field( 'color', 'term_'.$cd->cat_ID);
                           if( !empty( $color ) ) {
                             $colorHex = $color;
                           } else {
                             $colorHex = '#003276';
                           }
                           ?>
                           <div class="single_cat" style="background-color: <?php echo $colorHex ?>">
                             <?php echo $cd->cat_name; ?>
                           </div>
                         <?php }
                        ?>
                      </div>
                      <h3><?php the_title(); ?></h3>
                    </a>
                </li>
            <?php endforeach; ?>
            </ul>
            <?php
            // Reset the global post object so that the rest of the page works correctly.
            wp_reset_postdata(); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<section class="filter">
  <div class="container">
    <div class="row">
      <div class="col-12 flex">
        <div class="filter_content">
          <div class="filter_title">
            <p>Co cie interesuję?</p>
          </div>
          <div class="filter_cat">
            <div class="single_cat active">
              <a href="">Wszystkie</a>
            </div>
            <?php
            $all_cat=get_categories();
             foreach($all_cat as $cat){
               if( $cat->slug == 'bez-kategorii' ) {

               } else { ?>
                 <div class="single_cat">
                   <a href="<?php echo $cat->cat_ID;?>"><?php echo $cat->cat_name; ?></a>
                 </div>
               <?php }
                ?>
             <?php }
            ?>
          </div>
        </div>
        <div class="filter_search">
          <?php get_search_form(); ?>
          <div class="button">
            <img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/ikona-szukaj@2.png" />
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="list_news">
  <div class="container">
    <div class="row">
      <?php
      $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
      $args = array(
          'post_type' => 'post',
          'posts_per_page' => 6,
          'paged' => $paged,
          's' =>$s
      );
      $wp_query = new WP_Query( $args ); ?>
      <?php if ( $wp_query->have_posts() ) : ?>
          <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
              <div class="col-md-4 single_news">
                  <div class="background">
                      <a href="<?php the_permalink(); ?>">
                          <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
                           <div class="thumbnail" style="background-image: url('<?php echo $thumb['0'];?>')">
                           </div>
                           <div class="desc">
                             <div class="cat_container">
                               <?php
                               $category_detail=get_the_category(get_the_ID());//$post->ID
                                foreach($category_detail as $cd){
                                  $color = get_field( 'color', 'term_'.$cd->cat_ID);
                                  if( !empty( $color ) ) {
                                    $colorHex = $color;
                                  } else {
                                    $colorHex = '#003276';
                                  }
                                  ?>
                                  <div class="single_cat" style="background-color: <?php echo $colorHex ?>">
                                    <?php echo $cd->cat_name; ?>
                                  </div>
                                <?php }
                               ?>
                             </div>
                             <h3><?php the_title(); ?></h3>
                           </div>
                           <div class="user">
                             <?php
                             $post_date = get_the_date( 'd.m.Y', get_the_ID() );
                             global $post;
                             $author_id = $post->post_author;
                             $author_badge = get_field('img_user', 'user_'. $author_id );
                             ?>
                             <div class="row">
                               <div class="col-6 img">
                                 <img src="<?php echo $author_badge['url']?>" alt="">
                               </div>
                               <div class="col-6 date">
                                 <p class="user_name"><?php echo get_the_author_meta( 'nicename', $author_id ); ?></p>
                                 <p class="post_date"><?php echo $post_date; ?></p>
                               </div>
                             </div>
                           </div>
                      </a>
                  </div>
              </div>
          <?php endwhile; ?>
          <div class="col-12 pagination_container">
            <?php taco_pagination();  ?>
          </div>
        <?php endif; ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
