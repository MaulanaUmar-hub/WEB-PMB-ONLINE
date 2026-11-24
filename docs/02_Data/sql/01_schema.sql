-- =====================================================================
-- PMB Online UNH · 01_schema.sql (DDL)
-- DBMS        : PostgreSQL 14+ (diuji di PostgreSQL 16) · ADR-001
-- Sumber      : ERD_PMB_Online_UNH_v1.3.drawio, halaman "3. ERD Fisik"
-- WBS         : 1.1.2.4 · Fitur F-01 s.d. F-05 · UC-01 s.d. UC-07
-- Disusun oleh: Bunga Olivia (Database Officer)
-- Direview oleh: Maulana Umar Al-Faroq (CEO/PO)
-- Versi 1.0 · 24 Nov 2026 · draf dibantu AI generatif (wajib diungkapkan di refleksi)
--
-- Cara pakai : psql -d pmb_unh -f 01_schema.sql
-- Skrip aman dijalankan ulang: semua tabel dihapus lalu dibuat lagi.
-- =====================================================================

BEGIN;

SET client_min_messages = warning;
SET TIME ZONE 'Asia/Jakarta';

DROP TABLE IF EXISTS notifikasi, pendaftaran_ulang, ekspor_siakad, hasil_seleksi,
  pembayaran, tagihan, berkas_pendaftaran, pilihan_prodi, pendaftaran,
  jenis_berkas, program_studi, jalur_pendaftaran, gelombang, calon_mahasiswa,
  otp_verifikasi, pengguna, sumber_informasi, kelas, peran, kampus CASCADE;

-- ---------------------------------------------------------------------
-- A. TABEL MASTER (hijau di ERD)
-- ---------------------------------------------------------------------

-- Kampus: dasar pemisahan data per kampus (roadmap multi-kampus, C-03)
CREATE TABLE kampus (
  kampus_id    SMALLINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  kode_kampus  VARCHAR(10)  NOT NULL UNIQUE,
  nama_kampus  VARCHAR(100) NOT NULL,
  aktif        BOOLEAN      NOT NULL DEFAULT TRUE
);

-- Peran/role untuk login (fondasi semua fitur)
CREATE TABLE peran (
  peran_id    SMALLINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  kode_peran  VARCHAR(20) NOT NULL UNIQUE,
  nama_peran  VARCHAR(50) NOT NULL
);

-- Kelas perkuliahan (pagi/malam)
CREATE TABLE kelas (
  kelas_id    SMALLINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  nama_kelas  VARCHAR(20) NOT NULL UNIQUE
);

-- Sumber informasi PMB (untuk statistik promosi)
CREATE TABLE sumber_informasi (
  sumber_informasi_id  SMALLINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  nama_sumber          VARCHAR(60) NOT NULL UNIQUE
);

CREATE TABLE gelombang (
  gelombang_id    SMALLINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  kampus_id       SMALLINT    NOT NULL REFERENCES kampus(kampus_id),
  tahun_akademik  VARCHAR(9)  NOT NULL,           -- format 2027/2028
  nama_gelombang  VARCHAR(30) NOT NULL,
  tanggal_buka    DATE        NOT NULL,
  tanggal_tutup   DATE        NOT NULL,
  CONSTRAINT uk_gelombang UNIQUE (kampus_id, tahun_akademik, nama_gelombang),
  CONSTRAINT ck_gelombang_tanggal CHECK (tanggal_tutup >= tanggal_buka),
  CONSTRAINT ck_gelombang_tahun CHECK (tahun_akademik ~ '^[0-9]{4}/[0-9]{4}$')
);

CREATE TABLE jalur_pendaftaran (
  jalur_id    SMALLINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  kampus_id   SMALLINT     NOT NULL REFERENCES kampus(kampus_id),
  nama_jalur  VARCHAR(100) NOT NULL,
  deskripsi   VARCHAR(255),
  aktif       BOOLEAN      NOT NULL DEFAULT TRUE,
  CONSTRAINT uk_jalur UNIQUE (kampus_id, nama_jalur)
);

CREATE TABLE program_studi (
  prodi_id    SMALLINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  kampus_id   SMALLINT    NOT NULL REFERENCES kampus(kampus_id),
  nama_prodi  VARCHAR(80) NOT NULL,
  jenjang     VARCHAR(5)  NOT NULL,
  aktif       BOOLEAN     NOT NULL DEFAULT TRUE,
  CONSTRAINT uk_prodi UNIQUE (kampus_id, nama_prodi),
  CONSTRAINT ck_prodi_jenjang CHECK (jenjang IN ('D3','D4','S1','S2'))
);

