# Register Risiko — PMB Online

> Disusun oleh: Maulana Umar Al-Faroq (CEO) · Direview oleh: Muhammad Zaki Rayhan (QA) · v1.0 · 18 November 2026

Skala: Probabilitas (P) dan Dampak (D) 1–3. Skor = P × D. Skor ≥ 6 = prioritas tinggi.

| ID | Risiko | P | D | Skor | Mitigasi | Pemilik | Status |
|---|---|---|---|---|---|---|---|
| R-01 | Mitra tidak bisa dihubungi atau UAT batal di P15 | 2 | 3 | 6 | Kunci jadwal UAT tertulis sejak P13; siapkan ≥ 3 pengguna proksi berprofil jelas sebagai cadangan | Maulana | Terbuka |
| R-02 | Hanya satu orang yang bisa menjalankan/menjelaskan kode | 2 | 3 | 6 | Pair programming Bunga–Rio; setiap anggota menjalankan proyek di lokal; latihan presenter acak | Rio | Terbuka |
| R-03 | Lingkup membengkak karena permintaan mitra/Kartu Kejutan | 3 | 2 | 6 | Must maksimal 5; semua permintaan baru lewat log CR dengan analisis dampak | Maulana | Terbuka |
| R-04 | Demo gagal karena internet atau server down | 2 | 3 | 6 | Akun demo, data demo, video demo cadangan; opsi jalan di LAN/lokal | Zaki | Terbuka |
| R-05 | ERD, use case, dan prototipe tidak konsisten | 2 | 2 | 4 | Matriks ketelusuran diperbarui di setiap PR; review silang sebelum gate | Ratu | Terbuka |
| R-06 | Anggota terlambat atau tidak berkontribusi | 2 | 2 | 4 | Kartu tugas jelas, tenggat H-1; jalur teguran → mediasi dosen → Kartu Kuning | Maulana | Terbuka |
| R-07 | Kebocoran data pribadi pendaftar (berkas identitas) | 1 | 3 | 3 | Hanya data dummy/anonim di repo; akses per peran; HTTPS; `.env` tidak di-commit | Zaki | Terbuka |
| R-08 | Backup tidak bisa dipulihkan saat simulasi P15 | 2 | 2 | 4 | Uji restore sebelum P15 dan dokumentasikan langkahnya | Bunga | Terbuka |
| R-09 | Peran QA belum disetujui dosen sebagai pengganti Network/DevOps | 2 | 2 | 4 | Konfirmasi ke dosen di P13; jika ditolak, sesuaikan pembagian domain | Maulana | Terbuka |
| R-10 | Fitur pembayaran terlalu rumit jika memakai payment gateway | 2 | 2 | 4 | MVP memakai unggah bukti bayar + verifikasi manual; gateway masuk roadmap | Rio | Terbuka |

Register ditinjau di setiap stand-up sebelum gate.
