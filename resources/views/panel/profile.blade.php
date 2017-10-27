@extends('layouts.main')
@section('title', 'Profile')
@section('content')
    <div class="row">
        {{Auth::check() }}
        <a href="{{url("#")}}" class="btn btn-default btn-lg" id="listSub"></a>
    </div>

@endsection