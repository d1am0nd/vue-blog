<?php

namespace App\Models\Posts;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function getPublishedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($q)
    {
        return $q->where('active', 1)->where('published_at', '<', Carbon::now());
    }

    public function scopeByUserOrActive($q, $userId = null)
    {
        return $userId === null ? $q->active() : $q->where(function ($q) use ($userId) {
            $q->where('user_id', $userId)
                ->orWhere(function ($q) {
                    $q->active();
                });
            });
    }

    public function scopeBySlug($q, $slug)
    {
        return $q->where('slug', $slug);
    }

    public function scopeByUserId($q, $userId)
    {
        return $q->where('user_id', $userId);
    }

    public function createFromArray(array $array, $userId)
    {
        $this->active = (array_key_exists('active', $array) && is_bool($array['active'])) ? $array['active'] : false;
        $this->user_id = $userId;
        $this->title = $array['title'];
        $this->summary = ($array['summary']);
        $this->slug = str_slug($array['title']);
        $this->content = $array['content'];
        try {
            $this->published_at = Carbon::parse($array['published_at']);
        } catch (\Exception $e) {
            $this->published_at = null;
        }
        return $this->save();
    }

    public function updateById(array $array, $userId)
    {
        $array['summary'] = ($array['summary']);
        return $this->byUserId($userId)->update($array);
    }

    private function convertToCool(array $array)
    {
        $atts = collect($array)->except('user_id', 'id');
        if ($atts->has('title')) {
            // TODO
        }
    }
}
