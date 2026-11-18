# Matriks Ketelusuran

> Disusun oleh: Maulana Umar Al-Faroq (CEO) · Direview oleh: Ratu Nafisah (Analyst), Bunga Olivia (Database) · v0.1 (kerangka) · 18 November 2026
>
> Kolom "Use case", "Tabel", dan "Layar" berisi usulan awal. Ratu dan Bunga memperbaruinya sesuai use case dan ERD final sebelum Gate 1 (minimal 5 baris lengkap).

| Masalah mitra | Kebutuhan (user story) | Fitur | Use case | Tabel | Layar | Uji (UAT) |
|---|---|---|---|---|---|---|
| P1, P3 | Sebagai calon mahasiswa, saya ingin mendaftar dan mengunggah berkas secara online agar tidak perlu datang ke kampus | F-01 | UC-01 Registrasi & isi formulir; UC-02 Unggah berkas | pendaftar, berkas, prodi, gelombang | Form pendaftaran, halaman unggah berkas | 1 pendaftar mendaftar dari ponsel |
| P1 | Sebagai verifikator, saya ingin melihat dan memvalidasi berkas pendaftar di satu dasbor agar verifikasi lebih cepat | F-02 | UC-03 Verifikasi berkas | berkas, verifikasi, pengguna | Dasbor verifikasi | Verifikator memproses 5 pendaftar |
| P2 | Sebagai pendaftar, saya ingin melihat tagihan dan mengunggah bukti bayar agar pembayaran tercatat | F-03 | UC-04 Unggah bukti bayar | tagihan, pembayaran | Halaman pembayaran | [skenario dari Ratu] |
| P2 | Sebagai admin keuangan, saya ingin memverifikasi bukti bayar agar status lunas akurat | F-03 | UC-05 Verifikasi pembayaran | pembayaran, pengguna | Dasbor pembayaran | [skenario dari Ratu] |
| P3 | Sebagai pendaftar, saya ingin melihat hasil seleksi di akun saya agar tidak perlu bertanya ke panitia | F-04 | UC-06 Lihat pengumuman | pendaftar, hasil_seleksi | Dasbor pendaftar | [skenario dari Ratu] |
| P4 | Sebagai admin akademik, saya ingin mengekspor data pendaftar diterima ke format siap impor agar tidak mengetik ulang | F-05 | UC-07 Ekspor data | pendaftar, hasil_seleksi, prodi | Halaman ekspor | [skenario dari Ratu] |
