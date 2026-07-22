@extends('layouts.master')

@section('content')

<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua" style="background-color:#82c5ee"><i class="fas fa-eye"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Income</span>
        <span class="info-box-number">{{$totalIncome}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fas fa-cart-plus"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Expense</span>
        <span class="info-box-number">41,410</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix visible-sm-block"></div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fas fa-funnel-dollar"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Budget</span>
        <span class="info-box-number">760</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fas fa-user-tie"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Budget Remain</span>
        <span class="info-box-number">2,000</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>

@endsection