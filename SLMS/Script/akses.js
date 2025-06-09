// Login dan Register
// Fungsi saat input focus atau tidak
function inputAktif() {
    document.querySelectorAll(".form-input input").forEach(input => {
        
        function toggleActive() {
            input.parentElement.classList.toggle("active", input === document.activeElement || input.value);
        }
        
        input.addEventListener("focus", toggleActive);
        input.addEventListener("blur", toggleActive);
    });
}

// Fungsi intip password
function intiPassword() {
    document.querySelectorAll(".togglePassword").forEach(icon => {
        icon.addEventListener("click", () => {
            const input = icon.closest(".form-input").querySelector(".isi-password");
            const password = input.type === "password";
            
            input.type = password ? "text" : "password";
            icon.textContent = password ? "lock_open" : "lock";
        });
    });
}

// Jalankan semua fitur saat DOM sudah siap
document.addEventListener("DOMContentLoaded", () => {
    inputAktif();
    intiPassword();
});

// Navigasi
const iconMenu = document.querySelector(".icon");
const container = document.querySelector(".container");
const sidebar = document.querySelector("#sidebar");

iconMenu.addEventListener("click", () => {
    container.classList.toggle("collapsed");
    sidebar.classList.toggle("active");
});

// Formulir Input
function editForm () {
    const btnEdit = document.getElementById("btn-edit");
    const inputs = document.querySelectorAll("input");
    const select = document.querySelectorAll("select");
    const hidden = [
        document.getElementById("btn-simpan"),
        document.getElementById("btn-kembali"),
        document.querySelector(".icon-camera")];

    btnEdit.addEventListener("click", function () {
        [...inputs, ...select].forEach(item => {
            if(item.tagName === "INPUT") item.readOnly = false;
            if(item.tagName === "SELECT") item.disabled = false;
            item.style.backgroundColor = "#ffffff";
        });

        btnEdit.style.display = "none";
        hidden.forEach(list => {
            list.style.display = "inline-block";
        });
    });
}

editForm();






