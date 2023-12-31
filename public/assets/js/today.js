// script.js
const today = new Date();
const options = { weekday: "long", timeZone: "Asia/Jakarta" };
const namaHariIni = today.toLocaleDateString("id-ID", options);

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("namaHariIni").value = namaHariIni;
});
