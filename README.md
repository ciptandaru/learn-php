# Learn PHP

Repositori pembelajaran PHP dari dasar hingga Object-Oriented Programming (OOP). Setiap modul berisi file-file PHP yang bisa langsung dijalankan sebagai referensi dan latihan.

## Prasyarat

- PHP 8.0+

## Struktur Modul

### [PHP Basic Fundamentals 01](PHP-Basic-Fundamentals-01/)

Konsep dasar PHP yang menjadi fondasi sebelum masuk ke OOP.

| # | Topik | File |
|---|-------|------|
| 01 | Loops, Conditions & Functions | `01_loops_conditions_functions.php` |
| 02 | Type Juggling vs Strict Types | `02_type_juggling_vs_strict.php`, `02b_strict_types_demo.php` |
| 03 | Associative Arrays | `03_associative_arrays.php` |
| 04 | Array Functions (`map`, `filter`, `reduce`) | `04_array_functions.php` |
| 05 | String Manipulation (`substr`, `str_replace`, `explode`, `implode`) | `05_string_manipulation.php` |
| 06 | Typed Functions & Return Types | `06_typed_functions.php` |

### [PHP OOP Fundamentals](PHP-OOP-Fundamentals/)

Konsep OOP di PHP beserta relevansinya dengan framework Laravel.

| # | Topik | File |
|---|-------|------|
| 01 | Class, Constructor, Properties & Visibility | `01-class-dasar.php` |
| 02 | Interface & Polimorfisme | `02-interface.php` |
| 03 | Inheritance, Extend & Override | `03-inheritance.php` |
| 04 | Abstract Class | `04-abstract-class.php` |
| 05 | Trait & Conflict Resolution | `05-trait.php` |

## Cara Menjalankan

```bash
# Jalankan file secara individual
php PHP-Basic-Fundamentals-01/01_loops_conditions_functions.php

# Jalankan semua materi OOP sekaligus
php PHP-OOP-Fundamentals/index.php
```

## Urutan Belajar yang Disarankan

1. **Basic Fundamentals** — Pahami dulu loop, kondisi, fungsi, array, dan string
2. **OOP Fundamentals** — Lanjut ke class, interface, inheritance, abstract class, dan trait
3. **Praktik** — Coba modifikasi contoh kode atau buat variasi sendiri
