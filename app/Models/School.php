<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    public function licenses()
    {
        return $this->hasMany(License::class);
    }

    public function activeLicenses()
    {
        return $this->hasMany(License::class)
            ->where('status', 'active')
            ->where('expiry_date', '>=', now());
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
