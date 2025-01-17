<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class section extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'subtitle',
        'thumbnail',
        'content',
        'post_as',
    ];    

    protected static function boot()
    {
        parent::boot();
        static::updating(function ($model) {
            //jika pada thumbnail terdapat file baru dan file lama !== null, maka hapus file thumbnail lama
            if($model->isDirty('thumbnail') && ($model->getOriginal('thumbnail') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('thumbnail'));
            }
        });
    }
}
