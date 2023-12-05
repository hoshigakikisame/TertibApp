// javascript validation for update password

const alertWarning = /*html*/ `<div class="alert alert-warning alert-dismissible fade show" role="alert">
<strong>Confirm Password Not Same.</strong> Retype your Confirm Password 
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`;

function checkValid(alert) {
  const buttonSelector = "button[type=submit]";
  $(buttonSelector).click(function (e) {
    e.preventDefault();
    const newPassword = $(this).parent().siblings().find("#newPassword");
    const confirmPassword = $(this)
      .parent()
      .siblings()
      .find("#confirmPassword");
    if (newPassword.val() !== confirmPassword.val()) {
      $("div[role=alert]").remove();
      $("div[title=flash]").before(alert);
    } else {
      $(this).parents().find("form").submit();
    }
  });
}

if ($("button#btnPress").length > 0) {
  $("button#btnPress").click(function (e) {
    $("div[role=alert]").remove();
    checkValid(alertWarning);
  });
} else {
  checkValid(alertWarning);
}
