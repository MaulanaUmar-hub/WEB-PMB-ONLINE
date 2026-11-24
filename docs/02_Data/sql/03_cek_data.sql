-- =====================================================================
-- PMB Online UNH · 03_cek_data.sql (uji cepat setelah schema + seed)
-- Disusun oleh: Bunga Olivia · Direview oleh: Maulana Umar Al-Faroq · v1.0 · 24 Nov 2026
-- Semua query bagian B harus menghasilkan 0 baris / angka 0.
-- =====================================================================

-- A. Jumlah baris per tabel
SELECT 'pengguna' AS tabel, count(*) FROM pengguna UNION ALL
SELECT 'calon_mahasiswa', count(*) FROM calon_mahasiswa UNION ALL
SELECT 'pendaftaran', count(*) FROM pendaftaran UNION ALL
SELECT 'pilihan_prodi', count(*) FROM pilihan_prodi UNION ALL
SELECT 'berkas_pendaftaran', count(*) FROM berkas_pendaftaran UNION ALL
SELECT 'tagihan', count(*) FROM tagihan UNION ALL
SELECT 'pembayaran', count(*) FROM pembayaran UNION ALL
SELECT 'hasil_seleksi', count(*) FROM hasil_seleksi UNION ALL
SELECT 'pendaftaran_ulang', count(*) FROM pendaftaran_ulang UNION ALL
SELECT 'notifikasi', count(*) FROM notifikasi UNION ALL
SELECT 'otp_verifikasi', count(*) FROM otp_verifikasi;

-- Sebaran status pendaftaran (bahan dasbor & UAT)
SELECT status_pendaftaran, count(*) FROM pendaftaran GROUP BY 1 ORDER BY 2 DESC;

-- B1. Pendaftaran berstatus setelah bayar tetapi tagihan formulir belum lunas
SELECT p.nomor_pendaftaran FROM pendaftaran p
JOIN tagihan t ON t.pendaftaran_id = p.pendaftaran_id AND t.jenis_tagihan = 'formulir'
WHERE p.status_pendaftaran NOT IN ('draf','menunggu_pembayaran','batal') AND t.status_tagihan <> 'lunas';

-- B2. Tagihan lunas tanpa satu pun pembayaran diterima
SELECT t.tagihan_id FROM tagihan t
WHERE t.status_tagihan = 'lunas'
  AND NOT EXISTS (SELECT 1 FROM pembayaran b WHERE b.tagihan_id = t.tagihan_id AND b.status_verifikasi = 'diterima');

-- B3. Pendaftaran "terverifikasi"/"diumumkan" yang masih punya berkas aktif belum terverifikasi
SELECT DISTINCT p.nomor_pendaftaran FROM pendaftaran p
JOIN v_berkas_terbaru b ON b.pendaftaran_id = p.pendaftaran_id
WHERE p.status_pendaftaran IN ('terverifikasi','diumumkan') AND b.status_verifikasi <> 'terverifikasi';

-- B4. Pendaftaran "diumumkan" yang belum punya hasil untuk setiap pilihan
SELECT p.nomor_pendaftaran FROM pendaftaran p
JOIN pilihan_prodi pp ON pp.pendaftaran_id = p.pendaftaran_id
LEFT JOIN hasil_seleksi h ON h.pilihan_id = pp.pilihan_id
WHERE p.status_pendaftaran = 'diumumkan' AND h.hasil_id IS NULL;

-- B5. Lebih dari satu prodi "diterima" untuk satu pendaftaran
SELECT pp.pendaftaran_id FROM hasil_seleksi h JOIN pilihan_prodi pp USING (pilihan_id)
WHERE h.status_hasil = 'diterima' GROUP BY 1 HAVING count(*) > 1;

-- B6. Daftar ulang untuk pilihan yang tidak "diterima"
SELECT du.daftar_ulang_id FROM pendaftaran_ulang du
JOIN hasil_seleksi h USING (pilihan_id) WHERE h.status_hasil <> 'diterima';

-- B7. Jumlah baris di log ekspor tidak sama dengan data yang diekspor
SELECT e.ekspor_id FROM ekspor_siakad e
WHERE e.jumlah_baris <> (SELECT count(*) FROM pendaftaran_ulang du WHERE du.ekspor_id = e.ekspor_id);

-- C. Data siap ekspor SIAKAD (F-05)
SELECT nomor_pendaftaran, nim, nama_lengkap, nama_prodi, nama_kelas, ekspor_id FROM v_ekspor_siakad ORDER BY nim;

-- D. Antrean dasbor verifikator (F-02): pendaftar menunggu verifikasi berkas
SELECT p.nomor_pendaftaran, u.nama_lengkap, count(*) AS berkas_menunggu
FROM pendaftaran p
JOIN calon_mahasiswa c ON c.calon_id = p.calon_id
JOIN pengguna u ON u.pengguna_id = c.pengguna_id
JOIN v_berkas_terbaru b ON b.pendaftaran_id = p.pendaftaran_id AND b.status_verifikasi = 'menunggu'
WHERE p.status_pendaftaran = 'menunggu_verifikasi'
GROUP BY 1, 2 ORDER BY 1;
