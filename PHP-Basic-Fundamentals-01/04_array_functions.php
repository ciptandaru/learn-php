<?php
// ============================================================
// 04 - Array Functions: array_map, array_filter, array_reduce
// ============================================================

$angka = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

echo "=== array_map ===\n";
echo "Mengubah setiap elemen dalam array\n\n";

// Kalikan semua angka dengan 2
$kaliDua = array_map(fn($n) => $n * 2, $angka);
echo "Original : " . implode(", ", $angka) . "\n";
echo "Kali dua : " . implode(", ", $kaliDua) . "\n";

// Map pada associative array
$harga = ["Nasi Goreng" => 15000, "Mie Ayam" => 12000, "Bakso" => 10000];
$denganPajak = array_map(fn($h) => $h * 1.1, $harga);
echo "\nHarga + pajak 10%:\n";
foreach ($denganPajak as $menu => $total) {
    echo "  $menu: Rp " . number_format($total, 0, ',', '.') . "\n";
}

echo "\n=== array_filter ===\n";
echo "Menyaring elemen berdasarkan kondisi\n\n";

// Ambil angka genap saja
$genap = array_filter($angka, fn($n) => $n % 2 === 0);
echo "Genap: " . implode(", ", $genap) . "\n";

// Filter harga di atas 10rb
$mahal = array_filter($harga, fn($h) => $h > 10000);
echo "Menu > 10rb: " . implode(", ", array_keys($mahal)) . "\n";

echo "\n=== array_reduce ===\n";
echo "Mengakumulasi array jadi satu nilai\n\n";

// Jumlahkan semua angka
$total = array_reduce($angka, fn($carry, $n) => $carry + $n, 0);
echo "Total 1-10: $total\n";

// Cari angka terbesar
$max = array_reduce($angka, fn($carry, $n) => ($n > $carry) ? $n : $carry, 0);
echo "Terbesar: $max\n";

// Total harga semua menu
$totalHarga = array_reduce($harga, fn($carry, $h) => $carry + $h, 0);
echo "Total harga menu: Rp " . number_format($totalHarga, 0, ',', '.') . "\n";
