document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const email = document.querySelector(".box-email__input");

  const displayName = document.querySelector(".box-dpname__input");
  const password = document.querySelector(
    '.box-password__input[name="password"]'
  );
  const confirmPassword = document.querySelector(
    '.box-password__input[name="confirm_password"]'
  );
  const submitBtn = document.querySelector(".box-button__submit");
  const buttonBox = document.querySelector(".box-button");

  const emailError = createErrorBox(email);
  const nameError = createErrorBox(displayName);
  const passError = createErrorBox(password);
  const confirmError = createErrorBox(confirmPassword);

  function createErrorBox(input) {
    const error = document.createElement("div");
    error.className = "notice-error";
    input.parentNode.insertAdjacentElement("afterend", error);
    return error;
  }

  function validateEmail() {
    const value = email.value.trim();

    // Xoá dòng thông báo khi người dùng bắt đầu nhập lại
    const phpEmailError = document.getElementById("php-email-error"); // mục đích xoá thông báo ngay khi người dùng nhập lại
    if (phpEmailError) {
      phpEmailError.remove();
    }

    // Kiểm tra rỗng
    if (value === "") {
      emailError.innerHTML = "";
      emailError.classList.remove("show");
      return false;
    }
    // Kiểm tra định dạng email
    const regex = /^[\w.-]+@[\w.-]+\.(com|net|org|edu|gov|vn)$/;
    if (!regex.test(value)) {
      emailError.innerHTML = `
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fa-circle-exclamation">
        <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24v112c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zm-32 232a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/>
      </svg>
      Please enter your email address using the format name@example.com
    `;
      emailError.classList.add("show");
      return false;
    }
    // Nếu hợp lệ
    emailError.innerHTML = "";
    emailError.classList.remove("show");
    return true;
  }

  function validateDisplayName() {
    const value = displayName.value.trim();

    // Xoá dòng thông báo khi người dùng bắt đầu nhập lại
    const phpDisplayNameError = document.getElementById(
      "php-displayname-error"
    ); // mục đích xoá thông báo ngay khi người dùng nhập lại
    if (phpDisplayNameError) {
      phpDisplayNameError.remove();
    }

    if (value === "") {
      nameError.innerHTML = "";
      nameError.classList.remove("show");
      return false;
    }
    const regex = /^[a-zA-Z0-9 _\-]+$/;
    if (!regex.test(value)) {
      nameError.innerHTML = `
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fa-circle-exclamation" style="width: 1em; height: 1em; margin-right: 6px; vertical-align: middle;">
      <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24l0 112c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-112c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
    </svg>
    Display name must not contain special characters.
  `;
      nameError.classList.add("show");
      return false;
    }
    nameError.innerHTML = "";
    nameError.classList.remove("show");
    return true;
  }

  function validatePassword() {
    const value = password.value.trim();
    if (value === "") {
      return false;
    }
    passError.textContent = "";
    return true;
  }

  function validateConfirmPassword() {
    const value = confirmPassword.value.trim();
    if (value === "") {
      confirmError.innerHTML = "";
      confirmError.classList.remove("show");
      return false;
    }

    if (value !== password.value.trim()) {
      confirmError.innerHTML = ` <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fa-circle-exclamation" style="width: 1em; height: 1em; margin-right: 6px; vertical-align: middle;">
      <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24l0 112c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-112c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
    </svg>Passwords do not match.`;
      confirmError.classList.add("show");
      return false;
    }
    confirmError.innerHTML = "";
    confirmError.classList.remove("show");
    return true;
  }

  function validateForm() {
    const valid =
      validateEmail() &&
      validateDisplayName() &&
      validatePassword() &&
      validateConfirmPassword();
    submitBtn.disabled = !valid;
    if (!valid) {
      buttonBox.classList.add("brown-disabled");
    } else {
      buttonBox.classList.remove("brown-disabled");
    }
    return valid;
  }

  [email, displayName, password, confirmPassword].forEach((input) => {
    input.addEventListener("blur", validateForm);
    input.addEventListener("input", validateForm);
    input.addEventListener("keydown", function (e) {
      if (e.key === "Enter") {
        validateForm();
      }
    });
  });

  form.addEventListener("submit", function (e) {
    if (!validateForm()) {
      e.preventDefault();
    }
  });
});
