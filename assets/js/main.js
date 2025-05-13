// =========================RATING================================
const stars = document.querySelectorAll(".star");
let currentRating = 0;

stars.forEach((star) => {
  star.addEventListener("mouseover", () => {
    const val = star.getAttribute("data-value");
    highlightStars(val);
  });

  star.addEventListener("mouseout", () => {
    highlightStars(currentRating);
  });

  star.addEventListener("click", () => {
    currentRating = star.getAttribute("data-value");
    highlightStars(currentRating);
  });
});

function highlightStars(rating) {
  stars.forEach((star) => {
    const starVal = star.getAttribute("data-value");
    if (starVal <= rating) {
      star.classList.add("hover");
    } else {
      star.classList.remove("hover");
    }
  });
}
// ==================================================================