CREATE TABLE jenis_berkas (
  jenis_berkas_id  SMALLINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  kampus_id        SMALLINT    NOT NULL REFERENCES kampus(kampus_id),
  nama_jenis       VARCHAR(60) NOT NULL,
  wajib            BOOLEAN     NOT NULL DEFAULT TRUE,
  CONSTRAINT uk_jenis_berkas UNIQUE (kampus_id, nama_jenis)
);

-- ---------------------------------------------------------------------
-- B. AKUN & IDENTITAS
-- ---------------------------------------------------------------------

CREATE TABLE pengguna (
  pengguna_id               BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  peran_id                  SMALLINT     NOT NULL REFERENCES peran(peran_id),
  kampus_id                 SMALLINT     REFERENCES kampus(kampus_id), -- NULL untuk pendaftar
  nama_lengkap              VARCHAR(100) NOT NULL,
  email                     VARCHAR(100) NOT NULL UNIQUE,
  no_hp                     VARCHAR(20),
  password_hash             VARCHAR(255),          -- NULL jika hanya login Google
  google_sub                VARCHAR(64)  UNIQUE,   -- ID akun Google (ADR SSO P14)
  email_terverifikasi_pada  TIMESTAMPTZ,
  status_akun               VARCHAR(20)  NOT NULL DEFAULT 'belum_verifikasi',
  jumlah_gagal_login        SMALLINT     NOT NULL DEFAULT 0,
  terkunci_sampai           TIMESTAMPTZ,
  dibuat_pada               TIMESTAMPTZ  NOT NULL DEFAULT now(),
  diubah_pada               TIMESTAMPTZ  NOT NULL DEFAULT now(),
  CONSTRAINT ck_pengguna_status CHECK (status_akun IN ('belum_verifikasi','aktif','terkunci','nonaktif')),
  CONSTRAINT ck_pengguna_gagal CHECK (jumlah_gagal_login BETWEEN 0 AND 5),
  CONSTRAINT ck_pengguna_login CHECK (password_hash IS NOT NULL OR google_sub IS NOT NULL)
);

CREATE TABLE otp_verifikasi (
  otp_id            BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  pengguna_id       BIGINT       NOT NULL REFERENCES pengguna(pengguna_id) ON DELETE CASCADE,
  tujuan            VARCHAR(20)  NOT NULL,
  kode_hash         VARCHAR(255) NOT NULL,           -- kode OTP tidak disimpan polos
  kedaluwarsa_pada  TIMESTAMPTZ  NOT NULL,
  digunakan_pada    TIMESTAMPTZ,
  dibuat_pada       TIMESTAMPTZ  NOT NULL DEFAULT now(),
  CONSTRAINT ck_otp_tujuan CHECK (tujuan IN ('verifikasi_email','reset_sandi','login_staf'))
);

CREATE TABLE calon_mahasiswa (
  calon_id             BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  pengguna_id          BIGINT   NOT NULL UNIQUE REFERENCES pengguna(pengguna_id),
  sumber_informasi_id  SMALLINT REFERENCES sumber_informasi(sumber_informasi_id),
  nik                  CHAR(16) UNIQUE,
  nisn                 CHAR(10) UNIQUE,
  tempat_lahir         VARCHAR(80),
  tanggal_lahir        DATE,
  alamat               TEXT,
  sekolah_asal         VARCHAR(120),
  CONSTRAINT ck_calon_nik  CHECK (nik  ~ '^[0-9]{16}$'),
  CONSTRAINT ck_calon_nisn CHECK (nisn ~ '^[0-9]{10}$')
);

-- ---------------------------------------------------------------------
-- C. TRANSAKSI PMB (kuning = entitas pusat, biru = transaksi)
-- ---------------------------------------------------------------------

-- F-01 · UC-01 Registrasi & isi formulir
CREATE TABLE pendaftaran (
  pendaftaran_id      BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  nomor_pendaftaran   VARCHAR(20) NOT NULL UNIQUE,   -- format PMB-2027-000001
  calon_id            BIGINT      NOT NULL REFERENCES calon_mahasiswa(calon_id),
  gelombang_id        SMALLINT    NOT NULL REFERENCES gelombang(gelombang_id),
  jalur_id            SMALLINT    NOT NULL REFERENCES jalur_pendaftaran(jalur_id),
  kelas_id            SMALLINT    NOT NULL REFERENCES kelas(kelas_id),
  status_pendaftaran  VARCHAR(20) NOT NULL DEFAULT 'draf',
  dikirim_pada        TIMESTAMPTZ,                    -- NULL selama masih draf
  dibuat_pada         TIMESTAMPTZ NOT NULL DEFAULT now(),
  CONSTRAINT uk_pendaftaran_calon_gelombang UNIQUE (calon_id, gelombang_id),
  CONSTRAINT ck_pendaftaran_status CHECK (status_pendaftaran IN
    ('draf','menunggu_pembayaran','menunggu_berkas','menunggu_verifikasi',
     'perlu_perbaikan','terverifikasi','diumumkan','batal')),
  CONSTRAINT ck_pendaftaran_dikirim CHECK (status_pendaftaran = 'draf' OR dikirim_pada IS NOT NULL)
);

