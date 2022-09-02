(function ($) {

  $(document).ready(function () {

    //Uruchomienie isotope
    var $grid = $('.grid').isotope({
      itemSelector: '.grid-item',
      layoutMode: 'masonry',
      columnWidth: '.grid-sizer',
      masonry: {
        columnWidth: '.grid-sizer',
        gutter: '.gutter-sizer',
      }
    });

    // Filtruj elementy poklinieciu i dodaj klase activ do przycisku
    $('.case_studies_filters').on('click', '.case_studies_filters--button', function () {
      var selector = $(this).attr('data-filter');
      $grid.isotope({ filter: selector });
      $('.case_studies_filters--button').removeClass('case_studies_filters--active');
      $(this).addClass('case_studies_filters--active');
    });

      // End document.ready
    });
  })(jQuery);
