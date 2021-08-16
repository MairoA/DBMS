<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    //
    public function courseView(Request $request)
    {
        $paginate_count = 10;
        $query = Course::whereNotNull('name');
        
        if(isset($request->code)){
            $query = $query->where('code', 'like',"%{$request->code}%");
        }

        $courses = $query->paginate($paginate_count);
        $count_index = 1;
        if(isset($request['page'])) {
            $count_index += ($request['page'] - 1) * $paginate_count;
        }
        return view('view-courses')
                ->with(['courses'=> $courses, 
                        'count_index' => $count_index,
                        'code' => $request->code,
                        'searched' => $request->searched
                    ]);
    }

    public function addCourseView(Request $request)
    {
        return view('add-course');
    }

    public function registerCourse(Request $request)
    {
        $create_request = $request->except('_token');
        //validate entries
        $validateSignup = \Validator::make($create_request, [
            'name' => 'bail|required|max:100|min:3|unique:courses,name',
            'code' => 'bail|required|max:100|min:3|unique:courses,code'
        ]);

        if ($validateSignup->fails()) {
            return back()->withErrors($validateSignup)
                        ->withInput();
        }

        $course = Course::create($create_request);

        return redirect('/courses')->with('message', 'Course created successfully!');
    }

    public function deleteCourse(Request $request, $id) {
        $course = Course::find($id);
        $course->delete();
        return redirect('/courses')->with('message', 'Course deleted successfully!');
    }

    public function editCourseView(Request $request, $id) {
        $course = Course::find($id);

        if(is_null($course)) {
            return abort(404);
        }

        return view('edit-course')->with('course', $course);
    }

    public function updateCourse(Request $request)
    {
        $update_request = $request->except('_token');
        $id = $request->course_id;

        //validate entries
        $validateUpdate = \Validator::make($update_request, [
            'name' => 'bail|required|max:100|min:3|unique:courses,name,'.$id,
            'code' => 'bail|required|max:100|min:3|unique:courses,code,'.$id
        ]);

        if ($validateUpdate->fails()) {
            return back()->withErrors($validateUpdate)
                        ->withInput();
        }

        $course = Course::find($id);
        $course->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect('/courses')->with('message', 'Course updated successfully');
    }
}
