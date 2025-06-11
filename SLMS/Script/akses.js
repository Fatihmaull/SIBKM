// Login dan Register
// Fungsi aktifkan label saat input focus
function inputAktif() {
    const inputs = document.querySelectorAll(".form-input input");
    if (!inputs.length) return;

    inputs.forEach(input => {
        function toggleActive() {
        input.parentElement.classList.toggle("active", input === document.activeElement || input.value);
        }

        input.addEventListener("focus", toggleActive);
        input.addEventListener("blur", toggleActive);
    });
}

// Fungsi tampilkan/sembunyikan password
function intiPassword() {
    const iconKunci = document.querySelectorAll(".togglePassword");
    if (!iconKunci.length) return;

    iconKunci.forEach(icon => {
        icon.addEventListener("click", () => {
        const input = icon.closest(".form-input").querySelector(".isi-password");
        if (!input) return;

        const isPassword = input.type === "password";
        input.type = isPassword ? "text" : "password";
        icon.textContent = isPassword ? "lock_open" : "lock";
        });
    });
}

// Navigasi
function navigasi() {
    const iconMenu = document.querySelector(".icon");
    const container = document.querySelector(".container");
    const sidebar = document.getElementById("sidebar");

    if (!iconMenu || !container || !sidebar) return;

    iconMenu.addEventListener("click", () => {
        container.classList.toggle("collapsed");
        sidebar.classList.toggle("active");
    });
}

// Edit Profile
function editProfil() {
    const form = document.querySelector("form.pageProfil");
    const inputs = document.querySelectorAll("form.pageProfil input");
    const select = document.querySelector("form.pageProfil select");
    const btnEdit = document.getElementById("btn-edit");
    const btnKembali = document.getElementById("btn-kembali");

    if (!form || !btnEdit || !btnKembali) return;

    btnEdit.addEventListener("click", () => {
        inputs.forEach(item => item.readOnly = false);
        if (select) select.disabled = false;
        form.classList.add("edit");
    });

    btnKembali.addEventListener("click", () => {
        inputs.forEach(item => item.readOnly = true);
        if (select) select.disabled = true;
        form.classList.remove("edit");
    });
}

// Jalankan Fungsi
document.addEventListener("DOMContentLoaded", () => {
    inputAktif();
    intiPassword();
    navigasi();
    editProfil();
});
