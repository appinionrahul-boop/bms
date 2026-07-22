@extends('layouts.app')

@section('content')
@include('expense._form', [
    'title' => 'ব্যয় এডিট করুন',
    'action' => route('expense.update', $expense->id),
    'method' => 'PUT',
    'submitLabel' => 'Update',
])
@endsection
