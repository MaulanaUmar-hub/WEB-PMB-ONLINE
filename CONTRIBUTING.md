# Panduan Kontribusi

> Disusun oleh: Maulana Umar Al-Faroq (CEO) · Direview oleh: Rio Octara Abrialdi (Programmer) · v1.0 · 18 November 2026

Repo ini dilihat dosen. **Commit, pull request, dan kartu papan kerja adalah bukti kontribusi** yang menentukan nilai individu dan Faktor Kontribusi (PF). Jadi setiap anggota meng-commit pekerjaannya sendiri dari akunnya sendiri.

## 1. Strategi branch

```
main      ← versi stabil, hanya diisi lewat PR dari dev (di-merge CEO)
dev       ← integrasi, diisi lewat PR dari branch anggota
<branch anggota / feature/*>  ← tempat kerja harian
```

| Anggota | Peran | Branch kerja | Folder utama |
|---|---|---|---|
| Maulana Umar Al-Faroq | CEO / PO | branch CEO | `docs/00_Vision`, `docs/06_Governance`, `docs/05_Opportunities`, `docs/09_Pitch` |
| Ratu Nafisah | System Analyst & UI/UX | branch Analyst | `docs/01_Business` (BPMN), `docs/03_Application` |
| Bunga Olivia | Database Officer | branch Database | `docs/02_Data` |
| Rio Octara Abrialdi | Programmer | branch Programmer | `src/` |
| Muhammad Zaki Rayhan | Network/DevOps + QA | branch Network/QA | `docs/04_Technology`, `docs/07_Evidence/notulen` |

Sesuaikan kolom "Branch kerja" dengan nama branch yang sudah dibuat di GitHub. Mulai P14, fitur kode memakai branch `feature/<id-fitur>-<nama-singkat>`, misalnya `feature/F-01-pendaftaran`.

## 2. Alur kerja harian

```bash
git checkout <branch-kamu>
git pull origin <branch-kamu>
git merge origin/dev            # ambil perubahan terbaru tim
# ... kerjakan tugasmu ...
git add <file>
git commit -m "docs(data): ERD konseptual v0.1"
git push origin <branch-kamu>
```

Lalu buka **Pull Request ke `dev`** dan minta minimal 1 reviewer. Jangan push langsung ke `main` atau `dev`.

## 3. Format commit

`<tipe>(<area>): <ringkasan singkat>`

| Tipe | Dipakai untuk |
|---|---|
| `docs` | dokumen arsitektur, notulen, laporan |
| `feat` | fitur baru di kode |
| `fix` | perbaikan bug |
| `db` | DDL, seed, migrasi, backup |
| `chore` | konfigurasi, struktur folder |
| `test` | test case, skenario UAT |

Area: `vision`, `business`, `data`, `app`, `tech`, `gov`, `evidence`, `pitch`, `src`.

Contoh: `docs(business): BPMN to-be alur verifikasi`, `feat(src): F-01 form pendaftaran`, `db(data): DDL tabel pendaftar`.

## 4. Aturan dokumen

1. Setiap dokumen diawali baris **"Disusun oleh: … · Direview oleh: … · versi · tanggal"**.
2. Diagram (BPMN, ERD, topologi) disimpan dalam dua bentuk: **file sumber** (`.bpmn`, `.drawio`, `.mwb`, dsb.) dan **ekspor gambar** (`.png`/`.pdf`).
3. Setiap artefak harus bisa ditelusuri di [matriks ketelusuran](docs/06_Governance/traceability-matrix.md).
4. Keputusan teknologi dicatat sebagai ADR di `docs/06_Governance/adr/`.
5. Permintaan baru dari mitra atau dosen masuk [log CR](docs/06_Governance/cr-log.md), bukan langsung dikerjakan.
6. Jangan meng-commit data pribadi asli pendaftar. Pakai data dummy atau data yang sudah dianonimkan.
7. Pemakaian AI generatif dicatat (alat apa, untuk apa) karena wajib diungkapkan di refleksi individu.

## 5. Review pull request

- Reviewer mengecek isi terhadap [Definition of Done](docs/06_Governance/definition-of-done.md).
- PR dokumen boleh di-merge setelah 1 approval. PR kode butuh 1 approval dari anggota selain penulis.
- Merge `dev → main` dilakukan CEO sebelum setiap gate (P13, P14, P15) dan sebelum Demo Day.
