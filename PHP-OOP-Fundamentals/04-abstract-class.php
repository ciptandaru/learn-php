<?php

/**
 * BAGIAN 4: ABSTRACT CLASS — Setengah Blueprint, Setengah Kontrak
 *
 * Abstract class adalah GABUNGAN antara class biasa dan interface:
 * - Bisa punya method dengan implementasi (seperti class biasa)
 * - Bisa punya method TANPA implementasi / abstract (seperti interface)
 * - TIDAK BISA di-instansiasi langsung (harus di-extend)
 *
 * KAPAN PAKAI ABSTRACT CLASS vs INTERFACE?
 * ┌─────────────────────┬────────────────────────────────────────────┐
 * │ Interface            │ Hanya kontrak, tanpa kode sama sekali      │
 * │ Abstract Class       │ Ada kode yang dishare + ada kontrak         │
 * │ Class Biasa          │ Semua method sudah ada implementasinya     │
 * └─────────────────────┴────────────────────────────────────────────┘
 *
 * Gunakan abstract class ketika child class PASTI punya logic yang sama,
 * tapi ada bagian tertentu yang HARUS berbeda di setiap child.
 */

// ============================================================
// Abstract Class
// ============================================================

abstract class Bentuk
{
    public function __construct(
        protected string $nama,
        protected string $warna = 'merah'
    ) {}

    // Abstract method — WAJIB diimplementasikan oleh semua child class
    // Tidak ada body, hanya deklarasi
    abstract public function hitungLuas(): float;
    abstract public function hitungKeliling(): float;

    // Method biasa — sudah ada implementasinya, bisa langsung dipakai child
    public function deskripsi(): string
    {
        $luas = number_format($this->hitungLuas(), 2, ',', '.');
        $keliling = number_format($this->hitungKeliling(), 2, ',', '.');
        return "{$this->nama} ({$this->warna}) — Luas: {$luas}, Keliling: {$keliling}";
    }

    public function getWarna(): string
    {
        return $this->warna;
    }
}

// ============================================================
// Concrete Class (implementasi dari abstract class)
// ============================================================

class Lingkaran extends Bentuk
{
    public function __construct(
        private float $jariJari,
        string $warna = 'merah'
    ) {
        parent::__construct('Lingkaran', $warna);
    }

    // WAJIB mengimplementasikan semua abstract method
    public function hitungLuas(): float
    {
        return M_PI * $this->jariJari ** 2;
    }

    public function hitungKeliling(): float
    {
        return 2 * M_PI * $this->jariJari;
    }
}

class PersegiPanjang extends Bentuk
{
    public function __construct(
        private float $panjang,
        private float $lebar,
        string $warna = 'biru'
    ) {
        parent::__construct('Persegi Panjang', $warna);
    }

    public function hitungLuas(): float
    {
        return $this->panjang * $this->lebar;
    }

    public function hitungKeliling(): float
    {
        return 2 * ($this->panjang + $this->lebar);
    }
}

class Segitiga extends Bentuk
{
    public function __construct(
        private float $alas,
        private float $tinggi,
        private float $sisiA,
        private float $sisiB,
        private float $sisiC,
        string $warna = 'hijau'
    ) {
        parent::__construct('Segitiga', $warna);
    }

    public function hitungLuas(): float
    {
        return 0.5 * $this->alas * $this->tinggi;
    }

    public function hitungKeliling(): float
    {
        return $this->sisiA + $this->sisiB + $this->sisiC;
    }
}

// ============================================================
// Abstract class bisa juga implement interface
// ============================================================

interface Gambar
{
    public function render(): string;
}

abstract class BentukGambar extends Bentuk implements Gambar
{
    // Kita bisa implement sebagian dari interface, sisanya abstract
    // atau implement semua — terserah kebutuhan

    abstract public function render(): string;

    public function renderDenganInfo(): string
    {
        return $this->render() . "\n  → " . $this->deskripsi();
    }
}

class LingkaranGambar extends BentukGambar
{
    public function __construct(
        private float $jariJari,
        string $warna = 'kuning'
    ) {
        parent::__construct('Lingkaran Gambar', $warna);
    }

    public function hitungLuas(): float
    {
        return M_PI * $this->jariJari ** 2;
    }

    public function hitungKeliling(): float
    {
        return 2 * M_PI * $this->jariJari;
    }

    public function render(): string
    {
        return "  ●  (r={$this->jariJari}, warna={$this->getWarna()})";
    }
}

// ============================================================
// DEMO
// ============================================================
echo "=== BAGIAN 4: ABSTRACT CLASS ===\n\n";

// $bentuk = new Bentuk('test');  // ❌ Fatal Error — abstract class tidak bisa di-instansiasi!

$lingkaran = new Lingkaran(7, 'merah');
$persegi = new PersegiPanjang(10, 5, 'biru');
$segitiga = new Segitiga(6, 8, 6, 8, 10, 'hijau');

echo $lingkaran->deskripsi() . "\n";
echo $persegi->deskripsi() . "\n";
echo $segitiga->deskripsi() . "\n";

echo "\n--- Abstract + Interface ---\n";
$lg = new LingkaranGambar(5, 'emas');
echo $lg->renderDenganInfo() . "\n";

echo "\n--- Polimorfisme: semua adalah Bentuk ---\n";
$bentukBentuk = [$lingkaran, $persegi, $segitiga];
$totalLuas = 0;
foreach ($bentukBentuk as $b) {
    $totalLuas += $b->hitungLuas();
    echo "  " . $b->deskripsi() . "\n";
}
echo "Total luas semua bentuk: " . number_format($totalLuas, 2, ',', '.') . "\n";
