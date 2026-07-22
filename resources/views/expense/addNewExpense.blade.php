@extends('layouts.app')

@section('content')
@include('expense._form', [
    'title' => 'নতুন ব্যয় যোগ করুন',
    'action' => route('expense.store'),
    'submitLabel' => 'Submit',
    'expenseSubCat' => collect(),
])
@endsection
