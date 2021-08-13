@extends('layouts.unauthenticated-layout')


@section('content')
<div class="full-height mx-5">
  <div class="login-page-scroll">
    <h2>Register Lecturer</h2>
    <p>Enter details</>
    <form action="/register-lecturer" method="post">
        <div class="mb-3 mt-4">
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
            <label for="idNoInput" class="form-label">Staff Id</label>
            <input name="id_no" type="text" class="form-control" id="idNoInput" 
              value="{{ old('id_no') }}" placeholder="Enter Staff Id" Required>
            
            @if(isset($errors) && !is_null($errors->first('id_no')))
              <p class="text-danger">{{$errors->first('id_no')}}</p>
            @endif
        </div>
        <div class="mb-3">
          <label for="courseInput" class="form-label">Course</label>
          <select name="course[]" type="file" class="form-control multiple-select" id="courseInput" multiple="multiple"  Required>
            <option value="">Select Course</option>
            @foreach ($courses as $course)
              <option value="{{$course->id}}" {{in_array($course->id, old('course')?? [])? 'selected':''}}>{{$course->name}}</option>    
            @endforeach
          </select>
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
