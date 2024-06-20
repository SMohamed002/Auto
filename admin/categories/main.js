let eform_data = "";
function add_data(frm_id) {
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
function delete_row(row_id) {
  if (
    row_id !== "" &&
    row_id !== null &&
    row_id !== undefined &&
    !isNaN(row_id) &&
    row_id > 0
  ) {
    Swal.fire({
      icon: "question",
      title: "Do you want to delete this record ?",
      showDenyButton: true,
      showCloseButton: true,
      showCancelButton: true,
      confirmButtonText: "Yes",
      denyButtonText: `No`,
      focusDeny: true,
    }).then((result) => {
      if (result.isConfirmed) {
        $("#ext_code").load("delete.php", "id=" + row_id, null);
      }
    });
  }
}
function edit_data(frm_id, id) {
  if (eform_data === $("#save_data").serialize()) {
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
    let data = $("#save_data").serialize();
    data += "&id=" + id;
    $.ajax({
      type: "POST",
      url: "update.php",
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
