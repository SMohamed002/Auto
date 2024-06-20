function login(frm_id) {
  $("html").css({ cursor: "wait" });
  let old_attr = $("#" + frm_id).attr("action");
  $("#" + frm_id).attr("action", "javascript:void(0);");
  let data = $("#" + frm_id).serialize();
  $.ajax({
    type: "POST",
    url: "login.php",
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
