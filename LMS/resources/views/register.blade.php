@extends('layouts.unauthenticated-layout')


@section('content')
<div class="login-page mx-5">
  <div class="login-page-scroll">
    <h2>Register</h2>
    <p>Specify register type: </>
    <div class="d-grid mb-5">
      <a class="btn btn-link" href="\add-lecturer">Lecturer</a>
    </div>
    <div class="d-grid">
      <a class="btn btn-link" href="\add-student">Student</a>
    </div>
  </div>
</div>
@endsection
