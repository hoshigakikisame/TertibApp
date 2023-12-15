// flash alert for error
function flashAlert(type, message, action) {
  return /*html*/ `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
  <strong>${message}</strong> ${action}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>`;
}

// javascript validation for nim and nidn
function validationIdentity(max = 10, target = "", alert = "", elemen) {
  let identity = elemen.parent().siblings().find("#identity");
  if (identity.val().length > max || identity.val().length < 4) {
    $(target).before(alert);
  } else {
    return elemen.parents().find("form");
  }
}

// javascript validation for telephone number
function countTlp(max = 15, target, alert, elemen) {
  let tlp = elemen.parent().siblings().find("#noTelp");
  if (tlp.val().length > max || tlp.val().length < 3) {
    $(target).before(alert);
  } else {
    return elemen.parents().find("form");
  }
}

// javascript validation for update password
function checkValidPassword(alert, elemen) {
  const newPassword = elemen.parent().siblings().find("#newPassword");
  const confirmPassword = elemen.parent().siblings().find("#confirmPassword");
  if (newPassword.val() !== confirmPassword.val()) {
    $("div[title=flash]").before(alert);
  } else {
    return elemen.parents().find("form");
  }
}

// listener action
let validTlp, password, identity;
if ($("button#btnPress").length > 0) {
  $("button#btnPress").click(function (e) {
    const buttonSelector = "button[type=submit]";
    $(buttonSelector).click(function (e) {
      e.preventDefault();
      if ($("div[role=alert]").length > 0) {
        $("div[role=alert]").remove();
      }

      validTlp = countTlp(
        15,
        "div[title=flashTelepon]",
        flashAlert(
          "warning",
          "Telephone Number Maximal 15 Character and Minimal 3 Character",
          "Retype your Telephone Number"
        ),
        $(this)
      );

      password = checkValidPassword(
        flashAlert(
          "warning",
          "Confirm Password Not Same.",
          "Retype your Confirm Password "
        ),
        $(this)
      );

      identity = validationIdentity(
        10,
        "div[title=flashIdentity]",
        flashAlert(
          "warning",
          "Identity Number Maximal 10 Character and Minimal 4 Character",
          "Retype your Identity Number"
        ),
        $(this)
      );

      if (
        validTlp !== undefined &&
        identity !== undefined &&
        password !== undefined
      ) {
        $(this).parents().find("form").submit();
      }
    });
  });
} else {
  const buttonSelector = "button[type=submit]";
  $(buttonSelector).click(function (e) {
    e.preventDefault();
    $("div[role=alert]").remove();
    if ($(this).parent().siblings().find("#noTelp").length > 0) {
      validTlp = countTlp(
        15,
        "div[title=flashTelepon]",
        flashAlert(
          "warning",
          "Telephone Number Maximal 15 Character and Minimal 3 Character",
          "Retype your Telephone Number"
        ),
        $(this)
      );
    }

    if ($(this).parent().siblings().find("#newPassword").length > 0) {
      password = checkValidPassword(
        flashAlert(
          "warning",
          "Confirm Password Not Same.",
          "Retype your Confirm Password "
        ),
        $(this)
      );
    }

    if ($(this).parent().siblings().find("#identity").length > 0) {
      identity = validationIdentity(
        10,
        "div[title=flashIdentity]",
        flashAlert(
          "warning",
          "Identity Number Maximal 10 Character and Minimal 4 Character",
          "Retype your Identity Number"
        ),
        $(this)
      );
    }
    if (validTlp !== undefined && identity !== undefined) {
      validTlp.submit();
    } else if (identity !== undefined && validTlp !== undefined) {
      identity.submit();
    } else if (password !== undefined) {
      password.submit();
    }
  });
}
