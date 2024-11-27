function updateDate() {
  const dateElement = document.getElementById("date");
  const daysOfWeek = [
    "Chủ nhật",
    "Thứ hai",
    "Thứ ba",
    "Thứ tư",
    "Thứ năm",
    "Thứ sáu",
    "Thứ bảy",
  ];

  const now = new Date();
  const dayOfWeek = daysOfWeek[now.getDay()];
  const day = now.getDate();
  const month = now.getMonth() + 1; // Months are zero-indexed in JavaScript
  const year = now.getFullYear();

  dateElement.textContent = `${dayOfWeek}, ${day}/${
    month < 10 ? "0" : ""
  }${month}/${year}`;
}

// Update date initially and then every second
updateDate();
setInterval(updateDate, 1000);
// weather

async function fetchWeather() {
  const apiKey = "7b13dd4702d20b2cf24aa6b7a7de15de";
  const city = "Hanoi";
  const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${apiKey}`;

  try {
    const response = await fetch(url);
    const data = await response.json();

    if (data.cod === 200) {
      const temperature = data.main.temp;
      const weatherDescription = data.weather[0].main;

      // Thêm biểu tượng thời tiết (ví dụ: 🌤, 🌧, ⛅️) tùy vào tình trạng
      let weatherIcon;
      if (weatherDescription === "Clouds") {
        weatherIcon = '<i class="fa-solid fa-cloud"></i>';
      } else if (weatherDescription === "Clear") {
        weatherIcon = '<i class="fa-solid fa-sun"></i>';
      } else if (weatherDescription === "Rain") {
        weatherIcon = '<i class="fa-solid fa-cloud-rain"></i>';
      } else {
        weatherIcon = '<i class="fa-solid fa-cloud-sun"></i>';
      }

      document.getElementById(
        "weather-info"
      ).innerHTML = `Hà Nội ${weatherIcon} ${temperature}°C`;
    } else {
      document.getElementById("weather-info").innerHTML =
        "Không thể lấy dữ liệu thời tiết";
    }
  } catch (error) {
    console.error("Lỗi khi lấy dữ liệu thời tiết:", error);
    document.getElementById("weather-info").innerHTML =
      "Không thể lấy dữ liệu thời tiết";
  }
}

// Gọi hàm để cập nhật thời tiết khi tải trang
fetchWeather();
