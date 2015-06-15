<?php

class NavigationsRepository implements NavigationsRepositoryInterface
{
    public function lists($data)
    {
        //required
        if (!isset($data)) {
            return false;
        }

        $filters = $data;

        $query = Navigations::filters($filters)->orderBy('member_id', 'desc');

        $results = $query->get();

        if (!isset($results) || !is_object($results)) {
            return false;
        }

        $results = json_decode($results, true);
        return $results;
    }

    public function create($data)
    {
        //required
        if (!isset($data)) {
            return false;
        }

        // [1] Insert Navigations
        $results               = new Navigations();
        $results->member_id    = $data['member_id'];
        $results->title        = $data['title'];
        $results->position     = (isset($data['position']) ? $data['position'] : '0');
        $results->url          = $data['url'];
        $results->status       = (isset($data['parent_id']) ? $data['parent_id'] : '1');
        $results->save();

        if (!isset($results)) {
            return false;
        }

        return $results;
    }

    public function update($data)
    {
        //required
        if (!isset($data['id'])) {
            return false;
        }

        $results = Navigations::where('id', '=', $data['id'])
                ->update($data);

        if (!isset($results)) {
            return false;
        }

        return $results;
    }

    public function destroy($data)
    {
        //required
        if (!isset($data['id'])) {
            return false;
        }

        $results = Navigations::find($data['id']);
        $results->delete();

        if (!isset($results)) {
            return false;
        }

        return $results;
    }
}
