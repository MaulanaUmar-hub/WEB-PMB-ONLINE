<?php

namespace App\Http\Controllers;

use App\Models\DataPendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CRUD_Pendaftaran extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create()
    {
        return view('pendaftaran.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jalur'     => 'required|string|max:255',
            'gelombang' => 'required|string|max:255',
            'pilihan1'  => 'required|string|max:255',
            'pilihan2'  => 'nullable|string|max:255|different:pilihan1',
            'pilihan3'  => 'nullable|string|max:255|different:pilihan1|different:pilihan2',
        ]);

        // email diambil dari akun yang login, bukan dari input form
        $data['email']  = Auth::user()->email;
        $data['status'] = 'draft';

        DataPendaftar::create($data);

        return redirect('/')->with('success', 'Pendaftaran berhasil!');
    }
}