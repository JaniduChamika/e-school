
// note pagination 
function searchNote(page) {
      var tableBox = document.getElementById("tableBox");
      var selectsub = document.getElementById("selectsub");
      var seachbar = document.getElementById("seachbar");

      var f = new FormData();
      f.append("page", page);
      f.append("s", selectsub.value);

      f.append("word", seachbar.value);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  tableBox.innerHTML = t;
            }

      };
      r.open("POST", "../backend/search-note.php", true);
      r.send(f);
}

// search all assignment and show them  
function searchAssignment(page) {
      var tableBox = document.getElementById("tableBox");

      var selectsub = document.getElementById("selectsub");
      var activetag = document.getElementById("activetag");
      var seachbar = document.getElementById("seachbar");

      var f = new FormData();
      f.append("page", page);

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

// open file upload model 
var mod;
function showUploadMod(id) {
      document.getElementById("fileid").value = "";
      document.getElementById("divdocviewer").innerHTML = "";
      document.getElementById("error2").innerHTML = "";
      document.getElementById("fileid").classList.remove("error-bac");
      mod = new bootstrap.Modal(document.getElementById('myModelID'), 'static');


      document.getElementById("submitBtn").setAttribute("onclick", "saveAnswer(" + id + ");");


      mod.show();


}
// send pdf to server side 
function saveAnswer(id) {
      var awnser = document.getElementById("fileid");
      var error2 = document.getElementById("error2");
      error2.innerHTML = "";
      var f = new FormData();
      f.append("id", id);
      f.append("f", awnser.files[0]);


      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t);
                  if (t == "success") {
                        tost("Assingment uploaded successfully");
                        mod.hide();
                        fileid.value = "";
                        divdocviewer.innerHTML = "";
                        searchAssignment(1);
                  } else if (t == "notPDF") {
                        error2.innerHTML = "File Type Must be PDF";
                        fileid.classList.add("error-bac");


                  } else if (t == "emptyFile") {
                        error2.innerHTML = "Please Choose Assignment PDF";
                        fileid.classList.add("error-bac");


                  } else {
                        tostdanger("Oops! Somthing went wrong please try again later");

                  }
            }

      };
      r.open("POST", "../backend/upload-assignment.php", true);
      r.send(f);
}



// enable feilds to make changes 
function profileEdiStudent() {
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

      document.getElementById("parantnametag").disabled = false;
      document.getElementById("parantcontacttag").disabled = false;

      document.getElementById("postalcodetag").disabled = false;
      document.getElementById("editbtn").innerHTML = "Save";
      document.getElementById("editbtn").setAttribute("onclick", "profileUpdateStudent();");



}

// disable all feild 
function restPofile() {
      document.getElementById("fname").disabled = true;
      document.getElementById("lname").disabled = true;
true
      document.getElementById("nametag").disabled = true;

      document.getElementById("phonetag").disabled = true;
      document.getElementById("ganderradiomale").disabled = true;
      document.getElementById("dobtag").disabled = true;
      document.getElementById("Religious ").disabled = true;
      document.getElementById("addresstag").disabled = true;
      document.getElementById("provincetag").disabled = true;
      document.getElementById("districtag").disabled = true;
      document.getElementById("citytag").disabled = true;

      document.getElementById("parantnametag").disabled = true;
      document.getElementById("parantcontacttag").disabled = true;

      document.getElementById("postalcodetag").disabled = true;
      document.getElementById("editbtn").innerHTML = "Edit";
      document.getElementById("editbtn").setAttribute("onclick", "profileEdiStudent();");
}
// update student profile 
function profileUpdateStudent() {
      var fname = document.getElementById("fname");
      var lname = document.getElementById("lname");
      var nametag = document.getElementById("nametag");

      var phonetag = document.getElementById("phonetag");

      var ganderradiomale = document.getElementById("ganderradiomale");
      var dobtag = document.getElementById("dobtag");
      var Religious = document.getElementById("Religious ");
      var addresstag = document.getElementById("addresstag");

      var gardianName = document.getElementById("parantnametag");
      var gardianContact = document.getElementById("parantcontacttag");

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

      f.append("guardcontact", gardianContact.value);
      f.append("guardname", gardianName.value);


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

                        } else if (text == "emptyGaurdianName") {
                              gardianName.classList.add("error-bac");
                              errormsg.innerHTML = "Please enter your guardian's name — check it out!";

                        } else if (text == "emptyemptyContact") {
                              gardianContact.classList.add("error-bac");
                              errormsg.innerHTML = "Please enter your guardian's contact number — check it out!";

                        } else if (text == "invalidGardianContact") {
                              gardianContact.classList.add("error-bac");
                              errormsg.innerHTML = "Oops! your guardian 's contact number is not valid — check it out!";

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



      document.getElementById("parantnametag").classList.remove("error-bac");

      document.getElementById("parantcontacttag").classList.remove("error-bac");


}

var mod2;
function emailModal() {
      mod2 = new bootstrap.Modal(document.getElementById("newemailMod"), 'static');
      mod2.show();
}
function requestEmailChange() {
      var emailtag = document.getElementById("newEmail");
      emailtag.classList.remove("error-bac");

      var f = new FormData();
      f.append("e", emailtag.value);


      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
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
