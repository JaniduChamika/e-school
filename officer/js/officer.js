// image crop 
var imageurl = "";
function done() {

  $(document).ready(function () {
    var url;
    document.getElementById("selectImage3").onchange = function () {
      var file = this.files[0];
      url = window.URL.createObjectURL(file);
      // alert(url)
      document.getElementById("cropbox").classList.remove("d-none");
      document.getElementById("imageviewbox").classList.add("d-none");

      $('#contain').imageResizer({
        image: url,
        imgFormat: '1/1', // Formats: 3/2, 200x360, auto
        // circleCrop: true,
        // zoomable: true,
        // outBoundColor: 'white', // black, white
        btnDoneAttr: '.resize-done'
      }, function (imgResized) {
        // $('#move-stats').html('<h3>Resized Image</h3><img id="abcd" style="margin:10% auto;" src="' + imgResized + '">')
        document.getElementById("viewImage3").style.backgroundImage = "url('" + imgResized + "')";
        document.getElementById("cropbox").classList.add("d-none");
        document.getElementById("imageviewbox").classList.remove("d-none");
        imageurl = imgResized;
      })
    }
  })


}
// image crop 


// register student 
function addUser(type) {
  clearerro();

  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var nametag = document.getElementById("nametag");
  var usernametag = document.getElementById("usernametag");
  var emailtag = document.getElementById("emailtag");
  var phonetag = document.getElementById("phonetag");

  var gardianName = document.getElementById("gardian-name");
  var gardianContact = document.getElementById("gardian-contact");
  var classtag = document.getElementById("classtag");

  var ganderradiomale = document.getElementById("ganderradiomale");
  var dobtag = document.getElementById("dobtag");
  var Religious = document.getElementById("Religious ");
  var addresstag = document.getElementById("addresstag");

  var citytag = document.getElementById("citytag");
  var imagetag = document.getElementById("viewImage3");

  var errormsg = document.getElementById("errormsg");


  var f = new FormData();
  f.append("fn", fname.value);
  f.append("ln", lname.value);
  f.append("fulln", nametag.value);
  f.append("uname", usernametag.value);
  f.append("emailt", emailtag.value);
  f.append("contact", phonetag.value);

  f.append("gname", gardianName.value);
  f.append("gcontact", gardianContact.value);
  f.append("stuclass", classtag.value);


  f.append("gen", ganderradiomale.checked);
  f.append("dob", dobtag.value);
  f.append("religion", Religious.value);
  f.append("add", addresstag.value);

  f.append("city", citytag.value);
  f.append("image", imageurl);
  f.append("userType", "student");

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      document.getElementById("submitbtn").disabled = false;

      document.getElementById("pendingbtn2").classList.add("d-none");
      var text = r.responseText;
      // alert(text)
      if (text == "success") {
        tost(type + " registration successfully");
        clearFileds(type)
      } else {
        errormsg.classList.remove("d-none");
        if (text == "emptyFname") {
          fname.classList.add("error-bac");
          errormsg.innerHTML = "Please enter " + type + "'s first name — check it out!";
        } else if (text == "emptyLname") {
          lname.classList.add("error-bac");
          errormsg.innerHTML = "Please enter " + type + "'s last name — check it out!";

        } else if (text == "emptyFullname") {
          nametag.classList.add("error-bac");
          errormsg.innerHTML = "Please enter " + type + "'s full name — check it out!";

        } else if (text == "emptyUname") {
          usernametag.classList.add("error-bac");
          errormsg.innerHTML = "Please enter " + type + "'s username — check it out!";

        } else if (text == "emptyEmail") {
          emailtag.classList.add("error-bac");
          errormsg.innerHTML = "Please enter " + type + "'s email address — check it out!";

        } else if (text == "invalidEmail") {
          emailtag.classList.add("error-bac");
          errormsg.innerHTML = "Oops! " + type + "'s email address is not valid — check it out!";

        } else if (text == "emptyContact") {
          phonetag.classList.add("error-bac");
          errormsg.innerHTML = "Please enter " + type + "'s contact number — check it out!";

        } else if (text == "invalidContact") {
          phonetag.classList.add("error-bac");
          errormsg.innerHTML = "Oops! " + type + "'s contact number is not valid — check it out!";

        } else if (text == "emptyGaurdianName") {
          gardianName.classList.add("error-bac");
          errormsg.innerHTML = "Please enter " + type + " guardian's name — check it out!";

        } else if (text == "emptyemptyContact") {
          gardianContact.classList.add("error-bac");
          errormsg.innerHTML = "Please enter " + type + " guardian's contact number — check it out!";

        } else if (text == "invalidGardianContact") {
          gardianContact.classList.add("error-bac");
          errormsg.innerHTML = "Oops! " + type + " guardian 's contact number is not valid — check it out!";

        } else if (text == "emptyBOD") {
          dobtag.classList.add("error-bac");
          errormsg.innerHTML = "Please select " + type + "'s birth of date — check it out!";

        } else if (text == "emptyClass") {
          classtag.classList.add("error-bac");
          errormsg.innerHTML = "Please select " + type + "'s class — check it out!";

        } else if (text == "emptyReligion") {
          Religious.classList.add("error-bac");
          errormsg.innerHTML = "Please select " + type + "'s Religious — check it out!";

        } else if (text == "emptyAddress") {
          addresstag.classList.add("error-bac");
          errormsg.innerHTML = "Please enter " + type + "'s address — check it out!";

        } else if (text == "emptyCity") {
          citytag.classList.add("error-bac");
          errormsg.innerHTML = "Please select " + type + "'s city — check it out!";

        } else if (text == "emptyImage") {
          imagetag.classList.add("error-bac");
          errormsg.innerHTML = "Please choose " + type + "'s profile image — check it out!";

        } else {
          errormsg.innerHTML = text;
        }
      }

    } else {
      document.getElementById("submitbtn").disabled = true;

      document.getElementById("pendingbtn2").classList.add("d-none");
    }
  };
  r.open("POST", "../backend/ragister-student.php", true);
  r.send(f);

}
// clear error color in ui 
function clearerro() {
  document.getElementById("errormsg").classList.add("d-none");

  document.getElementById("fname").classList.remove("error-bac");
  document.getElementById("lname").classList.remove("error-bac");
  document.getElementById("nametag").classList.remove("error-bac");
  document.getElementById("usernametag").classList.remove("error-bac");
  document.getElementById("emailtag").classList.remove("error-bac");
  document.getElementById("phonetag").classList.remove("error-bac");
  document.getElementById("ganderradiomale").classList.remove("error-bac");
  document.getElementById("dobtag").classList.remove("error-bac");
  document.getElementById("Religious ").classList.remove("error-bac");
  document.getElementById("addresstag").classList.remove("error-bac");
  document.getElementById("provincetag").classList.remove("error-bac");
  document.getElementById("districtag").classList.remove("error-bac");
  document.getElementById("citytag").classList.remove("error-bac");
  document.getElementById("viewImage3").classList.remove("error-bac");

  document.getElementById("gardian-name").classList.remove("error-bac");
  document.getElementById("gardian-contact").classList.remove("error-bac");
  document.getElementById("classtag").classList.remove("error-bac");



}
// clear all feild after done student registration 
function clearFileds() {
  document.getElementById("fname").value = "";
  document.getElementById("lname").value = "";
  document.getElementById("nametag").value = "";
  document.getElementById("usernametag").value = "";
  document.getElementById("emailtag").value = "";
  document.getElementById("phonetag").value = "";
  document.getElementById("ganderradiomale").checked = true;
  document.getElementById("dobtag").value = "";
  document.getElementById("Religious ").value = "0";
  document.getElementById("addresstag").value = "";
  document.getElementById("postalcodetag").value = "";
  document.getElementById("provincetag").value = "0";
  document.getElementById("districtag").value = "0";
  document.getElementById("citytag").value = "0";

  document.getElementById("viewImage3").style.backgroundImage = "url('../../image/profile/student-default.png')";
  imageurl = "";
  // optinal
  document.getElementById("gardian-name").value = "";
  document.getElementById("gardian-contact").value = "";
  document.getElementById("classtag").value = "0";
  document.getElementById("gradetag").value = "0";


}

