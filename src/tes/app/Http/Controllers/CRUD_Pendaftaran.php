<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\DataPendaftar;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CRUD_Pendaftaran extends Controller
{
    private const JALUR = [
        'Reguler',
        'Beasiswa',
        'Rekognisi Pembelajaran Lampau (RPL)',
        'Beasiswa KIP',
        'Beasiswa SMA Plus & SMK Binaan Yayasan',
    ];

    // value => label. Sesuaikan value dengan tipe kolom `gender` di database
    // (cek: DESCRIBE biodata;). Kalau enum('Laki-laki','Perempuan'), ganti key-nya.
    private const GENDER = [
        'L' => 'Laki-laki',
        'P' => 'Perempuan',
    ];

    private const SUMBER = [
        'Instagram',
        'Facebook',
        'YouTube',
        'Teman / keluarga',
        'Sosialisasi sekolah',
        'Brosur / spanduk',
        'Lainnya',
    ];

    // Nomor HP Indonesia: 08xx..., 628xx..., atau +628xx...
    private const REGEX_HP = '/^(\+62|62|0)8[1-9][0-9]{6,11}$/';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Daftar gelombang. Nanti bisa dipindah ke tabel / config.
     * 'dibuka' => false berarti tampil tapi tidak bisa dipilih.
     */
    private function gelombang(): array
    {
        return [
            'Gelombang 1' => ['label' => 'Gelombang 1 (13 Oktober 2026 - 30 April 2027)', 'dibuka' => true],
            'Gelombang 2' => ['label' => 'Gelombang 2 (1 Mei - 31 Juli 2027)',            'dibuka' => false],
            'Gelombang 3' => ['label' => 'Gelombang 3 (1 Agustus - 15 Oktober 2027)',     'dibuka' => false],
        ];
    }

    private function draftMilikUser(): ?DataPendaftar
    {
        return DataPendaftar::with('biodata')
            ->where('email', Auth::user()->email)
            ->where('status', 'draft')
            ->first();
    }

    public function show()
    {
        $pendaftar = $this->draftMilikUser();

        return view('seleksi', [
            'pendaftar'  => $pendaftar,
            'biodata'    => $pendaftar?->biodata,
            'jalurList'  => self::JALUR,
            'kelasList'  => Kelas::aktif()->orderBy('id')->get(),
            'genderList' => self::GENDER,
            'sumberList' => self::SUMBER,
            'gelombang'  => $this->gelombang(),
        ]);
    }

    public function store(Request $request)
    {
        $pendaftar = $this->draftMilikUser();
        $lanjut    = $request->input('aksi') === 'lanjut';

        // Simpan draft = boleh belum lengkap, Simpan dan lanjut = semua wajib
        $wajib = $lanjut ? 'required' : 'nullable';

        $gelombangDibuka = collect($this->gelombang())
            ->filter(fn ($g) => $g['dibuka'])
            ->keys()
            ->all();

        $data = $request->validate([
            // Jalur dan kelas
            'jalur'         => ['required', Rule::in(self::JALUR)],
            'kelas_id'      => ['required', Rule::exists('kelas', 'id')->where('aktif', true)],
            'gelombang'     => ['required', Rule::in($gelombangDibuka)],

            // Data diri
            'nama'          => ['required', 'string', 'max:255'],
            'nik'           => [
                $wajib, 'digits:16',
                Rule::unique('biodata', 'nik')->ignore($pendaftar?->idpendaftar, 'idpendaftar'),
            ],
            'no_kk'         => [$wajib, 'digits:16'],
            'tempat_lahir'  => [$wajib, 'string', 'max:100'],
            'tanggal_lahir' => [$wajib, 'date', 'before:today'],
            'gender'        => [$wajib, Rule::in(array_keys(self::GENDER))],
            'alamat'        => [$wajib, 'string', 'max:500'],
            'no_hp'         => [$wajib, 'regex:' . self::REGEX_HP],
            'nisn'          => [$wajib, 'digits:10'],
            'asal_sekolah'  => [$wajib, 'string', 'max:255'],
            'sumber_info'   => [$wajib, Rule::in(self::SUMBER)],

            // Orang tua / wali
            'nama_ayah'     => [$wajib, 'string', 'max:255'],
            'nama_ibu'      => [$wajib, 'string', 'max:255'],
            'nama_wali'     => ['nullable', 'string', 'max:255'],
            'no_hp_wali'    => ['nullable', 'required_with:nama_wali', 'regex:' . self::REGEX_HP],
        ], [
            'nik.digits'            => 'NIK harus 16 digit angka.',
            'nik.unique'            => 'NIK ini sudah terdaftar.',
            'no_kk.digits'          => 'No. KK harus 16 digit angka.',
            'nisn.digits'           => 'NISN harus 10 digit angka.',
            'tanggal_lahir.before'  => 'Tanggal lahir tidak valid.',
            'gelombang.in'          => 'Gelombang yang dipilih belum dibuka.',
            'no_hp.regex'           => 'Format No. HP tidak valid (contoh: 081234567890).',
            'no_hp_wali.regex'      => 'Format No. HP wali tidak valid (contoh: 081234567890).',
            'no_hp_wali.required_with' => 'No. HP wali wajib diisi jika nama wali diisi.',
        ]);

        DB::transaction(function () use ($data) {
            $pendaftar = DataPendaftar::updateOrCreate(
                ['email' => Auth::user()->email, 'status' => 'draft'],
                [
                    'jalur'       => $data['jalur'],
                    'kelas_id'    => $data['kelas_id'],
                    'gelombang'   => $data['gelombang'],
                    'sumber_info' => $data['sumber_info'] ?? null,
                ]
            );

            Biodata::updateOrCreate(
                ['idpendaftar' => $pendaftar->idpendaftar],
                [
                    'nama'          => $data['nama'],
                    'nik'           => $data['nik'] ?? null,
                    'no_kk'         => $data['no_kk'] ?? null,
                    'tempat_lahir'  => $data['tempat_lahir'] ?? null,
                    'tanggal_lahir' => $data['tanggal_lahir'] ?? null,
                    'gender'        => $data['gender'] ?? null,
                    'alamat'        => $data['alamat'] ?? null,
                    'no_hp'         => $data['no_hp'] ?? null,
                    'nisn'          => $data['nisn'] ?? null,
                    'asal_sekolah'  => $data['asal_sekolah'] ?? null,
                    'nama_ayah'     => $data['nama_ayah'] ?? null,
                    'nama_ibu'      => $data['nama_ibu'] ?? null,
                    'nama_wali'     => $data['nama_wali'] ?? null,
                    'no_hp_wali'    => $data['no_hp_wali'] ?? null,
                ]
            );
        });

        if ($lanjut) {
            // TODO: ganti ke langkah 2 (Program studi) kalau sudah dibuat:
            // return redirect()->route('seleksi.prodi');
            return redirect()->route('seleksi.show')
                ->with('success', 'Langkah 1 tersimpan.');
        }

        return redirect()->route('seleksi.show')
            ->with('success', 'Draft berhasil disimpan.');
    }

    public function cekkelulusan()
    {
        $email   = Auth::user()->email;
        $results = DataPendaftar::where('email', $email)->get();

        return view('cek', compact('results'));
    }
}
