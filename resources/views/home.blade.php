@extends('layouts.app')

@section('content')
    <div
        id="dashboard-root"
        data-dashboard='@json($dashboardData)'
    ></div>
@endsection
