<?php

/**
 * Case Studies Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'case_studies-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'case_studies';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$case_study_type_array_filters = array();

?>


<!--- Przypisanie typów case studies do tablicy, aby móc wygenerować filtrowanie--->
<?php if ( have_rows( 'case_studies' ) ) : ?>
    <?php while ( have_rows( 'case_studies' ) ) :
        the_row(); ?>

            <?php if ( have_rows( 'case_study_type' ) ) : ?>
            <?php
                while ( have_rows( 'case_study_type' ) ) :
                the_row(); 
                $case_studies_type_name2 = get_sub_field( 'case_studies_type_name' );
                ?>
            
                <?php
                    array_push($case_study_type_array_filters, $case_studies_type_name2)
                ?>

            <?php endwhile; ?>
        <?php endif; ?>
    <?php endwhile; ?>

<?php $case_study_type_array_filters_unique = array_unique($case_study_type_array_filters); ?>

<?php endif; ?>


    

<?php if ( have_rows( 'case_studies' ) ) : ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">


        <div class="case_studies_filters">
            <span class="case_studies_filters--button case_studies_filters--active case_studies_text--gray" data-filter="*">All</span>
            <?php foreach ( $case_study_type_array_filters_unique as $case_study_type_array_filter_unique) : ?>
                <span class="case_studies_filters--button case_studies_text--gray" data-filter=".<?php echo strtolower(str_replace(' ', '', $case_study_type_array_filter_unique)); ?>"><?php echo $case_study_type_array_filter_unique ?></span>
            <?php endforeach; ?>
        </div>

        <div class="grid case_studies_grid">

            <?php while ( have_rows( 'case_studies' ) ) :
                the_row(); 
                $case_study_img = get_sub_field( 'case_study_img' );
                $case_study_title = get_sub_field( 'case_study_title' );
                $case_study_link = get_sub_field( 'case_study_link' );

                $case_study_type_array = array();
                ?>
                <!--- Przypisanie typów case studies do tablicy, aby móc wygenerować klasy dla elementów--->
                <?php if ( have_rows( 'case_study_type' ) ) : ?>
                    <?php
                        while ( have_rows( 'case_study_type' ) ) :
                        the_row(); 
                        $case_studies_type_name = get_sub_field( 'case_studies_type_name' );
                        ?>
                        
                        <?php 
                            array_push($case_study_type_array, strtolower($case_studies_type_name))
                        ?>

                    <?php endwhile; ?>
                <?php endif; ?>

                <div class="case_studies--single grid-item <?php echo implode(' ', str_replace(' ', '', $case_study_type_array)); ?>">
                    <?php if ( !empty($case_study_link) ) :
                        $link_url = $case_study_link['url'];
                        $link_title = $case_study_link['title'];
                        $link_target = $case_study_link['target'] ? $case_study_link['target'] : '_self';
                        ?>
                        <a class="case_studies_anchor" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                    <?php endif; ?>

                        <?php if ( !empty($case_study_img) ) : ?>
                            <img class="case_studies--img" src="<?php echo esc_url( $case_study_img['url'] ); ?>" alt="<?php echo esc_attr( $case_study_img['alt'] ); ?>" />
                        <?php endif; ?>
                        
                        <div class="case_studies--content">

                            <?php if ( have_rows( 'case_study_type' ) ) : ?>
                                <?php
                                    while ( have_rows( 'case_study_type' ) ) :
                                    the_row(); 
                                    $case_studies_type_name = get_sub_field( 'case_studies_type_name' );
                                    ?>
                                    
                                    <?php if ( !empty($case_studies_type_name) ) : ?>
                                        <span class="case_studies--type case_studies_text--small case_studies_text--gray">
                                            <?php echo esc_html( $case_studies_type_name ); ?>
                                        </span>
                                    <?php endif; ?>

                                <?php endwhile; ?>
                            <?php endif; ?>

                            <?php if ( !empty($case_study_title) ) : ?>
                                <h3 class="case_studies--title case_studies_text--gray">
                                    <?php echo esc_html( $case_study_title ); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if ( !empty($case_study_link) ) : ?>
                                <p class="case_studies--button case_studies_text--gray case_studies_text--small"><?php echo esc_html( $link_title ); ?></p>
                            <?php endif; ?>

                        </div>
                    </a>
                </div>

            <?php endwhile; ?>
        </div>

    </div>
<?php endif; ?>