<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffShift extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shift_date',
        'start_time',
        'end_time',
        'section',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'shift_date' => 'date',
        ];
    }

    public function staffMember()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
