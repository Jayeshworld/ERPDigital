<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageDetails extends Model
{
    use HasFactory;
    protected $table = 'packageDetails';
    protected $fillable = [
        'package_name',
        'package_thrashold',
        'package_descript',
        'status',
        'HSN',
        'created_at',
        'updated_at'
    ];

    // Ensure timestamps are used correctly
    public $timestamps = true;
    public function getStatusAttribute($value)
    {
        if ($value == 'Y') {
            return 1;
        } else {
            return 0;
        }
    }
}