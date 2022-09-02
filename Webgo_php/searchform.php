<form class="search" method="get" action="<?php echo home_url(); ?>/search/" role="search">
  <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Wyszukaj …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="search" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
</form>
