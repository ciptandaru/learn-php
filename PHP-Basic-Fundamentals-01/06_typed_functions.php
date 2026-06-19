<?php
declare(strict_types=1);

// ============================================================
// 06 - Typed Functions dengan Return Types
// ============================================================

// Function dengan parameter type dan return type
function hitungDiskon(float $harga, float $persenDiskon): float
{
    return $harga - ($harga * $persenDiskon / 100);
}

// Nullable return type (bisa return null)
function cariMahasiswa(array $data, string $nama): ?array
{
    foreach ($data as $m) {
        if ($m["nama"] === $nama) {
            return $m;
        }
    }
    return null;
}

// Union types (PHP 8+) - bisa terima/return beberapa tipe
function formatId(int|string $id): string
{
    return "ID-" . str_pad((string) $id, 5, "0", STR_PAD_LEFT);
}

// Array return type
function hitungStatistik(array $angka): array
{
    $count = count($angka);
    return [
        "jumlah"  => array_sum($angka),
        "rata"    => array_sum($angka) / $count,
        "min"     => min($angka),
        "max"     => max($angka),
        "total"   => $count,
    ];
}

// Void return type (tidak mengembalikan nilai)
function tampilkanGaris(int $panjang = 40): void
{
    echo str_repeat("=", $panjang) . "\n";
}

// ============================================================
// Penggunaan
// ============================================================

tampilkanGaris();
echo "=== TYPED FUNCTIONS DEMO ===\n";
tampilkanGaris();

echo "\n--- hitungDiskon ---\n";
$hargaAsli = 250000.0;
$setelahDiskon = hitungDiskon($hargaAsli, 15.0);
echo "Harga: Rp " . number_format($hargaAsli, 0, ',', '.') . "\n";
echo "Diskon 15%: Rp " . number_format($setelahDiskon, 0, ',', '.') . "\n";

echo "\n--- cariMahasiswa ---\n";
$dataMhs = [
    ["nama" => "Andi",  "ipk" => 3.5],
    ["nama" => "Budi",  "ipk" => 3.8],
    ["nama" => "Citra", "ipk" => 3.2],
];

$hasil = cariMahasiswa($dataMhs, "Budi");
if ($hasil !== null) {
    echo "Ditemukan: {$hasil['nama']} (IPK: {$hasil['ipk']})\n";
}

$tidakAda = cariMahasiswa($dataMhs, "Zoro");
echo "Cari 'Zoro': " . ($tidakAda === null ? "Tidak ditemukan" : $tidakAda["nama"]) . "\n";

echo "\n--- formatId ---\n";
echo formatId(42) . "\n";       // ID-00042
echo formatId("789") . "\n";   // ID-00789

echo "\n--- hitungStatistik ---\n";
$nilai = [85, 92, 78, 95, 88];
$stat = hitungStatistik($nilai);
foreach ($stat as $label => $value) {
    echo "  $label: $value\n";
}
