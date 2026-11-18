# Backlog MVP — Prioritas MoSCoW

> Disusun oleh: Maulana Umar Al-Faroq (CEO / PO) · Direview oleh: Rio Octara Abrialdi (Programmer) · v1.0 · 18 November 2026

Aturan: **Must maksimal 5**. Permintaan baru masuk lewat [log CR](cr-log.md). User story rinci dan kriteria penerimaan disusun System Analyst di `docs/03_Application/`.

## Must (MVP, wajib jalan di P16)

| ID | Fitur | Deskripsi singkat | Masalah | Target build |
|---|---|---|---|---|
| F-01 | Daftar & unggah berkas | Pendaftar membuat akun, mengisi biodata & pilihan prodi, mengunggah berkas (ijazah/SKL, KTP/KK, pas foto) | P1, P3 | P14 |
| F-02 | Verifikasi berkas | Verifikator memeriksa berkas, memberi status valid/perlu perbaikan + catatan | P1 | P14 |
| F-03 | Pembayaran | Pendaftar melihat tagihan & mengunggah bukti bayar; admin keuangan memverifikasi → status lunas | P2 | Sebelum P15 |
| F-04 | Pengumuman | Admin menetapkan hasil seleksi; pendaftar melihat status lulus/tidak di dasbornya | P3 | Sebelum P15 |
| F-05 | Ekspor data | Admin mengekspor data pendaftar diterima ke CSV/Excel dalam format siap impor | P4 | P15 |

Login + role (pendaftar, verifikator, admin) adalah fondasi semua fitur dan dikerjakan di P13 sebagai PR Programmer.

## Should (dikerjakan jika Must selesai lebih cepat)

| ID | Fitur |
|---|---|
| S-01 | Notifikasi email saat status berubah |
| S-02 | Dasbor statistik pendaftar per prodi/gelombang |
| S-03 | Pengaturan gelombang pendaftaran & kuota |

## Could (roadmap fase 2)

| ID | Fitur |
|---|---|
| C-01 | Payment gateway otomatis (virtual account) |
| C-02 | Notifikasi WhatsApp |
| C-03 | Multi-kampus (satu platform untuk banyak universitas swasta) |

## Won't (tidak di sprint ini; roadmap fase 3)

| ID | Fitur |
|---|---|
| W-01 | Ujian seleksi online (CBT) |
| W-02 | Integrasi langsung API ke SIAKAD |
| W-03 | Aplikasi mobile native |
