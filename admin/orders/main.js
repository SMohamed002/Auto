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
        title: "Do you want to cancel this order ?",
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

  function active(row_id) {
    if (
      row_id !== "" &&
      row_id !== null &&
      row_id !== undefined &&
      !isNaN(row_id) &&
      row_id > 0
    ) {
      Swal.fire({
        icon: "question",
        title: "Do you want to active this order ?",
        showDenyButton: true,
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: "Yes",
        denyButtonText: `No`,
        focusDeny: true,
      }).then((result) => {
        if (result.isConfirmed) {
          $("#ext_code").load("active.php", "id=" + row_id, null);
        }
      });
    }
  }