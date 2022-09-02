<?php get_header(); ?>
<div class="content-wrap">
    <div class="content container">
        <div class="row">
            <div class="page-content">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                     if(has_post_format('link')): 
                     else : ?>
                        <h1 class="single-title"><?php the_title(); ?></h1>
                        <hr>
                        <p class="single-description"><?php the_content(); ?></p>
                        <div class="single-img">
                           <?php the_post_thumbnail(); ?>
                        </div>
                        <div class="single-desc">
                            <h4>Author: <?php the_author(); ?> </h4>
                            <h4>Date: <?php the_date(); ?></h4>
                        </div>
                    <?php endif; 	
                    endwhile; 
                    else: ?>
                    <p><?php echo esc_html('Brak wpisów.'); ?></p>
				<?php endif; ?>	
           </div>
        </div>
    </div>
</div>
<?php get_footer(); 