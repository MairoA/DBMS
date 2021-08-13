@extends('layouts.authenticated-layout')


@section('content')
<form action="/update-student" method="post">
<div class="main-container">
  <div class="left-section ps-5 mx-5">
          <h2>Edit Student</h2>
          <p>Enter details:</>
              <div class="mb-3">
                <label for="firstNameInput" class="form-label">First Name</label>
                <input name="first_name" type="text" class="form-control" id="firstNameInput" 
                  value="{{ old('first_name') ?? $student->first_name }}" placeholder="Enter First Name" Required>
                
                @if(isset($errors) && !is_null($errors->first('first_name')))
                  <p class="text-danger">{{$errors->first('first_name')}}</p>
                @endif
              </div>
              <div class="mb-3">
                  <label for="lastNameInput" class="form-label">Last Name</label>
                  <input name="last_name" type="text" class="form-control" id="lastNameInput" 
                    value="{{ old('last_name') ?? $student->last_name }}" placeholder="Enter Last Name" Required>
                  
                  @if(isset($errors) && !is_null($errors->first('last_name')))
                    <p class="text-danger">{{$errors->first('last_name')}}</p>
                  @endif
              </div>
              <div class="mb-3">
                  <label for="emailInput" class="form-label">Email address</label>
                  <input name="email" type="email" class="form-control" id="emailInput" 
                  value="{{ old('email') ?? $student->email }}" placeholder="Enter Email address" Required>
                  
                  @if(isset($errors) && !is_null($errors->first('email')))
                  <p class="text-danger">{{$errors->first('email')}}</p>
                  @endif
              </div>
              <div class="mb-3">
                  <label for="idNoInput" class="form-label">Reg No</label>
                  <input name="id_no" type="text" class="form-control" id="idNoInput" 
                    value="{{ old('id_no') ?? $student->id_no }}" placeholder="Enter Reg No" Required>
                  
                  @if(isset($errors) && !is_null($errors->first('id_no')))
                    <p class="text-danger">{{$errors->first('id_no')}}</p>
                  @endif
              </div>
              
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="student_id" value="{{ $student->id }}">
              <div class="d-grid">
                  <button class="btn btn-primary" type="submit">Update</button>
              </div>
    </div>
    <div class="left-section-2 ps-5 mx-5">
      <div class="mb-3">
        <label for="sexInput" class="form-label">Sex</label>
        <input name="sex" type="text" class="form-control" id="sexInput" 
          value="{{ old('sex') ?? $student->sex }}" placeholder="Enter Sex" Required>
        
        @if(isset($errors) && !is_null($errors->first('sex')))
          <p class="text-danger">{{$errors->first('sex')}}</p>
        @endif
      </div>
      <div class="mb-3">
        <label for="yearOfEntryInput" class="form-label">Year Of Entry</label>
        <input name="year_of_entry" type="text" class="form-control" id="yearOfEntryInput" 
          value="{{ old('year_of_entry') ?? $student->year_of_entry }}" placeholder="Enter Year Of Entry" Required>
        
        @if(isset($errors) && !is_null($errors->first('year_of_entry')))
          <p class="text-danger">{{$errors->first('year_of_entry')}}</p>
        @endif
      </div>
      <div class="mb-3">
        <label for="courseOfEntryInput" class="form-label">Course Of Entry</label>
        <input name="course_of_entry" type="text" class="form-control" id="courseOfEntryInput" 
          value="{{ old('course_of_entry') ?? $student->course_of_entry }}" placeholder="Enter Course Of Entry" Required>
        
        @if(isset($errors) && !is_null($errors->first('course_of_entry')))
          <p class="text-danger">{{$errors->first('course_of_entry')}}</p>
        @endif
      </div>
    </div>
</div>
</form>
@endsection
