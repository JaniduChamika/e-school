// start trial periad 
function startTiral() {
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "alradyUse") {
                        openModel();
                  } else if (t == "triaStart") {
                        window.location = "../student/gui/dashboard.php";
                  }

            }
      };
      r.open("POST", "../misc/trial-start.php", true);
      r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      r.send();
}
var mod;
function openModel() {

      mod = new bootstrap.Modal(document.getElementById('delteMod'), 'static');
      mod.show();
}
var uid;
// fill payment details 
function payEnrollmentFee() {
      document.getElementById("viewbox").classList.add("d-none");
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  var data = JSON.parse(t);
                  // direct pay payment gatway
                  DirectPayCardPayment.init({
                        container: 'card_container', //<div id="card_container"></div>
                        merchantId: 'EE14968', //your merchant_id
                        amount: data["price"],
                        refCode: "DPfdsfds12345", //unique referance code form merchant
                        currency: 'LKR',
                        type: 'ONE_TIME_PAYMENT',
                        customerEmail: data["email"],
                        customerMobile: data["contact"],
                        description: 'Student Enrollment Fee payment',  //product or service description
                        debug: true,
                        responseCallback: responseCallback,
                        errorCallback: errorCallback,
                        logo: 'https://test.com/directpay_logo.png',
                        apiKey: '888ed17d392e4190df62d18feb6bf850643b35e5acc757abe26bc1b4e5853f3d'
                  });

                  uid = data["uid"]
            }
      };
      r.open("POST", "../misc/payment-data.php", true);
      r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      r.send();


}
// add payment details to database 
function pay(id) {
      var f = new FormData();
      f.append("id", id);
      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
            if (r.readyState == 4) {
                  var t = r.responseText;
                  // alert(t)
                  if (t == "success") {
                        // window.location = "../student/gui/dashboard.php";
                        document.getElementById("paysuccesBox").classList.remove("d-none");
                        document.getElementById("card_container").classList.add("d-none");
                  }
            }
      };
      r.open("POST", "../misc/pay-procces.php", true);

      r.send(f);
}

//response callback.
function responseCallback(result) {
      // console.log("successCallback-Client", result);
      // alert(JSON.stringify(result));
      pay(uid);

}

//error callback
function errorCallback(result) {
      // console.log("successCallback-Client", result);
      // alert(JSON.stringify(result));
      pay(uid);

}