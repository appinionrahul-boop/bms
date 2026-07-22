@extends('layouts.app')

@section('content')
  @include('income._form', [
    'title' => 'নতুন আয় যোগ করুন',
    'action' => route('income.store'),
    'submitLabel' => 'Submit',
    'subCategories' => collect(),
    'botSubCategories' => collect(),
  ])
@endsection
