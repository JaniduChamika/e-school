
var imageurl = "";
// image crop function 
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
// image crop function end
// register admin ,teacher,student,officer
function addUser(type) {
      clearerro(type);

      var fname = document.getElementById("fname");
      var lname = document.getElementById("lname");
      var nametag = document.getElementById("nametag");
      var usernametag = document.getElementById("usernametag");
      var emailtag = document.getElementById("emailtag");
      var phonetag = document.getElementById("phonetag");
      // optinal data tag
      var gardianName;
      var gardianContact;
      var classtag;
      var nictag;
      // optinal data tag

      if (type == "student") {
            gardianName = document.getElementById("gardian-name");
            gardianContact = document.getElementById("gardian-contact");
            classtag = document.getElementById("classtag");
      } else {
            nictag = document.getElementById("nictag");

      }
      var ganderradiomale = document.getElementById("ganderradiomale");
      var dobtag = document.getElementById("dobtag");
      var Religious = document.getElementById("Religious ");
      var addresstag = document.getElementById("addresstag");
      var provincetag = document.getElementById("provincetag");
      var districtag = document.getElementById("districtag");
      var citytag = document.getElementById("citytag");
      var imagetag = document.getElementById("viewImage3");

      var errormsg = document.getElementById("errormsg");

      //  form with user detail  
      var f = new FormData();
      f.append("fn", fname.value);
      f.append("ln", lname.value);
      f.append("fulln", nametag.value);
      f.append("uname", usernametag.value);
      f.append("emailt", emailtag.value);
      f.append("contact", phonetag.value);
      if (type == "student") {
            f.append("gname", gardianName.value);
            f.append("gcontact", gardianContact.value);
            f.append("stuclass", classtag.value);

      } else {
            f.append("nic", nictag.value);

      }
      f.append("gen", ganderradiomale.checked);
      f.append("dob", dobtag.value);
      f.append("religion", Religious.value);
      f.append("add", addresstag.value);
      // f.append("province", provincetag.value);
      // f.append("dis", districtag.value);
      f.append("city", citytag.value);
      f.append("image", imageurl);
      f.append("userType", type);
      if (type == "teacher") {
            var grade = document.getElementsByClassName("gradeTec");

            for (let index = 0; index < grade.length; index++) {
                  f.append("g" + index, grade[index].checked);
                  f.append("gid" + index, grade[index].value);


            }
            var sub = document.getElementsByClassName("subjectTec");
            for (let index = 0; index < sub.length; index++) {
                  f.append("sub" + index, sub[index].checked);
                  f.append("subid" + index, sub[index].value);


            }
            f.append("sublen", sub.length);
      }
      // send form using AJAX to user-ragistration.php file in the server
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

                        } else if (text == "emptyNic") {
                              nictag.classList.add("error-bac");
                              errormsg.innerHTML = "Please enter " + type + "'s national id number — check it out!";

                        } else if (text == "invalidNic") {
                              nictag.classList.add("error-bac");
                              errormsg.innerHTML = "Oops! " + type + "'s national id number is Invalid — check it out!";

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
                  document.getElementById("pendingbtn2").classList.remove("d-none");
            }
      };
      r.open("POST", "../backend/user-ragistration.php", true);
      r.send(f);

}
// clear error color in ui 
function clearerro(type) {
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

      // optinal

      if (type == "student") {
            document.getElementById("gardian-name").classList.remove("error-bac");
            document.getElementById("gardian-contact").classList.remove("error-bac");
            document.getElementById("classtag").classList.remove("error-bac");

      } else {
            document.getElementById("nictag").classList.remove("error-bac");

      }


}
//function for clear fields after ragistration user  
function clearFileds(type) {
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

      document.getElementById("viewImage3").style.backgroundImage = "url('../../image/profile/" + type + "-default.png')";

      imageurl = "";
      // optinal

      if (document.getElementById("nictag") != undefined) {
            document.getElementById("nictag").value = "";

      }
      if (type == "teacher") {
            var grade = document.getElementsByClassName("gradeTec");

            for (let index = 0; index < grade.length; index++) {
                  grade[index].checked = false;


            }
            var sub = document.getElementsByClassName("subjectTec");
            for (let index = 0; index < sub.length; index++) {
                  sub[index].checked = false;



            }
      } else if (type == "student") {
            document.getElementById("gardian-name").value = "";
            document.getElementById("gardian-contact").value = "";
            document.getElementById("classtag").value = "0";
            document.getElementById("gradetag").value = "0";

      }
}

