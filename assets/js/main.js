// =========================SEARCH================================
// SEARCH keyword
// Tìm kiếm theo tên món
//Tìm kiếm theo thành phần nguyên liệu
// Tìm kiếm theo chế độ ăn
// =========================SEARCH================================

document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchInput");
  const allItems = Array.from(document.querySelectorAll(".main-dishmenu-item"));
  const paginationContainer = document.querySelector(".main-pagelist");
  const itemsPerPage = 8;

  let filteredItems = [...allItems];

  function showPage(page, data = filteredItems) {
    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;

    allItems.forEach((item) => (item.style.display = "none"));

    data.forEach((item, index) => {
      if (index >= start && index < end) {
        item.style.display = "flex";
      }
    });

    updatePagination(data.length, page);
  }

  function updatePagination(totalItems, currentPage) {
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    paginationContainer.innerHTML = ""; // clear old pages

    for (let i = 1; i <= totalPages; i++) {
      const li = document.createElement("li");
      const a = document.createElement("a");
      a.className = "main-pageitem" + (i === currentPage ? " active" : "");
      a.href = "#!";
      a.dataset.page = i;
      a.textContent = i;

      a.addEventListener("click", function (e) {
        e.preventDefault();
        showPage(parseInt(this.dataset.page), filteredItems);
      });

      li.appendChild(a);
      paginationContainer.appendChild(li);
    }
  }

  searchInput.addEventListener("input", function () {
    const keyword = this.value.toLowerCase();

    filteredItems = allItems.filter((item) => {
      const name =
        item
          .querySelector(".dish__card-info--name")
          ?.textContent.toLowerCase() || "";
      const ingredients =
        item.querySelector(".dish__ingredients")?.textContent.toLowerCase() ||
        "";
      const tag1 =
        item
          .querySelector(".dish__card-tag--tag1")
          ?.textContent.toLowerCase() || "";
      const tag2 =
        item
          .querySelector(".dish__card-tag--tag2")
          ?.textContent.toLowerCase() || "";

      return (
        name.includes(keyword) ||
        ingredients.includes(keyword) ||
        tag1.includes(keyword) ||
        tag2.includes(keyword)
      );
    });

    showPage(1);
  });

  showPage(1); // Initial load
});

// =========================Account Logout==============================
document.addEventListener("DOMContentLoaded", () => {
  const avatar = document.getElementById("accountAvatar");
  const dropdown = document.getElementById("accountDropdown");

  avatar.addEventListener("click", () => {
    dropdown.style.display =
      dropdown.style.display === "block" ? "none" : "block";
  });

  // Ẩn dropdown nếu click ngoài vùng
  document.addEventListener("click", (e) => {
    if (!avatar.contains(e.target) && !dropdown.contains(e.target)) {
      dropdown.style.display = "none";
    }
  });

  // Xử lý logout
  const logoutBtn = document.querySelector(".account-dropdown__logout");

  logoutBtn.addEventListener("click", () => {
    const confirmLogout = confirm("Bạn có chắc chắn muốn đăng xuất không?");

    if (confirmLogout) {
      // Thực hiện hành động đăng xuất tại đây
      // Ví dụ: chuyển hướng sang trang đăng nhập
      window.location.href = "./login.html";
    }
  });
});
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