-- F-01 · pilih 1 sampai 2 prodi
CREATE TABLE pilihan_prodi (
  pilihan_id      BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  pendaftaran_id  BIGINT   NOT NULL REFERENCES pendaftaran(pendaftaran_id) ON DELETE CASCADE,
  prodi_id        SMALLINT NOT NULL REFERENCES program_studi(prodi_id),
  urutan          SMALLINT NOT NULL,
  CONSTRAINT uk_pilihan_urutan UNIQUE (pendaftaran_id, urutan),
  CONSTRAINT uk_pilihan_prodi  UNIQUE (pendaftaran_id, prodi_id),
  CONSTRAINT ck_pilihan_urutan CHECK (urutan IN (1, 2))
);

-- F-01 unggah berkas (UC-02) + F-02 verifikasi berkas (UC-03)
-- Unggah ulang = baris baru; berkas aktif = unggahan terbaru per jenis.
CREATE TABLE berkas_pendaftaran (
  berkas_id           BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  pendaftaran_id      BIGINT       NOT NULL REFERENCES pendaftaran(pendaftaran_id) ON DELETE CASCADE,
  jenis_berkas_id     SMALLINT     NOT NULL REFERENCES jenis_berkas(jenis_berkas_id),
  nama_file           VARCHAR(255) NOT NULL,
  path_file           VARCHAR(500) NOT NULL,
  tipe_file           VARCHAR(4)   NOT NULL,
  ukuran_byte         INT          NOT NULL,
  status_verifikasi   VARCHAR(20)  NOT NULL DEFAULT 'menunggu',
  catatan_verifikasi  VARCHAR(255),
  diunggah_pada       TIMESTAMPTZ  NOT NULL DEFAULT now(),
  diverifikasi_oleh   BIGINT       REFERENCES pengguna(pengguna_id),
  diverifikasi_pada   TIMESTAMPTZ,
  CONSTRAINT ck_berkas_tipe   CHECK (tipe_file IN ('pdf','jpg','jpeg')),
  CONSTRAINT ck_berkas_ukuran CHECK (ukuran_byte > 0 AND ukuran_byte <= 2097152), -- maks 2 MB
  CONSTRAINT ck_berkas_status CHECK (status_verifikasi IN ('menunggu','terverifikasi','perlu_revisi')),
  CONSTRAINT ck_berkas_catatan CHECK (status_verifikasi <> 'perlu_revisi' OR catatan_verifikasi IS NOT NULL),
  CONSTRAINT ck_berkas_verifikator CHECK (status_verifikasi = 'menunggu'
    OR (diverifikasi_oleh IS NOT NULL AND diverifikasi_pada IS NOT NULL))
);
CREATE INDEX ix_berkas_terbaru ON berkas_pendaftaran (pendaftaran_id, jenis_berkas_id, diunggah_pada DESC);

-- F-03 · tagihan biaya formulir / daftar ulang
CREATE TABLE tagihan (
  tagihan_id      BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  pendaftaran_id  BIGINT      NOT NULL REFERENCES pendaftaran(pendaftaran_id),
  jenis_tagihan   VARCHAR(15) NOT NULL,
  nomor_va        VARCHAR(20) UNIQUE,                 -- NULL di MVP; diisi saat payment gateway (C-01)
  nominal         BIGINT      NOT NULL,
  batas_bayar     TIMESTAMPTZ NOT NULL,
  status_tagihan  VARCHAR(20) NOT NULL DEFAULT 'belum_bayar',
  dibuat_pada     TIMESTAMPTZ NOT NULL DEFAULT now(),
  CONSTRAINT ck_tagihan_jenis   CHECK (jenis_tagihan IN ('formulir','daftar_ulang')),
  CONSTRAINT ck_tagihan_nominal CHECK (nominal > 0),
  CONSTRAINT ck_tagihan_status  CHECK (status_tagihan IN ('belum_bayar','menunggu_verifikasi','lunas','kedaluwarsa'))
);
CREATE INDEX ix_tagihan_pendaftaran ON tagihan (pendaftaran_id);

