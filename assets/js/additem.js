document.addEventListener("DOMContentLoaded", () => {
  const addButton = document.querySelector(".calculator__add-btn");
  const table = document.querySelector(".caculator-infowrap");

  const ingredientOptions = [
    "Rau Muống",
    "Đu Đủ",
    "Hạt Sen",
    "Cà Rốt",
    "Bông Cải",
    "Khoai Tây",
    "Thịt Bò",
    "Thịt Gà",
    "Thịt Lợn",
    "Cá Hồi",
    "Cá Thu",
    "Cá Trê",
    "Trứng Gà",
    "Trứng Vịt",
    "Đậu Hũ",
    "Đậu Đen",
    "Đậu Hà Lan",
    "Gạo Trắng",
    "Gạo Lứt",
    "Bánh Mì",
    "Phở Tươi",
    "Mì Trứng",
    "Yến Mạch",
    "Sữa Tươi",
    "Sữa Chua",
    "Chuối",
    "Cam",
    "Dứa",
    "Xoài",
    "Táo",
  ];

  function getSelectedIngredients() {
    const selected = [];
    document.querySelectorAll(".ingredient-select").forEach((select) => {
      selected.push(select.value);
    });
    return selected;
  }

  function createIngredientSelect(currentValue = "") {
    const select = document.createElement("select");
    select.className = "ingredient-select";

    const selectedValues = getSelectedIngredients();
    ingredientOptions.forEach((opt) => {
      if (!selectedValues.includes(opt) || opt === currentValue) {
        const option = document.createElement("option");
        option.value = opt;
        option.textContent = opt;
        if (opt === currentValue) option.selected = true;
        select.appendChild(option);
      }
    });

    return select;
  }

  function updateSTTandOptions() {
    const rows = document.querySelectorAll(".calculator__row");
    const selectedValues = getSelectedIngredients();

    rows.forEach((row, index) => {
      // STT
      const sttCell = row.querySelector(".col-1");
      if (sttCell) sttCell.textContent = index + 1;

      // Update select options
      const select = row.querySelector(".ingredient-select");
      if (select) {
        const currentValue = select.value;
        select.innerHTML = "";
        ingredientOptions.forEach((opt) => {
          if (!selectedValues.includes(opt) || opt === currentValue) {
            const option = document.createElement("option");
            option.value = opt;
            option.textContent = opt;
            select.appendChild(option);
          }
        });
        select.value = currentValue;
      }
    });
  }

  addButton.addEventListener("click", () => {
    const rows = document.querySelectorAll(".calculator__row");
    const newIndex = rows.length + 1;

    const newRow = document.createElement("ul");
    newRow.className = "calculator__row";

    const li1 = document.createElement("li");
    li1.className = "col-1";
    li1.textContent = newIndex;

    const li2 = document.createElement("li");
    li2.className = "col-2";
    li2.appendChild(createIngredientSelect());

    const li3 = document.createElement("li");
    li3.className = "col-3";
    li3.innerHTML = `<span class="col-3__value">200</span>
                     <i class="fa-solid fa-circle-minus delete-icon fa-2x"></i>`;

    newRow.appendChild(li1);
    newRow.appendChild(li2);
    newRow.appendChild(li3);

    table.insertBefore(newRow, addButton);
    updateSTTandOptions();
  });

  // Cập nhật option khi thay đổi lựa chọn
  document.addEventListener("change", function (e) {
    if (e.target.classList.contains("ingredient-select")) {
      updateSTTandOptions();
    }
  });
});
