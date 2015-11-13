<?php

ModuleRoute::context('Participants');

ModuleRoute::resource('participants', 'ParticipantsController', ['only' => ['index']]);
ModuleRoute::get('participants', 'ParticipantsController@index');