// add grades to system 
function addGrade() {
      var g15 = document.getElementById("btncheck1");
      var g611 = document.getElementById("btncheck2");
      var g1213 = document.getElementById("btncheck3");

      var isSelect = false;
      // check at least is one grade or selected 
      if (g15.checked || g611.checked || g1213.checked) {
            isSelect = true;
      }
      if (isSelect) {
            var form = new FormData();

            form.append("g15", g15.checked);
            form.append("g611", g611.checked);
            form.append("g1213", g1213.checked);



            var r = new XMLHttpRequest();
            r.onreadystatechange = function () {
                  if (r.readyState == 4) {
                        var text = r.responseText;
                        // alert(text);
                        if (text == "success") {

                              g15.disabled = true;
                              g611.disabled = true;
                              g1213.disabled = true;
                              document.getElementById("gradeadd").remove();

                              if (!g1213.checked) {
                                    document.getElementById("albox").innerHTML = "";
                              }
                              setTimeout(function () { location.reload(); }, 3000);
                              tost("Grade added to the system successfully")
                        }
                  }
            };
            r.open("POST", "../backend/grade-add.php", true);
            r.send(form);
      } else {
            tostwarning("Please select grand ranges school have");
      }
}
// send selected mediums to medium-add.php file in server side 
function addMedium() {
      var sin = document.getElementById("sinhala");
      var eng = document.getElementById("Englsih");
      var tam = document.getElementById("Tamil");
      var isSelect = false;
      if (sin.checked || eng.checked || tam.checked) {
            isSelect = true;
      }
      if (isSelect) {
            var form = new FormData();

            form.append("s", sin.checked);
            form.append("e", eng.checked);
            form.append("t", tam.checked);

            var r = new XMLHttpRequest();
            r.onreadystatechange = function () {
                  if (r.readyState == 4) {
                        var text = r.responseText;
                        // alert(text);
                        if (text == "success") {

                              sin.disabled = true;
                              tam.disabled = true;
                              eng.disabled = true;
                              document.getElementById("addlang").remove();


                              tost("Mediums added to the system successfully");
                        }
                  }
            };
            r.open("POST", "../backend/medium-add.php", true);
            r.send(form);
      } else {
            tostwarning("Please select mediums school use to teach");
      }
}
// send selected stream to al-stream-add.php file in server side 
function addALstream() {

      var form = new FormData();

      form.append("p", document.getElementById("Physical-Science").checked);
      form.append("c", document.getElementById("Commerce").checked);
      form.append("a", document.getElementById("Arts").checked);
      form.append("b", document.getElementById("Bio-Science").checked);
      form.append("t", document.getElementById("Technology").checked);

      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var text = r.responseText;
                  // alert(text);
                  if (text == "success") {

                        document.getElementById("Physical-Science").disabled = true;
                        document.getElementById("Commerce").disabled = true;
                        document.getElementById("Arts").disabled = true;
                        document.getElementById("Technology").disabled = true;
                        document.getElementById("Bio-Science").disabled = true;
                        document.getElementById("addalstram").remove();


                        tost("A/L Stream added to the system successfully");
                  }
            }
      };
      r.open("POST", "../backend/al-stream-add.php", true);
      r.send(form);

}
// show catergory selector for each selected grade 
function checkSelectGrade() {
      var grad15 = document.getElementById("grad15");
      var grad69 = document.getElementById("grad69");
      var grad1011 = document.getElementById("grad1011");
      if (grad15.checked) {
            document.getElementById("grade15").classList.remove("d-none");
      } else {
            document.getElementById("grade15").classList.add("d-none");

      }
      if (grad69.checked) {
            document.getElementById("grade69").classList.remove("d-none");
      } else {
            document.getElementById("grade69").classList.add("d-none");

      }
      if (grad1011.checked) {
            document.getElementById("grade1011").classList.remove("d-none");
      } else {
            document.getElementById("grade1011").classList.add("d-none");

      }
}
// start add subject to system
// grade 1-11 subject data sending function 
function addSubject111() {
      var grad15 = document.getElementById("grad15");
      var grad69 = document.getElementById("grad69");
      var grad1011 = document.getElementById("grad1011");
      var cate15;
      var cate69;
      var cate1011;
      var sub = document.getElementById("subjectName");

      var error = document.getElementById("error");
      error.innerHTML = "";

      var f = new FormData();

      if (grad15.checked) {
            cate15 = document.getElementById("sub-category15");
            cate15.classList.remove("error-bac");

            f.append("c15", cate15.value);

      }
      if (grad69.checked) {
            cate69 = document.getElementById("sub-category69");
            f.append("c69", cate69.value);
            cate69.classList.remove("error-bac");

      }
      if (grad1011.checked) {
            cate1011 = document.getElementById("sub-category1011");
            f.append("c1011", cate1011.value);
            cate1011.classList.remove("error-bac");

      }
      f.append("c15state", grad15.checked);
      f.append("c69state", grad69.checked);
      f.append("c1011state", grad1011.checked);

      f.append("s", sub.value);
      f.append("ty", "111");
      sub.classList.remove("error-bac");


      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        sub.value = "";
                        if (grad15.checked) {
                              cate15.value = "0";
                        }
                        if (grad69.checked) {
                              cate69.value = "0";
                        }
                        if (grad1011.checked) {
                              cate1011.value = "0";
                        }
                        grad15.checked = false;
                        grad69.checked = false;
                        grad1011.checked = false;
                        document.getElementById("grade15").classList.add("d-none");
                        document.getElementById("grade69").classList.add("d-none");
                        document.getElementById("grade1011").classList.add("d-none");

                        tost("Subject added successfully");
                  } else if (t == "emptySubname") {
                        sub.classList.add("error-bac");
                  } else if (t == "selectGrandRange") {
                        error.innerHTML = "Please Select Grade Range";

                  } else if (t == "selectC15") {
                        cate15.classList.add("error-bac");

                  } else if (t == "selectC69") {
                        cate69.classList.add("error-bac");

                  } else if (t == "selectC1011") {
                        cate1011.classList.add("error-bac");

                  } else if (t == "alreadyExist") {
                        tostwarning("Subject already exist");
                  } else {
                        tostdanger("Oops! Somthing went wrong please try again later");

                  }
            }
      };
      r.open("POST", "../backend/subject-add.php", true);
      r.send(f);

}
// grade 12-13 subject data sending function 

