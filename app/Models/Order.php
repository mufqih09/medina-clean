<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'worker_id',
        'cleaning_date',
        'location',
        'carpet_length',
        'carpet_width',
        'total_price',
        'payment_method',
        'payment_status',
        'job_status',
    ];

    protected function casts(): array
    {
        return [
            'cleaning_date' => 'date',
            'carpet_length' => 'float',
            'carpet_width' => 'float',
            'total_price' => 'decimal:2',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function worker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'worker_id');
    }
}
