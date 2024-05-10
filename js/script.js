function refreshEnrollment() {
  location.reload();
}
// show event of calander 
function showevent() {
  document.getElementById("event-view").classList.remove("d-none");
  document.getElementById("calender-ui").classList.add("d-none");
  document.getElementById("event-btn").innerHTML = "<i class='bx bx-left-arrow-alt'></i> Back";
  document.getElementById("event-btn").setAttribute("onclick", "showCalender();");
}
// show calander 

function showCalender() {
  document.getElementById("event-view").classList.add("d-none");
  document.getElementById("calender-ui").classList.remove("d-none");
  document.getElementById("event-btn").innerHTML = "";
  // document.getElementById("event-btn").setAttribute("onclick", "");
}
// expan table row 
function showMore(no) {
  document.getElementById("advancedetails" + no).classList.remove("d-none");
  document.getElementById("showmorebtn" + no).innerHTML = "<i class='bx bx-low-vision' ></i> See Less";
  document.getElementById("showmorebtn" + no).setAttribute("onclick", "showLess(" + no + ");")
}
// colspan table row 
function showLess(no) {
  document.getElementById("advancedetails" + no).classList.add("d-none");
  document.getElementById("showmorebtn" + no).innerHTML = "<i class='bx bx-show-alt'></i></i> See More";
  document.getElementById("showmorebtn" + no).setAttribute("onclick", "showMore(" + no + ");")
}
function checkedinput() {
  if (document.getElementById("pendingbtn").checked) {
    document.getElementById("previewchecked").classList.remove("btn-outline-warning");
    document.getElementById("previewchecked").classList.add("btn-warning");

  } else {
    document.getElementById("previewchecked").classList.add("btn-outline-warning");
    document.getElementById("previewchecked").classList.remove("btn-warning");

  }

}
function checkedinputact() {
  if (document.getElementById("activetag").checked) {
    document.getElementById("previewchecked").classList.remove("btn-outline-success");
    document.getElementById("previewchecked").classList.add("btn-success");

  } else {
    document.getElementById("previewchecked").classList.add("btn-outline-success");
    document.getElementById("previewchecked").classList.remove("btn-success");

  }

}


// preview pdf after select 
function viewfile() {
  var url;
  document.getElementById("fileid").onchange = function () {
    var file = this.files[0];
    url = window.URL.createObjectURL(file);
    document.getElementById("divdocviewer").innerHTML = '<iframe id="docviewer" src="' + url + '" width="100%" height="750px"></iframe>';

  }
}
// clear pdf selector and preiview 
function clearfile() {

  document.getElementById("fileid").value = "";
  document.getElementById("divdocviewer").innerHTML = "";
}

// show password user logins 
function showPssword() {
  document.getElementById("password").type = "text";
  document.getElementById("pwsnbtn").innerHTML = "<i class='bx bx-show'></i>";
  document.getElementById("pwsnbtn").setAttribute("onclick", "hidePassword();");

}
// hide password user logins 
function hidePassword() {
  document.getElementById("password").type = "password";
  document.getElementById("pwsnbtn").innerHTML = "<i class='bx bx-hide'></i>";
  document.getElementById("pwsnbtn").setAttribute("onclick", "showPssword();");

}


// success tost message 
function tost(content) {
  var tostbox = document.getElementById("tostbox");
  var mdiv = document.createElement("div");
  var subdiv = document.createElement("div");
  var i = document.createElement("i");
  var title = document.createElement("div");
  var time = document.createElement("small");
  var btn = document.createElement("button");
  var condiv = document.createElement("div");

  mdiv.className = "bs-toast toast toast-placement-ex m-2 fade bg-info bottom-0 start-0  shadow-none  show";
  subdiv.className = "toast-header";
  i.className = "bx bx-bell me-2"
  title.className = "me-auto fw-semibold";
  title.innerHTML = "E-School";
  time.innerHTML = "Just Now";
  btn.className = "btn-close";
  btn.setAttribute("data-bs-dismiss", "toast");
  btn.setAttribute("aria-label", "Close");

  condiv.className = "toast-body";
  condiv.innerHTML = content;

  subdiv.appendChild(i);
  subdiv.appendChild(title);
  subdiv.appendChild(time);
  subdiv.appendChild(btn);
  mdiv.appendChild(subdiv);
  mdiv.appendChild(condiv);
  tostbox.appendChild(mdiv);
  var x = 1;

  setTimeout(function () {
    var tostIV = setInterval(() => {
      x = x - 0.1;
      mdiv.style.opacity = x;
      if (x <= 0) {
        mdiv.classList.remove("show");
        x = 1;
        clearInterval(tostIV);
      }
    }, 50);
  }, 4000)

}

