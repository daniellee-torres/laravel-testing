<?php

namespace App\Models;

trait Likeability
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
    public function like()
    {
        $like = new Like(['user_id' => auth()->id()]);
        $this->likes()->save($like);
    }

    public function unlike()
    {
        $this->likes()->where('user_id', auth()->id())->delete();
    }

    public function isLiked()
    {
        return !! $this->likes()->where('user_id', auth()->id())->count();
    }

    public function toggle()
    {
        if($this->isLiked()){
            return $this->unlike();
        }
        return $this->like();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}
