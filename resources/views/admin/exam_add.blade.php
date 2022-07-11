@extends('admin.layout.main')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Exam</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Exam</li>
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
                <form action="{{ route('admin.store.exam') }}" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="category">Email address</label>
                        <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}" placeholder="Enter Category">
                    </div>
                    <div class="form-group">
                        <label for="exam_time">Password</label>
                        <input type="text" class="form-control" id="exam_time" name="exam_time" value="{{ old('exam_time') }}" placeholder="Enter Exam Time">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Exam</button>
                </form>
            </div>
        </div>
      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
