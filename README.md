# PMB Online — Kelompok 2 · Arsitektur Sistem Perusahaan (R001)

Web Penerimaan Mahasiswa Baru (PMB) untuk universitas: calon mahasiswa mendaftar dan mengunggah berkas, panitia memverifikasi, pendaftar membayar, hasil diumumkan, dan data pendaftar diterima diekspor dalam format siap impor.

Proyek ini dikerjakan sebagai role play startup berbasis **TOGAF ADM** (Fase C–H) selama Sprint Akhir P13–P16.

## Tim

| Nama | Peran utama | Domain arsitektur |
|---|---|---|
| Maulana Umar Al-Faroq | CEO / Product Owner | Business Architecture + Governance |
| Ratu Nafisah | System Analyst & UI/UX | Application Architecture (kebutuhan) |
| Bunga Olivia | Database Officer | Data Architecture |
| Rio Octara Abrialdi | Programmer | Application Architecture (implementasi) |
| Muhammad Zaki Rayhan | QA → Network/DevOps* | Technology Architecture + Security |

\* Menunggu konfirmasi dosen. Lihat [pembagian peran](docs/00_Vision/pembagian-peran.md).

## Fitur Must MVP (maksimal 5)

| ID | Fitur |
|---|---|
| F-01 | Daftar & unggah berkas |
| F-02 | Verifikasi berkas |
| F-03 | Pembayaran |
| F-04 | Pengumuman hasil seleksi |
| F-05 | Ekspor data pendaftar diterima |

Detail prioritas ada di [backlog MoSCoW](docs/06_Governance/P13_Backlog_MoSCoW_DoD_Ketelusuran.pdf).

## Struktur repo

```
.
├── docs/                      Architecture Repository (dikumpulkan H-1 sebelum P16)
│   ├── 00_Vision/             Vision, stakeholder, team charter, pembagian peran
│   ├── 01_Business/           BPMN as-is & to-be, Business Model Canvas
│   ├── 02_Data/               ERD, kamus data, SQL (DDL, seed), migrasi
│   ├── 03_Application/        Use case, user story, wireframe, prototipe
│   ├── 04_Technology/         Topologi, deployment, keamanan, TCO
│   ├── 05_Opportunities/      Gap analysis, roadmap, rencana implementasi
│   ├── 06_Governance/         Backlog, DoD, WBS, Gantt, RACI, risiko, ADR, log CR, ProjectLibre, RAB
│   ├── 07_Evidence/           Notulen stand-up, bukti mitra, UAT, SUS
│   └── 09_Pitch/              Pitch deck final
├── src/                       Kode aplikasi (08_Source = repo ini: tag v1.0, changelog)
├── CONTRIBUTING.md            Alur branch, commit, dan pull request
└── .github/                   Template PR dan issue
```

## Jadwal sprint

| Pertemuan | Fase | Fokus | Gate |
|---|---|---|---|
| P13 | C | Architecture Freeze & Desain Sistem | Gate 1 · Design Review |
| P14 | D | Technology Architecture & Build | Gate 2 · Build Review |
| P15 | E–F | Integrasi, UAT & Roadmap | Gate 3 · Dry-run Pitch |
| P16 | G–H | Demo Day & Penilaian Akhir | Panel 4 dosen |

## Cara menjalankan aplikasi

Diisi Programmer di P13 (PR sebelum P14): prasyarat, instalasi, konfigurasi database, dan perintah menjalankan. Lihat [src/README.md](src/README.md).
