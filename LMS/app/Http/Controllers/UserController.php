<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;

class UserController extends Controller
{
    //
    public function lecturerView(Request $request)
    {
        $paginate_count = 10;

        $query = User::where('role','Lecturer');

        if(isset($request->staff_id)){
            $query = $query->where('id_no', 'like',"%{$request->staff_id}%");
        }

        $lecturers =  $query->paginate($paginate_count);
        $count_index = 1;
        if(isset($request['page'])) {
            $count_index += ($request['page'] - 1) * $paginate_count;
        }
        return view('view-lecturers')
                ->with(['lecturers'=> $lecturers, 
                        'count_index' => $count_index,
                        'staff_id' => $request->staff_id,
                        'searched' => $request->searched
                    ]);
    }

    public function addLecturerView(Request $request)
    {
        $courses = Course::all();
        return view('add-lecturer')->with(['courses' => $courses]);
    }

    public function registerLecturer(Request $request)
    {
        $create_request = $request->except('_token');
        //validate entries
        $validateSignup = \Validator::make($create_request, [
            'first_name' => 'bail|required|max:100|min:3|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'bail|required|max:100|min:3|regex:/^[a-zA-Z\s]+$/',
            'password' => 'bail|required|confirmed',
            'course' => 'bail|required|array|exists:courses,id',
            'id_no' => 'bail|required|unique:users,id_no|numeric'
        ]);

        if ($validateSignup->fails()) {
            return back()->withErrors($validateSignup)
                        ->withInput();
        }
        $create_request['role'] = 'Lecturer';
        $create_request['course'] = json_encode($create_request['course']);
        $create_request['password'] = \Hash::make($create_request['password']);

        $user = User::create($create_request);

        return redirect('/login')->with('message', 'Lecturer created successfully! Kindly login with the created credentials');
    }

    public function deleteLecturer(Request $request, $id) {
        $user = User::find($id);
        $user->delete();
        return redirect('/lecturers')->with('message', 'Lecturer deleted successfully!');
    }

    public function editLecturerView(Request $request, $id) {
        $user = User::find($id);

        if(is_null($user) || $user->role != 'Lecturer') {
            return abort(404);
        }

        $courses = Course::all();
        return view('edit-lecturer')->with(['lecturer'=> $user,'courses' => $courses]);
    }