// get class for student registation 
function getClass() {
  var grade = document.getElementById("gradetag");
  var classtag = document.getElementById("classtag");

  var f = new FormData();
  f.append("g", grade.value);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      classtag.innerHTML = t;
      // alert(t)
    }
  }
  r.open("POST", "../backend/get-class-relavent-grade.php", true);
  r.send(f);
}


// update student  details 
function updateStudent(type, uid) {
  clearerro(type);

  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var nametag = document.getElementById("nametag");
  var usernametag = document.getElementById("usernametag");
  var emailtag = document.getElementById("emailtag");
  var phonetag = document.getElementById("phonetag");

  var gardianName = document.getElementById("gardian-name");
  var gardianContact = document.getElementById("gardian-contact");
  var classtag = document.getElementById("classtag");

  var ganderradiomale = document.getElementById("ganderradiomale");
  var dobtag = document.getElementById("dobtag");
  var Religious = document.getElementById("Religious ");
  var addresstag = document.getElementById("addresstag");

  var citytag = document.getElementById("citytag");
  var imagetag = document.getElementById("viewImage3");

  var errormsg = document.getElementById("errormsg");


  var f = new FormData();
  f.append("uid", uid);

  f.append("fn", fname.value);
  f.append("ln", lname.value);
  f.append("fulln", nametag.value);
  f.append("uname", usernametag.value);
  f.append("emailt", emailtag.value);
  f.append("contact", phonetag.value);

  f.append("gname", gardianName.value);
  f.append("gcontact", gardianContact.value);
  f.append("stuclass", classtag.value);


  f.append("gen", ganderradiomale.checked);
  f.append("dob", dobtag.value);
  f.append("religion", Religious.value);
  f.append("add", addresstag.value);

  f.append("city", citytag.value);
  f.append("image", imageurl);
  f.append("userType", "student");

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;
      // alert(text)
      if (text == "success") {
        tost(type + " details updated successfully");
      } else {
        errormsg.classList.remove("d-none");
        if (text == "emptyFname") {
          fname.classList.add("error-bac");
          errormsg.innerHTML = "Please enter " + type + "'s first name — check it out!";
        } else if (text == "emptyLname") {
          lname.classList.add("error-bac");
          errormsg.innerHTML = "Please enter " + type + "'s last name — check it out!";

        } else if (text == "emptyFullname") {
          nametag.classList.add("error-bac");
          errormsg.innerHTML = "Please enter " + type + "'s full name — check it out!";

        } else if (text == "emptyUname") {
          usernametag.classList.add("error-bac");
          errormsg.innerHTML = "Please enter " + type + "'s username — check it out!";

        } else if (text == "emptyEmail") {
          emailtag.classList.add("error-bac");
          errormsg.innerHTML = "Please enter " + type + "'s email address — check it out!";

        } else if (text == "invalidEmail") {
          emailtag.classList.add("error-bac");
          errormsg.innerHTML = "Oops! " + type + "'s email address is not valid — check it out!";

        } else if (text == "emptyContact") {
          phonetag.classList.add("error-bac");
          errormsg.innerHTML = "Please enter " + type + "'s contact number — check it out!";

        } else if (text == "invalidContact") {
          phonetag.classList.add("error-bac");
          errormsg.innerHTML = "Oops! " + type + "'s contact number is not valid — check it out!";

        } else if (text == "emptyGaurdianName") {
          gardianName.classList.add("error-bac");
          errormsg.innerHTML = "Please enter " + type + " guardian's name — check it out!";

        } else if (text == "emptyemptyContact") {
          gardianContact.classList.add("error-bac");
          errormsg.innerHTML = "Please enter " + type + " guardian's contact number — check it out!";

        } else if (text == "invalidGardianContact") {
          gardianContact.classList.add("error-bac");
          errormsg.innerHTML = "Oops! " + type + " guardian 's contact number is not valid — check it out!";

        } else if (text == "emptyBOD") {
          dobtag.classList.add("error-bac");
          errormsg.innerHTML = "Please select " + type + "'s birth of date — check it out!";

        } else if (text == "emptyClass") {
          classtag.classList.add("error-bac");
          errormsg.innerHTML = "Please select " + type + "'s class — check it out!";

        } else if (text == "emptyReligion") {
          Religious.classList.add("error-bac");
          errormsg.innerHTML = "Please select " + type + "'s Religious — check it out!";

        } else if (text == "emptyAddress") {
          addresstag.classList.add("error-bac");
          errormsg.innerHTML = "Please enter " + type + "'s address — check it out!";

        } else if (text == "emptyCity") {
          citytag.classList.add("error-bac");
          errormsg.innerHTML = "Please select " + type + "'s city — check it out!";

        } else if (text == "emptyImage") {
          imagetag.classList.add("error-bac");
          errormsg.innerHTML = "Please choose " + type + "'s profile image — check it out!";

        } else {
          errormsg.innerHTML = text;
        }
      }

    }
  };
  r.open("POST", "../backend/edit-student.php", true);
  r.send(f);
}


