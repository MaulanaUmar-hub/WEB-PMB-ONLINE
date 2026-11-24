# Architecture Vision v1.0 — PMB Online

> Disusun oleh: Maulana Umar Al-Faroq (CEO) · Direview oleh: Ratu Nafisah (System Analyst) · v1.0 (draf, dibekukan di Gate 1) · 18 November 2026
>
> Bagian bertanda `[isi dari mitra]` wajib diisi dari wawancara atau dokumen kerja mitra sebelum Gate 1. Bukti lapangan disimpan di `docs/07_Evidence/mitra/`.

## 1. Mitra

| Item | Isi |
|---|---|
| Nama universitas mitra | [isi dari mitra] |
| Unit / narasumber | Panitia PMB / Biro Administrasi Akademik: [nama & jabatan] |
| Tanggal wawancara | [isi dari mitra] |
| Bukti | Rekaman/notulen wawancara, foto formulir, contoh spreadsheet pendaftar |

## 2. Problem statement

Proses PMB di universitas mitra masih bergantung pada [formulir kertas / Google Form / spreadsheet: isi dari mitra]. Dampaknya:

| # | Masalah | Bukti lapangan |
|---|---|---|
| P1 | Verifikasi berkas lambat karena berkas dikirim terpisah dan dicek manual | [isi dari mitra] |
| P2 | Status pembayaran sulit dilacak; bukti transfer dicocokkan manual | [isi dari mitra] |
| P3 | Pendaftar tidak tahu status pendaftarannya dan sering bertanya ke panitia | [isi dari mitra] |
| P4 | Data pendaftar diterima harus diketik ulang ke sistem akademik | [isi dari mitra] |

## 3. Nilai yang ditawarkan

- **Bagi calon mahasiswa:** satu portal untuk mendaftar, mengunggah berkas, membayar, dan melihat pengumuman, termasuk dari ponsel.
- **Bagi panitia PMB:** verifikasi berkas dan pembayaran dalam satu dasbor; status pendaftar selalu jelas.
- **Bagi bagian akademik:** data pendaftar diterima bisa diekspor dalam format siap impor, tanpa input ulang.
- **Nilai jual (enterprise):** dirancang agar bisa dipakai banyak universitas swasta sebagai layanan berlangganan. MVP dibangun untuk satu mitra, tetapi struktur datanya sudah siap dipisahkan per kampus (roadmap fase 2).

## 4. Lingkup

**Dalam lingkup MVP (Must):**

| ID | Fitur | Masalah yang dijawab |
|---|---|---|
| F-01 | Daftar & unggah berkas | P1, P3 |
| F-02 | Verifikasi berkas oleh panitia | P1 |
| F-03 | Pembayaran (unggah bukti bayar + verifikasi) | P2 |
| F-04 | Pengumuman hasil seleksi | P3 |
| F-05 | Ekspor data pendaftar diterima | P4 |

**Di luar lingkup MVP** (masuk Should/Could atau roadmap): multi-kampus penuh, payment gateway otomatis, notifikasi WhatsApp, ujian seleksi online, integrasi langsung ke SIAKAD. Detail ada di [backlog MoSCoW](../06_Governance/P13_Backlog_MoSCoW_DoD_Ketelusuran.pdf).

## 5. KPI

| KPI | Baseline (sekarang) | Target setelah MVP | Cara ukur |
|---|---|---|---|
| K1 · Waktu rata-rata verifikasi berkas per pendaftar | [isi dari mitra] | [target] | Selisih waktu unggah vs. status terverifikasi di sistem |
| K2 · Persentase pendaftar yang menyelesaikan alur sampai bayar | [isi dari mitra] | [target] | Jumlah status "lunas" ÷ jumlah akun terdaftar |
| K3 · Jumlah input ulang data manual oleh panitia per gelombang | [isi dari mitra] | 0 (lewat ekspor) | Wawancara panitia saat UAT |

## 6. Stakeholder utama

Lihat [stakeholder.md](stakeholder.md).

## 7. Prinsip arsitektur

1. **Satu sumber data:** status pendaftar, berkas, dan pembayaran tersimpan di satu database terpusat.
2. **Akses per peran:** pendaftar, verifikator, dan admin hanya melihat data sesuai haknya.
3. **Data pribadi dilindungi:** berkas identitas disimpan aman, akses tercatat, dan tidak ada data asli di repo.
4. **Mobile-friendly:** alur pendaftaran bisa diselesaikan dari ponsel.
5. **Siap tumbuh:** desain data menyiapkan pemisahan per kampus dan per gelombang pendaftaran.

## 8. Rantai ketelusuran

Masalah mitra (P1–P4) → kebutuhan (user story) → desain (BPMN, ERD, use case, topologi) → fitur F-01 s.d. F-05 → UAT + SUS. Lihat [matriks ketelusuran](../06_Governance/Traceability_Matrix_PMB_Online_UNH_v1.1.xlsx).
