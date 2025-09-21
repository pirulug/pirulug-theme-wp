(function ($) {
  wp.customize('pirublog_welcome_title', function (value) {
    value.bind(function (newval) {
      $('.welcome h1').text(newval);
    });
  });

  wp.customize('pirublog_welcome_text', function (value) {
    value.bind(function (newval) {
      $('.welcome p').html(newval);
    });
  });
})(jQuery);
