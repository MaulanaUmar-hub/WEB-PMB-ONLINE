<head><link rel="stylesheet" href="{{ asset('css/style.css')}}"> </head>

@include('partials.topbar')

@extends('layouts.app')

@section('title', 'Penerimaan Mahasiswa Baru 2027/2028')

@section('content')

@php
    $jalur = [
        ['no' => '01', 'nama' => 'Reguler',                                   'ket' => 'Jalur seleksi umum untuk lulusan SMA/SMK sederajat.'],
        ['no' => '02', 'nama' => 'Beasiswa',                                  'ket' => ''],
        ['no' => '03', 'nama' => 'Rekognisi Pembelajaran Lampau (RPL)',       'ket' => ''],
        ['no' => '04', 'nama' => 'Beasiswa KIP',                              'ket' => ''],
        ['no' => '05', 'nama' => 'Beasiswa SMA Plus & SMK Binaan Yayasan',    'ket' => ''],
    ];

    $gelombang = [
        ['nama' => 'Gelombang 1', 'status' => 'DIBUKA',        'tanggal' => '14 Oktober 2026 – 28 April 2027', 'aktif' => true],
        ['nama' => 'Gelombang 2', 'status' => 'SEGERA DIBUKA', 'tanggal' => '1 Mei – 31 Juli 2027',            'aktif' => false],
        ['nama' => 'Gelombang 3', 'status' => 'SEGERA DIBUKA', 'tanggal' => '1 Agustus – 15 Oktober 2027',     'aktif' => false],
    ];

    $prodi = ['Sistem Informasi', 'Teknik Informatika', 'Teknologi Informasi', 'Ilmu Pemerintahan', 'Ilmu Komunikasi'];
@endphp

{{-- HERO --}}
<section class="landingpage">
    <div class="container two-col">
        <div class="hero-text">
            <span class="badge">Gelombang 1 dibuka 14 Oktober 2026 – 28 April 2027</span>
            <h1>PENERIMAAN MAHASISWA BARU 2027/2028</h1>
            <p>
                Universitas Nurdin Hamzah membuka lima program studi S1 dengan kelas malam. Daftar,
                bayar, dan pantau status pendaftaran Anda dari satu akun.
            </p>
            <div class="btn-row">
                <a href="/daftar" class="btn btn-solid">Daftar Sekarang</a>
                <a href="#jalur" class="btn btn-outline">Lihat jalur pendaftaran</a>
            </div>
        </div>

        <div class="gambar">GAMBAR</div>
    </div>
</section>

{{-- JALUR --}}
<section class="jalur" id="jalur">
    <div class="container two-col jalur-grid">
        <div class="jalur-intro">
            <h2>Pilih Jalur Pendaftaran:</h2>
            <p>Berikut ini adalah informasi jalur masuk yang dibuka pada Penerimaan Mahasiswa Baru (PMB) Tahun akademik 2027/2028</p>
            <a href="#" class="btn btn-dark">&#8681; Unduh Brosur</a>
        </div>

        <div class="jalur-cards">
            @foreach ($jalur as $j)
                <div class="card {{ $loop->last ? 'span-2' : '' }}">
                    <span class="card-no">{{ $j['no'] }}</span>
                    <strong>{{ $j['nama'] }}</strong>
                    @if ($j['ket'])
                        <small>{{ $j['ket'] }}</small>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- JADWAL --}}
<section class="jadwal">
    <div class="container">
        <h2>Jadwal Pendaftaran 2027/2028</h2>
        <div class="cards-3">
            @foreach ($gelombang as $g)
                <div class="card">
                    <div class="card-head">
                        <strong>{{ $g['nama'] }}</strong>
                        <span class="tag {{ $g['aktif'] ? 'tag-active' : '' }}">{{ $g['status'] }}</span>
                    </div>
                    <small>{{ $g['tanggal'] }}</small>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PROGRAM STUDI --}}
<section class="prodi" id="program-studi">
    <div class="container">
        <h2>Program Studi S1</h2>
        <div class="cards-5">
            @foreach ($prodi as $p)
                <div class="card">
                    <span class="card-no">S1</span>
                    <strong>{{ $p }}</strong>
                </div>
            @endforeach
        </div>
    </div>
</section>

<div class="contact">
    <div class="onethirdwidth">
        <a href="/cek">Cek kelulusan</a> <br>
    </div>

    <div class="onethirdwidth">
        <a href="/seleksi">Seleksi online</a><br>
    </div>
    
    <div class="onethirdwidth">
        <a href="/daftarulang">daftar ulang</a>
    </div>
</div>

@endsection
