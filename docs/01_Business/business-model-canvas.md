# Business Model Canvas — PMB Online

> Disusun oleh: Maulana Umar Al-Faroq (CEO) · Direview oleh: [nama] · v0.3 · 23 November 2026
> Gambar kanvas: [BMC_PMB_Online_v0.3.png](BMC_PMB_Online_v0.3.png) · Versi sebelumnya: [P13_Business_Model_Canvas_v0.2.pdf](P13_Business_Model_Canvas_v0.2.pdf)
>
> Model bisnis: **SaaS PMB untuk perguruan tinggi swasta, dengan langganan tahunan.** Studi kasus UNH (Universitas Nurdin Hamzah) memakai data simulasi. Semua angka harga adalah **hipotesis untuk pitching** dan belum divalidasi ke kampus.

| Blok | Isi |
|---|---|
| **Key Partners** (Mitra Utama) | • Universitas Nurdin Hamzah (UNH): kampus mitra pertama & studi kasus referensi<br>• Penyedia cloud hosting & domain<br>• APTISI & LLDIKTI wilayah: kanal pemasaran & kredibilitas<br>• Vendor SIAKAD: kerja sama format impor data<br>• *(Roadmap)* payment gateway & layanan notifikasi (email/WhatsApp) |
| **Key Activities** (Aktivitas Utama) | • Pengembangan & pemeliharaan platform<br>• Onboarding & pelatihan panitia PMB<br>• Keamanan, backup & kepatuhan UU PDP (UU 27/2022)<br>• Dukungan saat gelombang PMB<br>• Penagihan & perpanjangan langganan |
| **Key Resources** (Sumber Daya Utama) | • Platform PMB multi-tenant (data dipisah per kampus & gelombang)<br>• Template ekspor siap impor per SIAKAD<br>• Tim pengembang & dukungan<br>• Dokumentasi arsitektur (TOGAF) |
| **Value Propositions** (Proposisi Nilai) | • Satu portal: daftar, unggah berkas, verifikasi, bayar, pengumuman<br>• Verifikasi berkas ≤ 1 hari kerja (dari 3 hari)<br>• Tanpa input ulang: ekspor data siap impor SIAKAD<br>• Tidak perlu mengganti SIAKAD yang sudah ada<br>• Tanpa server & tim IT sendiri; siap dipakai ±2 minggu sebelum gelombang dibuka<br>• Bisa diselesaikan dari ponsel oleh calon mahasiswa<br>• Terjangkau: mulai ±Rp625 ribu/bulan, jauh di bawah paket SIAKAD lengkap |
| **Customer Relationships** (Hubungan Pelanggan) | • Onboarding & pelatihan sebelum gelombang dibuka<br>• Dukungan prioritas & SLA saat puncak pendaftaran<br>• Laporan per gelombang<br>• Review tahunan sebelum perpanjangan |
| **Channels** (Saluran) | • Presentasi langsung ke yayasan & rektorat<br>• APTISI & LLDIKTI wilayah<br>• Studi kasus UNH sebagai referensi<br>• Demo online & uji coba gratis 1 gelombang<br>• Webinar untuk panitia PMB |
| **Customer Segments** (Segmen Pelanggan) | • PTS kecil (≤ 1.000 pendaftar/tahun) yang masih memakai Google Form + WhatsApp<br>• PTS menengah yang sudah punya SIAKAD, tetapi PMB-nya masih manual<br>• Termasuk sekolah tinggi & akademi swasta<br>• **Pembayar:** yayasan / rektorat<br>• **Pengguna:** calon mahasiswa, panitia PMB, keuangan, BAAK |
| **Cost Structure** (Struktur Biaya) | • **Biaya tetap:** pengembangan & pemeliharaan, gaji tim, server dasar & domain<br>• **Biaya variabel per kampus:** penyimpanan berkas, bandwidth, onboarding<br>• Kapasitas server tambahan saat gelombang dibuka (beban puncak)<br>• Pemasaran & dukungan pelanggan<br>• Rincian angka: estimasi TCO 12 bulan (Network/DevOps, P14) |
| **Revenue Streams** (Arus Pendapatan) — *hipotesis* | • Langganan tahunan per kampus, ditagih di depan (lihat tabel paket)<br>• Kelebihan kuota: Rp5.000 per pendaftar<br>• Biaya setup & migrasi data satu kali: Rp3–5 jt<br>• Ditagih tahunan karena PMB musiman dan sesuai siklus anggaran kampus |

## Paket langganan (hipotesis)

| Paket | Kuota pendaftar/tahun | Harga/tahun |
|---|---|---|
| Starter | ≤ 1.000 | Rp7,5 jt |
| Standar | ≤ 3.000 | Rp15 jt |
| Pro | ≤ 6.000 | Rp25 jt |

## Titik impas (diisi setelah TCO selesai, P14)

> Jumlah kampus impas = Biaya tetap per tahun ÷ (Harga rata-rata per kampus − Biaya variabel per kampus)
> = `[biaya tetap dari TCO]` ÷ (Rp15 jt − `[biaya variabel per kampus]`) = `[N]` kampus

## Catatan ketelusuran & lingkup

- Value proposition 1–3 menelusur ke masalah P1–P5 dan fitur Must F-01 s.d. F-05.
- Klaim "data dipisah per kampus" bergantung pada tabel `kampus` di ERD (temuan A3 review ERD).
- Penagihan langganan, manajemen paket, dan pendaftaran kampus mandiri **bukan MVP**. Semuanya masuk Architecture Roadmap fase 2–3, dan permintaan baru diproses lewat Change Request.

## Riwayat versi

| Versi | Tanggal | Perubahan |
|---|---|---|
| v0.1 | 18 Nov 2026 | Kerangka awal |
| v0.2 | 18 Nov 2026 | Isi awal + hipotesis harga (PDF) |
| v0.3 | 23 Nov 2026 | Mengikuti template 9 blok standar (PNG); model SaaS multi-kampus & paket langganan tahunan; segmen dipecah; UU PDP, APTISI/LLDIKTI, biaya tetap vs variabel |
