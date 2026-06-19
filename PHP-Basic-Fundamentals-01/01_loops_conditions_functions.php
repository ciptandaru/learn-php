<?php
// ============================================================
// 01 - Loops, Conditions, dan Functions
// ============================================================

echo "=== LOOPS ===\n";

// For loop - cetak angka 1-5
for ($i = 1; $i <= 5; $i++) {
    echo "For loop: $i\n";
}

// While loop
$counter = 1;
while ($counter <= 3) {
    echo "While loop: $counter\n";
    $counter++;
}

// Foreach loop
$buah = ["Apel", "Mangga", "Jeruk"];
foreach ($buah as $index => $nama) {
    echo "Buah ke-$index: $nama\n";
}

echo "\n=== CONDITIONS ===\n";

$nilai = 75;

if ($nilai >= 80) {
    echo "Grade: A\n";
} elseif ($nilai >= 70) {
    echo "Grade: B\n";
} elseif ($nilai >= 60) {
    echo "Grade: C\n";
} else {
    echo "Grade: D\n";
}

// Match expression (PHP 8+)
$hari = "Senin";
$tipe = match ($hari) {
    "Senin", "Selasa", "Rabu", "Kamis", "Jumat" => "Hari Kerja",
    "Sabtu", "Minggu" => "Hari Libur",
    default => "Tidak diketahui",
};
echo "$hari adalah $tipe\n";

echo "\n=== FUNCTIONS ===\n";

function spiawakan(string $nama): string
{
    return "Halo, $nama! Selamat belajar PHP.";
}

function hitungLuas(float $panjang, float $lebar): float
{
    return $panjang * $lebar;
}

function cekGanjilGenap(int $angka): string
{
    return ($angka % 2 === 0) ? "Genap" : "Ganjil";
}

echo spiawakan("Buahlil") . "\n";
echo "Luas: " . hitungLuas(5.0, 3.0) . "\n";
echo "Angka 7 adalah: " . cekGanjilGenap(7) . "\n";
echo "Angka 4 adalah: " . cekGanjilGenap(4) . "\n";
