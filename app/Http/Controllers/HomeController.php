<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // data array dikirim dari controller ke Blade, tanpa database
        $data = [
            'judul' => 'Selamat Datang di CampusInfo',
            'deskripsi' => 'Informasi kampus dasar: program studi dan kontak.',
            'highlights' => [
                'Tiga halaman utama: Beranda, Program Studi, Kontak',
                'Routing menggunakan route() dengan named routes',
                'Tampilan dipisah lewat Blade layout',
            ],
        ];

        return view('home', $data);
    }
}
