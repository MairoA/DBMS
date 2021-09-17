@extends('layouts.unauthenticated-layout')


@section('content')
<div class="full-height mx-5">
  <div class="login-page-scroll">
    <h2>Register Student</h2>
    <p>Enter details</>
    <form action="/register-student" method="post">
        <div class="mb-3">
          <label for="firstNameInput" class="form-label">First Name</label>
          <input name="first_name" type="text" class="form-control" id="firstNameInput" 
            value="{{ old('first_name') }}" placeholder="Enter First Name" Required>
          
          @if(isset($errors) && !is_null($errors->first('first_name')))
            <p class="text-danger">{{$errors->first('first_name')}}</p>
          @endif
        </div>
        <div class="mb-3">
            <label for="lastNameInput" class="form-label">Last Name</label>
            <input name="last_name" type="text" class="form-control" id="lastNameInput" 
              value="{{ old('last_name') }}" placeholder="Enter Last Name" Required>
            
            @if(isset($errors) && !is_null($errors->first('last_name')))
              <p class="text-danger">{{$errors->first('last_name')}}</p>
            @endif
        </div>
        <div class="mb-3">
            <label for="emailInput" class="form-label">Email address</label>
            <input name="email" type="email" class="form-control" id="emailInput" 
            value="{{ old('email') }}" placeholder="Enter Email address" Required>
            
            @if(isset($errors) && !is_null($errors->first('email')))
            <p class="text-danger">{{$errors->first('email')}}</p>
            @endif
        </div>
        <div class="mb-3">
            <label for="idNoInput" class="form-label">Matric No</label>
            <input name="id_no" type="text" class="form-control" id="idNoInput" 
              value="{{ old('id_no') }}" placeholder="Enter Matric No" Required>
            
            @if(isset($errors) && !is_null($errors->first('id_no')))
              <p class="text-danger">{{$errors->first('id_no')}}</p>
            @endif
        </div>
        <div class="mb-3">
            <label for="sexInput" class="form-label">Sex</label>
            <input name="sex" type="text" class="form-control" id="sexInput" 
              value="{{ old('sex') }}" placeholder="Enter Sex" Required>
            
            @if(isset($errors) && !is_null($errors->first('sex')))
              <p class="text-danger">{{$errors->first('sex')}}</p>
            @endif
        </div>
        <div class="mb-3">
          <label for="yearOfEntryInput" class="form-label">Year Of Entry</label>
          <input name="year_of_entry" type="text" class="form-control" id="yearOfEntryInput" 
            value="{{ old('year_of_entry') }}" placeholder="Enter Year Of Entry" Required>
          
          @if(isset($errors) && !is_null($errors->first('year_of_entry')))
            <p class="text-danger">{{$errors->first('year_of_entry')}}</p>
          @endif
        </div>
        <div class="mb-3">
          <label for="courseOfEntryInput" class="form-label">Course Of Entry</label>
          <input name="course_of_entry" type="text" class="form-control" id="courseOfEntryInput" 
            value="{{ old('course_of_entry') }}" placeholder="Enter Course Of Entry" Required>
          
          @if(isset($errors) && !is_null($errors->first('course_of_entry')))
            <p class="text-danger">{{$errors->first('course_of_entry')}}</p>
          @endif
        </div>
        <div class="mb-3">
            <label for="inputPassword" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="inputPassword" Required>
            
            @if(isset($errors) && !is_null($errors->first('password')))
              <p class="text-danger">{{$errors->first('password')}}</p>
            @endif
        </div>
        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input name="password_confirmation" type="password" class="form-control" id="confirmPassword" Required>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="d-grid">
            <button class="btn btn-primary" type="submit">Register</button>
        </div>
    </form>
    <div class="forgot-link">
      <a href="/login">Sign In</a>
    </div>
  </div>
</div>
@endsection
