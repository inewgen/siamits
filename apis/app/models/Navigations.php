<?php

class Navigations extends Eloquent
{
    protected $softDelete = true;
    /**
     * [boot description]
     * @return [type] [description]
     */
    public static function boot()
    {

    }

    /**
     * [scopeFilters description]
     * @param  [type] $query   [description]
     * @param  array  $filters [description]
     * @return [type] [description]
     */
    public function scopeFilters($query, $filters = array())
    {
        if ($val = array_get($filters, 'member_id')) {
            $query->where('member_id', '=', $val);
        }

        return $query;
    }
}

//Members::observe(new MembersObserver());
