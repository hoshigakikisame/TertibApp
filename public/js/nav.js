// Start scroll handling
$(window).scroll(function () {
  // Start scroll add shadow
  if ($(window).scrollTop() >= 10) {
    $(".NavUp").addClass("shadow-drop-bottom");
  } else {
    $(".NavUp").removeClass("shadow-drop-bottom");
  }
  // End scroll add shadow

  // Start animation handling
  if ($(window).scrollTop() <= 700) {
    $("div[title=lefthero]").addClass("slide-in-left");
  } else {
    $("div[title=lefthero]").removeClass("slide-in-left");
  }

  if ($(window).scrollTop() <= 700) {
    $("div[title=righthero]").addClass("slide-in-right");
  } else {
    $("div[title=righthero]").removeClass("slide-in-right");
  }

  if ($(window).scrollTop() >= 50) {
    $("section[title=pelanggaran]").addClass("slide-in-bottom");
  } else {
    $("section[title=pelanggaran]").removeClass("slide-in-bottom");
  }
  if ($(window).scrollTop() >= 400) {
    $("section[title=tatatertib]").addClass("slide-in-bottom");
  } else {
    $("section[title=tatatertib]").removeClass("slide-in-bottom");
  }

  // End animation handling
});

// End scroll handling

// Start navbar active
$(window).ready(function (e) {
  // get page uri
  let page = location.pathname.replace(/\/$/, "");
  $(".nav-item").removeClass("active-page");
  

  if (location.pathname.includes("manage")) {
    $(`.dropdown-item[href="${page}"]`).parent().addClass("active-drop");
    page = page.substring(0, page.indexOf("manage") + "manage".length);
    $(`.nav-item[title="${page}"]`).addClass("active-page");
    $(`.active-drop`).parent().addClass("show");
  }else if (location.pathname.includes("report")) {
    page = page.substring(0, page.indexOf("report") + "report".length);
    $(`.nav-link[href="${page}"]`).parent().addClass("active-page");
  }else{
    $(`.nav-link[href="${page}"]`).parent().addClass("active-page");
  }
});
// End navbar active
