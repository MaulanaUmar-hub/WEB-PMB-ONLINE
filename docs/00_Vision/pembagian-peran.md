# Pembagian Peran — Kelompok 2 · PMB Online

> Disusun oleh: Maulana Umar Al-Faroq (CEO) · Direview oleh: seluruh anggota · v1.0 · 18 November 2026 (P13)

Peran dikunci di P13. Setelah P13, pergantian peran hanya bisa dilakukan dengan persetujuan dosen.

## Peran utama

| Nama | Peran utama | Domain arsitektur | Tanggung jawab inti |
|---|---|---|---|
| Maulana Umar Al-Faroq | CEO / Product Owner | Business Architecture + Governance | Visi & prioritas backlog, relasi mitra & model bisnis, pimpin stand-up, log Change Request |
| Ratu Nafisah | System Analyst & UI/UX | Application Architecture (kebutuhan) | BPMN, use case, user story, wireframe & prototipe, skenario & laporan UAT |
| Bunga Olivia | Database Officer | Data Architecture | ERD 3NF & kamus data, DDL/constraint/transaksi, backup & migrasi data |
| Rio Octara Abrialdi | Programmer | Application Architecture (implementasi) | Struktur kode & API, fitur MVP end-to-end, Git/PR/code review |
| Muhammad Zaki Rayhan | Network/DevOps + QA* | Technology Architecture + Security | Topologi & IP plan, deploy/HTTPS/backup, biaya infrastruktur (TCO), pengujian |

\* **Catatan penyesuaian:** skenario dosen memakai peran Network/DevOps, sedangkan QA dirangkap bergilir. Tim kita menetapkan QA sebagai peran, jadi Muhammad Zaki Rayhan memegang domain Network/DevOps sekaligus menjadi penanggung jawab kualitas. Status: **menunggu konfirmasi dosen**.

## Rotasi QA & Notulen (wajib dari skenario)

Satu anggota per pertemuan merangkap penguji produk tim sendiri dan pencatat stand-up.

| Pertemuan | Peran yang merangkap | Nama |
|---|---|---|
| P13 | Network/DevOps | Muhammad Zaki Rayhan |
| P14 | CEO | Maulana Umar Al-Faroq |
| P15 | Database | Bunga Olivia |
| P16 | System Analyst | Ratu Nafisah |

## Pasangan kerja

- **Database ↔ Programmer** (Bunga ↔ Rio): pair programming untuk DDL, constraint, dan query fitur, supaya tidak hanya satu orang yang bisa coding.
- **Analyst ↔ Programmer** (Ratu ↔ Rio): cek UI implementasi terhadap prototipe; keduanya membawakan demo live di P16.
- **Network/QA ↔ seluruh tim** (Zaki): uji fitur sebelum setiap gate.

## Pembawa slide pitch P16 (rencana awal)

| Slide | Isi | Pembawa |
|---|---|---|
| 1–2 | Problem & bukti mitra; Architecture Vision & KPI | Maulana |
| 3 | Business Architecture (BPMN to-be) | Ratu |
| 4 | Data Architecture | Bunga |
| 5 | Application Architecture | Rio |
| 6 | Technology Architecture & keamanan | Zaki |
| 7 | Demo live | Rio + Ratu |
| 8 | Hasil UAT & skor SUS | Ratu |
| 9–10 | Roadmap, migrasi, model biaya; Fase G–H | Maulana + tim |
