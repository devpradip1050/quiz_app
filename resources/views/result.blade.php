@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Exam Result</div>

                <div class="card-body">
                    <h2 class="text-center">Total Question : {{$count}}</h2>
                    <h2 class="text-center">Correct Answer : {{$correct}}</h2>
                    <h2 class="text-center">Wrong Answer : {{$wrong}}</h2>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection