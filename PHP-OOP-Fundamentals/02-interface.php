<?php

/**
 * BAGIAN 2: INTERFACE — Kontrak yang Wajib Dipenuhi
 *
 * Interface adalah "kontrak" — ia menentukan method APA yang harus ada,
 * tapi TIDAK menentukan BAGAIMANA implementasinya.
 *
 * Analogi: Interface seperti job description.
 * "Seorang kasir HARUS bisa: menerima pembayaran, memberikan kembalian, mencetak struk."
 * Tapi CARA dia melakukannya terserah masing-masing.
 *
 * KENAPA INTERFACE PENTING?
 * 1. Konsistensi — Semua class yang implement interface punya method yang sama
 * 2. Polimorfisme — Kita bisa memperlakukan object berbeda dengan cara yang sama
 * 3. Dependency Injection — Kode bergantung pada kontrak, bukan implementasi spesifik
 *    (Ini fondasi utama Laravel: Service Container, Repositories, dll)
 */

// ============================================================
// Mendefinisikan Interface
// ============================================================

interface PembayaranInterface
{
    // Interface hanya berisi "tanda tangan" method — tanpa body
    public function bayar(float $jumlah): bool;
    public function getMetode(): string;
    public function getSaldo(): float;
}

// Interface bisa extend interface lain
interface PembayaranOnlineInterface extends PembayaranInterface
{
    public function verifikasiOTP(string $kode): bool;
}

// ============================================================
// Implementasi Interface
// ============================================================

class PembayaranTunai implements PembayaranInterface
{
    private float $kasYangDiterima = 0;

    public function __construct(
        private float $saldo
    ) {}

    // WAJIB mengimplementasikan SEMUA method dari interface
    public function bayar(float $jumlah): bool
    {
        if ($jumlah > $this->saldo) {
            echo "  [Tunai] Saldo tidak cukup!\n";
            return false;
        }
        $this->saldo -= $jumlah;
        echo "  [Tunai] Pembayaran Rp " . number_format($jumlah, 0, ',', '.') . " berhasil\n";
        return true;
    }

    public function getMetode(): string
    {
        return 'Tunai';
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }
}

class PembayaranEWallet implements PembayaranOnlineInterface
{
    public function __construct(
        private string $namaWallet,
        private float $saldo,
        private string $otpValid = '123456'
    ) {}

    private bool $otpTerverifikasi = false;

    public function verifikasiOTP(string $kode): bool
    {
        $this->otpTerverifikasi = ($kode === $this->otpValid);
        if ($this->otpTerverifikasi) {
            echo "  [{$this->namaWallet}] OTP terverifikasi\n";
        } else {
            echo "  [{$this->namaWallet}] OTP salah!\n";
        }
        return $this->otpTerverifikasi;
    }

    public function bayar(float $jumlah): bool
    {
        if (!$this->otpTerverifikasi) {
            echo "  [{$this->namaWallet}] Verifikasi OTP dulu!\n";
            return false;
        }
        if ($jumlah > $this->saldo) {
            echo "  [{$this->namaWallet}] Saldo tidak cukup!\n";
            return false;
        }
        $this->saldo -= $jumlah;
        echo "  [{$this->namaWallet}] Pembayaran Rp " . number_format($jumlah, 0, ',', '.') . " berhasil\n";
        return true;
    }

    public function getMetode(): string
    {
        return $this->namaWallet;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }
}

// ============================================================
// Kekuatan Interface: Polimorfisme
// ============================================================
// Fungsi ini menerima APAPUN yang mengimplementasikan PembayaranInterface
// Tidak peduli itu tunai, e-wallet, kartu kredit, atau crypto sekalipun

function prosesCheckout(PembayaranInterface $pembayaran, float $total): void
{
    echo "\nMemproses checkout dengan metode: {$pembayaran->getMetode()}\n";
    echo "Saldo sebelum: Rp " . number_format($pembayaran->getSaldo(), 0, ',', '.') . "\n";

    if ($pembayaran->bayar($total)) {
        echo "Saldo sesudah: Rp " . number_format($pembayaran->getSaldo(), 0, ',', '.') . "\n";
    }
}

// ============================================================
// DEMO
// ============================================================
echo "=== BAGIAN 2: INTERFACE ===\n";

$tunai = new PembayaranTunai(500_000);
prosesCheckout($tunai, 150_000);

$gopay = new PembayaranEWallet('GoPay', 1_000_000);
prosesCheckout($gopay, 200_000); // Akan gagal — belum verifikasi OTP

$gopay->verifikasiOTP('123456');
prosesCheckout($gopay, 200_000); // Sekarang berhasil

// Ini yang membuat interface powerful:
// prosesCheckout() tidak perlu tahu JENIS pembayaran apa yang dipakai.
// Selama object-nya mengimplementasikan PembayaranInterface, fungsi ini bekerja.
// Inilah yang disebut "program to an interface, not an implementation."
