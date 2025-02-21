<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guidelines extends Model
{
    use HasFactory;
    protected $table = 'guidelines';
    protected $fillable = [
        'title',
        'guidelines',
        'fileName',
        'updatedBy',
        'created_at',
        'updated_at'
    ];

    // Enable timestamps for automatic handling
    public $timestamps = true;

    public function getStatusAttribute($value)
    {
        if ($value == 'Y') {
            return 1;
        } else {
            return 0;
        }
    }

    public function getupdatedByAttribute($value)
    {
        $name = User::where('id', $value)->first();
        return $name->employeeName;
    }
}