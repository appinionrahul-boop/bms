@php
    
    use Rakibhstu\Banglanumber\NumberToBangla;
    $numto = new NumberToBangla();

@endphp

@extends('layouts.app')

@section('content')

    <div class="row">

        <!-- statustic-card start -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-c-yellow text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5"> মোট আয় </p>
                            <h4 class="m-b-0">{{$numto->bnNum($totalIncome)}}</h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i class="icofont icofont-cur-taka-plus f-50 text-c-yellow"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-c-green text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5"> মোট ব্যয়</p>
                            <h4 class="m-b-0">{{$numto->bnNum($totalExpense)}}</h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i
                                class="icofont icofont-cur-taka-minus f-50 text-c-green"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-c-pink text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5">রাজস্ব আয় </p>
                            <h4 class="m-b-0">{{$numto->bnNum($ownIncome)}}</h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i class="icofont icofont-calculator-alt-2 f-50  text-c-pink"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        
    </div>
    <div class="row">
         <div class="col-xl-4 col-md-6">
            <div class="card bg-c-blue text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5">রাজস্ব ব্যয়  </p>
                        <h4 class="m-b-0">{{$numto->bnNum($ownExpense)}}</h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i
                                class="icofont icofont-sand-clock f-50 text-c-blue"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- statustic-card start -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-c-pink text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5"> এডিপি আয় </p>
                            <h4 class="m-b-0">{{$numto->bnNum($govIncome)}}</h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i class="icofont icofont-deal f-50 text-c-pink"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-c-blue text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5"> এডিপি ব্যয়  </p>
                            <h4 class="m-b-0">{{$numto->bnNum($govExpense)}}</h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i
                                class="icofont icofont-building-alt f-50 text-c-blue"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
