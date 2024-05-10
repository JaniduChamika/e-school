var mod;

// get pdf and data send sever
function addNote() {
      var subject = document.getElementById("subject");
      var medium = document.getElementById("medium");
      var notetitle = document.getElementById("notetitle");
      var grade = document.getElementById("grade");
      var fileid = document.getElementById("fileid");

      var errormsg = document.getElementById("errormsg");
      var f = new FormData();
      f.append("s", subject.value);
      f.append("m", medium.value);
      f.append("t", notetitle.value);
      f.append("g", grade.value);
      f.append("f", fileid.files[0]);

      medium.classList.remove("error-bac");
      notetitle.classList.remove("error-bac");
      grade.classList.remove("error-bac");
      subject.classList.remove("error-bac");
      fileid.classList.remove("error-bac");
      errormsg.innerHTML = "";
      errormsg.classList.add("d-none");

      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        tost("Note added successfully");

                        medium.value = "0";
                        notetitle.value = "";
                        grade.value = "0";
                        subject.value = "0";
                        fileid.value = "";
                        divdocviewer.innerHTML = "";

                  } else if (t == "emptyGrade") {
                        errormsg.innerHTML = "Please Select Grade";
                        grade.classList.add("error-bac");
                        errormsg.classList.remove("d-none");

                  } else if (t == "emptySubject") {
                        errormsg.innerHTML = "Please Select Subject";
                        subject.classList.add("error-bac");
                        errormsg.classList.remove("d-none");

                  } else if (t == "emptyMedium") {
                        errormsg.innerHTML = "Please Select Medium";
                        medium.classList.add("error-bac");
                        errormsg.classList.remove("d-none");

                  } else if (t == "emptyTitle") {
                        errormsg.innerHTML = "Please Enter Title";
                        notetitle.classList.add("error-bac");
                        errormsg.classList.remove("d-none");

                  } else if (t == "notPDF") {
                        errormsg.innerHTML = "File Type Must be PDF";
                        fileid.classList.add("error-bac");
                        errormsg.classList.remove("d-none");

                  } else if (t == "emptyFile") {
                        errormsg.innerHTML = "Please Choose Assignment PDF";
                        fileid.classList.add("error-bac");
                        errormsg.classList.remove("d-none");

                  } else {
                        tostdanger("Oops! Somthing went wrong please try again later");

                  }
            }
      }
      r.open("POST", "../backend/add-note-pro.php", true);
      r.send(f);
}


// show comfirmation model 
function noteDeleteCom(id) {

      mod = new bootstrap.Modal(document.getElementById('delteMod'), 'static');

      var deletebtn = document.getElementById("deletebtn");
      deletebtn.setAttribute("onclick", "noteDelete(" + id + ");");
      mod.show();
}
// note deleteing proccess 
function noteDelete(nid) {
      var f = new FormData();
      f.append("nid", nid);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        tost("Note deleted successfully");
                        mod.hide();
                        searchNote(1);
                  } else {
                        tostdanger("Oops! Somthing went wrong please try again later");

                  }
            }
      }
      r.open("POST", "../backend/note-delete.php", true);
      r.send(f);
}
// note pagination 
function searchNote(page) {
      var tableBox = document.getElementById("tableBox");
      var selectgrade = document.getElementById("selectgrade");
      var selectsub = document.getElementById("selectsub");
      var seachbar = document.getElementById("seachbar");

      var f = new FormData();
      f.append("page", page);
      f.append("g", selectgrade.value);
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



// get pdf and data send sever assinment
function addAssingment() {
      var subject = document.getElementById("subject");

      var title = document.getElementById("title");
      var grade = document.getElementById("grade");
      var fileid = document.getElementById("fileid");
      var sdate = document.getElementById("startdate");
      var edate = document.getElementById("enddate");

      var errormsg = document.getElementById("errormsg");
      var f = new FormData();
      f.append("s", subject.value);

      f.append("t", title.value);
      f.append("g", grade.value);
      f.append("sd", sdate.value);
      f.append("ed", edate.value);
      f.append("f", fileid.files[0]);


      title.classList.remove("error-bac");
      grade.classList.remove("error-bac");
      subject.classList.remove("error-bac");
      fileid.classList.remove("error-bac");
      sdate.classList.remove("error-bac");
      edate.classList.remove("error-bac");
      errormsg.innerHTML = "";
      errormsg.classList.add("d-none");

      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        tost("Assingment added successfully");

                        title.value = "";
                        grade.value = "0";
                        subject.value = "0";
                        fileid.value = "";
                        sdate.value = "";
                        edate.value = "";
                        divdocviewer.innerHTML = "";

                  } else if (t == "emptyGrade") {
                        errormsg.innerHTML = "Please Select Grade";
                        grade.classList.add("error-bac");
                        errormsg.classList.remove("d-none");

                  } else if (t == "emptySubject") {
                        errormsg.innerHTML = "Please Select Subject";
                        subject.classList.add("error-bac");
                        errormsg.classList.remove("d-none");

                  } else if (t == "emptyTitle") {
                        errormsg.innerHTML = "Please Enter Title";
                        title.classList.add("error-bac");
                        errormsg.classList.remove("d-none");

                  } else if (t == "notPDF") {
                        errormsg.innerHTML = "File Type Must be PDF";
                        fileid.classList.add("error-bac");
                        errormsg.classList.remove("d-none");

                  } else if (t == "emptyFile") {
                        errormsg.innerHTML = "Please Choose Assignment PDF";
                        fileid.classList.add("error-bac");
                        errormsg.classList.remove("d-none");

                  } else if (t == "emptySdate") {
                        errormsg.innerHTML = "Please Select Assignment Start Date";
                        sdate.classList.add("error-bac");
                        errormsg.classList.remove("d-none");

                  } else if (t == "invalidStart") {
                        errormsg.innerHTML = "Start date should be today or a date after today";
                        startdate.classList.add("error-bac");
                        errormsg.classList.remove("d-none");

                  } else if (t == "emptyEdate") {
                        errormsg.innerHTML = "Please Select Assignment End Date";
                        edate.classList.add("error-bac");
                        errormsg.classList.remove("d-none");

                  } else if (t == "invalidEndDate") {
                        errormsg.innerHTML = "End date should be a date after the start date";
                        edate.classList.add("error-bac");
                        errormsg.classList.remove("d-none");

                  } else {
                        tostdanger("Oops! Somthing went wrong please try again later");

                  }
            }
      }
      r.open("POST", "../backend/add-assingment-pro.php", true);
      r.send(f);
}