function addSubject1213() {
      var stream = document.getElementById("al-stream");
      var sub = document.getElementById("subjectName1213");
      var f = new FormData();
      f.append("str", stream.value);
      f.append("s", sub.value);
      f.append("ty", "1213");
      sub.classList.remove("error-bac");
      stream.classList.remove("error-bac");

      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        sub.value = "";
                        stream.value = "0";
                        tost("Subject added successfully");

                  } else if (t == "emptySubname") {
                        sub.classList.add("error-bac");
                  } else if (t == "nostream") {
                        stream.classList.add("error-bac");

                  } else if (t == "alreadyExist") {
                        tostwarning("Subject already exist");
                  } else {
                        tostdanger("Oops! Somthing went wrong please try again later");

                  }
            }
      };
      r.open("POST", "../backend/subject-add.php", true);
      r.send(f);
}
// end add subject to system
// start get relevent subject for selected grades 
function getRelevantSub() {
      var subviewr = document.getElementById("subject-viewer");
      var grade = document.getElementsByClassName("gradeTec");
      var g15 = false;
      var g69 = false;
      var g1011 = false;
      var g1213 = false;
      for (let index = 0; index < grade.length; index++) {
            if (grade[index].checked) {
                  if (grade[index].name <= 5) {
                        g15 = true;
                  }
                  if (grade[index].name >= 12) {
                        g1213 = true;
                  }
                  if (grade[index].name <= 11 && grade[index].name >= 10) {
                        g1011 = true;
                  }
                  if (grade[index].name <= 9 && grade[index].name >= 6) {
                        g69 = true;
                  }
            }
      }
      var f = new FormData();
      f.append("g15", g15);
      f.append("g69", g69);
      f.append("g1011", g1011);
      f.append("g1213", g1213);

      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  subviewr.innerHTML = t;
            }

      };
      r.open("POST", "../backend/get-grade-relavent-subject.php", true);
      r.send(f);

}
// end get relevent subject for selected grades

function getGradeTeacher() {
      var teacer = document.getElementById("Assigntecher");
      var grade = document.getElementById("grade");

      var f = new FormData();
      f.append("g", grade.value);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  teacer.innerHTML = t;
                  // alert(t)
            }
      }
      r.open("POST", "../backend/get-grede-relavent-teacher.php", true);
      r.send(f);
}
function getGradeTeacherAL() {
      var teacer = document.getElementById("Assigntecheral");
      var grade = document.getElementById("gradeal");

      var f = new FormData();
      f.append("g", grade.value);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  teacer.innerHTML = t;
                  // alert(t)
            }
      }
      r.open("POST", "../backend/get-grede-relavent-teacher.php", true);
      r.send(f);
}
// send class details to class-add.php file in server side 
function addClass() {
      addclassErrorClear()
      var teacer = document.getElementById("Assigntecher");
      var grade = document.getElementById("grade");
      var mediumid = document.getElementById("mediumid");
      var classname = document.getElementById("classname");
      var f = new FormData();
      f.append("t", teacer.value);
      f.append("g", grade.value);
      f.append("m", mediumid.value);
      f.append("c", classname.value);
      f.append("ty", "111");
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  if (t == "success") {
                        teacer.value = "0";
                        grade.value = "0";
                        mediumid.value = "0";
                        classname.value = "";
                        tost("Class added successfully");

                  } else if (t == "emptyTeacher") {
                        teacer.classList.add("error-bac");


                  } else if (t == "emptygrade") {
                        grade.classList.add("error-bac");


                  } else if (t == "emptymeduim") {
                        mediumid.classList.add("error-bac");

                  } else if (t == "emptyCname") {
                        classname.classList.add("error-bac");


                  } else if (t == "alreadyHave") {
                        tostwarning("This class name already exist");

                  } else {
                        // alert(t)
                        tostdanger("Oops! Somthing went wrong please try again later");
                  }
            }
      };
      r.open("POST", "../backend/class-add.php", true);
      r.send(f);
}
// clear all erros showing after add class successfully 
function addclassErrorClear() {
      document.getElementById("Assigntecher").classList.remove("error-bac");
      document.getElementById("grade").classList.remove("error-bac");
      document.getElementById("mediumid").classList.remove("error-bac");
      document.getElementById("classname").classList.remove("error-bac");
}

// send a/l class details to class-add.php in server side 
function addClassAL() {
      addclassErrorClearAL()
      var teacer = document.getElementById("Assigntecheral");
      var grade = document.getElementById("gradeal");
      var mediumid = document.getElementById("mediumidal");
      var classname = document.getElementById("classnameal");
      var alstream = document.getElementById("alstream");
      var f = new FormData();
      f.append("t", teacer.value);
      f.append("g", grade.value);
      f.append("m", mediumid.value);
      f.append("c", classname.value);
      f.append("str", alstream.value);
      f.append("ty", "1213");
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  if (t == "success") {
                        teacer.value = "0";
                        grade.value = "0";
                        mediumid.value = "0";
                        classname.value = "";
                        alstream.value = "0";
                        tost("Class added successfully");

                  } else if (t == "emptyTeacher") {
                        teacer.classList.add("error-bac");


                  } else if (t == "emptygrade") {
                        grade.classList.add("error-bac");


                  } else if (t == "emptymeduim") {
                        mediumid.classList.add("error-bac");

                  } else if (t == "emptyCname") {
                        classname.classList.add("error-bac");


                  } else if (t == "emptyStream") {
                        alstream.classList.add("error-bac");


                  } else if (t == "alreadyHave") {
                        tostwarning("This class name already exist");

                  } else {
                        tostdanger("Oops! Somthing went wrong please try again later");
                  }
            }
      };
      r.open("POST", "../backend/class-add.php", true);
      r.send(f);
}
// clear all erros  showing in al class add part after add class successfully 

