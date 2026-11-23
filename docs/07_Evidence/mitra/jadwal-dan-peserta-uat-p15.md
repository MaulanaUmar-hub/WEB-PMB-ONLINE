# Jadwal & Peserta UAT P15 — PMB Online UNH

> Disusun oleh: Maulana Umar Al-Faroq (CEO) · Direview oleh: Ratu Nafisah (System Analyst) · v1.0 · 23 November 2026
> Status: **Peserta terkunci, menunggu konfirmasi tertulis final** · Folder: `docs/07_Evidence/mitra/`

## 1. Tujuan
Dokumen ini mengunci **siapa, kapan, dan di mana** UAT P15 dilakukan, supaya UAT tidak ditunda sampai minggu terakhir (jebakan #5).
Mitra UNH di proyek ini adalah **studi kasus simulasi**, jadi UAT memakai **pengguna proksi** (minimal 3 orang, profil jelas) sesuai aturan UAT.

Dasar:
- Skenario UAT kunci Kelompok 2: **staf verifikasi memproses 5 pendaftar; 1 pendaftar mendaftar dari ponsel.**
- DoD Gate 3: laporan UAT dengan bukti dan skor SUS.
- Aturan UAT: pengguna **diberi tugas, bukan ditunjukkan caranya**. Catat waktu, kesalahan, dan komentar; hitung SUS; simpan bukti.

## 2. Jadwal
| Item | Rencana |
|---|---|
| Tanggal | Rabu, 2 Desember 2026 (P15, sesuai Gantt, *asumsi*) |
| Waktu | [isi dari tim: jam mulai–selesai], slot UAT 60 menit dalam sesi P15 |
| Lokasi | [isi dari tim: ruang kelas] |
| Alternatif jika peserta berhalangan hadir di kelas | UAT dilakukan **sebelum P15** di tempat peserta, **direkam** (layar + suara), paling lambat [isi tanggal, mis. 30 Nov 2026] |
| Lingkungan aplikasi | Versi staging yang sudah ter-deploy: [isi URL staging] |

## 3. Peserta (pengguna proksi)
| Kode | Nama | Peran di UAT | Persona yang diwakili | Profil singkat | Perangkat | Konfirmasi tertulis |
|---|---|---|---|---|---|---|
| UAT-01 | Muhamad Maulana Riski | Staf verifikasi berkas | Verifikator panitia PMB | [isi: usia, status/pekerjaan, pengalaman administrasi/komputer] | Laptop | [ ] Belum · tgl: [isi] |
| UAT-02 | Indah Khoerunisa | Staf keuangan & admin PMB | Rina Maharani (Staf Keuangan) + admin data | [isi: usia, status/pekerjaan, pengalaman administrasi/komputer] | Laptop | [ ] Belum · tgl: [isi] |
| UAT-03 | Nabila Meylanty | Pendaftar dari ponsel | Dimas, 18 th (pendaftar dari ponsel) | [isi: usia, status, pernah/tidak ikut PMB online] | Ponsel milik sendiri: [isi merek/OS] | [ ] Belum · tgl: [isi] |
| UAT-04 | [isi: nama cadangan] | Cadangan (bisa jadi staf atau pendaftar) | — | [isi] | — | [ ] Belum |

> Pembagian peran UAT-01 dan UAT-02 di atas adalah **usulan CEO**; final diputuskan bersama Ratu saat menyusun skenario UAT.
> Profil diisi dari jawaban peserta sendiri, jangan dikarang. Jumlah peserta saat ini **pas 3 orang**, jadi cadangan sangat disarankan.

## 4. Alur UAT & ketelusuran
Urutan dibuat mengikuti BPMN to-be (daftar → verifikasi → bayar → pengumuman → ekspor), sehingga satu sesi UAT menguji kelima fitur Must.

| Urutan | Peserta | Tugas (diberikan sebagai soal, bukan demo) | Fitur | Masalah / KPI |
|---|---|---|---|---|
| 1 | UAT-03 Nabila | Membuat akun, mengisi formulir, dan mengunggah berkas dari ponsel | F-01 | P1, P3, P5 · K2 |
| 2 | UAT-01 Riski | Memverifikasi berkas **5 pendaftar** (Nabila + 4 data dummy), termasuk menolak 1 berkas yang sengaja dibuat tidak lengkap | F-02 | P1 · K1 |
| 3 | UAT-03 Nabila | Mengecek status, lalu mengunggah bukti bayar | F-01, F-03 | P2, P3, P5 |
| 4 | UAT-02 Indah | Memverifikasi pembayaran pendaftar | F-03 | P2 |
| 5 | UAT-02 Indah | Menerbitkan pengumuman hasil seleksi | F-04 | P3 |
| 6 | UAT-03 Nabila | Melihat pengumuman dari ponsel | F-04 | P3 |
| 7 | UAT-02 Indah | Mengekspor data pendaftar diterima ke format impor SIAKAD | F-05 | P4 · K3 |
| 8 | Semua | Mengisi kuesioner SUS (10 butir) + wawancara singkat | — | Validasi |

Rincian lembar tugas, kriteria berhasil, dan kuesioner SUS disusun Ratu di `docs/07_Evidence/uat/`.

## 5. Persiapan & PIC
| Target | Batas waktu | PIC | Status |
|---|---|---|---|
| Ajakan awal ke 3 peserta + minta kesediaan | 24 Nov 2026 | Maulana | [ ] |
| Cari 1 peserta cadangan | 25 Nov 2026 (P14) | Maulana | [ ] |
| Profil peserta lengkap di tabel §3 | 27 Nov 2026 | Maulana | [ ] |
| Skenario UAT, lembar tugas, kuesioner SUS | 28 Nov 2026 | Ratu | [ ] |
| 4 data pendaftar dummy (1 berkas sengaja tidak lengkap) + akun staf UAT | 29 Nov 2026 | Bunga + Rio | [ ] |
| Staging bisa diakses dari ponsel (HTTPS, tampilan responsif dicek) | 29 Nov 2026 | Zaki + Rio | [ ] |
| **Konfirmasi final H-3** ke peserta (tanggal, jam, lokasi) | 29 Nov 2026 | Maulana | [ ] |
| Pengingat H-1 | 1 Des 2026 | Maulana | [ ] |
| Pencatat waktu & kesalahan saat UAT | 2 Des 2026 | QA & Notulen P15: Bunga | [ ] |

## 6. Persetujuan & privasi
- Minta izin peserta untuk: (a) **direkam/difoto** selama UAT, (b) **nama lengkap** dicantumkan di laporan. Jika tidak setuju, laporan hanya memakai kode UAT-01 s.d. UAT-03.
- **Jangan** commit nomor HP, alamat, atau data pribadi lain. Data yang diunggah peserta ke aplikasi memakai data contoh, bukan dokumen asli (KTP/ijazah asli).
- Sensor nomor HP pada tangkapan layar chat sebelum di-commit.

## 7. Bukti yang disimpan
| Bukti | Lokasi |
|---|---|
| Tangkapan layar/email konfirmasi kesediaan & konfirmasi final | `docs/07_Evidence/mitra/konfirmasi-uat/` |
| Lembar tugas terisi, catatan waktu & kesalahan | `docs/07_Evidence/uat/` |
| Kuesioner & perhitungan skor SUS | `docs/07_Evidence/uat/` |
| Foto/rekaman sesi (atau tautannya jika file besar) | `docs/07_Evidence/uat/` |

## 8. Rencana cadangan
| Kejadian | Tindakan |
|---|---|
| 1 peserta batal | Peserta cadangan (UAT-04) menggantikan perannya |
| Peserta tidak bisa ke kelas | UAT di tempat peserta sebelum P15, direkam, dengan lembar tugas yang sama |
| Staging tidak bisa diakses | Jalankan versi lokal di laptop + hotspot; catat sebagai temuan |
| Ponsel peserta bermasalah | Pakai ponsel anggota tim dengan akun milik peserta; catat di laporan |

## Riwayat versi
| Versi | Tanggal | Perubahan | Oleh |
|---|---|---|---|
| v1.0 | 23 Nov 2026 | Peserta UAT dikunci (3 orang), jadwal & alur awal | Maulana |
