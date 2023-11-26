// Start scroll add shadow
$(window).scroll(function () {
  if ($(window).scrollTop() >= 10) {
    $(".NavUp").addClass("shadow-lg");
  } else {
    $(".NavUp").removeClass("shadow-lg");
  }
});
// End scroll add shadow

// Start responsive sidebar
$(window).ready(function () {
  if ($(window).width() >= 1024) {
    $(".sidebar").addClass("position-fixed");
    $(".sidebar").css({
      height: "100vh",
    });
    $(".main").css({
      left: "260px",
    });
  } else {
    $(".sidebar").removeClass("position-fixed");
    $(".sidebar").css({
      height: "100%",
    });
  }
});
// End responsive sidebar
