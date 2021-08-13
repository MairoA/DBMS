@extends('layouts.authenticated-layout')


@section('content')
<div class="main-container">
    <div class="left-section">
        <div class="search-page">
            <div class="search-page-scroll mx-5">
              <h2>Search Students</h2>
              <p>Enter details:</>
              <form action="/students" method="get">
                <div class="mb-3 mt-5">
                  <label for="matricNoInput" class="form-label">Reg No.</label>
                  <input name="matric_no" type="text" class="form-control" id="matricNoInput" 
                    value="{{ $matric_no }}" placeholder="Enter Reg No.">
                </div>
                <input name="searched" type="hidden" value="true">
                <div class="d-grid">
                  <button class="btn btn-primary" type="submit">Search</button>
                </div>
              </form>
            </div>
        </div>
    </div>
    <div class="py-5 ps-5 right-section">
        @if($searched && count($students) > 0)
        <table class="table table-striped"> 
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Reg No</th>
                    <th scope="col">Email</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $key=>$student)
                <tr>
                    <th scope="row">{{$key + $count_index}}</th>
                    <td>{{$student->name}}</td>
                    <td>{{$student->id_no}}</td>
                    <td>{{$student->email}}</td>
                    <td><a href="/edit-student/{{$student->id}}"> Edit </a></td>
                    <td><a onclick="confirm('Are you sure?')" href="/delete-student/{{$student->id}}"> Delete </a></td>
                </tr>
                @endforeach
            </tbody>    
        </table>
        {{ $students->links() }}
        @elseif($searched)
        <div class="alert alert-primary">
            No Students found!
        </div>
        @else
            <div class="blank-background"></div>
        @endif
    </div>
</div>
@endsection
