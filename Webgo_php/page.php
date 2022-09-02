<?php get_header(); ?>
<div class="content-wrap">
    <div class="content container">
            <div class="page-content">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                     if(has_post_format('link')): 
                     else : ?>

                        <?php the_content(); ?>

                    <?php endif; 	
                    endwhile; 
                    else: ?>
                    <p><?php echo esc_html('Brak wpisów.'); ?></p>
				<?php endif; ?>	
           </div>
    </div>
</div>
<?php get_footer(); 