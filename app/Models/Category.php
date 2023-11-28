<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['name', 'description'];
    protected $table = 'categories';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
            $model->name = Str::upper($model->name);
        });
    }
}