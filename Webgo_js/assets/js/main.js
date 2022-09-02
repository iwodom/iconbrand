(function ($) {


  $(document).ready(function () {

    //Przypisuje typy case studies do klasy
    ($('.case_studies--single')).each(function(){
      let caseStudiesTypeForSingleElement = $(this).find('.case_studies--type').text();
      $(this).addClass($.trim(caseStudiesTypeForSingleElement).toLowerCase().replace(/\s+/g, ' '))
      
    });

    //Tworzy listę typów case studies
    let caseStudiesTypesArray = [];
    $('.case_studies--type').each(function () {
      let caseStudiesTypesValue = $(this).text();
      caseStudiesTypesArray.push($.trim(caseStudiesTypesValue));
    });

    let caseStudiesTypesArrayNoDuplicates = [...new Set(caseStudiesTypesArray)];

    caseStudiesTypesArrayNoDuplicates.forEach(function (val) {
      $('.case_studies_filters').append('<span class="case_studies_filters--button case_studies_text--gray" data-filter=".' + val.toLowerCase().replace(/\s+/g, '') + '">' + val + '</span>')
    });

    var $grid = $('.grid').isotope({
      itemSelector: '.grid-item',
      layoutMode: 'masonry',
      columnWidth: '.grid-sizer',
      masonry: {
        columnWidth: '.grid-sizer',
        gutter: '.gutter-sizer',
      }
    });

    // filter items on button click
    $('.case_studies_filters').on('click', '.case_studies_filters--button', function () {
      var selector = $(this).attr('data-filter');
      // $('.grid').find(filterValue).hide();
      $grid.isotope({ filter: selector });
      $('.case_studies_filters--button').removeClass('case_studies_filters--active');
      $(this).addClass('case_studies_filters--active');
    });



      // End document.ready
    });
  })(jQuery);
