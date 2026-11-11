<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class ArchitectureController extends Controller
{
    public function dashboard(): View
    {
        // daftar folder penting di root project Laravel 12 beserta fungsinya
        $folders = [
            ['nama' => 'app/', 'fungsi' => 'Kode aplikasi: Controller, Model, Provider, Middleware'],
            ['nama' => 'bootstrap/', 'fungsi' => 'Bootstrap framework; membuat instance aplikasi dan cache'],
            ['nama' => 'config/', 'fungsi' => 'File konfigurasi (app, database, session, dll.)'],
            ['nama' => 'database/', 'fungsi' => 'Migration, seeder, factory'],
            ['nama' => 'public/', 'fungsi' => 'Entry point index.php dan aset publik'],
            ['nama' => 'resources/', 'fungsi' => 'View Blade, CSS, JS mentah'],
            ['nama' => 'routes/', 'fungsi' => 'Definisi route web.php, api.php, console.php'],
            ['nama' => 'storage/', 'fungsi' => 'Log, cache file, upload, session file'],
        ];

        return view('architecture.dashboard', [
            'judul' => 'Architecture Dashboard',
            'folders' => $folders,
        ]);
    }

    public function lifecycle(): View
    {
        // tahapan request dari browser sampai response
        $tahap = [
            ['label' => 'Browser', 'detail' => 'GET /program-studi'],
            ['label' => 'public/index.php', 'detail' => 'Entry point, load autoload'],
            ['label' => 'bootstrap/app.php', 'detail' => 'Buat instance aplikasi'],
            ['label' => 'HTTP Kernel', 'detail' => 'Jalankan middleware global'],
            ['label' => 'Router', 'detail' => 'Cocokkan dengan routes/web.php'],
            ['label' => 'Controller', 'detail' => 'ProgramStudiController@index'],
            ['label' => 'Blade View', 'detail' => 'resources/views/programs.blade.php'],
            ['label' => 'Response', 'detail' => 'HTML dikirim ke browser'],
        ];

        return view('architecture.lifecycle', [
            'judul' => 'Request Lifecycle',
            'tahap' => $tahap,
        ]);
    }

    public function environment(): View
    {
        // hanya info aman, TANPA APP_KEY, password DB, atau secret lain
        $info = [
            'Nama aplikasi' => config('app.name'),
            'Environment' => app()->environment(),
            'Debug mode' => config('app.debug') ? 'Aktif' : 'Nonaktif',
            'Versi Laravel' => app()->version(),
            'Versi PHP' => PHP_VERSION,
            'Timezone' => config('app.timezone'),
            'Locale' => config('app.locale'),
        ];

        return view('architecture.environment', [
            'judul' => 'Environment',
            'info' => $info,
        ]);
    }
}
