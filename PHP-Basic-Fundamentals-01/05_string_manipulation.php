<?php
// ============================================================
// 05 - String Manipulation: substr, str_replace, explode, implode
// ============================================================

$kalimat = "Selamat belajar PHP dasar dan fundamental";

echo "=== substr ===\n";
echo "Mengambil sebagian string\n\n";

echo "Original: $kalimat\n";
echo "substr(\$k, 0, 7)   : " . substr($kalimat, 0, 7) . "\n";   // "Selamat"
echo "substr(\$k, 8, 7)   : " . substr($kalimat, 8, 7) . "\n";   // "belajar"
echo "substr(\$k, -11)    : " . substr($kalimat, -11) . "\n";     // "fundamental" (dari belakang)

echo "\n=== str_replace ===\n";
echo "Mengganti teks dalam string\n\n";

$hasil = str_replace("PHP", "Laravel", $kalimat);
echo "Ganti 'PHP' -> 'Laravel': $hasil\n";

// Replace multiple
$template = "Halo {nama}, selamat datang di {kota}!";
$pesan = str_replace(
    ["{nama}", "{kota}"],
    ["Dhimas", "Jakarta"],
    $template
);
echo "Template: $pesan\n";

echo "\n=== explode ===\n";
echo "Memecah string jadi array\n\n";

$csv = "Andi,Budi,Citra,Dina,Eko";
$nama = explode(",", $csv);
echo "CSV: $csv\n";
echo "Array: ";
print_r($nama);

$tanggal = "2026-06-19";
[$tahun, $bulan, $hari] = explode("-", $tanggal);
echo "Tahun: $tahun, Bulan: $bulan, Hari: $hari\n";

echo "\n=== implode ===\n";
echo "Menggabungkan array jadi string\n\n";

$kata = ["PHP", "itu", "mudah", "dan", "seru"];
echo implode(" ", $kata) . "\n";
echo implode(" | ", $kata) . "\n";
echo implode(", ", $nama) . "\n";
