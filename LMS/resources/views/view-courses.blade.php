@extends('layouts.authenticated-layout')


@section('content') 
<div class="main-container">
    <div class="left-section">
        <div class="search-page">
            <div class="search-page-scroll mx-5">
              <h2>Search Courses</h2>
              <p>Enter details:</>
              <form action="/courses" method="get">
                <div class="mb-3 mt-5">
                  <label for="nameInput" class="form-label">Name</label>
                  <input name="name" type="text" class="form-control" id="nameInput" 
                    value="{{ $name }}" placeholder="Enter Name">
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
        <div class="float-right mx-5 mb-3">
            <a class="btn btn-primary" href="/add-course">Add Course</a>
        </div>
        @if($searched && count($courses) > 0)
    <div class="m-5">
        <table class="table table-striped"> 
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Code</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $key=>$course)
                <tr>
                    <th scope="row">{{$key + $count_index}}</th>
                    <td>{{$course->name}}</td>
                    <td>{{$course->code}}</td>
                    <td><a href="/edit-course/{{$course->id}}"> Edit </a></td>
                    <td><a onclick="confirm('Are you sure?')" href="/delete-course/{{$course->id}}"> Delete </a></td>
                </tr>
                @endforeach
            </tbody>    
        </table>
    {{ $courses->links() }}
    @elseif($searched)
            <div class="alert alert-primary mt-5">
                No Courses found!
            </div>
            @else
                <div class="blank-background mt-5"></div>
            @endif
        </div>
    </div>
@endsection
