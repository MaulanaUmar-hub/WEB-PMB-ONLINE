@if (session('success'))
    {{ session('success') }}
    <br>
@endif

@foreach ($errors->all() as $error)
    {{ $error }}
    <br>
@endforeach

<form method="POST" action="{{ route('pendaftaran.store') }}">
    @csrf

    Jalur
    <select name="jalur">
        <option value="Reguler" @selected(old('jalur') == 'Reguler')>Reguler</option>
        <option value="Prestasi" @selected(old('jalur') == 'Prestasi')>Prestasi</option>
        <option value="Mandiri" @selected(old('jalur') == 'Mandiri')>Mandiri</option>
    </select>
    <br>

    Gelombang
    <select name="gelombang">
        <option value="Gelombang 1" @selected(old('gelombang') == 'Gelombang 1')>Gelombang 1</option>
        <option value="Gelombang 2" @selected(old('gelombang') == 'Gelombang 2')>Gelombang 2</option>
        <option value="Gelombang 3" @selected(old('gelombang') == 'Gelombang 3')>Gelombang 3</option>
    </select>
    <br>

    Pilihan 1
    <select name="pilihan1">
        @foreach (['sisfor', 'it', 'bank', 'cihuy'] as $prodi)
            <option value="{{ $prodi }}" @selected(old('pilihan1') == $prodi)>{{ $prodi }}</option>
        @endforeach
    </select>
    <br>

    Pilihan 2
    <select name="pilihan2">
        <option value="">-</option>
        @foreach (['sisfor', 'it', 'bank', 'cihuy'] as $prodi)
            <option value="{{ $prodi }}" @selected(old('pilihan2') == $prodi)>{{ $prodi }}</option>
        @endforeach
    </select>
    <br>

    Pilihan 3
    <select name="pilihan3">
        <option value="">-</option>
        @foreach (['sisfor', 'it', 'bank', 'cihuy'] as $prodi)
            <option value="{{ $prodi }}" @selected(old('pilihan3') == $prodi)>{{ $prodi }}</option>
        @endforeach
    </select>
    <br>

    <button type="submit">Simpan</button>
</form>
