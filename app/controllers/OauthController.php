<?php

class OauthController extends \BaseController {

	public function __construct()
	{
		$this->beforeFilter('check-authorization-params|auth', array('on' => 'getAuthorize'));
		$this->beforeFilter('check-authorization-params|auth|csrf', array('on' => 'postAuthorize'));
	}

	public function postAccessToken()
	{
		return AuthorizationServer::performAccessTokenFlow();
	}

	public function postAuthorize()
	{
		// get the data from the check-authorization-params filter
	    $params = Session::get('authorize-params');

	    // get the user id
	    $params['user_id'] = Auth::user()->id;

	    // check if the user approved or denied the authorization request
	    if (Input::get('approve') !== null) {

	        $code = AuthorizationServer::newAuthorizeRequest('user', $params['user_id'], $params);

	        Session::forget('authorize-params');

	        return Redirect::to(AuthorizationServer::makeRedirectWithCode($code, $params));
	    }

	    if (Input::get('deny') !== null) {

	        Session::forget('authorize-params');

	        return Redirect::to(AuthorizationServer::makeRedirectWithError($params));
	    }
	}

	public function getAuthorize()
	{
		// get the data from the check-authorization-params filter
	    $params = Session::get('authorize-params');

	    // get the user id
	    $params['user_id'] = Auth::user()->id;

	    // display the authorization form
	    return View::make('authorization-form', array('params' => $params));
	}
}