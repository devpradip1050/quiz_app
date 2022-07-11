<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Result;
use Session;
use Carbon\Carbon;
use Auth;

class QuizController extends Controller
{
    public function selectExam()
    {
        $exams = Exam::all();
        return view('show_exam_category')->with(['exams'=>$exams]);
    }
    public function startExam($exam_category)
    {
        
        
        Session::put('exam_category', $exam_category);

        $exams = Exam::where('category',$exam_category)->get();
        
        foreach($exams as $exam)
        {
            
            Session::put('exam_time', $exam->exam_time);
            
        }
        
        $date = Carbon::now()->addMinutes($exam->exam_time);
        
        
        
        Session::put('end_time', $date);
        
        Session::put('exam_start', "yes");
        
    }
    public function loadTimer()
    {
        if(!Session::has('end_time'))
        {
            echo "00:00:00";
        }
        else
        {
            $time1 = gmdate("H:i:s",strtotime(Session::get('end_time'))-strtotime(Carbon::now()));
            
            if(strtotime(Session::get('end_time')) < strtotime(Carbon::now()))
            {
                
                echo "00:00:00";
                
            }
            else
            {
                
                echo $time1;
                
            }
        }
    }
    public function loadTotalQuestion()
    {
        
        $qt = Question::where('exam_category',Session::get('exam_category'))->get();
        $total_que = count($qt);
        echo $total_que;
    }
    public function loadQuestions($questionno)
    {
        $question_no = '';
        $question = '';
        $opt1 = '';
        $opt2 = '';
        $opt3 = '';
        $opt4 = '';
        $answer = '';
        $count = '';
        $ans='';

        $queno = $questionno;
        
        
        if( Session::has('answer') )
        {
            $answer = Session::get('answer');
            $ans = $answer['answer'];
        }
        
        $que_res = Question::where(['exam_category'=>Session::get('exam_category'),'question_no'=>$questionno])->get();
        $count = count($que_res);
        
        if($count == 0)
        {
            echo "over";
        }
        else
        {
            foreach($que_res as $qst)
            {
            $question_no = $qst->question_no;
            $question = $qst->question;
            $opt1 = $qst->opt1;
            $opt2 = $qst->opt2;
            $opt3 = $qst->opt3;
            $opt4 = $qst->opt4;
                
            }
            ?>
            <table>
                <tr>
                    <td style="font-weight:bold;font-size:18px;padding-left:5px" colspan="2">
                        <?php echo "(" . $question_no ." ) " . $question; ?>
                    </td>
                </tr>
            </table>

            <table style="margin-left:10px">
                <tr>
                    <td>
                        <input type="radio" name="r1" id="r1" value="<?php echo $opt1; ?>" onclick="radioclick(this.value,<?php echo $question_no?>)" <?php if($ans==$opt1){echo "checked";}?> >
                    </td>
                    <td style="padding-left:10px">
                        <?php echo $opt1; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" name="r1" id="r1" value="<?php echo $opt2; ?>" onclick="radioclick(this.value,<?php echo $question_no?>)" <?php if($ans==$opt2){echo "checked";}?> >
                    </td>
                    <td style="padding-left:10px">
                        <?php echo $opt2; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" name="r1" id="r1" value="<?php echo $opt3; ?>" onclick="radioclick(this.value,<?php echo $question_no?>)" <?php if($ans==$opt3){echo "checked";}?> >
                    </td>
                    <td style="padding-left:10px">
                        <?php echo $opt3; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" name="r1" id="r1" value="<?php echo $opt4; ?>" onclick="radioclick(this.value,<?php echo $question_no?>)" <?php if($ans==$opt4){echo "checked";}?> >
                    </td>
                    <td style="padding-left:10px">
                        <?php echo $opt4; ?>
                    </td>
                </tr>
            </table>
            <?php

            
        }
    }
    public function saveAnswer($radiovalue, $questionno)
    {
        
        $value1 = $radiovalue;
        $data = [
            'questionno'=>$questionno,
            'answer'=>$value1
        ];
        Session::put('answer',$data);
        
         

        
        
        
    }
    public function result()
    {
        $correct = 0;
        $wrong = 0;

        if(Session::has('answer'))
        {
            for($i=1;$i<=sizeof(Session::get('answer'));$i++)
            {
                $answer = '';
                $getque = Question::where(['exam_category'=>Session::get('exam_category'),'question_no'=>$i])->get();
                foreach($getque as $que)
                {
                    $answer = $que->answer;
                }

                if(Session::has('answer'))
                {
                    if($answer == Session::get('answer'))
                    {
                        $correct = $correct + 1;
                    }
                    else
                    {
                        $wrong = $wrong + 1;
                    }
                }
                else
                {
                    $wrong = $wrong + 1;
                }
            }
        }

        $count = 0;
        $count_que = Question::where('exam_category',Session::get('exam_category'))->get();
        $count = count($count_que);
        $wrong= $count-$correct;

        $date = Carbon::now()->addMinutes(Session::get('exam_time'));
        Session::put('end_time', $date);

        if(Session::has('exam_start'))
        {
            $date_new = Carbon::now();
            $result = new Result();
            $result->email = Auth::user()->email;
            $result->exam_type = Session::get('exam_category');
            $result->total_question = $count;
            $result->correct_answer = $correct;
            $result->wrong_answer = $wrong;
            $result->exam_time = $date_new;
            $result->save();


        }
        if(Session::has('exam_start'))
        {
            Session::forget('exam_start');
            return redirect()->route('dashboard');
        }

        return view('result', compact('count','wrong','correct'));
    }
    
}