function addclassErrorClearAL() {
      document.getElementById("Assigntecheral").classList.remove("error-bac");
      document.getElementById("gradeal").classList.remove("error-bac");
      document.getElementById("mediumidal").classList.remove("error-bac");
      document.getElementById("classnameal").classList.remove("error-bac");
      document.getElementById("alstream").classList.remove("error-bac");
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
// start get relevent subject for selected grades for edit page for teacher
function getRelevantSubEdit(id) {
      var subviewr = document.getElementById("subject-viewer");
      var grade = document.getElementsByClassName("gradeTec");
      var g15 = false;
      var g69 = false;
      var g1011 = false;
      var g1213 = false;
      for (let index = 0; index < grade.length; index++) {
            if (grade[index].checked) {
                  if (grade[index].name <= 5) {
                        g15 = true;
                  }
                  if (grade[index].name >= 12) {
                        g1213 = true;
                  }
                  if (grade[index].name <= 11 && grade[index].name >= 10) {
                        g1011 = true;
                  }
                  if (grade[index].name <= 9 && grade[index].name >= 6) {
                        g69 = true;
                  }
            }
      }
      var f = new FormData();
      f.append("g15", g15);
      f.append("g69", g69);
      f.append("g1011", g1011);
      f.append("g1213", g1213);
      f.append("uid", id);

      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  subviewr.innerHTML = t;
            }

      };
      r.open("POST", "../backend/grade-relavent-subject.php", true);
      r.send(f);

}
// end get relevent subject for selected grades for edit page

// update users details admin,teacher,students,officers
function updateUser(type, uid) {
      clearerro(type);

      var fname = document.getElementById("fname");
      var lname = document.getElementById("lname");
      var nametag = document.getElementById("nametag");
      var usernametag = document.getElementById("usernametag");
      var emailtag = document.getElementById("emailtag");
      var phonetag = document.getElementById("phonetag");
      // optinal data tag
      var gardianName;
      var gardianContact;
      var classtag;
      var nictag;
      // optinal data tag

      if (type == "student") {
            gardianName = document.getElementById("gardian-name");
            gardianContact = document.getElementById("gardian-contact");
            classtag = document.getElementById("classtag");
      } else {
            nictag = document.getElementById("nictag");

      }
      var ganderradiomale = document.getElementById("ganderradiomale");
      var dobtag = document.getElementById("dobtag");
      var Religious = document.getElementById("Religious ");
      var addresstag = document.getElementById("addresstag");
      var provincetag = document.getElementById("provincetag");
      var districtag = document.getElementById("districtag");
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
      if (type == "student") {
            f.append("gname", gardianName.value);
            f.append("gcontact", gardianContact.value);
            f.append("stuclass", classtag.value);

      } else {
            f.append("nic", nictag.value);

      }
      f.append("gen", ganderradiomale.checked);
      f.append("dob", dobtag.value);
      f.append("religion", Religious.value);
      f.append("add", addresstag.value);
      // f.append("province", provincetag.value);
      // f.append("dis", districtag.value);
      f.append("city", citytag.value);
      f.append("image", imageurl);
      f.append("userType", type);
      if (type == "teacher") {
            var grade = document.getElementsByClassName("gradeTec");

            for (let index = 0; index < grade.length; index++) {
                  f.append("g" + index, grade[index].checked);
                  f.append("gid" + index, grade[index].value);


            }
            var sub = document.getElementsByClassName("subjectTec");
            for (let index = 0; index < sub.length; index++) {
                  f.append("sub" + index, sub[index].checked);
                  f.append("subid" + index, sub[index].value);


            }
            f.append("sublen", sub.length);
      }

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

                        } else if (text == "emptyNic") {
                              nictag.classList.add("error-bac");
                              errormsg.innerHTML = "Please enter " + type + "'s national id number — check it out!";

                        } else if (text == "invalidNic") {
                              nictag.classList.add("error-bac");
                              errormsg.innerHTML = "Oops! " + type + "'s national id number is Invalid — check it out!";

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

                        } else {
                              errormsg.innerHTML = text;
                        }
                  }

            }
      };
      r.open("POST", "../backend/user-edit.php", true);
      r.send(f);
}

// pagination get student table and veiw 

