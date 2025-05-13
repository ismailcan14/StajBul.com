document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("applyForm");
    const fileInput = document.getElementById("cv");

    form.addEventListener("submit", function (e) {
        if (!fileInput.value) {
            e.preventDefault();
            alert("Lütfen bir CV dosyası yükleyin.");
        }
    });
});