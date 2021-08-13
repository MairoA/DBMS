<?php

namespace App\Http\Controllers;

use App\Imports\ResultsImport;
use App\Models\CourseResult;
use App\Models\Course;
use App\Models\Session;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResultController extends Controller
{
    //
    public function resultUploadView()
    {
        $sessions = Session::all();
        $courses = Course::all();
        return view('result-upload')->with(['sessions' => $sessions, 'courses' => $courses]);
    }

    public function resultView(Request $request)
    {
        $sessions = Session::all();
        $courses = Course::all();
        $results = [];

        if (isset($request->session)){
            $query = CourseResult::where(
                ['session' => $request->session, 
                 'semester' => $request->semester, 
                 'course_id' => $request->course]);

            if(isset($request->martric_no)){
                $query = $query->where('matric_no', 'like',"%{$request->martric_no}%");
            }
                 
            $results = $query->get();
        }

        return view('view-results')
            ->with(['sessions' => $sessions, 
                    'courses' => $courses, 
                    'results' => $results,
                    'session_value' => $request->session, 
                    'semester' => $request->semester, 
                    'course_id' => $request->course, 
                    'martric_no' => $request->martric_no
                ]);
    }

    public function uploadResult(Request $request) 
    {
        $import = Excel::toArray(new ResultsImport, request()->file('upload-file'));
        $rows = $import[0];

        //validate entries
        foreach ($rows as $index=>$row) {
            $row_index = $index + 1;
            $validateSignup = \Validator::make($row,$this->rules());

            if ($validateSignup->fails()) {
                $validation_message = $validateSignup->errors()->first();
                $error_message="Issue on row {$row_index}: {$validation_message}";

                return back()->withErrors(['upload-file' => $error_message]);            
            }
        }

        //insert entries
        foreach ($rows as $row) {
            CourseResult::updateOrInsert(
            ['session' => $request->session, 
             'semester' => $request->semester, 
             'course_id' => $request->course, 
             'matric_no' => $row['matricno']
            ],
            ['ca_1' => $row['ca1'],
             'ca_2' => $row['ca2'],
             'exam' => $row['exam'],
             'total' => $row['total'],
             'grade' => $row['grade']
            ]);
        }
        return redirect('result-upload')->with('message', 'Course created successfully!');
    }

    public function rules(): array
    {
        return [
            'matricno' => 'required|exists:users,id_no',
            'ca1' => 'required|numeric|min:0|max:100',
            'ca2' => 'required|numeric|min:0|max:100',
            'exam' => 'required|numeric|min:0|max:100',
            'total' => 'required|numeric|min:0|max:100',
            'grade' => [
                'required',
                Rule::in(['A','B','C','D','E','F']),
            ]
        ];
    }
}