// search students and show them 
function searchStudent(page) {
  var tableBox = document.getElementById("tableBox");
  var grade = document.getElementById("filterGrade");
  var pendingbtn = document.getElementById("pendingbtn");
  var seachbar = document.getElementById("seachbar");

  var f = new FormData();
  f.append("page", page);
  f.append("g", grade.value);
  f.append("pen", pendingbtn.checked);
  f.append("word", seachbar.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert(t)
      tableBox.innerHTML = t;
    }

  };
  r.open("POST", "../backend/search-student.php", true);
  r.send(f);
}
function releseMarks(id) {

  var f = new FormData();

  f.append("id", id);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        searchAssignmentMark(1);
      }
    }

  };
  r.open("POST", "../backend/relese-marks.php", true);
  r.send(f);
}

// search assignment marks  from database and show them
function searchAssignmentMark(page) {
  var tableBox = document.getElementById("tableBox");
  var selectgrade = document.getElementById("selectgrade");
  var selectsub = document.getElementById("selectsub");
  var pendingbtn = document.getElementById("pendingbtn");
  var seachbar = document.getElementById("seachbar");

  var f = new FormData();
  f.append("page", page);
  f.append("g", selectgrade.value);
  f.append("s", selectsub.value);
  f.append("p", pendingbtn.checked);
  f.append("word", seachbar.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert(t)
      tableBox.innerHTML = t;
    }

  };
  r.open("POST", "../backend/search-assignment-marks.php", true);
  r.send(f);
}

