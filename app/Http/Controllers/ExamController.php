<?php

namespace App\Http\Controllers;
use App\Models\Exam;
use Validator;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::all();
        return view('admin.exam_list')->with(['exams'=>$exams]);
    }
    public function create()
    {
        return view('admin.exam_add');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required',
            'exam_time' => 'required'
        ]);
        
        $exam = new Exam();
        $exam->category = $request->category;
        $exam->exam_time = $request->exam_time;
        $exam->save();

        if($exam)
        {
            return redirect()->back()->with(['message'=>'Exam Successfully Added']);
        }
        else
        {
            return redirect()->route('admin.add.exam')->with(['message'=>'Something Went Wrong']);
        }
    }
    public function edit($id)
    {
        $exam = Exam::find($id);
        return view('admin.exam_edit')->with(['exam'=>$exam]);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category' => 'required',
            'exam_time' => 'required'
        ]);

        $exam = Exam::find($id);
        $exam->category = $request->category;
        $exam->exam_time = $request->exam_time;
        $exam->save();

        if($exam)
        {
            return redirect()->back()->with(['message'=>'Exam Successfully Updated']);
        }
        else
        {
            return redirect()->back()->with(['message'=>'Something Went Wrong']);
        }
    }
    public function destroy($id)
    {
        $exam = Exam::find($id)->delete();
        return redirect()->route('exam.index');
    }
}