function searchStudent(page) {
      var grade = document.getElementById("filterGrade");
      var pendingbtn = document.getElementById("pendingbtn");
      var tableBox = document.getElementById("tableBox");
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
// serach teachers from database and view on page 
function searchTeacher(page) {
      var grade = document.getElementById("filterGrade");
      var sub = document.getElementById("filterSub");
      var pen = document.getElementById("pendingbtn");
      var tableBox = document.getElementById("tableBox");
      var seachbar = document.getElementById("seachbar");

      var f = new FormData();
      f.append("page", page);
      f.append("g", grade.value);
      f.append("s", sub.value);
      f.append("pen", pen.checked);
      f.append("word", seachbar.value);

      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  tableBox.innerHTML = t;
            }

      };
      r.open("POST", "../backend/search-teacher.php", true);
      r.send(f);
}
// serach officer from database and view on page 
function searchOfficer(page) {
      var tableBox = document.getElementById("tableBox");
      var seachbar = document.getElementById("seachbar");
      var pen = document.getElementById("pendingbtn");

      var f = new FormData();
      f.append("page", page);
      f.append("pen", pen.checked);
      f.append("word", seachbar.value);

      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  tableBox.innerHTML = t;
            }

      };
      r.open("POST", "../backend/search-officer.php", true);
      r.send(f);
}
// serach admins from database and view on page 
function searchAdmin(page) {
      var tableBox = document.getElementById("tableBox");
      var seachbar = document.getElementById("seachbar");
      var pen = document.getElementById("pendingbtn");
      var f = new FormData();
      f.append("page", page);
      f.append("word", seachbar.value);
      f.append("pen", pen.checked);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  tableBox.innerHTML = t;
            }

      };
      r.open("POST", "../backend/search-admin.php", true);
      r.send(f);
}
// serach subjects from database and view on page 
function searchSubject(page) {
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
      r.open("POST", "../backend/search-subject.php", true);
      r.send(f);
}
// serach a/l subjects from database and view on page 
function searchSubjectal(page) {
      var tableBox = document.getElementById("tableBox");
      var stream = document.getElementById("al-stream");
      var seachbar = document.getElementById("seachbar");

      var f = new FormData();
      f.append("page", page);
      f.append("s", stream.value);
      f.append("word", seachbar.value);


      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  tableBox.innerHTML = t;

            }

      };
      r.open("POST", "../backend/search-subject-al.php", true);
      r.send(f);
}

// open models delete subject
var mod3;
function showDelModel(id) {

      mod3 = new bootstrap.Modal(document.getElementById('subDelModal'), 'static');

      document.getElementById("delbtn").setAttribute("onclick", "deleteSubject(" + id + ");");


      mod3.show();


}
// delete subject from database 
function deleteSubject(id) {
      var f = new FormData();
      f.append("id", id);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  mod3.hide();
                  if (t == "success") {
                        searchSubject(1);
                        tost("Subject deleted successfully");
                  } else if (t == "successal") {
                        searchSubjectal(1);
                        tost("Subject deleted successfully");
                  } else {
                        tostdanger("Opps! Somthing went wrong. Try agin later");
                  }


            }

      };
      r.open("POST", "../backend/delete-subject.php", true);
      r.send(f);
}
// serach grand 1-5 class from database and view on page 
function searchClass15(page) {
      var tableBox = document.getElementById("tableBox");
      var selectgrade = document.getElementById("selectgrade");
      var seachbar = document.getElementById("seachbar");

      var f = new FormData();
      f.append("page", page);
      f.append("g", selectgrade.value);
      f.append("word", seachbar.value);

      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  tableBox.innerHTML = t;

            }

      };
      r.open("POST", "../backend/search-class15.php", true);
      r.send(f);
}
// serach grand 6-11 class from database and view on page 

function searchClass611(page) {
      var tableBox = document.getElementById("tableBox");
      var selectgrade = document.getElementById("selectgrade");
      var seachbar = document.getElementById("seachbar");

      var f = new FormData();
      f.append("page", page);
      f.append("g", selectgrade.value);
      f.append("word", seachbar.value);


      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  tableBox.innerHTML = t;

            }

      };
      r.open("POST", "../backend/search-class611.php", true);
      r.send(f);
}
// serach a/l class from database and view on page 

function searchClass1213(page) {
      var tableBox = document.getElementById("tableBox");
      var selectgrade = document.getElementById("selectgrade");
      var selectAlstream = document.getElementById("selectAlstream");
      var seachbar = document.getElementById("seachbar");

      var f = new FormData();
      f.append("page", page);
      f.append("g", selectgrade.value);
      f.append("as", selectAlstream.value);
      f.append("word", seachbar.value);


      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  tableBox.innerHTML = t;

            }

      };
      r.open("POST", "../backend/search-class1213.php", true);
      r.send(f);
}

// serach note from database and view on page 

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


// serach assignmnets from database and view on page 

