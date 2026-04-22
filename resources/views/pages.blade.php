@extends('layouts.app')

@section('content')
    @include('pages.' . $pageConfigs['view'])
@endsection