// search assingment and show them 
function searchAssingment(page) {
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
      r.open("POST", "../backend/search-assingment.php", true);
      r.send(f);
}


// show comfirmation model 
function assingmentDeleteCom(id) {

      mod = new bootstrap.Modal(document.getElementById('delteMod'), 'static');

      var deletebtn = document.getElementById("deletebtn");
      deletebtn.setAttribute("onclick", "assingmentDelete(" + id + ");");
      mod.show();
}
// assingment deleteing proccess 
function assingmentDelete(id) {
      var f = new FormData();
      f.append("id", id);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        tost("Note deleted successfully");
                        mod.hide();
                        searchAssingment(1);
                  } else if (t == "can't") {
                        tostdanger("Sorry! this assignment can't delete");

                  } else {
                        tostdanger("Oops! Somthing went wrong please try again later");

                  }
            }
      }
      r.open("POST", "../backend/assingment-delete.php", true);
      r.send(f);
}
var mod;
// open model for  add marks, edit Date, update marks,
function showModTeacherk(id, opt) {



      mod = new bootstrap.Modal(document.getElementById('myModelID'), 'static');
      if (opt == "ad-marks") {
            document.getElementById("submitBtn").setAttribute("onclick", "submitMarks(" + id + ");");

      }
      if (opt == "up-marks") {
            document.getElementById("submitBtn").setAttribute("onclick", "updateMarks(" + id + ");");

      }
      if (opt == "ed-date") {
            document.getElementById("submitBtn").setAttribute("onclick", "editDate(" + id + ");");
      }
      mod.show();

}
// clear all error msg 
function errorclearMarksAdd() {
      document.getElementById("fileid").value = "";
      document.getElementById("error2").innerHTML = "";
      document.getElementById("divdocviewer").innerHTML = "";
      document.getElementById("marksid").value = "";
}
// add marks for assignments
function submitMarks(id) {


      var fileid = document.getElementById("fileid");
      var error2 = document.getElementById("error2");
      var error3 = document.getElementById("error3");
      var marksid = document.getElementById("marksid");
      marksid.classList.remove("error-bac");
      fileid.classList.remove("error-bac");

      error2.innerHTML = "";
      var f = new FormData();
      f.append("id", id);
      f.append("m", marksid.value);
      f.append("f", fileid.files[0]);


      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t);
                  if (t == "success") {
                        tost("Assingment uploaded successfully");
                        mod.hide();
                        searchAnswerSheet(1);
                        fileid.value = "";
                        divdocviewer.innerHTML = "";

                  } else if (t == "notPDF") {
                        error2.innerHTML = "File Type Must be PDF";
                        fileid.classList.add("error-bac");


                  } else if (t == "emptyFile") {
                        error2.innerHTML = "Please Choose Assignment PDF";
                        fileid.classList.add("error-bac");


                  } else if (t == "emptyMarks") {
                        error3.innerHTML = "Please Enter Marks";
                        marksid.classList.add("error-bac");


                  } else {
                        tostdanger("Oops! Somthing went wrong please try again later");

                  }
            }

      };
      r.open("POST", "../backend/upload-result-sheet.php", true);
      r.send(f);

}

