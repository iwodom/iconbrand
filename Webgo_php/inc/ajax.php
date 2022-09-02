<?php
// Add Ajax Actions
add_action('wp_ajax_category_filter', 'category_filter');
add_action('wp_ajax_nopriv_category_filter', 'category_filter');

// Front-page loop
function category_filter () {
  $currentCategory = $_POST[ 'cat' ];

  $args = array(
      'post_type' => 'realizacja',
      'category_name' => $currentCategory
  );
  $the_query = new WP_Query( $args ); ?>
  <?php if ( $the_query->have_posts() ) : ?>
      <div class="mansory-grid">
      <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <?php
        $logo = get_field( 'logo' );
        $project = get_field( 'project' );
        $investment = get_field( 'investment' );
        $investor = get_field( 'investor' );
        $work = get_field( 'work' );
        $project_time = get_field( 'project_time' );
        $gallery_single = get_field( 'gallery_single' );
        ?>
        <div class="post">
            <div class="background">
              <?php
              if ( !empty( $logo ) ) { ?>
                <div class="img">
                  <img src="<?php echo $logo ?>" alt="">
                </div>
              <?php } ?>
              <div class="title">
                <h2><?php echo $project ?></h2>
              </div>
              <?php
              if ( !empty( $investment ) ) { ?>
                <div class="desc-post">
                  <h4>Inwestycja:</h4>
                  <p><?php echo $investment ?></p>
                </div>
              <?php } ?>
              <?php
              if ( !empty( $investor ) ) { ?>
                <div class="desc-post">
                  <h4>Inwestor:</h4>
                  <p><?php echo $investor ?></p>
                </div>
              <?php } ?>
              <?php
              if ( !empty( $work ) ) { ?>
                <div class="desc-post">
                  <h4>Zakres prac:</h4>
                  <p><?php echo $work ?></p>
                </div>
              <?php } ?>
              <?php
              if ( !empty( $project_time ) ) { ?>
                <div class="desc-post">
                  <h4>Okres realizacji:</h4>
                  <p><?php echo $project_time ?></p>
                </div>
              <?php } ?>
              <?php if( have_rows('gallery_single') ): ?>
                <?php $i = 0;
                $my_fields = get_field_object('gallery_single');
                $count = (count($my_fields['value']));
                 ?>
                 <div class="gallery-content">
                   <h2>Galeria:</h2>
                   <div class="overlay">
                     <div class="counter">
                       <p>+ <?php echo $count ?></p>
                     </div>
                   <?php while( have_rows('gallery_single') ): the_row();
                    $i++;
                   $image_single = get_sub_field('image_single');
                   ?>
                    <?php
                    if ( $i == 1 ) {
                      $gallery = 'first-image';
                    }
                    if ( $i > 1 ) {
                      $gallery = 'more-image';
                    }
                    ?>
                    <a href="<?php echo $image_single ?>" data-rel="lightcase:myCollection">
                      <div class="swipebox image-gallery <?php echo $gallery ?>" style="background-image:url(<?php echo $image_single ?>)">

                      </div>
                    </a>
                 <?php endwhile; ?>
                  </div>
                 </div>
              <?php endif; ?>
              <?php if( have_rows('document') ): ?>
                <div class="document-content">
                  <h2>Dokumentacja:</h2>
                  <?php while( have_rows('document') ): the_row();
                    $title_document = get_sub_field('title_document');
                    $file_document = get_sub_field('file_document');
                    ?>
                    <a download href="<?php echo $file_document['url']; ?>">
                      <?php echo $title_document ?>
                    </a>
                  <?php endwhile; ?>
                </div>
              <?php endif; ?>
            </div>
        </div>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    </div>
  <?php endif;
  die();

}
