<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = [
        'cate_parent_id',
        'cate_name',
        'cate_descript',
        'cate_img_loc',
        'status',
        'updated_at',
        'created_at',
    ];
    protected $primaryKey = 'cate_id';

    public function getStatusAttribute($value)
    {
        if ($value == 'Y') {
            return 1;
        } else {
            return 0;
        }
    }
}