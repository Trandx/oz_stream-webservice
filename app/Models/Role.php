<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Role extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    public static function boot()
    {

        parent::boot();

        self::creating(function ($model) {

            $model->id = Uuid::uuid4()->toString();

        });

    }
}
