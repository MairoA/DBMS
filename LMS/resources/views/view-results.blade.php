@extends('layouts.authenticated-layout')


@section('content')
<div class="main-container">
    <div class="left-section">
        <div class="search-page">
            <div class="search-page-scroll mx-5">
              <h2>Welcome</h2>
              <p>{{\Auth::user()->name}}</p>
              <form action="/view-results" method="get">
                <div class="mb-3">
                  <label for="sessionInput" class="form-label">Session</label>
                  <select name="session" type="file" class="form-control" id="sessionInput" Required>
                    <option value="">Select Session</option>
                    @foreach ($sessions as $session)
                      <option value="{{$session->session}}" {{$session_value == $session->session? 'selected':''}}>{{$session->session}}</option>    
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="semesterInput" class="form-label">Semester</label>
                  <select name="semester" type="file" class="form-control" id="semesterInput" Required>
                    <option value="">Select Semester</option>
                    <option value="1" {{$semester == "1"? 'selected':''}}>1st Semester</option>
                    <option value="2" {{$semester == "2"? 'selected':''}}>2nd Semester</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="courseInput" class="form-label">Course</label>
                  <select name="course" type="file" class="form-control" id="courseInput" Required>
                    <option value="">Select Course</option>
                    @foreach ($courses as $course)
                      <option value="{{$course->id}}" {{$course_id == $course->id? 'selected':''}}>{{$course->name}}</option>    
                    @endforeach
                  </select>
                </div>
                @if(\Auth::user()->role != 'Student')
                  <div class="mb-3">
                    <label for="matricNoInput" class="form-label">Matric No</label>
                    <input name="martric_no" value="{{ $martric_no }}" type="text" class="form-control" id="matricNoInput">     
                  </div>
                @else
                  <input name="martric_no" value="{{ \Auth::user()->id_no }}" type="hidden">
                @endif
                  <div class="d-grid">
                      <button class="btn btn-primary" type="submit">Load Results</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
        <div class="py-5 ps-5 right-section">
        @if(count($results) > 0)
            <table class="table table-striped mt-5"> 
              <thead>
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Matric No</th>
                      <th scope="col">CA 1</th>
                      <th scope="col">CA 2</th>
                      <th scope="col">Exam</th>
                      <th scope="col">Total</th>
                      <th scope="col">Grade</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($results as $key=>$result)
                  <tr>
                      <th scope="row">{{$key + 1}}</th>
                      <td>{{$result->matric_no}}</td>
                      <td>{{$result->ca_1}}</td>
                      <td>{{$result->ca_2}}</td>
                      <td>{{$result->exam}}</td>
                      <td>{{$result->total}}</td>
                      <td>{{$result->grade}}</td>
                  </tr>
                  @endforeach
              </tbody>    
          </table>
        @elseif(isset($session_value))
          <div class="alert alert-primary">
            No Results found!
          </div>
          @else
          <div class="blank-background"></div>
      @endif
    </div>
</div>
@endsection
