<?php

class Categories extends Eloquent {

	public function scopeFilters($query, $filters = array())
    {
        if ($val = array_get($filters, 'id')) {
            $query->where('id', '=', $val);
        }

        if ($val = array_get($filters, 'member_id')) {
            $query->where('member_id', '=', $val);
        }

        if ($val = array_get($filters, 'type')) {
            $query->where('type', '=', $val);
        }

        return $query;
    }

    public function news()
    {
        return $this->belongsTo('News');
    }
}