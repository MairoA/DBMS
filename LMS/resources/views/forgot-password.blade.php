@extends('layouts.unauthenticated-layout')


@section('content')
<div class="login-page mx-5">
  <div class="login-page-scroll">
    <h2>Reset Password</h2>
    <p>Enter details</>
    @if(session('message'))
      <div class="alert alert-success">
        {{session('message')}}
      </div>
    @endif
    <form action="/reset-password" method="post">
      <div class="mb-3 mt-5">
        <label for="emailInput" class="form-label">Staff Id/ Matric No.</label>
        <input name="email" type="text" class="form-control" id="emailInput" 
          value="{{ old('email') }}" placeholder="Enter Staff Id/ Matric No." Required>
        
        @if(isset($errors) && !is_null($errors->first('email')))
          <p class="text-danger">{{$errors->first('email')}}</p>
        @endif
      </div>
      <div class="mb-3">
        <label for="inputPassword" class="form-label">New Password</label>
        <input name="password" type="password" class="form-control" id="inputPassword" Required>
      </div>
      <div class="mb-3">
        <label for="inputConfirmPassword" class="form-label">Confirm New Password</label>
        <input name="password_confirmation" type="password" class="form-control" id="inputConfirmPassword" Required>
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="d-grid">
        <button class="btn btn-primary" type="submit">Reset Password</button>
      </div>
    </form>
    <div class="forgot-link">
      <a href="/login">Sign In</a>
    </div>
  </div>
</div>
@endsection
