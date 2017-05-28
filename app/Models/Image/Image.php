<?php

namespace App\Models\Image;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $appends = ['image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeById($q, $id)
    {
        return $q->where('id', $id);
    }

    public function getImageAttribute()
    {
        return $this->path;
    }

    public function createFromArray(array $array, $userId)
    {
        $this->user_id = $userId;
        $this->name = $array['name'];
        $this->path = ($array['path']);
        return $this->save();
    }
}
