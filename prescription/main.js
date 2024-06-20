let eform_data = "";
function save_data(frm_id) {
  $("html").css({ cursor: "wait" });
  let old_attr = $("#" + frm_id).attr("action");
  $("#" + frm_id).attr("action", "javascript:void(0);");
  let data = new FormData($("#" + frm_id)[0]);
  $.ajax({
    type: "POST",
    url: "save.php",
    data: data,
    enctype: "multipart/form-data",
    contentType: false,
    processData: false,
    cache: false,
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
$(document).ready(function () {
  eform_data = $("#save_data").serialize();
});

function rm_prescription(row_id) {
  if (
    row_id !== "" &&
    row_id !== null &&
    row_id !== undefined &&
    !isNaN(row_id) &&
    row_id > 0
  ) {
    Swal.fire({
      icon: "question",
      title: "Do you want to delete this Prescription ?",
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

async function get_prescription(cntr,imageUrl) {
  try {
      const response = await fetch(imageUrl);
      const blob = await response.blob();
      const arrayBuffer = await blob.arrayBuffer();
      const apiResponse = await fetch(
          "https://api-inference.huggingface.co/models/qassim227/Auto-pharmacy-V3",
          {
              headers: { Authorization: "Bearer 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" },
              method: "POST",
              body: arrayBuffer,
          }
      );
      let result = await apiResponse.json();
      result = JSON.stringify(result);
      result = JSON.parse(result);
      $("#img_txt_"+cntr).text(` ${result[0].generated_text}`);
    } catch (error) {
        console.error(error.message);
    }
}

function ordr_prescription(row_id) {
  if (
    row_id !== "" &&
    row_id !== null &&
    row_id !== undefined &&
    !isNaN(row_id) &&
    row_id > 0
  ) {
    Swal.fire({
      icon: "question",
      title: "Do you want to Order this Prescription ?",
      showDenyButton: true,
      showCloseButton: true,
      showCancelButton: true,
      confirmButtonText: "Yes",
      denyButtonText: `No`,
      focusDeny: true,
    }).then((result) => {
      if (result.isConfirmed) {
        $("#ext_code").load("order.php", "id=" + row_id, null);
      }
    });
  }
}
function cncl_prescription(row_id) {
  if (
    row_id !== "" &&
    row_id !== null &&
    row_id !== undefined &&
    !isNaN(row_id) &&
    row_id > 0
  ) {
    Swal.fire({
      icon: "question",
      title: "Do you want to Cancel The Order ?",
      showDenyButton: true,
      showCloseButton: true,
      showCancelButton: true,
      confirmButtonText: "Yes",
      denyButtonText: `No`,
      focusDeny: true,
    }).then((result) => {
      if (result.isConfirmed) {
        $("#ext_code").load("cncl.php", "id=" + row_id, null);
      }
    });
  }
}