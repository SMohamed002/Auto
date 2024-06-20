function place_order() {
  $("html").css({ cursor: "wait" });
  $.ajax({
    type: "POST",
    url: "save.php",
    data: null,
    success: function (response) {
      $("#ext_code").html(response);
    },
    /*error: function (xhr, status, error) {
        
      }*/
  }).done(function () {
    $("html").css({ cursor: "default" });
  });
}