function searchAssignment(page) {
      var tableBox = document.getElementById("tableBox");
      var selectgrade = document.getElementById("selectgrade");
      var selectAL = document.getElementById("selectsub");
      var activetag = document.getElementById("activetag");
      var seachbar = document.getElementById("seachbar");

      var f = new FormData();
      f.append("page", page);
      f.append("g", selectgrade.value);
      f.append("s", selectAL.value);
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
// serach assignment marks from database and view on page 

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

// open models chenge teacherLogin,rename subject
var mod;
function showModel(id, opt, g) {
      // document.getElementById("myModelID");
      mod = new bootstrap.Modal(document.getElementById('myModelID'), 'static');



      if (opt == "ch-teacher") {
            document.getElementById("submitBtn").setAttribute("onclick", "changeTeacher(" + id + "," + g + ");");

      }
      if (opt == "ed-subject") {
            document.getElementById("submitBtn").setAttribute("onclick", "editSubject(" + id + ");");
            var subname = g;
            document.getElementById("editsubname").value = subname;
      }
      mod.show();


}

// reassing teacher for claas 
function changeTeacher(id, g) {
      var Assigntecher = document.getElementById("Assigntecher");
      var f = new FormData();
      f.append("t", Assigntecher.value);
      f.append("clz", id);

      Assigntecher.classList.remove("error-bac");

      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        mod.hide();
                        Assigntecher.value = "0";
                        if (g == "1" || g == "2" || g == "3" || g == "4" || g == "5") {
                              searchClass15(1)

                        }
                        if (g == "6" || g == "7" || g == "8" || g == "9" || g == "10" || g == "11") {
                              searchClass611(1)

                        }
                        if (g == "12" || g == "13") {
                              searchClass1213(1)

                        }
                  } else if (t == "emptyTeacher") {
                        Assigntecher.classList.add("error-bac");
                  } else {
                        tostdanger("Oops! Somthing went wrong please try again later");
                  }
            }

      };
      r.open("POST", "../backend/change-teacher.php", true);
      r.send(f);



}
// change modal title 
function changeModelTitle(title) {
      document.getElementById("backDropModalTitle").innerHTML = title;
}
// open class rename modal 
function renameModal(id, name, g) {
      mod = new bootstrap.Modal(document.getElementById('renameModelID'), 'static');
      document.getElementById("renameBtn").setAttribute("onclick", "renameClass(" + id + "," + g + ");");

      document.getElementById("renameclass").value = name;
      document.getElementById("renametitle").innerHTML = "Rename " + name + " Class";
      mod.show();

}
// send class name to server 
function renameClass(id, g) {
      var name = document.getElementById("renameclass");
      name.classList.remove("error-bac");

      var f = new FormData();
      f.append("id", id);
      f.append("n", name.value);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        mod.hide();
                        // refresh the table after renamed 
                        if (g == "1" || g == "2" || g == "3" || g == "4" || g == "5") {
                              searchClass15(1)

                        }
                        if (g == "6" || g == "7" || g == "8" || g == "9" || g == "10" || g == "11") {
                              searchClass611(1)

                        }
                        if (g == "12" || g == "13") {
                              searchClass1213(1)

                        }
                  } else if (t == "empty") {
                        name.classList.add("error-bac");
                  } else if (t == "alreadyHave") {
                        tostwarning("This class name alrady exist");
                  } else {
                        tostdanger("Somthing Wrong.Please try again later");
                  }
            }

      };
      r.open("POST", "../backend/rename-class.php", true);
      r.send(f);
}
// open class delete comfimation modal 
function comfirmClzDelete(id, g) {
      mod = new bootstrap.Modal(document.getElementById('delteMod'), 'static');
      document.getElementById("deletebtn").setAttribute("onclick", "deleteClass(" + id + "," + g + ");");

      mod.show();

}
// delete class from database 
function deleteClass(id, g) {
      var f = new FormData();
      f.append("id", id);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  mod.hide();

                  if (t == "success") {

                        if (g == "1" || g == "2" || g == "3" || g == "4" || g == "5") {
                              searchClass15(1)

                        }
                        if (g == "6" || g == "7" || g == "8" || g == "9" || g == "10" || g == "11") {
                              searchClass611(1)

                        }
                        if (g == "12" || g == "13") {
                              searchClass1213(1)

                        }
                  } else if (t == "can'tDelete") {

                        tostwarning("Sorry, You cannot delete this class.");
                  } else {
                        tostdanger("Somthing Wrong.Please try again later");
                  }
            }

      };
      r.open("POST", "../backend/delete-class.php", true);
      r.send(f);
}
// edit subject name 
function editSubject(id) {

      var editsubname = document.getElementById("editsubname");
      var f = new FormData();
      f.append("id", id);
      f.append("sub", editsubname.value);
      editsubname.classList.remove("error-bac");

      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        mod.hide();
                        searchSubject(1);
                  } else if (t == "emptySub") {
                        editsubname.classList.add("error-bac");
                  } else {
                        tostdanger("Oops! Somthing went wrong please try again later");

                  }
            }

      };
      r.open("POST", "../backend/rename-subject.php", true);
      r.send(f);

}
// enable inputfiled in admin profile page 
function profileEdiAdmin() {
      document.getElementById("selectImage3").disabled = false;

      document.getElementById("fname").disabled = false;
      document.getElementById("lname").disabled = false;

      document.getElementById("nametag").disabled = false;
      document.getElementById("emailtag").disabled = false;
      document.getElementById("phonetag").disabled = false;
      document.getElementById("ganderradiomale").disabled = false;
      document.getElementById("dobtag").disabled = false;
      document.getElementById("Religious ").disabled = false;
      document.getElementById("addresstag").disabled = false;
      document.getElementById("provincetag").disabled = false;
      document.getElementById("districtag").disabled = false;
      document.getElementById("citytag").disabled = false;
      document.getElementById("nictag").disabled = false;
      document.getElementById("postalcodetag").disabled = false;
      document.getElementById("editbtn").innerHTML = "Save";
      document.getElementById("editbtn").setAttribute("onclick", "profileUpdateAdmin();");



}

function restPofile() {
      document.getElementById("selectImage3").disabled = true;
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
      document.getElementById("nictag").disabled = true;

      document.getElementById("postalcodetag").disabled = true;
      document.getElementById("editbtn").innerHTML = "Edit";
      document.getElementById("editbtn").setAttribute("onclick", "profileEdiAdmin();");
}