// assignment pagination 
function searchAssignment(page) {
  var tableBox = document.getElementById("tableBox");
  var selectgrade = document.getElementById("selectgrade");
  var selectsub = document.getElementById("selectsub");
  var activetag = document.getElementById("activetag");
  var seachbar = document.getElementById("seachbar");

  var f = new FormData();
  f.append("page", page);
  f.append("g", selectgrade.value);
  f.append("s", selectsub.value);
  f.append("a", activetag.checked);
  f.append("word", seachbar.value);


  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert(t)
      tableBox.innerHTML = t;
    }

  };
  r.open("POST", "../backend/search-assignment.php", true);
  r.send(f);
}


// enable feild to make any changes 
function profileEdiOfficer() {

  document.getElementById("fname").disabled = false;
  document.getElementById("lname").disabled = false;

  document.getElementById("nametag").disabled = false;

  document.getElementById("phonetag").disabled = false;
  document.getElementById("ganderradiomale").disabled = false;
  document.getElementById("dobtag").disabled = false;
  document.getElementById("Religious ").disabled = false;
  document.getElementById("addresstag").disabled = false;
  document.getElementById("provincetag").disabled = false;
  document.getElementById("districtag").disabled = false;
  document.getElementById("citytag").disabled = false;

  document.getElementById("postalcodetag").disabled = false;
  document.getElementById("editbtn").innerHTML = "Save";
  document.getElementById("editbtn").setAttribute("onclick", "profileUpdateOfficer();");

}
// disable all feild 
function restPofile() {

  document.getElementById("fname").disabled = true;
  document.getElementById("lname").disabled = true;

  document.getElementById("nametag").disabled = true;

  document.getElementById("phonetag").disabled = true;
  document.getElementById("ganderradiomale").disabled = true;
  document.getElementById("dobtag").disabled = true;
  document.getElementById("Religious ").disabled = true;
  document.getElementById("addresstag").disabled = true;
  document.getElementById("provincetag").disabled = true;
  document.getElementById("districtag").disabled = true;
  document.getElementById("citytag").disabled = true;

  document.getElementById("postalcodetag").disabled = true;
  document.getElementById("editbtn").innerHTML = "Edit";
  document.getElementById("editbtn").setAttribute("onclick", "profileEdiOfficer();");
}
// update officer profile 
function profileUpdateOfficer() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var nametag = document.getElementById("nametag");


  var phonetag = document.getElementById("phonetag");



  var ganderradiomale = document.getElementById("ganderradiomale");
  var dobtag = document.getElementById("dobtag");
  var Religious = document.getElementById("Religious ");
  var addresstag = document.getElementById("addresstag");

  var citytag = document.getElementById("citytag");
  var errormsg = document.getElementById("errormsg");
  errormsg.classList.add("d-none");

  var f = new FormData();

  f.append("fn", fname.value);
  f.append("ln", lname.value);
  f.append("fulln", nametag.value);

  f.append("contact", phonetag.value);

  f.append("gen", ganderradiomale.checked);
  f.append("dob", dobtag.value);
  f.append("religion", Religious.value);
  f.append("add", addresstag.value);


  f.append("city", citytag.value);



  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;
      // alert(text)
      if (text == "success") {
        restPofile();

        tost("Your profile updated successfully");
      } else {
        errormsg.classList.remove("d-none");
        if (text == "emptyFname") {
          fname.classList.add("error-bac");
          errormsg.innerHTML = "Please enter your first name — check it out!";
        } else if (text == "emptyLname") {
          lname.classList.add("error-bac");
          errormsg.innerHTML = "Please enter your last name — check it out!";

        } else if (text == "emptyFullname") {
          nametag.classList.add("error-bac");
          errormsg.innerHTML = "Please enter your full name — check it out!";

        } else if (text == "emptyContact") {
          phonetag.classList.add("error-bac");
          errormsg.innerHTML = "Please enter your contact number — check it out!";

        } else if (text == "invalidContact") {
          phonetag.classList.add("error-bac");
          errormsg.innerHTML = "Oops! your contact number is not valid — check it out!";

        } else if (text == "emptyBOD") {
          dobtag.classList.add("error-bac");
          errormsg.innerHTML = "Please select your birth of date — check it out!";

        } else if (text == "emptyClass") {
          classtag.classList.add("error-bac");
          errormsg.innerHTML = "Please select your class — check it out!";

        } else if (text == "emptyReligion") {
          Religious.classList.add("error-bac");
          errormsg.innerHTML = "Please select your Religious — check it out!";

        } else if (text == "emptyAddress") {
          addresstag.classList.add("error-bac");
          errormsg.innerHTML = "Please enter your address — check it out!";

        } else if (text == "emptyCity") {
          citytag.classList.add("error-bac");
          errormsg.innerHTML = "Please select your city — check it out!";

        } else {
          errormsg.innerHTML = "Somthing Wrong Please Try Again Later";
        }
      }

    }
  };
  r.open("POST", "../backend/update-profile.php", true);
  r.send(f);
}
// clear all error showing in profile page 
function ProfileErrorClear() {
  document.getElementById("errormsg").classList.add("d-none");

  document.getElementById("fname").classList.remove("error-bac");
  document.getElementById("lname").classList.remove("error-bac");
  document.getElementById("nametag").classList.remove("error-bac");


  document.getElementById("phonetag").classList.remove("error-bac");
  document.getElementById("ganderradiomale").classList.remove("error-bac");
  document.getElementById("dobtag").classList.remove("error-bac");
  document.getElementById("Religious ").classList.remove("error-bac");
  document.getElementById("addresstag").classList.remove("error-bac");
  document.getElementById("provincetag").classList.remove("error-bac");
  document.getElementById("districtag").classList.remove("error-bac");
  document.getElementById("citytag").classList.remove("error-bac");




}
// open new email enter modal 
var mod2;
function emailModal() {
  mod2 = new bootstrap.Modal(document.getElementById("newemailMod"), 'static');
  mod2.show();
}
// request from admin to change email 
function requestEmailChange() {
  var emailtag = document.getElementById("newEmail");
  emailtag.classList.remove("error-bac");

  var f = new FormData();
  f.append("e", emailtag.value);


  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "emtyemail") {
        emailtag.classList.add("error-bac");
      } else if (t == "success") {
        mod2.hide();
      }
    }

  };
  r.open("POST", "../backend/email-change.php", true);
  r.send(f);
}
// resend usernam,password and verification code 
function resendInvite(id) {
  var f = new FormData();
  f.append("id", id);


  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert(t);
      if (t == "success") {
        tost("Invitation sent successfully");
      } else {
        tostdanger("Oops! Somthing went wring. Please try again later");

      }
    }
  };
  r.open("POST", "../backend/resend-invitation.php", true);
  r.send(f);
}