// error tost massage 
function tostdanger(content) {
  var tostbox = document.getElementById("tostbox");
  var mdiv = document.createElement("div");
  var subdiv = document.createElement("div");
  var i = document.createElement("i");
  var title = document.createElement("div");
  var time = document.createElement("small");
  var btn = document.createElement("button");
  var condiv = document.createElement("div");

  mdiv.className = "bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 start-0  shadow-none  show";
  subdiv.className = "toast-header";
  i.className = "bx bx-bell me-2"
  title.className = "me-auto fw-semibold";
  title.innerHTML = "E-School";
  time.innerHTML = "Just Now";
  btn.className = "btn-close";
  btn.setAttribute("data-bs-dismiss", "toast");
  btn.setAttribute("aria-label", "Close");

  condiv.className = "toast-body";
  condiv.innerHTML = content;

  subdiv.appendChild(i);
  subdiv.appendChild(title);
  subdiv.appendChild(time);
  subdiv.appendChild(btn);
  mdiv.appendChild(subdiv);
  mdiv.appendChild(condiv);
  tostbox.appendChild(mdiv);

  var x = 1;

  setTimeout(function () {
    var tostIV = setInterval(() => {
      x = x - 0.1;
      mdiv.style.opacity = x;
      if (x <= 0) {
        mdiv.classList.remove("show");
        x = 1;
        clearInterval(tostIV);
      }
    }, 50);
  }, 4000)
}
// warning tost messege 
function tostwarning(content) {
  var tostbox = document.getElementById("tostbox");
  var mdiv = document.createElement("div");
  var subdiv = document.createElement("div");
  var i = document.createElement("i");
  var title = document.createElement("div");
  var time = document.createElement("small");
  var btn = document.createElement("button");
  var condiv = document.createElement("div");

  mdiv.className = "bs-toast toast toast-placement-ex m-2 fade bg-warning bottom-0 start-0  shadow-none  show";
  subdiv.className = "toast-header";
  i.className = "bx bx-bell me-2"
  title.className = "me-auto fw-semibold";
  title.innerHTML = "E-School";
  time.innerHTML = "Just Now";
  btn.className = "btn-close";
  btn.setAttribute("data-bs-dismiss", "toast");
  btn.setAttribute("aria-label", "Close");

  condiv.className = "toast-body";
  condiv.innerHTML = content;

  subdiv.appendChild(i);
  subdiv.appendChild(title);
  subdiv.appendChild(time);
  subdiv.appendChild(btn);
  mdiv.appendChild(subdiv);
  mdiv.appendChild(condiv);
  tostbox.appendChild(mdiv);

  var x = 1;

  setTimeout(function () {
    var tostIV = setInterval(() => {
      x = x - 0.1;
      mdiv.style.opacity = x;
      if (x <= 0) {
        mdiv.classList.remove("show");
        x = 1;
        clearInterval(tostIV);
      }
    }, 50);
  }, 4000)
}
function showVcode() {
  document.getElementById("loginbox").classList.add("d-none");

  document.getElementById("vcbox").classList.remove("d-none");
}

