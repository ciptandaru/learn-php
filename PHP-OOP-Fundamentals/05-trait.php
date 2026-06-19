<?php

/**
 * BAGIAN 5: TRAIT — Berbagi Kode Tanpa Inheritance
 *
 * MASALAH: PHP hanya mendukung single inheritance (satu parent saja).
 * Lalu bagaimana kalau dua class yang TIDAK berhubungan butuh fungsi yang sama?
 *
 * Contoh: Class Artikel dan class Produk sama-sama butuh fitur "soft delete"
 * dan "timestamp". Mereka tidak punya hubungan parent-child.
 *
 * SOLUSI: Trait — mekanisme untuk "copy-paste" method ke beberapa class.
 * Trait seperti potongan kode yang bisa di-"tempel" ke class manapun.
 *
 * Di Laravel, trait dipakai BANYAK SEKALI:
 * - HasFactory, SoftDeletes, Notifiable, HasApiTokens, dll.
 */

// ============================================================
// Mendefinisikan Trait
// ============================================================

trait Timestamp
{
    private ?string $createdAt = null;
    private ?string $updatedAt = null;

    public function setCreatedAt(): void
    {
        $this->createdAt = date('Y-m-d H:i:s');
    }

    public function setUpdatedAt(): void
    {
        $this->updatedAt = date('Y-m-d H:i:s');
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function infoTimestamp(): string
    {
        $created = $this->createdAt ?? 'belum diset';
        $updated = $this->updatedAt ?? 'belum diset';
        return "Dibuat: {$created} | Diperbarui: {$updated}";
    }
}

trait SoftDelete
{
    private ?string $deletedAt = null;

    public function softDelete(): void
    {
        $this->deletedAt = date('Y-m-d H:i:s');
    }

    public function restore(): void
    {
        $this->deletedAt = null;
    }

    public function isTerhapus(): bool
    {
        return $this->deletedAt !== null;
    }

    public function getDeletedAt(): ?string
    {
        return $this->deletedAt;
    }
}

trait Sluggable
{
    public function generateSlug(string $teks): string
    {
        $slug = strtolower($teks);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        return trim($slug, '-');
    }
}

// ============================================================
// Menggunakan Trait di Beberapa Class yang Tidak Berhubungan
// ============================================================

class Artikel
{
    use Timestamp, SoftDelete, Sluggable;  // Satu class bisa pakai banyak trait!

    private string $slug;

    public function __construct(
        private string $judul,
        private string $konten
    ) {
        $this->slug = $this->generateSlug($judul);  // Method dari trait Sluggable
        $this->setCreatedAt();                        // Method dari trait Timestamp
    }

    public function update(string $judul, string $konten): void
    {
        $this->judul = $judul;
        $this->konten = $konten;
        $this->slug = $this->generateSlug($judul);
        $this->setUpdatedAt();   // Method dari trait Timestamp
    }

    public function __toString(): string
    {
        $status = $this->isTerhapus() ? ' [TERHAPUS]' : '';
        return "[Artikel] {$this->judul}{$status}\n"
             . "  Slug: {$this->slug}\n"
             . "  {$this->infoTimestamp()}";
    }
}

class ProdukToko
{
    use Timestamp, SoftDelete;   // Pakai 2 trait yang sama dengan Artikel

    public function __construct(
        private string $nama,
        private float $harga
    ) {
        $this->setCreatedAt();
    }

    public function ubahHarga(float $hargaBaru): void
    {
        $this->harga = $hargaBaru;
        $this->setUpdatedAt();
    }

    public function __toString(): string
    {
        $status = $this->isTerhapus() ? ' [TERHAPUS]' : '';
        $hargaFormatted = number_format($this->harga, 0, ',', '.');
        return "[Produk] {$this->nama} — Rp {$hargaFormatted}{$status}\n"
             . "  {$this->infoTimestamp()}";
    }
}

// ============================================================
// Trait dengan Conflict Resolution
// ============================================================
// Jika dua trait punya method dengan nama yang sama, harus di-resolve

trait LogA
{
    public function log(): string
    {
        return "Log dari A";
    }
}

trait LogB
{
    public function log(): string
    {
        return "Log dari B";
    }
}

class Sistem
{
    use LogA, LogB {
        LogA::log insteadof LogB;   // Pilih LogA::log sebagai default
        LogB::log as logB;          // LogB::log tetap bisa diakses dengan nama berbeda
    }
}

// ============================================================
// DEMO
// ============================================================
echo "=== BAGIAN 5: TRAIT ===\n\n";

$artikel = new Artikel('Belajar PHP OOP itu Mudah!', 'Konten artikel...');
echo $artikel . "\n\n";

$artikel->update('Belajar PHP OOP itu Sangat Mudah!', 'Konten diperbarui...');
echo "Setelah update:\n" . $artikel . "\n\n";

$artikel->softDelete();
echo "Setelah soft delete:\n" . $artikel . "\n\n";

$artikel->restore();
echo "Setelah restore:\n" . $artikel . "\n\n";

echo "--- Trait yang sama di class berbeda ---\n\n";

$produk = new ProdukToko('Mechanical Keyboard', 750_000);
echo $produk . "\n\n";

$produk->ubahHarga(650_000);
echo "Setelah ubah harga:\n" . $produk . "\n\n";

$produk->softDelete();
echo "Setelah soft delete:\n" . $produk . "\n\n";

echo "--- Conflict Resolution ---\n";
$sistem = new Sistem();
echo $sistem->log() . "\n";     // Dari LogA (karena insteadof)
echo $sistem->logB() . "\n";    // Dari LogB (di-alias jadi logB)
