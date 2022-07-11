@extends('admin.layout.main')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Student</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Student</li>
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
        @if(session()->has('failed'))
      <div class="col-md-6">
        <div class="alert alert-danger">
        {{ session()->get('failed') }}
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
                <form action="{{ route('admin.update.student', $users->id) }}" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $users->name }}" >
                    </div>
                    <div class="form-group">
                        <label for="category">Email address</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $users->email }}" >
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="****************">
                    </div>
                    <div class="form-group">
                        <label for="cpassword">Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="****************">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Exam</button>
                </form>
            </div>
        </div>
      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
