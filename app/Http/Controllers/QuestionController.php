<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;
use DB;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view('admin.question_select')->with(['questions'=>$questions]);
    }
    public function create()
    {
        $exams = Exam::all();
        return view('admin.question_add')->with(['exams'=>$exams]);
    }
    public function store(Request $request)
    {
        $exam_id = $request->exam_category;
        $exam_data = Exam::find($exam_id);
        $exam_category = $exam_data->category;

        $loop = 0;
        $count = 0;

        $question = Question::where('exam_category',$exam_category)->orderBy('id', 'asc')->get();
        
        $count = count($question);
        if($count == 0)
        {

        }
        else
        {
            foreach($question as $que)
            {
                $loop = $loop+1;
                Question::where('id',$que->id)->update(['question_no'=>$loop]);
            }
        }
        $loop = $loop+1;

        $qu = new Question();
        $qu->question_no = $loop;
        $qu->question = $request->question;
        $qu->opt1 = $request->opt1;
        $qu->opt2 = $request->opt2;
        $qu->opt3 = $request->opt3;
        $qu->opt4 = $request->opt4;
        $qu->answer = $request->answer;
        $qu->exam_category = $exam_category;
        $qu->save();
        
        if($qu)
        {
            return redirect()->back()->with(['message'=>'Question Added Successfully']);
        }
        else
        {
            return redirect()->back()->with(['message'=>'Something Went Wrong']);
        }
        
    }
    public function edit($id)
    {
        $exams = Exam::all();
        $question = Question::find($id);
        return view('admin.question_edit')->with(['question'=>$question, 'exams'=>$exams]);
    }
    public function update(Request $request, $id)
    {
        $exam = Exam::find($request->exam_category);
        $exam_category = $exam->category;

        $loop = 0;
        $count = 0;

        $question = Question::where('exam_category',$exam_category)->orderBy('id', 'asc')->get();
        
        $count = count($question);
        if($count == 0)
        {

        }
        else
        {
            foreach($question as $que)
            {
                $loop = $loop+1;
                Question::where('id',$que->id)->update(['question_no'=>$loop]);
            }
        }
        $loop = $loop+1;
        
        $qu = Question::find($id);
        $qu->question_no = $loop;
        $qu->question = $request->question;
        $qu->opt1 = $request->opt1;
        $qu->opt2 = $request->opt2;
        $qu->opt3 = $request->opt3;
        $qu->opt4 = $request->opt4;
        $qu->answer = $request->answer;
        $qu->exam_category = $exam_category;
        $qu->save();

        if($qu)
        {
            return redirect()->back()->with(['message'=>'Question Added Successfully']);
        }
        else
        {
            return redirect()->back()->with(['message'=>'Something Went Wrong']);
        }

    }
    public function destroy($id)
    {
        $que = Question::find($id)->delete();
        return redirect()->route('question.index');
    }
}
