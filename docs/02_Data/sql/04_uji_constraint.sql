-- =====================================================================
-- PMB Online UNH · 04_uji_constraint.sql
-- Uji negatif: setiap percobaan di bawah SENGAJA melanggar aturan bisnis.
-- Hasil yang benar: semua baris berlabel "LULUS" (database menolak data salah).
-- Tidak ada data yang tersimpan; tiap uji dibatalkan otomatis.
-- Disusun oleh: Bunga Olivia · Direview oleh: Maulana Umar Al-Faroq · v1.0 · 24 Nov 2026
-- =====================================================================
SET client_min_messages = notice;

CREATE OR REPLACE FUNCTION pg_temp.uji(nama TEXT, perintah TEXT) RETURNS VOID AS $$
BEGIN
  EXECUTE perintah;
  RAISE NOTICE 'GAGAL  %  (data salah malah diterima)', nama;
EXCEPTION WHEN OTHERS THEN
  RAISE NOTICE 'LULUS  %  -> %', nama, SQLERRM;
END $$ LANGUAGE plpgsql;

BEGIN;
SELECT pg_temp.uji('U01 email pengguna harus unik',
  $q$INSERT INTO pengguna (peran_id, nama_lengkap, email, password_hash) VALUES (1, 'Uji', 'admin@pmb.unh.test', 'x')$q$);
SELECT pg_temp.uji('U02 NIK wajib 16 digit angka',
  $q$UPDATE calon_mahasiswa SET nik = '157101123456' WHERE calon_id = 5$q$);
SELECT pg_temp.uji('U03 pilihan prodi maksimal 2 (urutan 1/2)',
  $q$INSERT INTO pilihan_prodi (pendaftaran_id, prodi_id, urutan) VALUES (2, 3, 3)$q$);
SELECT pg_temp.uji('U04 prodi yang sama tidak boleh dipilih dua kali',
  $q$INSERT INTO pilihan_prodi (pendaftaran_id, prodi_id, urutan)
     SELECT pendaftaran_id, min(prodi_id), 2 FROM pilihan_prodi GROUP BY pendaftaran_id HAVING count(*) = 1 LIMIT 1$q$);
SELECT pg_temp.uji('U05 satu calon hanya sekali per gelombang',
  $q$INSERT INTO pendaftaran (nomor_pendaftaran, calon_id, gelombang_id, jalur_id, kelas_id) VALUES ('PMB-UJI-1', 5, 1, 1, 1)$q$);
SELECT pg_temp.uji('U06 berkas maksimal 2 MB',
  $q$INSERT INTO berkas_pendaftaran (pendaftaran_id, jenis_berkas_id, nama_file, path_file, tipe_file, ukuran_byte)
     VALUES (13, 4, 'kk.pdf', 'uploads/uji/kk.pdf', 'pdf', 3500000)$q$);
SELECT pg_temp.uji('U07 format berkas hanya pdf/jpg',
  $q$INSERT INTO berkas_pendaftaran (pendaftaran_id, jenis_berkas_id, nama_file, path_file, tipe_file, ukuran_byte)
     VALUES (13, 4, 'kk.png', 'uploads/uji/kk.png', 'png', 500000)$q$);
SELECT pg_temp.uji('U08 berkas "perlu_revisi" wajib ada catatan',
  $q$UPDATE berkas_pendaftaran SET status_verifikasi = 'perlu_revisi', catatan_verifikasi = NULL,
     diverifikasi_oleh = 3, diverifikasi_pada = now() WHERE berkas_id = (SELECT min(berkas_id) FROM berkas_pendaftaran WHERE status_verifikasi = 'menunggu')$q$);
SELECT pg_temp.uji('U09 verifikasi wajib mencatat siapa verifikatornya',
  $q$UPDATE berkas_pendaftaran SET status_verifikasi = 'terverifikasi' WHERE berkas_id = (SELECT min(berkas_id) FROM berkas_pendaftaran WHERE status_verifikasi = 'menunggu')$q$);
SELECT pg_temp.uji('U10 maksimal satu pembayaran "diterima" per tagihan',
  $q$INSERT INTO pembayaran (tagihan_id, path_bukti, nominal_dibayar, tanggal_transfer, status_verifikasi, diverifikasi_oleh, diverifikasi_pada)
     SELECT tagihan_id, 'uploads/uji.jpg', 250000, current_date, 'diterima', 5, now() FROM pembayaran WHERE status_verifikasi = 'diterima' LIMIT 1$q$);
SELECT pg_temp.uji('U11 bukti bayar ditolak wajib ada alasan',
  $q$UPDATE pembayaran SET status_verifikasi = 'ditolak', diverifikasi_oleh = 5, diverifikasi_pada = now(), catatan_verifikasi = NULL
     WHERE pembayaran_id = (SELECT min(pembayaran_id) FROM pembayaran WHERE status_verifikasi = 'menunggu')$q$);
SELECT pg_temp.uji('U12 status di luar daftar nilai ditolak',
  $q$UPDATE pendaftaran SET status_pendaftaran = 'lulus' WHERE pendaftaran_id = 40$q$);
SELECT pg_temp.uji('U13 satu pilihan hanya punya satu hasil seleksi',
  $q$INSERT INTO hasil_seleksi (pilihan_id, status_hasil, ditetapkan_oleh) SELECT pilihan_id, 'diterima', 2 FROM hasil_seleksi LIMIT 1$q$);
SELECT pg_temp.uji('U14 tanggal tutup gelombang >= tanggal buka',
  $q$INSERT INTO gelombang (kampus_id, tahun_akademik, nama_gelombang, tanggal_buka, tanggal_tutup) VALUES (1, '2027/2028', 'Gelombang Uji', '2027-05-01', '2027-04-01')$q$);
SELECT pg_temp.uji('U15 NIM harus unik',
  $q$UPDATE pendaftaran_ulang SET nim = (SELECT min(nim) FROM pendaftaran_ulang)
     WHERE daftar_ulang_id = (SELECT max(daftar_ulang_id) FROM pendaftaran_ulang WHERE nim IS NOT NULL)$q$);
SELECT pg_temp.uji('U16 hanya data tervalidasi yang boleh masuk ekspor SIAKAD',
  $q$UPDATE pendaftaran_ulang SET ekspor_id = 1 WHERE status_validasi = 'menunggu'$q$);
SELECT pg_temp.uji('U17 FK: pendaftaran ke prodi yang tidak ada',
  $q$INSERT INTO pilihan_prodi (pendaftaran_id, prodi_id, urutan) VALUES (1, 99, 1)$q$);
ROLLBACK;
