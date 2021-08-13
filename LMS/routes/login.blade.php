@extends('layouts.unauthenticated-layout')


@section('content')
<div class="login-page mx-5">
  <h2>Sign In</h2>
  <p>Enter details</>
  @if(session('message'))
    <div class="alert alert-success">
      {{session('message')}}
    </div>
  @endif
  <form action="/login" method="post">
    <div class="mb-3 mt-5">
      <label for="emailInput" class="form-label">Staff Id/ Matric No.</label>
      <input name="email" type="text" class="form-control" id="emailInput" 
        value="{{ old('email') }}" placeholder="Enter Staff Id/ Matric No." Required>
      
      @if(isset($errors) && !is_null($errors->first('email')))
        <p class="text-danger">{{$errors->first('email')}}</p>
      @endif
    </div>
    <div class="mb-3">
      <label for="inputPassword" class="form-label">Password</label>
      <input name="password" type="password" class="form-control" id="inputPassword" Required>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="d-grid">
      <button class="btn btn-primary" type="submit">Sign In</button>
    </div>
  </form>
  <div class="forgot-link">
    <a href="/forgot-password">Forgot your password?</a>
  </div>
  <div class="register-link">
    <a href="/register">Register</a>
  </div>
</div>
@endsection
