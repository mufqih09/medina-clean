<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user is an Admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'ADMIN';
    }

    /**
     * Check if user is a Field Worker
     */
    public function isWorker(): bool
    {
        return $this->role === 'WORKER';
    }

    /**
     * Check if user is a Customer
     */
    public function isCustomer(): bool
    {
        return $this->role === 'CUSTOMER';
    }

    /**
     * Profile relation for Worker
     */
    public function workerProfile(): HasOne
    {
        return $this->hasOne(WorkerProfile::class, 'user_id');
    }

    /**
     * Orders made by this user as customer
     */
    public function ordersAsCustomer(): HasMany
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    /**
     * Orders assigned to this user as worker
     */
    public function ordersAsWorker(): HasMany
    {
        return $this->hasMany(Order::class, 'worker_id');
    }
}
