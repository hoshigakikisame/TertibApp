// flash alert for error
function flashAlert(type, message, action) {
  return /*html*/ `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
  <strong>${message}</strong> ${action}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>`;
}

// javascript validation for nim and nidn
function validationIdentity(max =10,target="",alert="") {
  const buttonSelector = "button[type=submit]";
  $(buttonSelector).click(function (e) {
    e.preventDefault();
    let identity = $(this).parent().siblings().find("#identity");
    if (identity.val().length > max || identity.val().length < 4) {
      $(target).before(alert);
    } else {
      return $(this).parents().find("form");
    }
  });
}


// javascript validation for telephone number
function countTlp(max=15, target, alert) {
  const buttonSelector = "button[type=submit]";
  $(buttonSelector).click(function (e) {
    e.preventDefault();
    let tlp = $(this).parent().siblings().find("#noTelp");
    if (tlp.val().length > max || tlp.val().length < 3) {
      $(target).before(alert);
    } else {
      return $(this).parents().find("form");
    }
  });
}

// javascript validation for update password
function checkValidPassword(alert) {
  const buttonSelector = "button[type=submit]";
  $(buttonSelector).click(function (e) {
    e.preventDefault();
    const newPassword = $(this).parent().siblings().find("#newPassword");
    const confirmPassword = $(this)
      .parent()
      .siblings()
      .find("#confirmPassword");
    if (
      newPassword.val() !== confirmPassword.val() ||
      confirmPassword.val() === "" ||
      newPassword.val() === ""
    ) {
      $("div[title=flash]").before(alert);
    } else {
      return $(this).parents().find("form");
    }
  });
}

// listener action
if ($("button#btnPress").length > 0) {
  let validTlp, password, identity;
  $("button#btnPress").click(function (e) {
    $("div[role=alert]").remove();
    const buttonSelector = "button[type=submit]";
    $(buttonSelector).click(function (e) { 
      e.preventDefault();
      if($("div[role=alert]").length > 0) {
        $("div[role=alert]").remove();
      }
    });

    validTlp = countTlp( 
      15,
      "div[title=flashTelepon]",
      flashAlert(
        "warning",
        "Telephone Number Maximal 15 Character and Minimal 3 Character",
        "Retype your Telephone Number"
      )
    );

    password = checkValidPassword(
      flashAlert(
        "warning",
        "Confirm Password Not Same.",
        "Retype your Confirm Password "
      )
    );

    identity = validationIdentity(
      10,
      "div[title=flashIdentity]",
      flashAlert(
        "warning",
        "Identity Number Maximal 10 Character and Minimal 4 Character",
        "Retype your Identity Number"
      )
    );

    if(validTlp == password == identity) {
      validTlp.submit();
    }
  });
} else {

  validTlp = countTlp(
    15,
    "div[title=flashTelepon]",
    flashAlert(
      "warning",
      "Telephone Number Maximal 15 Character and Minimal 3 Character",
      "Retype your Telephone Number"
    )
  );

  password = checkValidPassword(
    flashAlert(
      "warning",
      "Confirm Password Not Same.",
      "Retype your Confirm Password "
    )
  );

  identity = validationIdentity(
    10,
    "div[title=flashIdentity]",
    flashAlert(
      "warning",
      "Identity Number Maximal 10 Character and Minimal 4 Character",
      "Retype your Identity Number"
    )
  );

  if(validTlp == password == identity) {
    password.submit();
  }
}
