<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'ordername',
        'customerno',
        'quantity',
        'amount',
        'status',
        'notes',
        'assigned_to',
        'assigned_staff_name',
        'assignment_notes',
        'assigned_at',
    ];

    protected function casts(): array
    {
        return [
            'assigned_at' => 'datetime',
        ];
    }

    public function assignedStaff()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getAssignmentNameAttribute(): ?string
    {
        return $this->assigned_staff_name ?: $this->assignedStaff?->name;
    }
}
