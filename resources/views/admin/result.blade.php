@extends('admin.layout.main')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Result Portal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Result Portal</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Exam Type</th>
                    <th>Total Question</th>
                    <th>Corretc Answer</th>
                    <th>Wrong Answer</th>
                    <th>Exam Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                <tr>
                    <td>{{ $result->id }}</td>
                    <td>{{ $result->email }}</td>
                    <td>{{ $result->exam_type }}</td>
                    <td>{{ $result->total_question }}</td>
                    <td>{{ $result->correct_answer }}</td>
                    <td>{{ $result->wrong_answer }}</td>
                    <td>{{ $result->exam_time }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
