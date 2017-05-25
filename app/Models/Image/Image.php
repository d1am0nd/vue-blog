<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    public function createFromArray(array $array, $userId)
    {
        $this->user_id = $userId;
        $this->name = $array['name'];
        $this->path = ($array['path']);
        return $this->save();
    }
}
