<?php

class News extends Eloquent
{
    public function images()
    {
        return $this->morphToMany('Images', 'imageable');
    }

    public function tags()
    {
        return $this->morphToMany('Tags', 'tagable');
    }

    public function categories()
    {
        return $this->hasOne('Categories', 'id', 'categories')->where('type', '=', '2');
    }

    public function scopeFilters($query, $filters = array())
    {
        if ($val = array_get($filters, 'id')) {
            $query->where('id', '=', $val);
        }

        if ($val = array_get($filters, 'type')) {
            $query->where('type', '=', $val);
        }

        if ($val = array_get($filters, 'user_id')) {
            $query->where('user_id', '=', $val);
        }

        if ($val = array_get($filters, 's')) {
            $query->where('title', 'LIKE', '%'.$val.'%');
            $query->orWhere('reference', 'LIKE', '%'.$val.'%');
        }

        return $query;
    }
}
