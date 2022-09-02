(function ($) {

  $(document).ready(function () {

    // Filtruj elementy poklinieciu i dodaj klase activ do przycisku
    $('.case_studies_filters').on('click', '.case_studies_filters--button', function () {
      var selector = $(this).attr('data-filter');

      $('.case_studies--single').hide(200);
      $('.case_studies--single' + selector).show(200);

      $('.case_studies_filters--button').removeClass('case_studies_filters--active');
      $(this).addClass('case_studies_filters--active');
    });

      // End document.ready
    });
  })(jQuery);