// update admin's profile 
function profileUpdateAdmin() {
      var fname = document.getElementById("fname");
      var lname = document.getElementById("lname");
      var nametag = document.getElementById("nametag");

      var emailtag = document.getElementById("emailtag");
      var phonetag = document.getElementById("phonetag");


      var nictag = document.getElementById("nictag");
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

      f.append("emailt", emailtag.value);
      f.append("contact", phonetag.value);

      f.append("gen", ganderradiomale.checked);
      f.append("dob", dobtag.value);
      f.append("religion", Religious.value);
      f.append("add", addresstag.value);
      f.append("nic", nictag.value);

      f.append("city", citytag.value);
      f.append("image", imageurl);


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

                        } else if (text == "emptyEmail") {
                              emailtag.classList.add("error-bac");
                              errormsg.innerHTML = "Please enter your email address — check it out!";

                        } else if (text == "invalidEmail") {
                              emailtag.classList.add("error-bac");
                              errormsg.innerHTML = "Oops! your email address is not valid — check it out!";

                        } else if (text == "emptyContact") {
                              phonetag.classList.add("error-bac");
                              errormsg.innerHTML = "Please enter your contact number — check it out!";

                        } else if (text == "invalidContact") {
                              phonetag.classList.add("error-bac");
                              errormsg.innerHTML = "Oops! your contact number is not valid — check it out!";

                        } else if (text == "emptyNic") {
                              nictag.classList.add("error-bac");
                              errormsg.innerHTML = "Please enter your national id number — check it out!";

                        } else if (text == "invalidNic") {
                              nictag.classList.add("error-bac");
                              errormsg.innerHTML = "Oops! your national id number is Invalid — check it out!";

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

                        } else if (text == "Please Select An SVG,JPEG,JPG or PNG Image") {
                              errormsg.innerHTML = text;
                        } else {
                              errormsg.innerHTML = "Somthing Wrong Please Try Again Later";
                        }
                  }

            }
      };
      r.open("POST", "../backend/update-profile.php", true);
      r.send(f);
}
// clear profile errors 
function ProfileErrorClear() {
      document.getElementById("errormsg").classList.add("d-none");

      document.getElementById("fname").classList.remove("error-bac");
      document.getElementById("lname").classList.remove("error-bac");
      document.getElementById("nametag").classList.remove("error-bac");

      document.getElementById("emailtag").classList.remove("error-bac");
      document.getElementById("phonetag").classList.remove("error-bac");
      document.getElementById("ganderradiomale").classList.remove("error-bac");
      document.getElementById("dobtag").classList.remove("error-bac");
      document.getElementById("Religious ").classList.remove("error-bac");
      document.getElementById("addresstag").classList.remove("error-bac");
      document.getElementById("provincetag").classList.remove("error-bac");
      document.getElementById("districtag").classList.remove("error-bac");
      document.getElementById("citytag").classList.remove("error-bac");


      document.getElementById("nictag").classList.remove("error-bac");


}
// chage add enrolment fee preview to edit enrollment fee preview 
function vieweditFee(id, fee) {

      var feebtn = document.getElementById("feeadd-btn");
      document.getElementById("enfeeid").value = fee;
      document.getElementById("feeheder").innerHTML = "Update Enrollment Fee";
      document.getElementById("grade").value = id;
      document.getElementById("grade").disabled = true;
      feebtn.setAttribute("onclick", "updateFee()");
      feebtn.innerHTML = "Update";
      document.getElementById("clearbtn").classList.remove("d-none");
}
// add enrollment fee 
function addFee() {
      var grade = document.getElementById("grade");
      var enfeeid = document.getElementById("enfeeid");
      var f = new FormData();
      f.append("g", grade.value);
      f.append("fee", enfeeid.value);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        grade.value = "0";
                        enfeeid.value = "";

                        tost("Fee Saved Successfully");
                        getFeeTable();
                  } else if (t == "alradyHave") {
                        tostwarning("Alrady exist");
                  }
            }
      };
      r.open("POST", "../backend/add-enrollment-fee.php", true);

      r.send(f);
}
// seach enrolment fees from database
function getFeeTable() {

      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  document.getElementById("tablbox").innerHTML = t;
            }
      };
      r.open("POST", "../backend/get-enrollment-fee.php", true);
      r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      r.send();
}
// send  new enrolment fee to server
function updateFee() {
      var grade = document.getElementById("grade");
      var enfeeid = document.getElementById("enfeeid");
      var f = new FormData();
      f.append("g", grade.value);
      f.append("fee", enfeeid.value);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        tost("Fee Update Successfully");
                        getFeeTable();
                        clearfee()
                  } else if (t == "alradyHave") {
                        tostdanger("Somthing Wrong! try again later");
                  }
            }
      };
      r.open("POST", "../backend/update-enrollment-fee.php", true);

      r.send(f);
}
// change back to add fee preview after update fee 
function clearfee() {
      var heder = document.getElementById("feeheder");
      var grade = document.getElementById("grade");
      var feebtn = document.getElementById("feeadd-btn");
      heder.innerHTML = "Add Enrollment Fee";
      grade.value = "0";
      grade.disabled = false;

      document.getElementById("enfeeid").value = "";

      feebtn.setAttribute("onclick", "addFee();");
      feebtn.innerHTML = "Save";
      document.getElementById("clearbtn").classList.add("d-none");

}



// pagination get student enroolment fee table and veiw 

function searchStudentEnrolment(page) {
      var tableBox = document.getElementById("tableBox");
      var selectgrade = document.getElementById("selectgrade");
      var seachbar = document.getElementById("seachbar");

      var f = new FormData();
      f.append("page", page);
      f.append("g", selectgrade.value);
      f.append("word", seachbar.value);

      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  tableBox.innerHTML = t;
            }

      };
      r.open("POST", "../backend/search-student-enrolment.php", true);
      r.send(f);
}