-- F-03 · UC-04 unggah bukti bayar + UC-05 verifikasi oleh keuangan
-- Satu tagihan boleh punya banyak unggahan (bukti ditolak → unggah ulang).
CREATE TABLE pembayaran (
  pembayaran_id       BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  tagihan_id          BIGINT       NOT NULL REFERENCES tagihan(tagihan_id),
  path_bukti          VARCHAR(500) NOT NULL,
  nominal_dibayar     BIGINT       NOT NULL,
  tanggal_transfer    DATE         NOT NULL,
  bank_pengirim       VARCHAR(50),
  nama_pengirim       VARCHAR(100),
  status_verifikasi   VARCHAR(20)  NOT NULL DEFAULT 'menunggu',
  catatan_verifikasi  VARCHAR(255),
  diverifikasi_oleh   BIGINT       REFERENCES pengguna(pengguna_id),
  diverifikasi_pada   TIMESTAMPTZ,
  diunggah_pada       TIMESTAMPTZ  NOT NULL DEFAULT now(),
  CONSTRAINT ck_pembayaran_nominal CHECK (nominal_dibayar > 0),
  CONSTRAINT ck_pembayaran_status  CHECK (status_verifikasi IN ('menunggu','diterima','ditolak')),
  CONSTRAINT ck_pembayaran_catatan CHECK (status_verifikasi <> 'ditolak' OR catatan_verifikasi IS NOT NULL),
  CONSTRAINT ck_pembayaran_verifikator CHECK (status_verifikasi = 'menunggu'
    OR (diverifikasi_oleh IS NOT NULL AND diverifikasi_pada IS NOT NULL))
);
CREATE INDEX ix_pembayaran_tagihan ON pembayaran (tagihan_id);
-- Aturan bisnis: maksimal satu pembayaran berstatus "diterima" per tagihan
CREATE UNIQUE INDEX uk_pembayaran_diterima ON pembayaran (tagihan_id) WHERE status_verifikasi = 'diterima';

