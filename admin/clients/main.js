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
        title: "Do you want to block this client ?",
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

  function unblock(row_id) {
    if (
      row_id !== "" &&
      row_id !== null &&
      row_id !== undefined &&
      !isNaN(row_id) &&
      row_id > 0
    ) {
      Swal.fire({
        icon: "question",
        title: "Do you want to unblock this client ?",
        showDenyButton: true,
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: "Yes",
        denyButtonText: `No`,
        focusDeny: true,
      }).then((result) => {
        if (result.isConfirmed) {
          $("#ext_code").load("unblock.php", "id=" + row_id, null);
        }
      });
    }
  }