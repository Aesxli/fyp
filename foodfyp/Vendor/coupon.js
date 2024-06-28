/*confirmation page start*/
function showOnClick() {
    document.getElementById("bg").classList.add("redeemClick");
    document.getElementById("cfm").classList.add("redeemClick");
    document.getElementById("content").classList.add("redeem");
    redeemedCfm = true;
    return redeemedCfm;
  }
  function removeOnCfm() {
    document.getElementById("bg").classList.remove("redeemClick");
    document.getElementById("cfm").classList.remove("redeemClick");
    document.getElementById("content").classList.remove("redeem");
    document.getElementById("redeem").classList.add("hide");
    document.getElementById("timer").classList.add("show");
  }
  /*confirmation page end*/