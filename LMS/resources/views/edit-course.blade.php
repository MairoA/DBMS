@extends('layouts.authenticated-layout')

@section('content')
<div class="mx-5">
    <form action="/update-course" method="post">
      <div class="mb-3">
        <label for="nameInput" class="form-label">Name</label>
        <input name="name" type="text" class="form-control" id="nameInput" 
          value="{{ old('name') ?? $course->name }}" placeholder="Enter Name" Required>
        
        @if(isset($errors) && !is_null($errors->first('name')))
          <p class="text-danger">{{$errors->first('name')}}</p>
        @endif
      </div>
      <div class="mb-3">
          <label for="codeInput" class="form-label">Code</label>
          <input name="code" type="text" class="form-control" id="codeInput" 
            value="{{ old('code') ?? $course->code }}" placeholder="Enter Code" Required>
          
          @if(isset($errors) && !is_null($errors->first('code')))
            <p class="text-danger">{{$errors->first('code')}}</p>
          @endif
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="course_id" value="{{ $course->id }}">
      <div class="d-grid">
        <button class="btn btn-primary" type="submit">Update</button>
      </div>
    </form>
  </div>
@endsection
