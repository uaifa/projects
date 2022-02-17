@extends('layouts.master')

@section('title', 'Add Book')


@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <!-- row start -->
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Books<small> Add new book</small></h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-md-12">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                  <strong>Whoops!</strong> There were some problems with your input.<br><br>
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
              </div>
            </div>

            <form role="form" action="/library/addbook" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="name">Code/ISBN No</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                        {{ Form::text('code','',['class'=>'form-control','required'=>'true','placeholder'=>'Book Code'])}}

                      </div>
                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <label for="name">Title/Name</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                        {{ Form::text('title','',['class'=>'form-control','required'=>'true','placeholder'=>'Book Name']) }}
                      </div>
                    </div>
                  </div>


                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label" for="author">Author</label>

                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>
                        {{ Form::text('author','',['class'=>'form-control','required'=>'true','placeholder'=>'Writer Name']) }}

                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label" for="rack">Quantity</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>
                        {{ Form::text('quantity','',['class'=>'form-control','required'=>'true','placeholder'=>'How many?']) }}

                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label" for="rack">Rack No</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>
                        {{ Form::text('rackNo','',['class'=>'form-control','placeholder'=>'Rack No']) }}

                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label" for="row">Row No</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>
                        {{ Form::text('rowNo','',['class'=>'form-control','placeholder'=>'Row No']) }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label" for="type">Type</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>
                        {{ Form::select('type',['Academic'=>'Academic','Story'=>'Story','Magazine'=>'Magazine','Other'=>'Other'],null,['class'=>'form-control'])}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label" for="class">Class</label>

                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                        {!! Form::select('department',$departments,null,['class'=>'form-control select2_single','required'=>'true']) !!}

                      </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label class="control-label" for="dec">Description</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>

                        {{ Form::textarea('desc','',['class'=>'form-control','placeholder'=>'Description No','rows'=>'3']) }}
                      </div>
                    </div>
                  </div>

                </div>
              </div>



              <div class="row">
                <div class="col-md-12">

                  <button class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-plus"></i>Add</button>

                </div>
              </div>
            </form>

          </div>
        </div>
        <!-- row end -->
        <div class="clearfix"></div>

      </div>
    </div>
    <!-- /page content -->
    @endsection
    @section('extrascript')
    <script>

    </script>
    @endsection
