# PHP Basic Fundamentals 01

Kumpulan materi dasar PHP yang mencakup konsep fundamental seperti loop, kondisi, fungsi, tipe data, array, string, dan typed functions.

## Prasyarat

- PHP 8.0+

## Cara Menjalankan

```bash
php <nama-file>.php
```

## Daftar Materi

### 01 — Loops, Conditions & Functions
**File:** `01_loops_conditions_functions.php`

- **Loops:** `for`, `while`, `foreach`
- **Conditions:** `if/elseif/else`, `match` expression (PHP 8+)
- **Functions:** deklarasi fungsi dengan type hint parameter dan return type

### 02 — Type Juggling vs Strict Types
**File:** `02_type_juggling_vs_strict.php` & `02b_strict_types_demo.php`

- Perilaku default PHP yang mengkonversi tipe secara otomatis (type juggling)
- Perbedaan `==` (loose comparison) vs `===` (strict comparison)
- Penggunaan `declare(strict_types=1)` untuk mendeteksi bug lebih awal
- Demo `TypeError` ketika strict types aktif

### 03 — Associative Arrays
**File:** `03_associative_arrays.php`

- Membuat dan mengakses associative array dengan key-value
- Loop associative array dengan `foreach`
- Array of associative arrays (nested)
- Fungsi: `array_key_exists()`, `array_keys()`, `array_values()`, `implode()`

### 04 — Array Functions
**File:** `04_array_functions.php`

- `array_map()` — transformasi setiap elemen array
- `array_filter()` — menyaring elemen berdasarkan kondisi
- `array_reduce()` — mengakumulasi array menjadi satu nilai
- Penggunaan arrow function (`fn()`) sebagai callback

### 05 — String Manipulation
**File:** `05_string_manipulation.php`

- `substr()` — mengambil sebagian string
- `str_replace()` — mengganti teks, termasuk multiple replace
- `explode()` — memecah string menjadi array
- `implode()` — menggabungkan array menjadi string
- Destructuring array dari `explode()`

### 06 — Typed Functions
**File:** `06_typed_functions.php`

- Parameter type hints dan return types
- Nullable return type (`?array`)
- Union types (`int|string`) — PHP 8+
- Void return type
- Default parameter values
