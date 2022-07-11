@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2 col-lg-push-10">
                            <div id="current_que" style="float:left">0</div>
                            <div style="float:left">/</div>
                            <div id="total_que" style="float:left">0</div>
                        </div>
                        <div class="row" style="margin-top:30px">
                            <div class="row">
                                <div class="col-lg-10 col-lg-push-1" style="min-height 300px; background-color:white;" id="load_questions"></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <div class="col-lg-6 col-lg-push-3" style="min-height:50px;">
                                <div class="col-lg-12 text-center">
                                    <input type="button" value="Previous" class="btn btn-warning" onclick="load_previous();">&nbsp;
                                    <input type="button" value="Next" class="btn btn-success" onclick="load_next();">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
        function radioclick(radiovalue,questionno)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    // alert(xmlhttp.responseText)
                }
            };
            xmlhttp.open("GET","/save_ans_ses/" + radiovalue + "/" +questionno,true);
            xmlhttp.send(null);
        }
        function load_total_que()
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    
                    document.getElementById('total_que').innerHTML = xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET","/load_total_que",true);
            xmlhttp.send(null);
        }

        var questionno="1";
        load_questions(questionno);
        function load_questions(questionno)
        {
            document.getElementById('current_que').innerHTML = questionno;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    if(xmlhttp.responseText == "over")
                    {
                        window.location = '/result';
                    }
                    else
                    {
                        document.getElementById('load_questions').innerHTML = xmlhttp.responseText;
                        load_total_que();
                    }
                    
                }
            };
            xmlhttp.open("GET","/load_questions/" + questionno,true);
            xmlhttp.send(null);
        }
        function load_previous()
        {
            if(questionno == "1")
            {
                load_questions(questionno);
            }
            else
            {
                questionno = eval(questionno)-1;
                load_questions(questionno);
            }
        }
        function load_next()
        {
            questionno = eval(questionno)+1;
            load_questions(questionno);
        }
    </script>
@endsection
