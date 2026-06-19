<?php

/**
 * BAGIAN 3: INHERITANCE (Pewarisan) — Extend & Override
 *
 * Inheritance memungkinkan class "mewarisi" property dan method dari class lain.
 * Class anak (child) mendapat semua kemampuan class induk (parent),
 * dan bisa menambah atau mengubah perilaku sesuai kebutuhan.
 *
 * Analogi: Kendaraan → Mobil → Mobil Listrik
 * Mobil punya semua sifat Kendaraan + sifat tambahan miliknya sendiri.
 */

// ============================================================
// Class Induk (Parent / Base Class)
// ============================================================

class Kendaraan
{
    public function __construct(
        protected string $merk,
        protected string $warna,
        protected int $tahun,
        protected float $kecepatan = 0
    ) {}

    public function akselerasi(float $tambahan): void
    {
        $this->kecepatan += $tambahan;
        echo "[{$this->merk}] Akselerasi +{$tambahan} km/h → sekarang {$this->kecepatan} km/h\n";
    }

    public function rem(float $pengurangan): void
    {
        $this->kecepatan = max(0, $this->kecepatan - $pengurangan);
        echo "[{$this->merk}] Rem -{$pengurangan} km/h → sekarang {$this->kecepatan} km/h\n";
    }

    public function info(): string
    {
        return "{$this->merk} ({$this->warna}, {$this->tahun})";
    }

    // Method yang BISA di-override oleh child class
    public function klakson(): string
    {
        return "BEEP BEEP!";
    }
}

// ============================================================
// Class Anak (Child Class) — extends
// ============================================================

class Mobil extends Kendaraan
{
    public function __construct(
        string $merk,
        string $warna,
        int $tahun,
        private int $jumlahPintu = 4
    ) {
        // parent::__construct() memanggil constructor class induk
        parent::__construct($merk, $warna, $tahun);
    }

    // Menambah method baru yang tidak ada di parent
    public function bukaKapMesin(): void
    {
        echo "[{$this->merk}] Kap mesin dibuka\n";
    }

    // OVERRIDE — mengubah perilaku method parent
    public function klakson(): string
    {
        return "HONK HONK! (Mobil {$this->jumlahPintu} pintu)";
    }

    public function info(): string
    {
        // Memanggil method parent lalu menambahkan info
        return parent::info() . " — {$this->jumlahPintu} pintu";
    }
}

class Motor extends Kendaraan
{
    public function __construct(
        string $merk,
        string $warna,
        int $tahun,
        private string $jenisMotor = 'matic'
    ) {
        parent::__construct($merk, $warna, $tahun);
    }

    public function wheelie(): void
    {
        if ($this->kecepatan > 30) {
            echo "[{$this->merk}] 🏍️ WHEELIE!\n";
        } else {
            echo "[{$this->merk}] Kecepatan kurang untuk wheelie (min 30 km/h)\n";
        }
    }

    public function klakson(): string
    {
        return "TIN TIN! (Motor {$this->jenisMotor})";
    }
}

// ============================================================
// Multi-level Inheritance
// ============================================================

class MobilListrik extends Mobil
{
    public function __construct(
        string $merk,
        string $warna,
        int $tahun,
        int $jumlahPintu,
        private float $kapasitasBaterai, // dalam kWh
        private float $bateraiSekarang   // dalam kWh
    ) {
        parent::__construct($merk, $warna, $tahun, $jumlahPintu);
    }

    public function charging(float $jumlahKWh): void
    {
        $this->bateraiSekarang = min(
            $this->kapasitasBaterai,
            $this->bateraiSekarang + $jumlahKWh
        );
        echo "[{$this->merk}] Charging... Baterai: {$this->bateraiSekarang}/{$this->kapasitasBaterai} kWh\n";
    }

    public function klakson(): string
    {
        // Mobil listrik suaranya lebih halus
        return "~hmmmm~ (Mobil Listrik)";
    }

    public function info(): string
    {
        return parent::info() . " | Baterai: {$this->bateraiSekarang}/{$this->kapasitasBaterai} kWh";
    }
}

// ============================================================
// DEMO
// ============================================================
echo "=== BAGIAN 3: INHERITANCE ===\n\n";

$avanza = new Mobil('Toyota Avanza', 'Silver', 2023);
echo $avanza->info() . "\n";
echo "Klakson: " . $avanza->klakson() . "\n";
$avanza->akselerasi(60);    // Method dari parent Kendaraan
$avanza->bukaKapMesin();    // Method milik Mobil sendiri

echo "\n";

$nmax = new Motor('Yamaha NMAX', 'Hitam', 2024, 'matic');
echo $nmax->info() . "\n";
echo "Klakson: " . $nmax->klakson() . "\n";
$nmax->akselerasi(20);
$nmax->wheelie();           // Kecepatan kurang
$nmax->akselerasi(15);
$nmax->wheelie();           // Sekarang bisa!

echo "\n";

$tesla = new MobilListrik('Tesla Model 3', 'Putih', 2025, 4, 75.0, 50.0);
echo $tesla->info() . "\n";
echo "Klakson: " . $tesla->klakson() . "\n";
$tesla->akselerasi(100);    // Dari Kendaraan (grandparent)
$tesla->bukaKapMesin();     // Dari Mobil (parent)
$tesla->charging(20);       // Method miliknya sendiri

echo "\n--- Polimorfisme via Inheritance ---\n";
// Semua bisa diperlakukan sebagai Kendaraan
$semuaKendaraan = [$avanza, $nmax, $tesla];
foreach ($semuaKendaraan as $k) {
    echo $k->info() . " → Klakson: " . $k->klakson() . "\n";
}
