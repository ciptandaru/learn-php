<?php

/**
 * PHP OOP FUNDAMENTALS — Ringkasan & Demo Lengkap
 *
 * Jalankan file ini untuk melihat semua konsep bekerja bersama:
 *   php index.php
 *
 * Atau jalankan masing-masing bagian secara terpisah:
 *   php 01-class-dasar.php
 *   php 02-interface.php
 *   php 03-inheritance.php
 *   php 04-abstract-class.php
 *   php 05-trait.php
 */

echo str_repeat('=', 60) . "\n";
echo "  PHP OOP FUNDAMENTALS\n";
echo str_repeat('=', 60) . "\n\n";

$files = [
    '01-class-dasar.php'    => 'Class, Constructor, Properties, Visibility',
    '02-interface.php'      => 'Interface & Kontrak',
    '03-inheritance.php'    => 'Inheritance, Extend & Override',
    '04-abstract-class.php' => 'Abstract Class',
    '05-trait.php'          => 'Trait',
];

foreach ($files as $file => $desc) {
    echo str_repeat('-', 60) . "\n";
    echo "  {$desc}\n";
    echo "  File: {$file}\n";
    echo str_repeat('-', 60) . "\n\n";

    require_once __DIR__ . '/' . $file;

    echo "\n\n";
}

echo str_repeat('=', 60) . "\n";
echo "  CHEAT SHEET RINGKASAN\n";
echo str_repeat('=', 60) . "\n\n";

echo <<<'CHEATSHEET'
┌──────────────────────────────────────────────────────────┐
│ KONSEP          │ PENJELASAN SINGKAT                      │
├──────────────────────────────────────────────────────────┤
│ class           │ Blueprint untuk membuat object           │
│ __construct()   │ Method yang dipanggil saat new Object()  │
│ $this           │ Merujuk ke object yang sedang aktif       │
│ public          │ Bisa diakses dari mana saja              │
│ protected       │ Hanya dari class sendiri + turunannya    │
│ private         │ Hanya dari class sendiri                 │
│ interface       │ Kontrak: "method apa yang HARUS ada"     │
│ implements      │ Class memenuhi kontrak interface          │
│ extends         │ Class mewarisi dari class lain            │
│ parent::        │ Memanggil method dari class induk         │
│ abstract class  │ Gabungan class + kontrak, tidak bisa     │
│                 │ di-instansiasi langsung                  │
│ abstract method │ Method tanpa body, WAJIB di-implement    │
│ trait           │ Potongan kode yang bisa ditempel ke      │
│                 │ beberapa class (solusi single inheritance)│
│ use (trait)     │ Menempelkan trait ke dalam class          │
└──────────────────────────────────────────────────────────┘

RELEVANSI DENGAN LARAVEL:
━━━━━━━━━━━━━━━━━━━━━━━━
• Model → extends class Model (inheritance)
• Controller → extends class Controller (inheritance)
• Request validation → implements interface (kontrak)
• SoftDeletes → menggunakan trait
• HasFactory → menggunakan trait
• Notifiable → menggunakan trait
• Service Container → bergantung pada interface (dependency injection)
• Middleware → implements interface
• Event/Listener → abstract patterns

CHEATSHEET;

echo "\n";
