# Definition of Done (DoD) Tim

> Disusun oleh: Maulana Umar Al-Faroq (CEO) · Direview oleh: Muhammad Zaki Rayhan (QA) · v1.0 · 18 November 2026

## DoD per item kerja

**Dokumen/diagram dianggap selesai jika:**
- [ ] Memuat "Disusun oleh / Direview oleh", versi, dan tanggal
- [ ] Konsisten dengan dokumen domain lain (ERD ↔ use case ↔ prototipe ↔ BPMN)
- [ ] Terhubung ke baris di matriks ketelusuran
- [ ] Sumber diagram dan ekspor gambarnya sama-sama di-commit
- [ ] Sudah direview 1 anggota lewat pull request dan di-merge ke `dev`

**Fitur kode dianggap selesai jika (mulai P14):**
- [ ] Berjalan end-to-end: UI → logika → database nyata
- [ ] Memenuhi kriteria penerimaan user story
- [ ] Lulus test case black-box dari System Analyst, dan diuji QA
- [ ] Di-merge lewat pull request yang direview
- [ ] README/dokumentasi endpoint diperbarui

## DoD Gate 1 · Design Review (P13)

- [ ] Architecture Vision dibekukan sebagai v1.0
- [ ] Matriks ketelusuran ≥ 5 baris: kebutuhan → use case → tabel → layar
- [ ] ERD 3NF konsisten dengan use case
- [ ] Backlog MoSCoW, fitur Must maksimal 5
- [ ] Repo & papan kerja aktif; tiap anggota punya kartu atau commit
- [ ] Artefak khusus kelompok 2: WBS, Gantt, RACI, register risiko, BPMN daftar → verifikasi → bayar → pengumuman

Keputusan gate: Hijau = lanjut · Kuning = syarat dipenuhi sebelum P14 · Merah = klinik tambahan dengan dosen.

## DoD Gate 2 · Build Review (P14)

- [ ] Demo langsung 2 fitur Must end-to-end dengan database nyata
- [ ] ADR tech stack tertulis dan disetujui CEO
- [ ] Topologi + deployment diagram final; versi awal ter-deploy ke staging
- [ ] CR dari Kartu Kejutan terdokumentasi dengan keputusan
- [ ] Tidak ada anggota dengan nol kontribusi di repo atau artefak

## DoD Gate 3 · Dry-run Pitch (P15)

- [ ] MVP feature-complete, ter-deploy, dan bisa diakses dosen
- [ ] Laporan UAT dengan bukti dan skor SUS
- [ ] Architecture Roadmap dan rencana migrasi tersedia
- [ ] Restore backup terbukti berhasil
- [ ] Dry-run pitch 7 menit di depan kelas
