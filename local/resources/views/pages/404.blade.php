@extends('layouts.default')

@section('title')
	404 Page not found
@stop

@section('styles')
@stop


@section('content')
<section class="content-header">
  <h1>
    404 Error Page
  </h1>
  <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">404 error</li>
  </ol>
</section>
<section class="content">
  <div class="error-page">
    <h2 class="headline text-yellow"> 404</h2>
    <div class="error-content">
      <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
      <p>
        We could not find the page you were looking for.
        Meanwhile, you may <a href="/dashboard">return to dashboard</a>.
      </p>
    </div><!-- /.error-content -->
  </div><!-- /.error-page -->
</section><!-- /.content -->
@stop

@section('scripts')
@stop