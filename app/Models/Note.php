<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Note extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'notes';
    protected $fillable = [
      'title',
      'content',
      'user_id',
    ];

    protected static function boot()
    {
      parent::boot();
  
      static::creating(function ($model) {
        $model->id = Uuid::uuid4()->toString();
      });
  
      static::deleting(function ($post) {
        $post->categories()->detach();
      });
    }
  
    public function categories()
    {
      return $this->belongsToMany(Category::class, 'notes_categories', 'note_id', 'category_id');
    }
}
