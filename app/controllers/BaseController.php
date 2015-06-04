<?php

class BaseController extends Controller {

	protected $user;

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }

        // Get user
        $this->user = array();
        if (Auth::check()) {
            $id = Auth::id();
            $client = new Client(Config::get('url.siamits-api'));
            $user = $client->get('users/' . $id);
            $user = json_decode($user);

            if (!isset($user->data->record)) {
                return Redirect::to('/login')->with('message', 'Sorry, Please try to login again');
            }

            $this->user = $user->data->record;

            // Admin
            if (Request::is('members*')) {
                if (!isset($this->user->roles[0]->id) || ($this->user->roles[0]->id != '1')) {
                    return Redirect::to('');
                }
            }

            // The Default Language
            date_default_timezone_set('Asia/Bangkok');
        }
    }

}
