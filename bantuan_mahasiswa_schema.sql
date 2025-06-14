
-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('mahasiswa', 'admin'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- -----------------------------------------------------
-- Table `mahasiswa_profiles`
-- -----------------------------------------------------
CREATE TABLE mahasiswa_profiles (
    profile_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    npm VARCHAR(20) UNIQUE,
    jurusan VARCHAR(100),
    fakultas VARCHAR(100),
    alamat TEXT,
    no_hp VARCHAR(15),
    tanggal_lahir DATE,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- -----------------------------------------------------
-- Table `dokumen`
-- -----------------------------------------------------
CREATE TABLE dokumen (
    dokumen_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    nama_dokumen VARCHAR(100),
    path_file VARCHAR(255),
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- -----------------------------------------------------
-- Table `pengajuan`
-- -----------------------------------------------------
CREATE TABLE pengajuan (
    pengajuan_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    tanggal_pengajuan DATE,
    status ENUM('diproses', 'ditolak', 'disetujui'),
    alasan_penolakan TEXT,
    catatan_admin TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- -----------------------------------------------------
-- Table `verifikasi_dokumen`
-- -----------------------------------------------------
CREATE TABLE verifikasi_dokumen (
    verifikasi_id INT AUTO_INCREMENT PRIMARY KEY,
    dokumen_id INT,
    admin_id INT,
    status_verifikasi ENUM('valid', 'tidak valid'),
    catatan TEXT,
    tanggal_verifikasi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (dokumen_id) REFERENCES dokumen(dokumen_id),
    FOREIGN KEY (admin_id) REFERENCES users(user_id)
);

-- -----------------------------------------------------
-- Table `status_penetapan`
-- -----------------------------------------------------
CREATE TABLE status_penetapan (
    penetapan_id INT AUTO_INCREMENT PRIMARY KEY,
    pengajuan_id INT,
    admin_id INT,
    status ENUM('disetujui', 'ditolak'),
    tanggal_penetapan TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pengajuan_id) REFERENCES pengajuan(pengajuan_id),
    FOREIGN KEY (admin_id) REFERENCES users(user_id)
);

-- -----------------------------------------------------
-- Table `penyaluran_dana`
-- -----------------------------------------------------
CREATE TABLE penyaluran_dana (
    penyaluran_id INT AUTO_INCREMENT PRIMARY KEY,
    pengajuan_id INT,
    nominal DECIMAL(15,2),
    tanggal_penyaluran DATE,
    catatan TEXT,
    FOREIGN KEY (pengajuan_id) REFERENCES pengajuan(pengajuan_id)
);

-- -----------------------------------------------------
-- Table `log_history`
-- -----------------------------------------------------
CREATE TABLE log_history (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    aktivitas VARCHAR(255),
    keterangan TEXT,
    waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- -----------------------------------------------------
-- Sample Data
-- -----------------------------------------------------

INSERT INTO users (name, email, password, role) VALUES
('Ahmad Fauzi', 'ahmad@example.com', 'hashed_password_123', 'mahasiswa'),
('Rina Sari', 'rina@example.com', 'hashed_password_456', 'mahasiswa'),
('Admin Pusat', 'admin@example.com', 'hashed_admin_pass', 'admin');

INSERT INTO mahasiswa_profiles (user_id, npm, jurusan, fakultas, alamat, no_hp, tanggal_lahir) VALUES
(1, '210001001', 'Teknik Informatika', 'FTI', 'Jl. Merdeka No. 1', '081234567890', '2003-05-10'),
(2, '210001002', 'Sistem Informasi', 'FTI', 'Jl. Soekarno No. 12', '082345678901', '2003-08-15');

INSERT INTO dokumen (user_id, nama_dokumen, path_file) VALUES
(1, 'KTM', 'uploads/ktm_ahmad.pdf'),
(1, 'Surat Keterangan Tidak Mampu', 'uploads/sktm_ahmad.pdf'),
(2, 'KTM', 'uploads/ktm_rina.pdf');

INSERT INTO pengajuan (user_id, tanggal_pengajuan, status) VALUES
(1, '2025-06-01', 'diproses'),
(2, '2025-06-05', 'disetujui');

INSERT INTO verifikasi_dokumen (dokumen_id, admin_id, status_verifikasi, catatan) VALUES
(1, 3, 'valid', 'Dokumen sesuai'),
(2, 3, 'valid', 'Dokumen diterima'),
(3, 3, 'tidak valid', 'File tidak lengkap');

INSERT INTO status_penetapan (pengajuan_id, admin_id, status) VALUES
(2, 3, 'disetujui');

INSERT INTO penyaluran_dana (pengajuan_id, nominal, tanggal_penyaluran, catatan) VALUES
(2, 3000000, '2025-06-10', 'Penyaluran tahap 1');

INSERT INTO log_history (user_id, aktivitas, keterangan) VALUES
(1, 'Login', 'Berhasil login ke sistem'),
(1, 'Upload Dokumen', 'Mengunggah KTM'),
(2, 'Pengajuan Bantuan', 'Mengajukan bantuan dana tanggal 5 Juni'),
(3, 'Verifikasi', 'Memverifikasi dokumen mahasiswa Ahmad');
