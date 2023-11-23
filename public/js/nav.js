// Start scroll add shadow
$(window).scroll(function () {
  if ($(window).scrollTop() >= 10) {
    $("Nav").addClass("shadow-lg");
  } else {
    $("Nav").removeClass("shadow-lg");
  }
});

// End scroll add shadow
