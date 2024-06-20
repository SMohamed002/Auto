function logout() {
  Swal.fire({
    icon: "question",
    title: "Do you want to logout ?",
    showDenyButton: true,
    showCloseButton: true,
    showCancelButton: true,
    confirmButtonText: "Yes",
    denyButtonText: `No`,
    focusDeny: true,
  }).then((result) => {
    if (result.isConfirmed) {
      $("#ext_code").load("/admin/pages/logout.php", null, null);
    }
  });
}
