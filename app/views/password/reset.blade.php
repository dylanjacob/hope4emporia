@extends('layouts.master')

@section('styles')
<style type="text/css">
body
{
    background: url('/img/01-wood.jpg') 50% 0 fixed;
    background-size: cover;
    padding: 0;
    margin: 0;
}
.wrap
{
    width: 100%;
    height: 100%;
    min-height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 99;
}

p.form-title
{
	padding-top: 80px;
    font-family: 'Open Sans' , sans-serif;
    font-size: 20px;
    font-weight: 600;
    text-align: center;
    color: #FFFFFF;
    margin-top: 5%;
    text-transform: uppercase;
    letter-spacing: 4px;
}

form
{
    width: 250px;
    margin: 0 auto;
}
form.login input[type="password"], form.login input[type="email"]
{
    width: 100%;
    margin: 0;
    padding: 5px 10px;
    background: 0;
    border: 0;
    border-bottom: 1px solid #FFFFFF;
    outline: 0;
    font-style: italic;
    font-size: 12px;
    font-weight: 400;
    letter-spacing: 1px;
    margin-bottom: 5px;
    color: #FFFFFF;
    outline: 0;
}

form.login input[type="submit"]
{
    width: 100%;
    font-size: 14px;
    text-transform: uppercase;
    font-weight: 500;
    margin-top: 16px;
    outline: 0;
    cursor: pointer;
    letter-spacing: 1px;
}

form.login input[type="submit"]:hover
{
    transition: background-color 0.5s ease;
}

form.login label, form.login a
{
    font-size: 12px;
    font-weight: 400;
    color: #FFFFFF;
}

form.login a
{
    transition: color 0.5s ease;
}

form.login a:hover
{
    color: #2ecc71;
}

.pr-wrap
{
    width: 100%;
    height: 100%;
    min-height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 999;
    display: none;
}
</style>
@stop

@section('content')


@if(Session::has('error'))
	<div class="alert alert-danger alert-dismissable navbar navbar-fixed-top">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p class="lead text-center"><strong>Ooops!</strong> {{ Session::get('error') }}</p>
	</div>
@endif

<div class="wrap">
	<p class="form-title">
	    Change Password</p>
	<form action="/password/reset" method="POST" class="login">
		<input type="hidden" name="token" value="{{ $token }}" />
	<input type="email" name="email" placeholder="Email" />
	<input type="password" name="password" placeholder="Password" />
	<input type="password" name="password_confirmation" placeholder="Confirm Password" />
	<input type="submit" value="Change Password" class="btn btn-success btn-sm" />
	</form>
</div>

@stop