# Jadwal Gantt — PMB Online

> Disusun oleh: Maulana Umar Al-Faroq (CEO) · Direview oleh: Muhammad Zaki Rayhan (QA) · v1.0 · 18 November 2026
>
> **Asumsi tanggal:** P13 = Rabu 18 Nov 2026, lalu satu pertemuan per minggu (P14 = 25 Nov, P15 = 2 Des, P16 = 9 Des). Ganti tanggal jika jadwal kuliah berbeda.

```mermaid
gantt
    title Sprint Akhir P13–P16 · PMB Online
    dateFormat  YYYY-MM-DD
    axisFormat  %d %b

    section Gate
    Gate 1 Design Review        :milestone, g1, 2026-11-18, 0d
    Gate 2 Build Review         :milestone, g2, 2026-11-25, 0d
    Gate 3 Dry-run Pitch        :milestone, g3, 2026-12-02, 0d
    Demo Day P16                :milestone, g4, 2026-12-09, 0d
    Repository dikumpulkan      :milestone, rp, 2026-12-08, 0d

    section CEO (Maulana)
    Vision, charter, backlog, WBS/RACI/risiko :done, c1, 2026-11-18, 1d
    Konfirmasi mitra & BMC                    :c2, 2026-11-19, 5d
    ADR & CR Kartu Kejutan                    :c3, 2026-11-25, 1d
    Gap analysis & jadwal UAT                 :c4, 2026-11-26, 5d
    Roadmap, model biaya, pitch deck          :c5, 2026-12-02, 6d

    section Analyst (Ratu)
    BPMN, use case, user story, wireframe     :a1, 2026-11-18, 1d
    Prototipe Figma hi-fi                     :a2, 2026-11-19, 5d
    Test case black-box                       :a3, 2026-11-25, 1d
    Skenario UAT & kuesioner SUS              :a4, 2026-11-26, 5d
    UAT & laporan, panduan pengguna           :a5, 2026-12-02, 6d

    section Database (Bunga)
    ERD 3NF & kamus data                      :d1, 2026-11-18, 1d
    DDL + data dummy                          :d2, 2026-11-19, 5d
    Implementasi DB + pair programming        :d3, 2026-11-25, 1d
    Transaksi & skrip backup                  :d4, 2026-11-26, 5d
    Migrasi & uji restore                     :d5, 2026-12-02, 6d

    section Programmer (Rio)
    Pola aplikasi & repo                      :p1, 2026-11-18, 1d
    Login + role, README                      :p2, 2026-11-19, 5d
    F-01 & F-02                               :p3, 2026-11-25, 1d
    F-03 & F-04                               :p4, 2026-11-26, 5d
    F-05, bugfix, rilis v1.0                  :p5, 2026-12-02, 6d

    section Network/QA (Zaki)
    Topologi as-is/to-be, NFR, notulen        :n1, 2026-11-18, 1d
    Opsi hosting & deployment diagram         :n2, 2026-11-19, 5d
    Topologi final & deploy staging           :n3, 2026-11-25, 1d
    Estimasi TCO 12 bulan                     :n4, 2026-11-26, 5d
    Deploy demo, HTTPS, backup, kesiapan demo :n5, 2026-12-02, 6d
```

Feature freeze di akhir P15 (2 Des). Setelah itu hanya perbaikan bug dan persiapan demo.