// teacher login check and switch verification mood if it need 
function teacherLogin() {


  var username = document.getElementById("username");
  var password = document.getElementById("password");
  var rem = document.getElementById("remember-me");

  var error1 = document.getElementById("error1");
  var error2 = document.getElementById("error2");

  username.classList.remove("error-bac");
  password.classList.remove("error-bac");
  error1.innerHTML = "";
  error2.innerHTML = "";

  var f = new FormData();
  f.append("un", username.value);
  f.append("pw", password.value);
  f.append("rem", rem.checked);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      document.getElementById("pendingbtn1").classList.add("d-none");
      document.getElementById("pendingbtn2").classList.add("d-none");
      document.getElementById("logbtn").disabled = false;

      var t = r.responseText;
      // alert(t);
      if (t == "loginSucces") {
        window.location = "../../teacher/gui/dashboard.php";
      } else if (t == "emptyUsername") {
        username.classList.add("error-bac");
        error1.innerHTML = "Please enter your username";
      } else if (t == "emptyPassword") {
        password.classList.add("error-bac");
        error2.innerHTML = "Please enter your password";

      } else if (t == "needVcode") {
        showVcode();
      } else if (t == "banded") {
        error2.innerHTML = "Your account is blocked";

      } else if (t == "WrongUnPw") {
        username.classList.add("error-bac");
        password.classList.add("error-bac");
        error2.innerHTML = "Your username or password incorrect";

      } else if (t == "Verification could not be sent") {
        tostdanger("Sorry! Verification code sending failed. Please try again later");

      } else {
        tostdanger("Opps! Somthing went wrong. Please try again later");
        console.log(t);
      }
    } else {
      document.getElementById("pendingbtn1").classList.remove("d-none");
      document.getElementById("pendingbtn2").classList.remove("d-none");
      document.getElementById("logbtn").disabled = true;
    }
  };
  r.open("POST", "teacher-log-pro.php", true);
  r.send(f);
}
// login teacher with verification code 
function teacherLoginVC() {

  var username = document.getElementById("username");
  var password = document.getElementById("password");
  var rem = document.getElementById("remember-me");
  var vc = document.getElementById("vcode");

  var error1 = document.getElementById("error1");
  var error2 = document.getElementById("error2");
  var error3 = document.getElementById("error3");

  username.classList.remove("error-bac");
  password.classList.remove("error-bac");
  error1.innerHTML = "";
  error2.innerHTML = "";
  error3.innerHTML = "";
  var f = new FormData();
  f.append("un", username.value);
  f.append("pw", password.value);
  f.append("rem", rem.checked);
  f.append("vc", vc.value);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      document.getElementById("pendingbtn1").classList.add("d-none");
      document.getElementById("pendingbtn2").classList.add("d-none");
      document.getElementById("logbtn").disabled = false;

      var t = r.responseText;
      // alert(t);
      if (t == "loginSucces") {
        window.location = "../../teacher/gui/dashboard.php";

      } else if (t == "emptyUsername") {
        username.classList.add("error-bac");
        error1.innerHTML = "Please enter your username";

      } else if (t == "emptyPassword") {
        password.classList.add("error-bac");
        error2.innerHTML = "Please enter your password";

      } else if (t == "wrongVc") {
        vc.classList.add("error-bac");
        error3.innerHTML = "Verification Code is wrong";
      } else if (t == "needVcode") {
        showVcode();

      } else if (t == "banded") {
        error2.innerHTML = "Your account is blocked";

      } else if (t == "WrongUnPw") {
        username.classList.add("error-bac");
        password.classList.add("error-bac");
        error2.innerHTML = "Your username or password incorrect";

      } else {
        tostdanger("Opps! Somthing went wrong. Please try again later");
        console.log(t);
      }
    } else {
      document.getElementById("pendingbtn1").classList.remove("d-none");
      document.getElementById("pendingbtn2").classList.remove("d-none");
      document.getElementById("logbtn").disabled = true;

    }
  };
  r.open("POST", "teacher-log-pro.php", true);
  r.send(f);
}
// student login check and switch verification mood if it need 

