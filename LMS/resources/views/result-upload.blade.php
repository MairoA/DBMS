@extends('layouts.authenticated-layout')


@section('content')
<div class="main-container">
  <div class="left-section ps-5 mx-5">
    <h2>Result Upload</h2>
    <p>Enter details:</>
    <form id="upload-form" action="/upload-report" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="sessionInput" class="form-label">Session</label>
        <select name="session" type="file" class="form-control" id="sessionInput" Required>
          <option value="">Select Session</option>
          @foreach ($sessions as $session)
            <option value="{{$session->session}}" {{old('session') == $session->session? 'selected':''}}>{{$session->session}}</option>    
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label for="semesterInput" class="form-label">Semester</label>
        <select name="semester" type="file" class="form-control" id="semesterInput" Required>
          <option value="">Select Semester</option>
          <option value="1" {{old('semester') == 1? 'selected':''}}>1st Semester</option>
          <option value="2" {{old('semester') == 2? 'selected':''}}>2nd Semester</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="courseInput" class="form-label">Course</label>
        <select name="course" type="file" class="form-control" id="courseInput" Required>
          <option value="">Select Course</option>
          @foreach ($courses as $course)
            <option value="{{$course->id}}" {{old('course') == $course->id? 'selected':''}}>{{$course->name}}</option>    
          @endforeach
        </select>
      </div>
      <div class="mb-3">
          <label for="nameInput" class="form-label">File</label>
          <input name="upload-file" type="file" class="form-control" id="nameInput"
          accept=".xls,.xlsx, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel" Required>
          
          @if(isset($errors) && !is_null($errors->first('upload-file')))
            <p id="error-message" class="text-danger">{{$errors->first('upload-file')}}</p>
          @endif
          <p id="max-file-message" class="text-danger" hidden>The uploaded file must not be greater than 2 megabytes</p>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="d-grid">
            <button class="btn btn-primary" type="submit">Upload File</button>
        </div>
    </form>
  </div>
</div>
@endsection

@section('script')
<script>
  $(function(){
      $('#upload-form').submit(function(){
          var isOk = true;

          $('#upload-form input[type=file]').each(function(){
              if(isOk && typeof this.files[0] !== 'undefined'){
                  var maxSize = 2097152; //2MB
                  var size = this.files[0].size;
                  isOk = maxSize > size;
              }
          });
          
          if (!isOk) {
            $('#max-file-message').attr('hidden', null);
            $('#error-message').attr('hidden', true);
          }
          else {      
            $('#max-file-message').attr('hidden', true);
          }
          return isOk;
      });
  });
  </script>
@endsection
