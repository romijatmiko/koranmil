<?php

// app/Models/Pejabat.php
// app/Models/Post.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'isi', 'img', 'status', 'distrik'];

    // Tidak ada hubungan dengan kategori dalam contoh ini
}


