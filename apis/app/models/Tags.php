<?php

class Tags extends Eloquent
{

    public function news()
    {
        return $this->morphedByMany('News', 'tagable');
    }

    public function scopeFilters($query, $filters = array())
    {
        if ($val = array_get($filters, 'id')) {
            $query->where('id', '=', $val);
        }

        if ($val = array_get($filters, 'title')) {
            $query->where('title', '=', $val);
        }

        if ($val = array_get($filters, 'search')) {
            $query->where('title', 'LIKE', '%' . $val . '%');
        }

        return $query;
    }
}
