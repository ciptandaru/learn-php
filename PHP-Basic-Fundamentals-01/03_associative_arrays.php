<?php
// ============================================================
// 03 - Associative Arrays
// ============================================================

echo "=== MEMBUAT ASSOCIATIVE ARRAY ===\n";

$mahasiswa = [
    "nama"    => "Buahlil",
    "umur"    => 49,
    "jurusan" => "Teknik Informatika",
    "ipk"     => 3.75,
];

// Mengambil data dengan key
echo "Nama: " . $mahasiswa["nama"] . "\n";
echo "Jurusan: " . $mahasiswa["jurusan"] . "\n";

// Menambah/mengubah data
$mahasiswa["email"] = "buahlil@example.com";
$mahasiswa["ipk"] = 3.80;

echo "\n=== LOOP ASSOCIATIVE ARRAY ===\n";

foreach ($mahasiswa as $key => $value) {
    echo "$key: $value\n";
}

echo "\n=== ARRAY OF ASSOCIATIVE ARRAYS ===\n";

$karyawan = [
    ["nama" => "Andi",  "posisi" => "Developer",  "gaji" => 8000000],
    ["nama" => "Budi",  "posisi" => "Designer",   "gaji" => 7000000],
    ["nama" => "Citra", "posisi" => "Manager",    "gaji" => 12000000],
];

foreach ($karyawan as $k) {
    echo "{$k['nama']} - {$k['posisi']} (Rp " . number_format($k['gaji'], 0, ',', '.') . ")\n";
}

echo "\n=== CEK KEY & AMBIL KEYS/VALUES ===\n";

echo "Key 'nama' ada? " . (array_key_exists("nama", $mahasiswa) ? "Ya" : "Tidak") . "\n";
echo "Keys: " . implode(", ", array_keys($mahasiswa)) . "\n";
echo "Values: " . implode(", ", array_values($mahasiswa)) . "\n";
