<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class ProgramStudiController extends Controller
{
    public function index(): View
    {
        $programs = [
            ['nama' => 'Teknik Informatika', 'jenjang' => 'S1', 'akreditasi' => 'Unggul'],
            ['nama' => 'Sistem Informasi', 'jenjang' => 'S1', 'akreditasi' => 'Baik Sekali'],
            ['nama' => 'Manajemen', 'jenjang' => 'S1', 'akreditasi' => 'Baik'],
        ];

        return view('programs', [
            'judul' => 'Program Studi',
            'programs' => $programs,
        ]);
    }
}
