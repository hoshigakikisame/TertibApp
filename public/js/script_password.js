// javascript validation for update password

const selectorbutton = "button[type=submit]";
$(selectorbutton).click(function (e) {
  e.preventDefault();
  const newPassword = $(this).parent().siblings().find("#newPassword");
  const confirmPassword = $(this).parent().siblings().find("#confirmPassword");

  if (newPassword.val() !== confirmPassword.val()) {
    const alert = `<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Confirm Password Not Same.</strong> Retype your Confirm Password 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>`;
    $(this).parent().siblings("div[title=flash]").before(alert);
  } else {
    $(this).parents().find("form").submit();
  }
});
