@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Select Exam Category</div>

                <div class="card-body">
                    
                    @foreach($exams as $exam)
                        <button class="btn btn-info form-control" style="margin-top:10px; color:white" value="{{$exam->category}}" onclick="set_exam_type(this.value);">{{$exam->category}}</button>
                    @endforeach
                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function set_exam_type(exam_category){
            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    window.location = '/home';
                }
            };
            xmlhttp.open("GET","/start_exam/" + exam_category,true);
            xmlhttp.send(null);
        };
    </script>
@endsection
