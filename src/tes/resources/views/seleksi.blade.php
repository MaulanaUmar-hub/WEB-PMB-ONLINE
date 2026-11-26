@extends('layouts.app')

@section('title', 'Formulir Pendaftaran')

@section('content')
@include('partials.topbar')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="form-page">
    <div class="container-narrow">

        <h1 class="form-title">Formulir pendaftaran</h1>
        <div class="title-line"></div>
        <p class="form-sub">Isi sesuai dokumen resmi. Data masih bisa diubah sebelum dikonfirmasi.</p>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">Ada isian yang belum benar. Periksa kembali form di bawah.</div>
        @endif

        {{-- Stepper --}}
        <div class="stepper">
            <div class="step active"><span>01</span> Jalur dan biodata</div>
            <div class="step"><span>02</span> Program studi</div>
            <div class="step"><span>03</span> Konfirmasi</div>
        </div>

        <form method="POST" action="{{ route('seleksi.store') }}" novalidate>
            @csrf

            {{-- ===== Jalur dan kelas ===== --}}
            <div class="panel">
                <h2>Jalur dan kelas</h2>

                <div class="field">
                    <label for="jalur">Jalur pendaftaran *</label>
                    <select id="jalur" name="jalur" class="@error('jalur') invalid @enderror">
                        @foreach ($jalurList as $j)
                            <option value="{{ $j }}" @selected(old('jalur', $pendaftar->jalur ?? '') === $j)>{{ $j }}</option>
                        @endforeach
                    </select>
                    @error('jalur') <small class="err">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label for="kelas_id">Kelas *</label>
                    <select id="kelas_id" name="kelas_id" class="@error('kelas_id') invalid @enderror">
                        @foreach ($kelasList as $k)
                            <option value="{{ $k->id }}" @selected((string) old('kelas_id', $pendaftar->kelas_id ?? '') === (string) $k->id)>
                                {{ $k->nama }}{{ $k->keterangan ? ' (' . $k->keterangan . ')' : '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelas_id') <small class="err">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label for="gelombang">Jalur pendaftaran (gelombang) *</label>
                    <select id="gelombang" name="gelombang" class="@error('gelombang') invalid @enderror">
                        @foreach ($gelombang as $key => $g)
                            <option value="{{ $key }}"
                                @selected(old('gelombang', $pendaftar->gelombang ?? '') === $key)
                                @disabled(!$g['dibuka'])>
                                {{ $g['label'] }}{{ $g['dibuka'] ? '' : ' - belum dibuka' }}
                            </option>
                        @endforeach
                    </select>
                    <small class="hint">Hanya gelombang yang sedang dibuka yang bisa dipilih.</small>
                    @error('gelombang') <small class="err">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- ===== Data diri ===== --}}
            <div class="panel">
                <h2>Data diri</h2>

                <div class="field">
                    <label for="nama">Nama lengkap *</label>
                    <input id="nama" type="text" name="nama" placeholder="Sesuai ijazah / KTP"
                           value="{{ old('nama', $biodata->nama ?? '') }}"
                           class="@error('nama') invalid @enderror">
                    @error('nama') <small class="err">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label for="nik">NIK *</label>
                    <input id="nik" type="text" name="nik" inputmode="numeric" maxlength="16"
                           placeholder="16 digit" value="{{ old('nik', $biodata->nik ?? '') }}"
                           class="@error('nik') invalid @enderror">
                    <small class="hint">NIK harus 16 digit angka.</small>
                    @error('nik') <small class="err">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label for="no_kk">No. KK *</label>
                    <input id="no_kk" type="text" name="no_kk" inputmode="numeric" maxlength="16"
                           placeholder="16 digit" value="{{ old('no_kk', $biodata->no_kk ?? '') }}"
                           class="@error('no_kk') invalid @enderror">
                    @error('no_kk') <small class="err">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label for="tempat_lahir">Tempat lahir *</label>
                    <input id="tempat_lahir" type="text" name="tempat_lahir" placeholder="Kota atau kabupaten"
                           value="{{ old('tempat_lahir', $biodata->tempat_lahir ?? '') }}"
                           class="@error('tempat_lahir') invalid @enderror">
                    @error('tempat_lahir') <small class="err">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label for="tanggal_lahir">Tanggal lahir *</label>
                    <input id="tanggal_lahir" type="date" name="tanggal_lahir"
                           max="{{ now()->subDay()->toDateString() }}"
                           value="{{ old('tanggal_lahir', $biodata?->tanggal_lahir?->format('Y-m-d')) }}"
                           class="@error('tanggal_lahir') invalid @enderror">
                    @error('tanggal_lahir') <small class="err">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label for="gender">Jenis kelamin *</label>
                    <select id="gender" name="gender" class="@error('gender') invalid @enderror">
                        <option value="">Pilih jenis kelamin</option>
                        @foreach ($genderList as $val => $label)
                            <option value="{{ $val }}" @selected(old('gender', $biodata->gender ?? '') === $val)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('gender') <small class="err">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label for="alamat">Alamat *</label>
                    <textarea id="alamat" name="alamat" rows="4"
                              placeholder="Jalan, kelurahan, kecamatan, kota"
                              class="@error('alamat') invalid @enderror">{{ old('alamat', $biodata->alamat ?? '') }}</textarea>
                    @error('alamat') <small class="err">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label for="no_hp">No. HP *</label>
                    <input id="no_hp" type="tel" name="no_hp" inputmode="tel" maxlength="16"
                           placeholder="081234567890" value="{{ old('no_hp', $biodata->no_hp ?? '') }}"
                           class="@error('no_hp') invalid @enderror">
                    @error('no_hp') <small class="err">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label for="nisn">NISN *</label>
                    <input id="nisn" type="text" name="nisn" inputmode="numeric" maxlength="10"
                           placeholder="10 digit" value="{{ old('nisn', $biodata->nisn ?? '') }}"
                           class="@error('nisn') invalid @enderror">
                    @error('nisn') <small class="err">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label for="asal_sekolah">Sekolah asal *</label>
                    <input id="asal_sekolah" type="text" name="asal_sekolah" placeholder="Ketik nama sekolah"
                           value="{{ old('asal_sekolah', $biodata->asal_sekolah ?? '') }}"
                           class="@error('asal_sekolah') invalid @enderror">
                    @error('asal_sekolah') <small class="err">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label for="sumber_info">Dari mana Anda mengetahui PMB UNH *</label>
                    <select id="sumber_info" name="sumber_info" class="@error('sumber_info') invalid @enderror">
                        <option value="">Pilih sumber informasi</option>
                        @foreach ($sumberList as $s)
                            <option value="{{ $s }}" @selected(old('sumber_info', $pendaftar->sumber_info ?? '') === $s)>{{ $s }}</option>
                        @endforeach
                    </select>
                    @error('sumber_info') <small class="err">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- ===== Orang tua / wali ===== --}}
            <div class="panel">
                <h2>Orang tua / wali</h2>

                <div class="field">
                    <label for="nama_ayah">Nama ayah *</label>
                    <input id="nama_ayah" type="text" name="nama_ayah" placeholder="Nama lengkap ayah"
                           value="{{ old('nama_ayah', $biodata->nama_ayah ?? '') }}"
                           class="@error('nama_ayah') invalid @enderror">
                    @error('nama_ayah') <small class="err">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label for="nama_ibu">Nama ibu *</label>
                    <input id="nama_ibu" type="text" name="nama_ibu" placeholder="Nama lengkap ibu"
                           value="{{ old('nama_ibu', $biodata->nama_ibu ?? '') }}"
                           class="@error('nama_ibu') invalid @enderror">
                    @error('nama_ibu') <small class="err">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label for="nama_wali">Nama wali (opsional)</label>
                    <input id="nama_wali" type="text" name="nama_wali" placeholder="Isi jika ada wali"
                           value="{{ old('nama_wali', $biodata->nama_wali ?? '') }}"
                           class="@error('nama_wali') invalid @enderror">
                    @error('nama_wali') <small class="err">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label for="no_hp_wali">No. HP wali</label>
                    <input id="no_hp_wali" type="tel" name="no_hp_wali" inputmode="tel" maxlength="16"
                           placeholder="081234567890" value="{{ old('no_hp_wali', $biodata->no_hp_wali ?? '') }}"
                           class="@error('no_hp_wali') invalid @enderror">
                    <small class="hint">Wajib diisi jika nama wali diisi.</small>
                    @error('no_hp_wali') <small class="err">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" name="aksi" value="draft" class="btn btn-grey">Simpan draft</button>
                <button type="submit" name="aksi" value="lanjut" class="btn btn-dark">Simpan dan lanjut</button>
            </div>
        </form>
    </div>
</div>
@endsection
