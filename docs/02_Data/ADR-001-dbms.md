# ADR-001: Pemilihan DBMS untuk PMB Online UNH

| | |
|---|---|
| **Status** | Disetujui CEO (23 Nov 2026). Menunggu konfirmasi teknis Programmer & Network |
| **Folder repo** | `docs/06_Governance/adr/` |
| **Pengusul** | Draf dibantu AI, diajukan oleh Maulana Umar Al-Faroq (CEO/PO) |
| **Pemutus** | Maulana Umar Al-Faroq (CEO/PO) |
| **Perlu konfirmasi** | Rio Octara Abrialdi (Programmer) · Muhammad Zaki Rayhan (Network/DevOps) · Bunga Olivia (Database Officer) |
| **Artefak terkait** | ERD v1.3 (`docs/02_Data`), DDL (PR Bunga sebelum P14) |

## Konteks
ERD v1.1 masih menulis "PostgreSQL / MySQL". DDL harus selesai sebelum P14, jadi DBMS perlu diputuskan sekarang. Pilihan ini memengaruhi tiga hal:
- **Integritas data F-03:** satu tagihan boleh punya banyak unggahan bukti bayar, tetapi maksimal satu yang `diterima`.
- **Pemisahan data per kampus:** sudah ada sejak MVP (`kampus_id`) dan menjadi nilai jual multi-kampus di fase 2.
- **Hosting:** opsi hosting dari Zaki harus mendukung DBMS yang dipilih.

## Opsi
| Kriteria | PostgreSQL | MySQL 8 |
|---|---|---|
| Aturan "maks. satu pembayaran diterima per tagihan" | Unique index parsial, ditegakkan database | Perlu trigger atau validasi aplikasi |
| CHECK constraint (urutan 1–2, tanggal gelombang) | Didukung | Didukung sejak 8.0.16 |
| Tipe BOOLEAN & zona waktu | BOOLEAN asli, TIMESTAMPTZ | BOOLEAN = TINYINT(1), TIMESTAMP tanpa info zona |
| DDL dalam transaksi (migrasi bisa di-rollback) | Ya | Tidak |
| Isolasi data per kampus (fase 2) | Row-Level Security tersedia | Harus di aplikasi |
| Ketersediaan di hosting murah | Lebih terbatas (biasanya VPS/managed) | Hampir semua shared hosting |

## Keputusan
Memakai **PostgreSQL**.

## Alasan
1. Aturan bisnis F-03 ditegakkan langsung di database, tidak bergantung pada kode aplikasi. Ini memperkuat jawaban untuk panel Data soal integritas.
2. Migrasi skema lebih aman karena DDL bisa di-rollback. Ini berguna untuk revisi skema sampai P15 dan untuk simulasi restore di P15.
3. Row-Level Security memberi jalur yang jelas ke multi-kampus (fase 2) tanpa mengubah struktur tabel.

## Konsekuensi
- ERD Fisik v1.3 memakai `TIMESTAMPTZ`, `NUMERIC`, `BOOLEAN`, dan PK `GENERATED ALWAYS AS IDENTITY`.
- DDL dan data dummy ditulis untuk PostgreSQL.
- Skrip backup/restore untuk P15 memakai `pg_dump` / `pg_restore`.

## Syarat yang harus dicek sebelum DDL final (batas H-1 P14, 24 Nov 2026)
- [ ] **Rio:** framework/ORM yang dipakai mendukung PostgreSQL. `[isi dari tim: nama framework]`
- [ ] **Zaki:** minimal satu dari dua opsi hosting mendukung PostgreSQL, beserta biayanya. `[isi dari tim: opsi hosting & biaya]`
- [ ] **Bunga:** PostgreSQL bisa dijalankan di laptop tim untuk pengembangan lokal.

## Rencana cadangan
Jika salah satu syarat gagal: kembali ke **MySQL 8**. Aturan "maks. satu pembayaran diterima" ditegakkan dengan trigger, dan tipe data di ERD Fisik disesuaikan. Perubahan ini dicatat sebagai revisi ADR-001, bukan ADR baru.

> Pemakaian AI: draf ADR ini disusun dengan bantuan AI generatif. Ungkapkan di refleksi individu.
