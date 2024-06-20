var a = document.getElementById("loginBtn");
var b = document.getElementById("registerBtn");
var x = document.getElementById("login_form");
var y = document.getElementById("sign_up_form");

var email = document.forms['form']['email'];
var password = document.forms['form']['password'];
var emailError = document.querySelector('.user-error');
var passwordError = document.querySelector('.password-error');

var firstName = document.getElementById('firstname');
var lastName = document.getElementById('lastname');

var emailUp = document.forms['form']['email_up'];
var passwordUp = document.forms['form']['password_up'];

email.addEventListener('textInput', email_Verify);
password.addEventListener('textInput', pass_Verify);

emailUp.addEventListener('textInput', pass_Verify);
passwordUp.addEventListener('textInput', pass_Verify);

function validated() {
   if(email.value.length < 9) {
    email.style.border = "1px solid red";
    emailError.style.display = "block";
    email.focus();
    return false ;
} 
   if(password.value.length < 9) {
    password.style.border = "1px solid red";
    passwordError.style.display = "block";
    email.focus();
    return false ;
   } 
}

function email_Verify() {
if(email.value.length >=8 ) {
    email.style.border = "1px solid silver";
    emailError.style.display = "none";
    return true ;
}
}
function pass_Verify() {
    if(password.value.length >= 5 ) {
        password.style.border = "1px solid silver";
        passwordError.style.display = "none";
        return true ;
    }
    
}

function pass_Verify() {
    if(passwordUp.value.length >= 5 ) {
        passwordUp.style.border = "1px solid silver";
        passwordError.style.display = "none";
        return true ;
    }

}
function pass_Verify() {
    if(emailUp.value.length >= 5 ) {
        emailUp.style.border = "1px solid silver";
        passwordError.style.display = "none";
        return true ;
    }
    
}

  
function login() {
x.style.left = "4px" ;
y.style.right = "-520px" ;
a.className += "loginbtn" ;
b.className = "btn";
}
function register() {
    x.style.left = "-510px" ;
    y.style.right = "5px" ;
    a.className += "btn" ;
b.className += "loginbtn";
}

function clogin(frm_id) {
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
  
function cregister(frm_id) {
    $("html").css({ cursor: "wait" });
    let old_attr = $("#" + frm_id).attr("action");
    $("#" + frm_id).attr("action", "javascript:void(0);");
    let data = $("#" + frm_id).serialize();
    $.ajax({
      type: "POST",
      url: "signup.php",
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
  