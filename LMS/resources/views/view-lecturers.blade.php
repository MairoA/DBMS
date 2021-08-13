@extends('layouts.authenticated-layout')


@section('content')
    <div class="main-container">
        <div class="left-section">
            <div class="search-page">
                <div class="search-page-scroll mx-5">
                  <h2>Search Lecturers</h2>
                  <p>Enter details:</>
                  <form action="/lecturers" method="get">
                    <div class="mb-3 mt-5">
                      <label for="staffIdInput" class="form-label">Staff Id</label>
                      <input name="staff_id" type="text" class="form-control" id="staffIdInput" 
                        value="{{ $staff_id }}" placeholder="Enter Staff Id">
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
            @if($searched && count($lecturers) > 0)
            <table class="table table-striped"> 
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Staff Id</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lecturers as $key=>$lecturer)
                    <tr>
                        <th scope="row">{{$key + $count_index}}</th>
                        <td>{{$lecturer->name}}</td>
                        <td>{{$lecturer->id_no}}</td>
                        <td><a href="/edit-lecturer/{{$lecturer->id}}"> Edit </a></td>
                        <td><a onclick="confirm('Are you sure?')" href="/delete-lecturer/{{$lecturer->id}}"> Delete </a></td>
                    </tr>
                    @endforeach
                </tbody>    
            </table>
            {{ $lecturers->links() }}
            @elseif($searched)
            <div class="alert alert-primary">
                No Lecturers found!
            </div>
            @else
                <div class="blank-background"></div>
            @endif
        </div>
    </div>
@endsection
