<?php
declare(strict_types=1); // HARUS di baris pertama setelah <?php

// ============================================================
// 02b - Dengan strict_types=1
// ============================================================

function tambahStrict(int $a, int $b): int
{
    return $a + $b;
}

echo "Hasil benar: " . tambahStrict(10, 20) . "\n"; // 30

// Baris di bawah akan ERROR (TypeError) karena strict_types aktif
// String tidak otomatis dikonversi ke int
echo tambahStrict("10", "20") . "\n";

// Output: Fatal error: Uncaught TypeError
// Ini membantu mendeteksi bug lebih awal!
