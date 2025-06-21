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

// Fungsi Melihat Foto
function lihatFoto(input) {
    const foto = document.getElementById("foto");
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            foto.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
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
        inputs.forEach(item => {
            if (item.name !== "nim" && item.name !== "nama") {
                item.readOnly = false;
            }if(item.name === "nim" && item.name === "nama") {
                item.style.backgroundColor = "rgba(255, 255, 255, 0.3)";
            }
        });

        if (select) select.disabled = false;
        form.classList.add("edit");
    });

    btnKembali.addEventListener("click", () => {
        inputs.forEach(item => item.readOnly = true);
        if (select) select.disabled = true;
        form.classList.remove("edit");
    });
}

// Fungsi ubah ceklis (isi atau kosong)
function ubahCeklis(idInput, status) {
    const ceklisId = `cek${idInput.toUpperCase()}`;
    const listCeklis = document.getElementById(ceklisId);
    const listItem = listCeklis?.closest("li");

    if (!listCeklis || !listItem) return;

    if (status === "isi") {
        listCeklis.textContent = "check_box";
        listItem.classList.add("ubah");
    } else {
        listCeklis.textContent = "check_box_outline_blank";
        listItem.classList.remove("ubah");
    }
}

// Fungsi untuk menangani upload dan tampilkan ceklis
function uploadBerkas() {
    const inputBerkas = document.querySelectorAll("input[type='file']");

    inputBerkas.forEach(upload => {
        upload.addEventListener("change", function (event) {
            const file = this.files[0];
            if (file) {
                const idInput = event.target.id;
                const namaFile = `fileName${idInput.toUpperCase()}`;
                const listUpload = document.getElementById(namaFile);
                const URLFile = URL.createObjectURL(file);

                // Tampilkan nama file dan tombol hapus
                listUpload.innerHTML = `
                    <a href="${URLFile}" target="_blank" class="linkBerkas">${file.name}</a><br>
                    <button type="button" class="btn-hapus" data-id="${idInput}"><span class="material-symbols-outlined">delete</span>Hapus Berkas</button>
                `;

                // Ceklis
                ubahCeklis(idInput, "isi");

                // Event tombol hapus
                const tombolHapus = listUpload.querySelector(".btn-hapus");
                tombolHapus.addEventListener("click", function () {
                    upload.value = ""; // reset input file
                    listUpload.textContent = "Belum Ada File";
                    ubahCeklis(idInput, "kosong");
                });
            }
        });
    });
}


// Jalankan Fungsi
document.addEventListener("DOMContentLoaded", () => {
    inputAktif();
    intiPassword();
    navigasi();
    editProfil();
    uploadBerkas();
});