function studentLogin() {


  var username = document.getElementById("username");
  var password = document.getElementById("password");
  var rem = document.getElementById("remember-me");

  var error1 = document.getElementById("error1");
  var error2 = document.getElementById("error2");

  username.classList.remove("error-bac");
  password.classList.remove("error-bac");
  error1.innerHTML = "";
  error2.innerHTML = "";

  var f = new FormData();
  f.append("un", username.value);
  f.append("pw", password.value);
  f.append("rem", rem.checked);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      document.getElementById("pendingbtn1").classList.add("d-none");
      document.getElementById("pendingbtn2").classList.add("d-none");
      document.getElementById("logbtn").disabled = false;

      var t = r.responseText;
      // alert(t);
      if (t == "loginSucces") {
        window.location = "../../student/gui/dashboard.php";
      } else if (t == "emptyUsername") {
        username.classList.add("error-bac");
        error1.innerHTML = "Please enter your username";
      } else if (t == "emptyPassword") {
        password.classList.add("error-bac");
        error2.innerHTML = "Please enter your password";

      } else if (t == "needVcode") {
        showVcode();
      } else if (t == "banded") {
        error2.innerHTML = "Your account is blocked";

      } else if (t == "WrongUnPw") {
        username.classList.add("error-bac");
        password.classList.add("error-bac");
        error2.innerHTML = "Your username or password incorrect";

      } else if (t == "Verification could not be sent") {
        tostdanger("Sorry! Verification code sending failed. Please try again later");

      } else {
        tostdanger("Opps! Somthing went wrong. Please try again later");
        console.log(t);
      }
    } else {
      document.getElementById("pendingbtn1").classList.remove("d-none");
      document.getElementById("pendingbtn2").classList.remove("d-none");
      document.getElementById("logbtn").disabled = true;

    }
  };
  r.open("POST", "student-log-pro.php", true);
  r.send(f);
}
// login student with verification code 

function studentLoginVC() {

  var username = document.getElementById("username");
  var password = document.getElementById("password");
  var rem = document.getElementById("remember-me");
  var vc = document.getElementById("vcode");

  var error1 = document.getElementById("error1");
  var error2 = document.getElementById("error2");
  var error3 = document.getElementById("error3");

  username.classList.remove("error-bac");
  password.classList.remove("error-bac");
  error1.innerHTML = "";
  error2.innerHTML = "";
  error3.innerHTML = "";
  var f = new FormData();
  f.append("un", username.value);
  f.append("pw", password.value);
  f.append("rem", rem.checked);
  f.append("vc", vc.value);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      document.getElementById("pendingbtn1").classList.add("d-none");
      document.getElementById("pendingbtn2").classList.add("d-none");
      document.getElementById("logbtn").disabled = false;

      var t = r.responseText;
      // alert(t);
      if (t == "loginSucces") {
        window.location = "../../student/gui/dashboard.php";

      } else if (t == "emptyUsername") {
        username.classList.add("error-bac");
        error1.innerHTML = "Please enter your username";

      } else if (t == "emptyPassword") {
        password.classList.add("error-bac");
        error2.innerHTML = "Please enter your password";

      } else if (t == "wrongVc") {
        vc.classList.add("error-bac");
        error3.innerHTML = "Verification Code is wrong";
      } else if (t == "needVcode") {
        showVcode();

      } else if (t == "banded") {
        error2.innerHTML = "Your account is blocked";

      } else if (t == "WrongUnPw") {
        username.classList.add("error-bac");
        password.classList.add("error-bac");
        error2.innerHTML = "Your username or password incorrect";

      } else {
        tostdanger("Opps! Somthing went wrong. Please try again later");
        console.log(t);
      }
    } else {
      document.getElementById("pendingbtn1").classList.remove("d-none");
      document.getElementById("pendingbtn2").classList.remove("d-none");
      document.getElementById("logbtn").disabled = true;

    }
  };
  r.open("POST", "student-log-pro.php", true);
  r.send(f);
}
// admin login check and switch verification mood if it need 

