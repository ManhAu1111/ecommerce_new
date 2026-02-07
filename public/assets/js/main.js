/*=============== SHOW MENU ===============*/
const navMenu = document.getElementById("nav-menu"),
  navToggle = document.getElementById("nav-toggle"),
  navClose = document.getElementById("nav-close");

/*===== Menu Show =====*/
/* Validate if constant exists */
if (navToggle) {
  navToggle.addEventListener("click", () => {
    navMenu.classList.add("show-menu");
  });
}

/*===== Hide Show =====*/
/* Validate if constant exists */
if (navClose) {
  navClose.addEventListener("click", () => {
    navMenu.classList.remove("show-menu");
  });
}

/*=============== IMAGE GALLERY ===============*/
function imgGallery() {
  const mainImg = document.querySelector(".details__img"),
    smallImg = document.querySelectorAll(".details__small-img");

  smallImg.forEach((img) => {
    img.addEventListener("click", function () {
      mainImg.src = this.src;
    });
  });
}

imgGallery();

// js trang home
document.addEventListener("click", function (e) {

  /* ================= TAB PRODUCT ================= */
  const tabBtn = e.target.closest(".tab__btn");
  if (tabBtn) {
    const target = tabBtn.dataset.target;

    document.querySelectorAll(".tab__btn").forEach(btn =>
      btn.classList.remove("active-tab")
    );
    document.querySelectorAll(".tab__item").forEach(tab =>
      tab.classList.remove("active-tab")
    );

    tabBtn.classList.add("active-tab");
    document.querySelector(target)?.classList.add("active-tab");
  }

  /* ================= TOGGLE REVIEWS ================= */
  if (e.target.id === "toggleReviews") {
    const wrapper = document.getElementById("reviewsWrapper");
    if (!wrapper) return;

    wrapper.classList.toggle("hidden");
    e.target.textContent = wrapper.classList.contains("hidden")
      ? "Show reviews"
      : "Hide reviews";
  }
});




