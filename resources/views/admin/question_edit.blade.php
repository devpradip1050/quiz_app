@extends('admin.layout.main')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Question</span></b></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Question</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      @if(session()->has('message'))
      <div class="col-md-6">
        <div class="alert alert-success">
        {{ session()->get('message') }}
        </div>
        </div>
        @endif
      @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('admin.question.update',$question->id) }}" method="POST">
                @csrf
                <input type="hidden" name="question_no" value="{{ $question->question_no }}">
                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" class="form-control" id="question" name="question" value="{{$question->question}}">
                    </div>
                    <div class="form-group">
                        <label for="opt1">Option 1</label>
                        <input type="text" class="form-control" id="opt1" name="opt1" value="{{$question->opt1}}">
                    </div>
                    <div class="form-group">
                        <label for="opt2">Option 2</label>
                        <input type="text" class="form-control" id="opt2" name="opt2" value="{{$question->opt2}}">
                    </div>
                    <div class="form-group">
                        <label for="opt3">Option 3</label>
                        <input type="text" class="form-control" id="opt3" name="opt3" value="{{$question->opt3}}">
                    </div>
                    <div class="form-group">
                        <label for="opt4">Option 4</label>
                        <input type="text" class="form-control" id="opt4" name="opt4" value="{{$question->opt4}}">
                    </div>
                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <input type="text" class="form-control" id="answer" name="answer" value="{{$question->answer}}">
                    </div>
                    <div class="form-group">
                        <label for="exam_category">Exam Category</label>
                        <select name="exam_category" class="form-control">
                            <option value="">Select Exam Category</option>
                            @foreach($exams as $exam)
                            <option value="{{$exam->id}}" {{ ( $exam->category == $question->exam_category) ? 'selected' : '' }}>{{$exam->category}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Question</button>
                </form>
            </div>
        </div>
      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
