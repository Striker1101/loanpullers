<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'from_type',
        'to_type',
        'status',
        'dob',
    ];

    public function wallet()
    {

        return $this->hasMany(Wallet::class);
    }


    public function account()
    {

        return $this->hasMany(Account::class);
    }




}