function adminLogin() {


  var username = document.getElementById("username");
  var password = document.getElementById("password");
  var rem = document.getElementById("remember-me");

  var error1 = document.getElementById("error1");
  var error2 = document.getElementById("error2");

  username.classList.remove("error-bac");
  password.classList.remove("error-bac");
  error1.innerHTML = "";
  error2.innerHTML = "";

  var f = new FormData();
  f.append("un", username.value);
  f.append("pw", password.value);
  f.append("rem", rem.checked);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      document.getElementById("pendingbtn1").classList.add("d-none");
      document.getElementById("pendingbtn2").classList.add("d-none");
      document.getElementById("logbtn").disabled = false;

      var t = r.responseText;
      // alert(t);
      if (t == "loginSucces") {
        window.location = "../../admin/gui/dashboard.php";
      } else if (t == "emptyUsername") {
        username.classList.add("error-bac");
        error1.innerHTML = "Please enter your username";
      } else if (t == "emptyPassword") {
        password.classList.add("error-bac");
        error2.innerHTML = "Please enter your password";

      } else if (t == "needVcode") {
        showVcode();
      } else if (t == "banded") {
        error2.innerHTML = "Your account is blocked";

      } else if (t == "WrongUnPw") {
        username.classList.add("error-bac");
        password.classList.add("error-bac");
        error2.innerHTML = "Your username or password incorrect";

      } else if (t == "Verification could not be sent") {
        tostdanger("Sorry! Verification code sending failed. Please try again later");

      } else {
        tostdanger("Opps! Somthing went wrong. Please try again later");
        console.log(t);
      }
    } else {
      document.getElementById("pendingbtn1").classList.remove("d-none");
      document.getElementById("pendingbtn2").classList.remove("d-none");
      document.getElementById("logbtn").disabled = true;

    }
  };
  r.open("POST", "admin-log-pro.php", true);
  r.send(f);
}
// login admin with verification code 

function adminLoginVC() {

  var username = document.getElementById("username");
  var password = document.getElementById("password");
  var rem = document.getElementById("remember-me");
  var vc = document.getElementById("vcode");

  var error1 = document.getElementById("error1");
  var error2 = document.getElementById("error2");
  var error3 = document.getElementById("error3");

  username.classList.remove("error-bac");
  password.classList.remove("error-bac");
  error1.innerHTML = "";
  error2.innerHTML = "";
  error3.innerHTML = "";
  var f = new FormData();
  f.append("un", username.value);
  f.append("pw", password.value);
  f.append("rem", rem.checked);
  f.append("vc", vc.value);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      document.getElementById("pendingbtn1").classList.add("d-none");
      document.getElementById("pendingbtn2").classList.add("d-none");
      document.getElementById("logbtn").disabled = false;

      var t = r.responseText;
      // alert(t);
      if (t == "loginSucces") {
        window.location = "../../admin/gui/dashboard.php";

      } else if (t == "emptyUsername") {
        username.classList.add("error-bac");
        error1.innerHTML = "Please enter your username";

      } else if (t == "emptyPassword") {
        password.classList.add("error-bac");
        error2.innerHTML = "Please enter your password";

      } else if (t == "wrongVc") {
        vc.classList.add("error-bac");
        error3.innerHTML = "Verification Code is wrong";
      } else if (t == "needVcode") {
        showVcode();

      } else if (t == "banded") {
        error2.innerHTML = "Your account is blocked";

      } else if (t == "WrongUnPw") {
        username.classList.add("error-bac");
        password.classList.add("error-bac");
        error2.innerHTML = "Your username or password incorrect";

      } else {
        tostdanger("Opps! Somthing went wrong. Please try again later");
        console.log(t);
      }
    } else {
      document.getElementById("pendingbtn1").classList.remove("d-none");
      document.getElementById("pendingbtn2").classList.remove("d-none");
      document.getElementById("logbtn").disabled = true;

    }
  };
  r.open("POST", "admin-log-pro.php", true);
  r.send(f);
}

// officer login check and switch verification mood if it need 