-- F-04 · UC-06 pengumuman hasil per pilihan prodi
CREATE TABLE hasil_seleksi (
  hasil_id         BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  pilihan_id       BIGINT       NOT NULL UNIQUE REFERENCES pilihan_prodi(pilihan_id) ON DELETE CASCADE,
  skor_tes         NUMERIC(5,2),                     -- diisi manual panitia (CBT = Won't)
  status_hasil     VARCHAR(20)  NOT NULL,
  ditetapkan_oleh  BIGINT       NOT NULL REFERENCES pengguna(pengguna_id),
  ditetapkan_pada  TIMESTAMPTZ  NOT NULL DEFAULT now(),
  diumumkan_pada   TIMESTAMPTZ,                      -- NULL = belum tampil ke pendaftar
  CONSTRAINT ck_hasil_status CHECK (status_hasil IN ('diterima','tidak_diterima','cadangan')),
  CONSTRAINT ck_hasil_skor   CHECK (skor_tes IS NULL OR skor_tes BETWEEN 0 AND 100)
);

-- F-05 · UC-07 log ekspor data ke format impor SIAKAD (CSV/XLSX)
CREATE TABLE ekspor_siakad (
  ekspor_id      BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  gelombang_id   SMALLINT     NOT NULL REFERENCES gelombang(gelombang_id),
  diekspor_oleh  BIGINT       NOT NULL REFERENCES pengguna(pengguna_id),
  nama_file      VARCHAR(255) NOT NULL,
  format_file    VARCHAR(5)   NOT NULL,
  jumlah_baris   INT          NOT NULL,
  diekspor_pada  TIMESTAMPTZ  NOT NULL DEFAULT now(),
  CONSTRAINT ck_ekspor_format CHECK (format_file IN ('csv','xlsx')),
  CONSTRAINT ck_ekspor_baris  CHECK (jumlah_baris >= 0)
);

-- Sumber data F-05: pendaftar diterima yang sudah divalidasi BAAK
CREATE TABLE pendaftaran_ulang (
  daftar_ulang_id  BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  pilihan_id       BIGINT       NOT NULL UNIQUE REFERENCES pilihan_prodi(pilihan_id),
  ekspor_id        BIGINT       REFERENCES ekspor_siakad(ekspor_id), -- NULL = belum diekspor
  status_validasi  VARCHAR(20)  NOT NULL DEFAULT 'menunggu',
  catatan_baak     VARCHAR(255),
  divalidasi_oleh  BIGINT       REFERENCES pengguna(pengguna_id),
  divalidasi_pada  TIMESTAMPTZ,
  nim              VARCHAR(20)  UNIQUE,
  diajukan_pada    TIMESTAMPTZ  NOT NULL DEFAULT now(),
  CONSTRAINT ck_daftar_ulang_status CHECK (status_validasi IN ('menunggu','divalidasi','ditolak')),
  CONSTRAINT ck_daftar_ulang_validator CHECK (status_validasi = 'menunggu'
    OR (divalidasi_oleh IS NOT NULL AND divalidasi_pada IS NOT NULL)),
  CONSTRAINT ck_daftar_ulang_ekspor CHECK (ekspor_id IS NULL OR status_validasi = 'divalidasi')
);

-- Should S-01 · notifikasi email (masalah P3)
CREATE TABLE notifikasi (
  notifikasi_id     BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  pengguna_id       BIGINT      NOT NULL REFERENCES pengguna(pengguna_id),
  pendaftaran_id    BIGINT      REFERENCES pendaftaran(pendaftaran_id),
  saluran           VARCHAR(10) NOT NULL,
  jenis_notifikasi  VARCHAR(30) NOT NULL,
  pesan             TEXT        NOT NULL,
  status_kirim      VARCHAR(20) NOT NULL DEFAULT 'antre',
  dikirim_pada      TIMESTAMPTZ,
  dibuat_pada       TIMESTAMPTZ NOT NULL DEFAULT now(),
  CONSTRAINT ck_notif_saluran CHECK (saluran IN ('email','whatsapp')),
  CONSTRAINT ck_notif_status  CHECK (status_kirim IN ('antre','terkirim','gagal')),
  CONSTRAINT ck_notif_jenis   CHECK (jenis_notifikasi IN
    ('akun_dibuat','pendaftaran_dikirim','tagihan_terbit','pembayaran_diterima','pembayaran_ditolak',
     'berkas_perlu_revisi','berkas_terverifikasi','hasil_diumumkan','daftar_ulang_divalidasi'))
);
CREATE INDEX ix_notifikasi_pengguna ON notifikasi (pengguna_id, dibuat_pada DESC);

-- ---------------------------------------------------------------------
-- D. INDEKS BANTU UNTUK DASBOR STAF
-- ---------------------------------------------------------------------
CREATE INDEX ix_pendaftaran_status ON pendaftaran (gelombang_id, status_pendaftaran);
CREATE INDEX ix_berkas_status      ON berkas_pendaftaran (status_verifikasi);
CREATE INDEX ix_pembayaran_status  ON pembayaran (status_verifikasi);

-- ---------------------------------------------------------------------
-- E. VIEW SIAP PAKAI
-- ---------------------------------------------------------------------

-- Berkas aktif = unggahan terbaru untuk setiap jenis berkas (dipakai dasbor verifikasi F-02)
CREATE VIEW v_berkas_terbaru AS
SELECT DISTINCT ON (b.pendaftaran_id, b.jenis_berkas_id) b.*
FROM berkas_pendaftaran b
ORDER BY b.pendaftaran_id, b.jenis_berkas_id, b.diunggah_pada DESC;

-- Data siap ekspor ke template impor SIAKAD (F-05).
-- Kolom akhir menunggu template resmi SIAKAD UNH: [isi dari tim].
CREATE VIEW v_ekspor_siakad AS
SELECT g.gelombang_id,
       g.tahun_akademik,
       p.nomor_pendaftaran,
       du.nim,
       u.nama_lengkap,
       c.nik,
       c.nisn,
       c.tempat_lahir,
       c.tanggal_lahir,
       c.alamat,
       c.sekolah_asal,
       ps.nama_prodi,
       ps.jenjang,
       k.nama_kelas,
       j.nama_jalur,
       u.email,
       u.no_hp,
       du.ekspor_id
FROM pendaftaran_ulang du
JOIN pilihan_prodi pp     ON pp.pilihan_id = du.pilihan_id
JOIN pendaftaran p        ON p.pendaftaran_id = pp.pendaftaran_id
JOIN calon_mahasiswa c    ON c.calon_id = p.calon_id
JOIN pengguna u           ON u.pengguna_id = c.pengguna_id
JOIN program_studi ps     ON ps.prodi_id = pp.prodi_id
JOIN kelas k              ON k.kelas_id = p.kelas_id
JOIN jalur_pendaftaran j  ON j.jalur_id = p.jalur_id
JOIN gelombang g          ON g.gelombang_id = p.gelombang_id
WHERE du.status_validasi = 'divalidasi';

COMMIT;
