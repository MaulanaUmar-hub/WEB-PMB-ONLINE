# 02_Data — Data Architecture

**Pemilik:** Bunga Olivia (Database Officer)

## Target P13 (Gate 1)
- [ ] `erd-konseptual.png` → `erd-logis.png` (+ file sumber), diturunkan dari use case
- [ ] `kamus-data.md`: tabel, kolom, tipe, constraint, keterangan
- [ ] Bukti normalisasi sampai 3NF

## PR sebelum P14
- [ ] `sql/ddl.sql`: MySQL/PostgreSQL
- [ ] `sql/seed.sql`: data dummy realistis ≥ 30 baris per tabel master

## Selanjutnya
- P14: constraint (PK, FK, unique, check), indeks, view laporan; transaksi proses kritis + skrip backup
- P15: rencana migrasi data dari spreadsheet lama; bukti uji restore

Jangan meng-commit data pribadi asli. Pakai data dummy atau data yang sudah dianonimkan.
