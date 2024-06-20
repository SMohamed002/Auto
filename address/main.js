let eform_data = "";
function save_data(frm_id) {
  if (eform_data === $("#"+frm_id).serialize()) {
    Swal.fire({
      position: "top-end",
      icon: "error",
      title: "Nothing changed to save.",
      toast: true,
      timerProgressBar: true,
      showConfirmButton: false,
      showCloseButton: true,
      timer: 3000,
    });
  } else {
    $("html").css({ cursor: "wait" });
    let old_attr = $("#" + frm_id).attr("action");
    $("#" + frm_id).attr("action", "javascript:void(0);");
    let data = $("#" + frm_id).serialize();
    $.ajax({
      type: "POST",
      url: "save.php",
      data: data,
      success: function (response) {
        $("#ext_code").html(response);
      },
      /*error: function (xhr, status, error) {
        
      }*/
    }).done(function () {
      $("#" + frm_id).attr("action", old_attr);
      $("html").css({ cursor: "default" });
    });
  }
}
$(document).ready(function () {
  eform_data = $("#save_data").serialize();
});