    public function updateLecturer(Request $request)
    {
        $update_request = $request->except('_token');
        $id = $request->lecturer_id;
        //validate entries
        $validateUpdate = \Validator::make($update_request, [
            'first_name' => 'bail|required|max:100|min:3|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'bail|required|max:100|min:3|regex:/^[a-zA-Z\s]+$/',
            'id_no' => 'bail|required|unique:users,id_no,'.$id.'|numeric',
            'course' => 'bail|required|array|exists:courses,id'
        ]);

        if ($validateUpdate->fails()) {
            return back()->withErrors($validateUpdate)
                        ->withInput();
        }

        $user = User::find($id);
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'id_no' => $request->id_no,
            'course' => json_encode($request->course)
        ]);

        return redirect('/lecturers')->with('message', 'Lecturer updated successfully');
    }
    
    public function studentView(Request $request)
    {
        $paginate_count = 10;    
        $query = User::where('role','Student');
        
        if(isset($request->matric_no)){
            $query = $query->where('id_no', 'like',"%{$request->matric_no}%");
        }

        $students =  $query->paginate($paginate_count);
        $count_index = 1;
        if(isset($request['page'])) {
            $count_index += ($request['page'] - 1) * $paginate_count;
        }
        return view('view-students')
                ->with(['students'=> $students, 
                        'count_index' => $count_index,
                        'matric_no' => $request->matric_no,
                        'searched' => $request->searched
                    ]);
    }

    public function addStudentView(Request $request)
    {
        return view('add-student');
    }

    public function registerStudent(Request $request)
    {
        $create_request = $request->except('_token');
        //validate entries
        $validateSignup = \Validator::make($create_request, [
            'first_name' => 'bail|required|max:100|min:3|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'bail|required|max:100|min:3|regex:/^[a-zA-Z\s]+$/',
            'email' => 'bail|required|email|max:100|unique:users,email',
            'password' => 'bail|required|confirmed',
            'id_no' => 'bail|required|unique:users,id_no|regex:/^LCU\/[\w]{2}\/[\d]{2}\/[\d]+$/',
            'sex' => 'bail|required|alpha',
            'year_of_entry' => 'bail|required|numeric',
            'course_of_entry' => 'bail|required',
        ]);

        if ($validateSignup->fails()) {
            return back()->withErrors($validateSignup)
                        ->withInput();
        }
        $create_request['role'] = 'Student';
        $create_request['password'] = \Hash::make($create_request['password']);

        $user = User::create($create_request);

        return redirect('/login')->with('message', 'Student created successfully! Kindly login with the created credentials');
    }

    public function deleteStudent(Request $request, $id) {
        $user = User::find($id);
        $user->delete();
        return redirect('/students')->with('message', 'Student deleted successfully!');
    }

    public function editStudentView(Request $request, $id) {
        $user = User::find($id);

        if(is_null($user) || $user->role != 'Student') {
            return abort(404);
        }

        return view('edit-student')->with('student', $user);
    }

    public function updateStudent(Request $request)
    {
        $update_request = $request->except('_token');
        $id = $request->student_id;

        //validate entries
        $validateUpdate = \Validator::make($update_request, [
            'first_name' => 'bail|required|max:100|min:3|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'bail|required|max:100|min:3|regex:/^[a-zA-Z\s]+$/',
            'email' => 'bail|required|email|max:100|unique:users,email,'.$id,
            'id_no' => 'bail|required|unique:users,id_no,'.$id.'|regex:/^LCU\/[\w]{2}\/[\d]{2}\/[\d]+$/',
            'sex' => 'bail|required|alpha',
            'year_of_entry' => 'bail|required|numeric',
            'course_of_entry' => 'bail|required',
        ]);

        if ($validateUpdate->fails()) {
            return back()->withErrors($validateUpdate)
                        ->withInput();
        }

        $user = User::find($id);
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'id_no' => $request->id_no,
            'sex' => $request->sex,
            'year_of_entry' => $request->year_of_entry,
            'course_of_entry' => $request->course_of_entry,
        ]);

        return redirect('/students')->with('message', 'Student updated successfully');
    }

    public function profileView(Request $request)
    {
        if(\Auth::user()->role == 'Lecturer'){
            $courses = Course::all();
            return view('lecturer-profile')->with(['courses' => $courses, 'lecturer' => \Auth::user()]);
        }

        if(\Auth::user()->role == 'Student'){
            return view('student-profile')->with(['student' => \Auth::user()]);
        }

        return redirect('/');
    }
    
    //very lazy smh: kindly refactor if any more work is to be done
    public function studentProfileUpdate(Request $request)
    {
        $update_request = $request->except('_token');
        $id = $request->student_id;

        //validate entries
        $validateUpdate = \Validator::make($update_request, [
            'first_name' => 'bail|required|max:100|min:3|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'bail|required|max:100|min:3|regex:/^[a-zA-Z\s]+$/',
            'email' => 'bail|required|email|max:100|unique:users,email,'.$id,
            'sex' => 'bail|required|alpha',
            'year_of_entry' => 'bail|required|numeric',
            'course_of_entry' => 'bail|required',
        ]);

        if ($validateUpdate->fails()) {
            return back()->withErrors($validateUpdate)
                        ->withInput();
        }

        $user = User::find($id);
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'sex' => $request->sex,
            'year_of_entry' => $request->year_of_entry,
            'course_of_entry' => $request->course_of_entry,
        ]);

        return redirect('/profile')->with('message', 'Student updated successfully');
    }
    
    //very lazy smh: kindly refactor if any more work is to be done
    public function lecturerProfileUpdate(Request $request)
    {
        $update_request = $request->except('_token');
        $id = $request->lecturer_id;
        //validate entries
        $validateUpdate = \Validator::make($update_request, [
            'first_name' => 'bail|required|max:100|min:3|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'bail|required|max:100|min:3|regex:/^[a-zA-Z\s]+$/',
            'course' => 'bail|required|array|exists:courses,id'
        ]);

        if ($validateUpdate->fails()) {
            return back()->withErrors($validateUpdate)
                        ->withInput();
        }

        $user = User::find($id);
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'course' => json_encode($request->course)
        ]);

        return redirect('/profile')->with('message', 'Lecturer updated successfully');
    }
}
