<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class VirtualRec extends Model
{
    use HasFactory;
    protected $table = 'virtual_rec'; // Specify table name

    protected $fillable = [
        'Virtual_Number',
        'User_Login_ID',
        'Company_Name',
        'Forwarding_Number',
        'Whatsapp_Number',
        'callNumber',
        'orderID',
        'Status',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true; // Enables timestamps (created_at & updated_at)

    public function getStatusAttribute($value)
    {
        // Normalize status values for consistency
        $formattedValue = strtolower(trim($value));

        // Define Bootstrap classes for statuses
        $statusColors = [
            'active' => 'bg-success',
            'closed' => 'bg-danger',
            'on hold' => 'bg-warning',
            'onhold' => 'bg-warning', // Handling variations
            'inforce' => 'bg-primary',
            'available' => 'bg-info',
        ];

        // Return formatted status with class
        return [
            'label' => ucwords($formattedValue), // Capitalize status text
            'class' => $statusColors[$formattedValue] ?? 'bg-light text-dark', // Default style
        ];
    }
}
