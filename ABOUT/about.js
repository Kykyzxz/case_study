function toggle(showMenu) {
  const panel = document.getElementById("panel");
  const menuBtn = document.getElementById("menubtn");
  const closeBtn = document.getElementById("closebtn");

  if (showMenu) {
    panel.classList.add("show");
    panel.classList.remove("hidden");
    menuBtn.classList.add("hidden");
    closeBtn.classList.remove("hidden");
  } else {
    panel.classList.remove("show");
    panel.classList.add("hidden");
    closeBtn.classList.add("hidden");
    menuBtn.classList.remove("hidden");
  }
}
// logout
function openPopup() {
    document.querySelector(".popup-overlay").style.display = "flex";
}
function closePopup() {
    document.querySelector(".popup-overlay").style.display = "none";
}
