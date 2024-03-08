<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class garden extends Model
{
    use HasFactory;

    protected $table = 'gardens';
    protected $guarded = [];

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_code', 'division_code');
    }
}