// assingment pagination 
function searchAnswerSheet(page) {
      var tableBox = document.getElementById("tableBox");
      var seachbar = document.getElementById("seachbar");

      var f = new FormData();
      f.append("page", page);
      f.append("word", seachbar.value);


      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  tableBox.innerHTML = t;
            }

      };
      r.open("POST", "../backend/search-answer-sheet.php", true);
      r.send(f);
}

// update assignmnet marks 
function updateMarks(id) {


      var fileid = document.getElementById("fileid");
      var error2 = document.getElementById("error2");
      var error3 = document.getElementById("error3");
      var marksid = document.getElementById("marksid");
      marksid.classList.remove("error-bac");
      fileid.classList.remove("error-bac");

      error2.innerHTML = "";
      var f = new FormData();
      f.append("id", id);
      f.append("m", marksid.value);
      f.append("f", fileid.files[0]);


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
                        searchAssignmentMarks(1);
                  } else if (t == "notPDF") {
                        error2.innerHTML = "File Type Must be PDF";
                        fileid.classList.add("error-bac");


                  } else if (t == "emptyFile") {
                        error2.innerHTML = "Please Choose Assignment PDF";
                        fileid.classList.add("error-bac");


                  } else if (t == "emptyMarks") {
                        error3.innerHTML = "Please Enter Marks";
                        marksid.classList.add("error-bac");


                  } else {
                        tostdanger("Oops! Somthing went wrong please try again later");

                  }
            }

      };
      r.open("POST", "../backend/update-result-sheet.php", true);
      r.send(f);

}
// search assignment marks and show Them 
function searchAssignmentMarks(page) {
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
// set dates for model date edit 
function setvaleDate(end, start) {
      document.getElementById("enddate").value = end;
      document.getElementById("startdate").value = start;
}
// start date and end data change of assignment 
function editDate(id) {

      var error2 = document.getElementById("error2");

      var enddate = document.getElementById("enddate");
      var startdate = document.getElementById("startdate");

      enddate.classList.remove("error-bac");
      startdate.classList.remove("error-bac");

      error2.innerHTML = "";
      var f = new FormData();
      f.append("id", id);
      f.append("s", startdate.value);
      f.append("e", enddate.value);



      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t);
                  if (t == "success") {
                        tost("Assingment date updated successfully");
                        mod.hide();
                        startdate.value = "";
                        enddate.value = "";

                        searchAssingment(1);
                  } else if (t == "emptyEndDate") {
                        error2.innerHTML = "Plaese select assignment end date";
                        enddate.classList.add("error-bac");


                  } else if (t == "emptyStartDate") {
                        error2.innerHTML = "Plaese select assignment start date";
                        startdate.classList.add("error-bac");


                  } else if (t == "invalidEndDate") {
                        errormsg.innerHTML = "End date should be a date after the start date";
                        edate.classList.add("error-bac");
                        errormsg.classList.remove("d-none");

                  } else {
                        tostdanger("Oops! Somthing went wrong please try again later");

                  }
            }

      };
      r.open("POST", "../backend/edit-assignment-date.php", true);
      r.send(f);


}

// enable feild to make changes on profile 
function profileEdiTeacher() {
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
      document.getElementById("editbtn").setAttribute("onclick", "profileUpdateTeacher();");



}
// update profile details 
function profileUpdateTeacher() {
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
      document.getElementById("editbtn").setAttribute("onclick", "profileEdiTeacher();");
}
// clear all error msg 
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

// myclass pagination 
function searchMyclass(page) {
      var tableBox = document.getElementById("tableBox");
      var seachbar = document.getElementById("seachbar");

      var f = new FormData();
      f.append("page", page);
      f.append("word", seachbar.value);


      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  tableBox.innerHTML = t;
            }

      };
      r.open("POST", "../backend/search-my-class.php", true);
      r.send(f);
}

var mod2;
function emailModal() {
      mod2 = new bootstrap.Modal(document.getElementById("newemailMod"), 'static');
      mod2.show();
}
// request from admin  to change email 
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