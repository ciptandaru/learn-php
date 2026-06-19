<?php
// ============================================================
// 02 - Type Juggling vs strict_types
// ============================================================

echo "=== TYPE JUGGLING (default PHP) ===\n";

// PHP secara default akan konversi tipe otomatis
var_dump("5" == 5);      // true  - string "5" dikonversi jadi int
var_dump("5" === 5);     // false - strict comparison, beda tipe
var_dump("0" == false);  // true  - "0" dianggap falsy
var_dump("" == false);   // true  - string kosong dianggap falsy
var_dump("1" + 2);       // 3    - string "1" otomatis jadi int

echo "\n--- Tanpa strict_types, function menerima tipe lain ---\n";

function tambahBiasa(int $a, int $b): int
{
    return $a + $b;
}

// Tanpa strict_types, string "10" otomatis dikonversi jadi int 10
echo tambahBiasa("10", "20") . "\n"; // Output: 30 (tidak error!)

echo "\n=== STRICT TYPES (lihat file 02b) ===\n";
echo "Jalankan: php 02b_strict_types_demo.php\n";