var mod2;
function showAddAnnounce() {

      mod2 = new bootstrap.Modal(document.getElementById("anncounceMod"), 'static');
      mod2.show();
}
// send announcement to severside to insert db 
function submitAnno() {
      var crowds = document.getElementById("crowds");
      var annonce = document.getElementById("annonce");
      annonce.classList.remove("error-bac");
      crowds.classList.remove("error-bac");

      var f = new FormData();
      f.append("c", crowds.value);
      f.append("a", annonce.value);


      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        mod2.hide();
                        searchAnnonce();
                  } else if (t == "emptyContent") {
                        annonce.classList.add("error-bac");
                  } else if (t == "selectCrowd") {
                        crowds.classList.add("error-bac");

                  }

            }

      };
      r.open("POST", "../backend/add-announcement.php", true);
      r.send(f);
}
// get annoucment from db 
function searchAnnonce() {
      var anonceBox = document.getElementById("anonceBox");
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)

                  anonceBox.innerHTML = t;


            }

      };
      r.open("POST", "../backend/search-announcement.php", true);
      r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      r.send();
}
// delete annoncement  
function deleteAnnoce(id) {
      var f = new FormData();
      f.append("id", id);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        searchAnnonce();
                  }

            }

      };
      r.open("POST", "../backend/delete-announcement.php", true);
      r.send(f);
}
var mod4;
function openBlockCom(id, page, ut) {
      mod4 = new bootstrap.Modal(document.getElementById('blockMod'), 'static');
      if (ut == "t") {
            document.getElementById("blockbtn").setAttribute("onclick", "blockT(" + id + "," + page + ");");

      } else if (ut == "o") {
            document.getElementById("blockbtn").setAttribute("onclick", "blockO(" + id + "," + page + ");");

      } else if (ut == "a") {
            document.getElementById("blockbtn").setAttribute("onclick", "blockA(" + id + "," + page + ");");

      } else if (ut == "s") {
            document.getElementById("blockbtn").setAttribute("onclick", "blockS(" + id + "," + page + ");");

      }


      mod4.show();
}
// block teacher 
function blockT(id, page) {
      var f = new FormData();

      f.append("id", id);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {

                        searchTeacher(page);
                        mod4.hide();
                  }

            }

      };
      r.open("POST", "../backend/block-user.php", true);
      r.send(f);
}
// unblock teacher 
function unblockT(id, page) {

      var f = new FormData();
      f.append("id", id);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  document.getElementById("lock").disabled = false;

                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        searchTeacher(page);


                  }

            } else {
                  document.getElementById("lock").disabled = true;
            }

      };
      r.open("POST", "../backend/unblock-user.php", true);
      r.send(f);
}
// block acafemic officer 

function blockO(id, page) {
      var f = new FormData();

      f.append("id", id);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        searchOfficer(page);
                        mod4.hide();
                  }

            }

      };
      r.open("POST", "../backend/block-user.php", true);
      r.send(f);
}
// unblock academic officer 
function unblockO(id, page) {

      var f = new FormData();
      f.append("id", id);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  document.getElementById("lock").disabled = false;

                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        searchOfficer(page);
                  }

            } else {
                  document.getElementById("lock").disabled = true;
            }

      };
      r.open("POST", "../backend/unblock-user.php", true);
      r.send(f);
}

// block student 
function blockS(id, page) {
      var f = new FormData();

      f.append("id", id);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        searchStudent(page);
                        mod4.hide();
                  }

            }

      };
      r.open("POST", "../backend/block-user.php", true);
      r.send(f);
}
// unblock student 
function unblockS(id, page) {

      var f = new FormData();
      f.append("id", id);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  document.getElementById("lock").disabled = false;

                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        searchStudent(page);
                  }

            } else {
                  document.getElementById("lock").disabled = true;
            }

      };
      r.open("POST", "../backend/unblock-user.php", true);
      r.send(f);
}
// block admin 
function blockA(id, page) {
      var f = new FormData();

      f.append("id", id);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        searchAdmin(page);
                        mod4.hide();
                  }

            }

      };
      r.open("POST", "../backend/block-user.php", true);
      r.send(f);
}
// unblock admin 

function unblockA(id, page) {

      var f = new FormData();
      f.append("id", id);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  document.getElementById("lock").disabled = false;

                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        searchAdmin(page);
                  }

            } else {
                  document.getElementById("lock").disabled = true;
            }

      };
      r.open("POST", "../backend/unblock-user.php", true);
      r.send(f);
}
function refreshEnrollment() {
      location.reload();
}


// add event to database 
function addEvent() {
      var evdate = document.getElementById("evdate");
      var evtime = document.getElementById("evtime");
      var info = document.getElementById("infotag");
      info.classList.remove("error-bac");
      evtime.classList.remove("error-bac");
      evdate.classList.remove("error-bac");

      var f = new FormData();
      f.append("date", evdate.value);
      f.append("time", evtime.value);
      f.append("info", info.value);

      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t);
                  if (t == "success") {
                        location.reload();
                  } else if (t == "emtytopic") {
                        info.classList.add("error-bac");

                  } else if (t == "emtytime") {
                        evtime.classList.add("error-bac");

                  } else if (t == "emptyDate") {
                        evdate.classList.add("error-bac");


                  }
            }
      };
      r.open("POST", "../backend/add-event.php", true);
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