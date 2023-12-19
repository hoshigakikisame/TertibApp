// javascript validation for nim and nidn
function validationIdentity(max = 10, target = "", alert = "", elemen) {
  let identity = elemen.parent().siblings().find("#identity");
  if (identity.val().length > max || identity.val().length < 4) {
    if (identity.attr("name") == "username") {
      $(target).before(
        flashAlert(
          "warning",
          "Username Maximal 10 Character and Minimal 4 Character",
          "Retype your Username"
        )
      );
    } else {
      $(target).before(alert);
    }
  } else {
    return elemen.closest("form");
  }
}

// javascript validation for telephone number
function countTlp(max = 15, target, alert, elemen) {
  let tlp = elemen.parent().siblings().find("#noTelp");
  if (tlp.val().length > max || tlp.val().length < 3) {
    $(target).before(alert);
  } else {
    return elemen.closest("form");
  }
}

// javascript validation for update password
function checkValidPassword(alert, elemen) {
  const newPassword = elemen.parent().siblings().find("#newPassword").val();
  const confirmPassword = elemen
    .parent()
    .siblings()
    .find("#confirmPassword")
    .val();

  let validated = 1;

  if (elemen.closest("#modalAdd").length == 1) {
    if (newPassword.length < 8) {
      $("div[title=flash]").before(
        flashAlert(
          "warning",
          "Password Must More Than 8 Character.",
          "Retype Your Password Again"
        )
      );
      validated = 0;
    }
    if (newPassword !== confirmPassword) {
      $("div[title=flash]").before(alert);
      validated = 0;
    }
  } else {
    if (newPassword !== confirmPassword) {
      $("div[title=flash]").before(alert);
      validated = 0;

      if (newPassword.val().length < 8) {
        $("div[title=flash]").before(
          flashAlert(
            "warning",
            "Password Must More Than 8 Character.",
            "Retype Your Password Again"
          )
        );
        validated = 0;
      }
    }
  }

  if (validated === 1) {
    return elemen.closest("form");
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

      if (
        validTlp !== undefined &&
        identity !== undefined &&
        password !== undefined
      ) {
        $(this).closest("form").submit();
      } else if (
        identity !== undefined &&
        $(this).closest("form").attr("name") !== "modalAdd"
      ) {
        $(this).closest("form").submit();
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
