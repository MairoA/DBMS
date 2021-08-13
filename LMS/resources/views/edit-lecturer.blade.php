@extends('layouts.authenticated-layout')


@section('content')
<div class="main-container">
  <div class="left-section ps-5 mx-5">
          <h2>Edit Lecturer</h2>
          <p>Enter details:</>
          <form action="/update-lecturer" method="post">
              <div class="mb-3">
                <label for="firstNameInput" class="form-label">First Name</label>
                <input name="first_name" type="text" class="form-control" id="firstNameInput" 
                  value="{{ old('first_name') ?? $lecturer->first_name }}" placeholder="Enter First Name" Required>
                
                @if(isset($errors) && !is_null($errors->first('first_name')))
                  <p class="text-danger">{{$errors->first('first_name')}}</p>
                @endif
              </div>
              <div class="mb-3">
                  <label for="lastNameInput" class="form-label">Last Name</label>
                  <input name="last_name" type="text" class="form-control" id="lastNameInput" 
                    value="{{ old('last_name') ?? $lecturer->last_name }}" placeholder="Enter Last Name" Required>
                  
                  @if(isset($errors) && !is_null($errors->first('last_name')))
                    <p class="text-danger">{{$errors->first('last_name')}}</p>
                  @endif
              </div>
              <div class="mb-3">
                  <label for="idNoInput" class="form-label">Staff Id</label>
                  <input name="id_no" type="text" class="form-control" id="idNoInput" 
                    value="{{ old('id_no') ?? $lecturer->id_no }}" placeholder="Enter Staff Id" Required>
                  
                  @if(isset($errors) && !is_null($errors->first('id_no')))
                    <p class="text-danger">{{$errors->first('id_no')}}</p>
                  @endif
              </div>
              <div class="mb-3">
                <label for="courseInput" class="form-label">Course</label>
                <select name="course[]" type="file" class="form-control multiple-select" id="courseInput" multiple="multiple"  Required>
                  <option value="">Select Course</option>
                  @foreach ($courses as $course)
                    <option value="{{$course->id}}" {{in_array($course->id, old('course') ?? json_decode($lecturer->course))? 'selected':''}}>{{$course->name}}</option>    
                  @endforeach
                </select>
              </div>
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="lecturer_id" value="{{ $lecturer->id }}">
              <div class="d-grid">
                  <button class="btn btn-primary" type="submit">Update</button>
              </div>
          </form>
  </div>
  <div class="right-section">
  </div>
</div>
@endsection
