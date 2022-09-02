<?php
/* The main template file */
 
get_header(); ?>
<div class="wrap container">
    <?php if (is_home() && ! is_front_page()) : ?>
        <header class="page-header">
            <h1 class="page-title"><?php single_post_title(); ?></h1>
        </header>
    <?php else : ?>
    <header class="page-header">
        <h2 class="page-title"><?php echo esc_html('Posts', THEMEDOMAIN); ?></h2>
    </header>
    <?php endif; ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php
            if (have_posts()) :
                /* Start the Loop */
                while (have_posts()) :
                    the_post();
                    get_template_part('single');
                endwhile;
            else :
                get_template_part('single');
            endif;
            ?>
        </main><!-- #main -->
    </div><!-- #primary -->
</div><!-- .wrap -->
<?php get_footer();
