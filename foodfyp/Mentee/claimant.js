function btnActive(btnId) {
  const buttons = document.getElementsByClassName("btnF");
  const currentCoupons = document.querySelectorAll("#curr");
  const expiredCoupons = document.querySelectorAll("#expired");

  for (let button of buttons) {
    button.classList.remove("btnActive");
  }

  document.getElementById(btnId).classList.add("btnActive");

  if (btnId === "btn1") {
    currentCoupons.forEach((coupon) => (coupon.style.display = "block"));
    expiredCoupons.forEach((coupon) => (coupon.style.display = "none"));
  } else if (btnId === "btn2") {
    currentCoupons.forEach((coupon) => (coupon.style.display = "none"));
    expiredCoupons.forEach((coupon) => (coupon.style.display = "block"));
  } else if (btnId === "btn3") {
    currentCoupons.forEach((coupon) => (coupon.style.display = "block"));
    expiredCoupons.forEach((coupon) => (coupon.style.display = "block"));
  }
}
btnActive("btn1");
