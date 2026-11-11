<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact', [
            'judul' => 'Kontak',
            'kontak' => [
                'alamat' => 'Jl. Pendidikan No. 1, Jakarta',
                'email' => 'info@campusinfo.test',
                'telepon' => '(021) 000-0000',
            ],
        ]);
    }
}