function officerLogin() {


  var username = document.getElementById("username");
  var password = document.getElementById("password");
  var rem = document.getElementById("remember-me");

  var error1 = document.getElementById("error1");
  var error2 = document.getElementById("error2");

  username.classList.remove("error-bac");
  password.classList.remove("error-bac");
  error1.innerHTML = "";
  error2.innerHTML = "";

  var f = new FormData();
  f.append("un", username.value);
  f.append("pw", password.value);
  f.append("rem", rem.checked);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      document.getElementById("pendingbtn1").classList.add("d-none");
      document.getElementById("pendingbtn2").classList.add("d-none");
      document.getElementById("logbtn").disabled = false;

      var t = r.responseText;
      // alert(t);
      if (t == "loginSucces") {
        window.location = "../../officer/gui/dashboard.php";
      } else if (t == "emptyUsername") {
        username.classList.add("error-bac");
        error1.innerHTML = "Please enter your username";
      } else if (t == "emptyPassword") {
        password.classList.add("error-bac");
        error2.innerHTML = "Please enter your password";

      } else if (t == "needVcode") {
        showVcode();
      } else if (t == "banded") {
        error2.innerHTML = "Your account is blocked";

      } else if (t == "WrongUnPw") {
        username.classList.add("error-bac");
        password.classList.add("error-bac");
        error2.innerHTML = "Your username or password incorrect";

      } else if (t == "Verification could not be sent") {
        tostdanger("Sorry! Verification code sending failed. Please try again later");

      } else {
        tostdanger("Opps! Somthing went wrong. Please try again later");
        console.log(t);
      }
    } else {
      document.getElementById("pendingbtn1").classList.remove("d-none");
      document.getElementById("pendingbtn2").classList.remove("d-none");
      document.getElementById("logbtn").disabled = true;

    }
  };
  r.open("POST", "officer-log-pro.php", true);
  r.send(f);
}
// login officer with verification code 

function officerLoginVC() {

  var username = document.getElementById("username");
  var password = document.getElementById("password");
  var rem = document.getElementById("remember-me");
  var vc = document.getElementById("vcode");

  var error1 = document.getElementById("error1");
  var error2 = document.getElementById("error2");
  var error3 = document.getElementById("error3");

  username.classList.remove("error-bac");
  password.classList.remove("error-bac");
  error1.innerHTML = "";
  error2.innerHTML = "";
  error3.innerHTML = "";
  var f = new FormData();
  f.append("un", username.value);
  f.append("pw", password.value);
  f.append("rem", rem.checked);
  f.append("vc", vc.value);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      document.getElementById("pendingbtn1").classList.add("d-none");
      document.getElementById("pendingbtn2").classList.add("d-none");
      document.getElementById("logbtn").disabled = false;

      var t = r.responseText;
      // alert(t);
      if (t == "loginSucces") {
        window.location = "../../officer/gui/dashboard.php";

      } else if (t == "emptyUsername") {
        username.classList.add("error-bac");
        error1.innerHTML = "Please enter your username";

      } else if (t == "emptyPassword") {
        password.classList.add("error-bac");
        error2.innerHTML = "Please enter your password";

      } else if (t == "wrongVc") {
        vc.classList.add("error-bac");
        error3.innerHTML = "Verification Code is wrong";
      } else if (t == "needVcode") {
        showVcode();

      } else if (t == "banded") {
        error2.innerHTML = "Your account is blocked";

      } else if (t == "WrongUnPw") {
        username.classList.add("error-bac");
        password.classList.add("error-bac");
        error2.innerHTML = "Your username or password incorrect";

      } else {
        tostdanger("Opps! Somthing went wrong. Please try again later");
        console.log(t);
      }
    } else {
      document.getElementById("pendingbtn1").classList.remove("d-none");
      document.getElementById("pendingbtn2").classList.remove("d-none");
      document.getElementById("logbtn").disabled = true;

    }
  };
  r.open("POST", "officer-log-pro.php", true);
  r.send(f);
}


// send verification code for fogort password 
function sendVerification() {

  // window.location = "../../login/gui/password-reset.php";
  var email = document.getElementById("email");

  var f = new FormData();
  f.append("e", email.value);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert(t)
      if (t == "Not Registed email") {
        document.getElementById("error2").innerHTML = t;
      } else if (t == "EmptyEmail") {
        document.getElementById("error2").innerHTML = "Enter Your Email Address";

      } else {
        window.location = t;

      }
      document.getElementById("vcbtn").disabled = false;

    } else {
      document.getElementById("vcbtn").disabled = true;
    }
  };
  r.open("POST", "../backend/link-generate.php", true);

  r.send(f);
}
// password reset for fogort password
function resetPassword(e) {
  var rtpassword = document.getElementById("rtpassword");
  var password = document.getElementById("password");
  var vcode = document.getElementById("vcode");

  var f = new FormData();
  f.append("cp", rtpassword.value);
  f.append("p", password.value);
  f.append("e", e);
  f.append("c", vcode.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert(t)
      if (t == "success") {
        window.location = "../../index.php";
      } else {
        document.getElementById("error2").innerHTML = t;
      }
    }
  };
  r.open("POST", "../backend/password-reset-pro.php", true);

  r.send(f);
}
// password reset from profile 

