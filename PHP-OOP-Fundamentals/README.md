# PHP OOP Fundamentals

Kumpulan materi Object-Oriented Programming (OOP) di PHP, mulai dari class dasar hingga trait. Setiap konsep disertai analogi, penjelasan, dan demo yang bisa langsung dijalankan.

## Prasyarat

- PHP 8.0+

## Cara Menjalankan

```bash
# Jalankan semua materi sekaligus
php index.php

# Atau jalankan per bagian
php 01-class-dasar.php
```

## Daftar Materi

### 01 — Class Dasar
**File:** `01-class-dasar.php`

- Class sebagai blueprint untuk membuat object
- Constructor (`__construct()`) dan keyword `$this`
- Visibility: `public`, `protected`, `private`
- PHP 8+ Constructor Promotion (deklarasi property langsung di parameter)
- Magic method `__toString()`

### 02 — Interface
**File:** `02-interface.php`

- Interface sebagai kontrak yang wajib dipenuhi
- Implementasi interface (`implements`)
- Interface extending interface lain
- Polimorfisme: memperlakukan object berbeda dengan cara yang sama
- Prinsip "program to an interface, not an implementation"

### 03 — Inheritance
**File:** `03-inheritance.php`

- Pewarisan class dengan `extends`
- Memanggil parent constructor (`parent::__construct()`)
- Override method dari parent class
- Multi-level inheritance (Kendaraan → Mobil → MobilListrik)
- Polimorfisme via inheritance

### 04 — Abstract Class
**File:** `04-abstract-class.php`

- Abstract class: gabungan class biasa + kontrak
- Abstract method yang wajib diimplementasikan child class
- Perbedaan interface vs abstract class vs class biasa
- Abstract class yang mengimplementasikan interface
- Polimorfisme dengan abstract class

### 05 — Trait
**File:** `05-trait.php`

- Trait sebagai solusi keterbatasan single inheritance
- Menggunakan multiple trait dalam satu class (`use TraitA, TraitB`)
- Trait: `Timestamp`, `SoftDelete`, `Sluggable`
- Conflict resolution (`insteadof`, `as`)
- Relevansi dengan Laravel: `HasFactory`, `SoftDeletes`, `Notifiable`

## Cheat Sheet

| Konsep | Penjelasan |
|---|---|
| `class` | Blueprint untuk membuat object |
| `__construct()` | Method yang dipanggil saat `new Object()` |
| `$this` | Merujuk ke object yang sedang aktif |
| `public` | Bisa diakses dari mana saja |
| `protected` | Hanya dari class sendiri + turunannya |
| `private` | Hanya dari class sendiri |
| `interface` | Kontrak: method apa yang harus ada |
| `implements` | Class memenuhi kontrak interface |
| `extends` | Class mewarisi dari class lain |
| `abstract class` | Gabungan class + kontrak, tidak bisa di-instansiasi |
| `trait` | Potongan kode reusable lintas class |

## Relevansi dengan Laravel

- **Model/Controller** → `extends` (inheritance)
- **Request validation** → `implements` interface (kontrak)
- **SoftDeletes, HasFactory, Notifiable** → trait
- **Service Container** → dependency injection via interface
- **Middleware** → implements interface
