<?php

class Tagables extends Eloquent
{

    public function scopeFilters($query, $filters = array())
    {
        if ($val = array_get($filters, 'tags_id')) {
            $query->where('tags_id', '=', $val);
        }

        if ($val = array_get($filters, 'tagable_id')) {
            $query->where('tagable_id', '=', $val);
        }

        if ($val = array_get($filters, 'tagable_type')) {
            $query->where('tagable_type', '=', $val);
        }

        return $query;
    }
}
