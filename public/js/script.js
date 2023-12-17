// flash alert for error
function flashAlert(type, message, action_message) {
  return /*html*/ `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
  <strong>${message}</strong> ${action_message}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>`;
}

function removeVal(selector) {
  $(selector).val("");
}
