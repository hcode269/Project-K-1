document.addEventListener("DOMContentLoaded", () => {
  const feedbackForm = document.querySelector(".feedbackform form");
  const submitBtn = document.querySelector(".feedbackform__btnsubmit");

  const popup = document.createElement("div");
  popup.className = "feedback-popup";
  popup.innerHTML = `
    <div class="feedback-popup__box">
      <p class="feedback-popup__text">Are you sure you want to send this feedback?</p>
      <div class="feedback-popup__actions">
        <button class="popup-confirm">Yes</button>
        <button class="popup-cancel">No</button>
      </div>
    </div>
  `;
  document.body.appendChild(popup);
  popup.style.display = "none";

  feedbackForm.addEventListener("submit", (e) => {
    e.preventDefault();

    let isValid = true;
    feedbackForm.querySelectorAll("[required]").forEach((input) => {
      if (!input.value.trim()) {
        input.style.border = "2px solid red";
        isValid = false;
      } else {
        input.style.border = "2px solid var(--primary-color)";
      }
    });

    if (!isValid) {
      alert("Please fill in all required fields.");
      return;
    }

    popup.style.display = "flex";
  });

  popup.querySelector(".popup-cancel").addEventListener("click", () => {
    popup.style.display = "none";
  });

  popup.querySelector(".popup-confirm").addEventListener("click", () => {
    popup.style.display = "none";
    alert("Feedback sent successfully!");
    feedbackForm.reset();
  });
});
