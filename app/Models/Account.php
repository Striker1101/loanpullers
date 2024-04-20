<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_name',
        'account_number',
        'bank_branch',
        'bank_address',
        'swidt_code',
        'account_type', // Bank or Crypto
        'bank_name', // Nullable
        'routing_number',
        'description', // Nullable
        'crypto_wallet_address', // Nullable
        // Add other fields as needed
    ];

    // Define relationships or additional methods here

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
