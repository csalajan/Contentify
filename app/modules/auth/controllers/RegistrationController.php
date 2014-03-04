<?php namespace App\Modules\Auth\Controllers;

use View, Sentry, Input, Redirect, Session, Captcha, FrontController, Exception, Validator;

class RegistrationController extends FrontController {

	public function getCreate()
	{
		$this->pageView('auth::register');
	}

	public function postCreate()
	{
		try {
			/*
			 * Validation
			 */
			$rules = array(
				'username' 	=> 'alpha_spaces|required|min:3|not_in:edit,password|unique:users,username', 
				'email' 	=> 'email|unique:users,email', 
				'password' 	=> 'required|min:6|confirmed'
			);

			$validator = Validator::make(Input::all(), $rules);
			if ($validator->fails()) {
				return Redirect::to('auth/registration/create')->withInput()->withErrors($validator);
			}

			if (! Captcha::check(Input::get('captcha'))) {
				return Redirect::to('auth/registration/create')
					->withInput()->withErrors(['message' => t('The captcha code is invalid!')]);
			}

			/*
			 * Register user
			 */
			$user = Sentry::register([
				'username'	=> Input::get('username'),
				'email'		=> Input::get('email'),
				'password'	=> Input::get('password'),
			], true);

			/*
			 * Add user to group "Users"
			 * This group is a basic group that isn't deletable so we do know it exists.
			 * (If it does'nt exist, we have a serious problem.)
			 */
			$userGroup = Sentry::findGroupById(2);
			$user->addGroup($userGroup);

			$this->message(t('Registration successful!'));
		} catch(Exception $e) {
			return Redirect::to('auth/registration/create')->withInput()->withErrors(['message' => $e->getMessage()]);
		}
	}
}