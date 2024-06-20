const navLinksElems = document.querySelectorAll(".menuea");
const windowPathname = window.location.pathname;

navLinksElems.forEach((navLinksElem) => {
  const navLinksPathname = new URL(navLinksElem.href).pathname;
  if (windowPathname === navLinksPathname) {
    navLinksElem.classList.add("activeM");
  }
});

function save_email(frm_id) {
  $("html").css({ cursor: "wait" });
  let old_attr = $("#" + frm_id).attr("action");
  $("#" + frm_id).attr("action", "javascript:void(0);");
  let data = $("#" + frm_id).serialize();
  $.ajax({
    type: "POST",
    url: "/pages/news_mail.php",
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

function logout(frm_id) {
  $("html").css({ cursor: "wait" });
  let old_attr = $("#" + frm_id).attr("action");
  $("#" + frm_id).attr("action", "javascript:void(0);");
  let data = $("#" + frm_id).serialize();
  $.ajax({
    type: "POST",
    url: "/pages/logout.php",
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

function add_to_cart(item_id) {
  let qty = $("#qty").val();
  if (
    !(
      qty !== "" &&
      qty !== undefined &&
      qty !== null &&
      !isNaN(qty) &&
      qty > 0 &&
      Math.floor(qty) == qty &&
      $.isNumeric(qty)
    )
  ) {
    qty = 1;
  }
  if (
    qty !== "" &&
    qty !== undefined &&
    qty !== null &&
    !isNaN(qty) &&
    qty > 0 &&
    Math.floor(qty) == qty &&
    $.isNumeric(qty)
  ) {
    {
      $("html").css({ cursor: "wait" });
      let data =
        "item_id=" + item_id + "&url=" + window.location.href + "&qty=" + qty;
      $.ajax({
        type: "POST",
        url: "/pages/add_to_cart.php",
        data: data,
        success: function (response) {
          $("#ext_code").html(response);
        },
        /*error: function (xhr, status, error) {
      
    }*/
      }).done(function () {
        $("html").css({ cursor: "default" });
      });
    }
  }
}

function add_to_wishlist(item_id) {
  $("html").css({ cursor: "wait" });
  let data = "item_id=" + item_id;
  $.ajax({
    type: "POST",
    url: "/pages/add_to_wishlist.php",
    data: data,
    success: function (response) {
      $("#ext_code").html(response);
    },
    /*error: function (xhr, status, error) {
      
    }*/
  }).done(function () {
    $("html").css({ cursor: "default" });
  });
}
function rm_from_wishlist(item_id) {
  $("html").css({ cursor: "wait" });
  let data = "item_id=" + item_id;
  $.ajax({
    type: "POST",
    url: "/pages/rm_from_wishlist.php",
    data: data,
    success: function (response) {
      $("#ext_code").html(response);
    },
    /*error: function (xhr, status, error) {
      
    }*/
  }).done(function () {
    $("html").css({ cursor: "default" });
  });
}
function rm_from_cart(item_id) {
  $("html").css({ cursor: "wait" });
  let data = "item_id=" + item_id;
  $.ajax({
    type: "POST",
    url: "/pages/rm_from_cart.php",
    data: data,
    success: function (response) {
      $("#ext_code").html(response);
    },
    /*error: function (xhr, status, error) {
      
    }*/
  }).done(function () {
    $("html").css({ cursor: "default" });
  });
}

function change_qty(way,cart_id) {
  if (way === "U" || way === "D") {
    $("html").css({ cursor: "wait" });
    let data = "cart_id=" + cart_id + "&way=" + way;
    $.ajax({
      type: "POST",
      url: "/pages/change_qty.php",
      data: data,
      success: function (response) {
        $("#ext_code").html(response);
      },
      /*error: function (xhr, status, error) {
      
    }*/
    }).done(function () {
      $("html").css({ cursor: "default" });
    });
  }
}

function rate_us(frm_id) {
  $("html").css({ cursor: "wait" });
  let old_attr = $("#" + frm_id).attr("action");
  $("#" + frm_id).attr("action", "javascript:void(0);");
  let data = $("#" + frm_id).serialize();
  $.ajax({
    type: "POST",
    url: "/rate/rate_us.php",
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
