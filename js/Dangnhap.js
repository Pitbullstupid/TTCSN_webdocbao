// Function to toggle dropdown menu visibility
function toggleDropdown() {
  const dropdown = document.getElementById("dropdown");
  dropdown.style.display =
    dropdown.style.display === "block" ? "none" : "block";
}

function logout() {
  fetch("../pages/Dangxuat.php", { method: "POST" }) // Gửi yêu cầu POST đến Dangxuat.php
    .then((response) => {
      if (response.ok) {
        return response.json(); // Chuyển đổi phản hồi JSON
      } else {
        throw new Error("Đăng xuất không thành công");
      }
    })
    .then((data) => {
      if (data.success) {
        // Xóa thông tin trong localStorage (nếu có)
        localStorage.removeItem("isLoggedIn");
        localStorage.removeItem("username");

        // Chuyển hướng người dùng về index.php
        window.location.href = "index.php";
      } else {
        alert(data.message || "Không thể đăng xuất. Vui lòng thử lại!");
      }
    })
    .catch((error) => {
      console.error("Error during logout:", error);
      alert("Đã xảy ra lỗi khi đăng xuất. Vui lòng thử lại!");
    });
}

// Close dropdown menu if clicked outside
document.addEventListener("click", function (event) {
  const dropdown = document.getElementById("dropdown");
  const avatar = document.querySelector(".avatar");
  if (dropdown && avatar && !avatar.contains(event.target)) {
    dropdown.style.display = "none";
  }
});
