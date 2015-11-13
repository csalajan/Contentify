<?php namespace App\Modules\Participants\Http\Controllers;

use Redirect, FrontController;

class ParticipantsController extends FrontController {

    public function index()
    {

        $this->pageView('participants::index');
    }


}