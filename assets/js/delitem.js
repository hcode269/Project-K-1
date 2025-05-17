// Hàm cập nhật lại STT sau khi xóa
function updateSTT() {
  const rows = document.querySelectorAll(".calculator__row");
  rows.forEach((row, index) => {
    const sttCell = row.querySelector(".col-1");
    if (sttCell) sttCell.textContent = index + 1;
  });
}

// Xử lý sự kiện khi click vào icon xóa
document.addEventListener("click", function (e) {
  if (e.target.classList.contains("delete-icon")) {
    const row = e.target.closest(".calculator__row");
    if (row) {
      row.remove();
      updateSTT();
    }
  }
});