function resetPws(ty) {
  var errorview = document.getElementById("errorview");
  var errorid1 = document.getElementById("errorid1");
  var errorid2 = document.getElementById("errorid2");
  errorid1.innerHTML = "";
  errorid2.innerHTML = "";
  errorview.innerHTML = "";


  var old = document.getElementById("currpasswod");
  var newpws = document.getElementById("newpws");
  var Cnewpws = document.getElementById("Cnewpws");
  var f = new FormData();
  f.append("olP", old.value);
  f.append("newpws", newpws.value);
  f.append("Cnewpws", Cnewpws.value);
  f.append("ty", ty);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert(t)
      if (t == "success") {
        tost("Password reset successfully");
        old.value = "";
        newpws.value = "";
        Cnewpws.value = "";
      } else if (t == "Please enter current password") {
        errorid1.innerHTML = t;
      } else if (t == "Please enter new password") {
        errorid2.innerHTML = t;
      } else if (t == "Please comfirm new password") {
        errorview.innerHTML = t;
      } else if (t == "Password length must between 8 to 20") {
        errorid2.innerHTML = t;
      } else if (t == "Password must contains numbers") {
        errorid2.innerHTML = t;
      } else if (t == "Current password is wrong") {
        errorid1.innerHTML = t;
      } else if (t == "Password not same") {
        errorview.innerHTML = t;
      }
    }
  };
  r.open("POST", "../../com/password-reset.php", true);
  r.send(f);
}

// theam changing to dark
function darktheam(ty) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert(t)
      if (t == "success") {
        location.reload();
      }
    }
  };
  r.open("GET", "../../com/dark-mode.php?ty=" + ty, true);
  r.send();
}
// theam changing to light

function Lighttheam(ty) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert(t)
      if (t == "success") {
        location.reload();
      }
    }
  };
  r.open("GET", "../../com/light-mode.php?ty=" + ty, true);
  r.send();
}
// enable or disable two step verification 
function twoStepVerify(ty) {
  var verifiyid = document.getElementById("verifiyid");
  var f = new FormData();
  f.append("ty", ty);
  f.append("s", verifiyid.checked);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert(t)
      if (t == "success") {
        location.reload();
      }
    }
  };
  r.open("POST", "../../com/two-step-verification.php", true);
  r.send(f);
}
// get event for calender 
function eventLoder(date) {
  var veiwer = document.getElementById("event-view");
  var f = new FormData();
  f.append("date", date);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert(t)
      veiwer.innerHTML = t;
      showevent();
    }
  };
  r.open("POST", "../../com/event-loader.php", true);
  r.send(f);
}
var mod3;
function showAddEveMod() {
  mod3 = new bootstrap.Modal(document.getElementById("eventMod"), 'static');
  mod3.show();
}


function refresh() {
  location.reload();
}


//start distric and city loader 
function loaderAddres(type) {
  var f = new FormData();
  if (type == "district") {
    f.append("ty", type);
    f.append("p", document.getElementById("provincetag").value);
  } else if (type == "city") {
    f.append("ty", type);
    f.append("d", document.getElementById("districtag").value);
  } else if (type == "postal") {
    f.append("ty", type);
    f.append("c", document.getElementById("citytag").value);
  }
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert(t)
      if (type == "district") {
        document.getElementById("districtag").innerHTML = t;
      } else if (type == "city") {
        document.getElementById("citytag").innerHTML = t;

      } else if (type == "postal") {
        document.getElementById("postalcodetag").value = t;

      }
    }

  };
  r.open("POST", "../../com/address-loader.php", true);
  r.send(f);
}
// end distric and city loader 
