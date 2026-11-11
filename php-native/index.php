<?php
// PHP native: tanpa framework. Routing manual lewat $_GET, data hardcode di file ini.
// Jalankan: php -S localhost:8000 -t php-native

$halaman = $_GET['page'] ?? 'beranda';

$programs = [
    ['nama' => 'Teknik Informatika', 'jenjang' => 'S1', 'akreditasi' => 'Unggul'],
    ['nama' => 'Sistem Informasi', 'jenjang' => 'S1', 'akreditasi' => 'Baik Sekali'],
    ['nama' => 'Manajemen', 'jenjang' => 'S1', 'akreditasi' => 'Baik'],
];

function layout(string $judul, string $isi): void {
    echo "<!DOCTYPE html><html lang=\"id\"><head><meta charset=\"UTF-8\"><title>$judul - CampusInfo</title></head><body>";
    echo '<nav><a href="?page=beranda">Beranda</a> | <a href="?page=program-studi">Program Studi</a> | <a href="?page=kontak">Kontak</a></nav><main>';
    echo $isi;
    echo '</main></body></html>';
}

switch ($halaman) {
    case 'program-studi':
        $isi = '<h1>Program Studi</h1><table border="1"><tr><th>Program Studi</th><th>Jenjang</th><th>Akreditasi</th></tr>';
        foreach ($programs as $p) {
            $isi .= "<tr><td>{$p['nama']}</td><td>{$p['jenjang']}</td><td>{$p['akreditasi']}</td></tr>";
        }
        $isi .= '</table>';
        layout('Program Studi', $isi);
        break;

    case 'kontak':
        layout('Kontak', '<h1>Kontak</h1><p>Alamat: Jl. Pendidikan No. 1, Jakarta</p><p>Email: info@campusinfo.test</p><p>Telepon: (021) 000-0000</p>');
        break;

    default:
        layout('Beranda', '<h1>Selamat Datang di CampusInfo</h1><p>Informasi kampus dasar: program studi dan kontak.</p>');
        break;
}
