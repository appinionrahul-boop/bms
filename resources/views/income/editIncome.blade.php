@extends('layouts.app')

@section('content')
  @include('income._form', [
    'title' => 'আয় এডিট করুন',
    'action' => route('income.update', $income->id),
    'submitLabel' => 'Update',
  ])
@endsection
