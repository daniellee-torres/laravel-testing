<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Article extends Model
{
    use HasFactory;
    use DatabaseTransactions;

    public function scopeTrending($query)
    {
        return $query->orderBy('reads', 'desc')->get();
    }
}
