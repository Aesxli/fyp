function showOnClick() {
  document.getElementById("bg").classList.add("redeemClick");
  document.getElementById("cfm").classList.add("redeemClick");
  document.getElementById("content").classList.add("redeem");
  redeemedCfm = true;
  return redeemedCfm;
}
function removeCancel(){
  document.getElementById("bg").classList.remove("redeemClick");
  document.getElementById("cfm").classList.remove("redeemClick");
  document.getElementById("content").classList.remove("redeem");
}
function removeOnCfm() {
  document.getElementById("bg").classList.remove("redeemClick");
  document.getElementById("cfm").classList.remove("redeemClick");
  document.getElementById("content").classList.remove("redeem");
  document.getElementById("redeem").classList.add("hide");
  document.getElementById("redeem").classList.remove("show");
  document.getElementById("timer").classList.add("show");
  document.getElementById("timer").classList.remove("hide");
}

function createQR() {
  new QRCode(
      document.querySelector(".qrCode"),
      "https://localhost:3000/doCouponDetails.php"
  );
  document.getElementById("qrPlaceholder").classList.add("hide");
  document.querySelector(".qrCode").classList.remove("hide");
};


function startTimer() {
  if (redeemedCfm === true) {
    document.querySelector(".btnRedeem").classList.add("disable");
    var timerElement = document.getElementById("timer");
    var timeRemaining = 10;

    var interval = setInterval(function () {
      var seconds = timeRemaining % 60;

      seconds = seconds < 10 ? seconds : seconds;

      timerElement.textContent = 0 + ":" + seconds;

      timeRemaining--;

      if (timeRemaining < 0) {
        clearInterval(interval);
        var qrCodeDiv = document.querySelector(".qrCode");
        qrCodeDiv.classList.add("hide");
        qrCodeDiv.innerHTML = "";
        document.querySelector(".btnRedeem").classList.remove("disable");

        document.getElementById("qrPlaceholder").classList.remove("hide");
        document.getElementById("timer").classList.add("hide");
        document.getElementById("timer").classList.remove("show");
        document.getElementById("redeem").classList.add("show");
        document.getElementById("redeem").classList.remove("hide");
      }
    }, 1000);
  }
}

var redeemedCfm = false;
