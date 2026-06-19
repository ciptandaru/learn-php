<?php

/**
 * BAGIAN 1: CLASS DASAR — Constructor, Properties, Methods, Visibility
 *
 * Class adalah blueprint untuk membuat object.
 * Bayangkan class seperti cetakan kue — dari satu cetakan, bisa bikin banyak kue.
 */

// ============================================================
// VISIBILITY (Hak Akses)
// ============================================================
// public    → bisa diakses dari mana saja
// protected → hanya bisa diakses dari dalam class itu sendiri DAN class turunannya
// private   → hanya bisa diakses dari dalam class itu sendiri

class Pengguna
{
    // Properties (atribut yang dimiliki setiap object)
    public string $nama;
    protected string $email;
    private string $password;

    // Constructor — method khusus yang otomatis dipanggil saat object dibuat
    // Di PHP, constructor SELALU bernama __construct()
    public function __construct(string $nama, string $email, string $password)
    {
        $this->nama = $nama;          // $this merujuk ke object yang sedang aktif
        $this->email = $email;
        $this->password = $password;
    }

    // Method public — bisa dipanggil dari luar class
    public function tampilProfilLengkap(): string
    {
        return "Nama: {$this->nama}, Email: {$this->getEmail()}";
    }

    // Method protected — hanya bisa diakses dari class ini dan turunannya
    protected function getEmail(): string
    {
        return $this->email;
    }

    // Method private — hanya bisa diakses dari dalam class ini saja
    private function hashPassword(): string
    {
        return password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function getHashedPassword(): string
    {
        // Method public ini bisa memanggil method private karena masih di class yang sama
        return $this->hashPassword();
    }
}

// ============================================================
// PHP 8+ Constructor Promotion (Sintaks Modern)
// ============================================================
// Daripada menulis property dan assign satu per satu,
// PHP 8 memungkinkan deklarasi langsung di parameter constructor

class Produk
{
    public function __construct(
        public string $nama,
        public float $harga,
        private int $stok = 0
    ) {
        // Property otomatis dibuat dan di-assign — tidak perlu $this->nama = $nama
    }

    public function tambahStok(int $jumlah): void
    {
        $this->stok += $jumlah;
    }

    public function kurangiStok(int $jumlah): bool
    {
        if ($jumlah > $this->stok) {
            return false;
        }
        $this->stok -= $jumlah;
        return true;
    }

    public function getStok(): int
    {
        return $this->stok;
    }

    public function __toString(): string
    {
        return "{$this->nama} — Rp " . number_format($this->harga, 0, ',', '.') . " (Stok: {$this->stok})";
    }
}

// ============================================================
// DEMO
// ============================================================
echo "=== BAGIAN 1: CLASS DASAR ===\n\n";

// Membuat object dari class (instansiasi)
$user = new Pengguna('Dhimas', 'dhimas@email.com', 'rahasia123');

echo $user->nama . "\n";                    // ✅ public — bisa diakses
echo $user->tampilProfilLengkap() . "\n";    // ✅ method public
echo $user->getHashedPassword() . "\n";     // ✅ public method yang memanggil private method

// echo $user->email;       // ❌ Fatal Error — protected, tidak bisa diakses dari luar
// echo $user->password;    // ❌ Fatal Error — private
// echo $user->getEmail();  // ❌ Fatal Error — protected method

echo "\n--- Produk ---\n";
$laptop = new Produk('Laptop ASUS', 12_500_000, 10);
echo $laptop . "\n";   // Memanggil __toString() secara otomatis

$laptop->kurangiStok(3);
echo "Setelah dikurangi 3: " . $laptop->getStok() . " unit\n";

$laptop->tambahStok(5);
echo "Setelah ditambah 5: " . $laptop->getStok() . " unit\n";
