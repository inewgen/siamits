<?php

class Images extends Eloquent
{

    public function scopeFilters($query, $filters = array())
    {
        if ($val = array_get($filters, 'id')) {
            $query->where('id', '=', $val);
        }

        if ($val = array_get($filters, 'user_id')) {
            $query->where('user_id', '=', $val);
        }

        if ($val = array_get($filters, 'code')) {
            $query->where('code', '=', $val);
        }

        return $query;
    }

    public function news()
    {
        return $this->morphedByMany('News', 'imageable');
    }

    public function users()
    {
        return $this->morphedByMany('Users', 'imageable');
    }

    public function banners()
    {
        return $this->morphedByMany('Banners', 'imageable');
    }
}
