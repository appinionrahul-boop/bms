@extends('layouts.app')

@section('content')

<div class="card p-20 z-depth-0 waves-effect">
  <div class="card-header">
      
      {{-- <a href="/income/create" class="btn btn-success">Add New Income </a> --}}
      <div class="card-header-right">
          <ul class="list-unstyled card-option">
              <li><i class="fas fa-expand-arrows-alt full-card"></i></li>
              <li><i class="fas fa-minus minimize-card"></i></li>
              {{-- <li style="margin-right:28px"> <a href="/income/create" class="btn hor-grd btn-grd-success">নতুন আয় যোগ করুন  </a></li> --}}
              {{-- <li><i class="fas fa-trash close-card"></i></li> --}}
          </ul>
      </div>
  </div>
<div class="card-block" style="margin-top:30px">
  <div class="table-responsive">
      <div class="dt-responsive table-responsive">
         <table id="res-config" class="table table-striped table-bordered nowrap">
          <thead>
            <tr>
                <th class="th-sm" style="text-align:center">Sl No</th>
                <th class="th-sm" style="text-align:center">ভাউচার নাম্বার</th>
                <th class="th-sm" style="text-align:center">চেক নাম্বার</th>
                {{-- <th class="th-sm" style="text-align:center">আয়ের উৎস </th> --}}
                <th class="th-sm" style="text-align:center">তারিখ</th>
                <th class="th-sm" style="text-align:center">টাকার পরিমাণ</th>
                <th class="th-sm" style="text-align:center">কার্যকলাপ</th>
             
            </tr>
        </thead>
        <tbody>
            <p hidden>{{ $sl = 1 }}</p>
            @foreach ($incomeCat as $incomeShow)
                <tr>
                    <td class="align-middle" style="text-align:center">{{ $sl }}</td>
                    <td class="align-middle" style="text-align:center"> {{ $incomeShow->voucher_no }} </td>
                    <td class="align-middle" style="text-align:center"> {{ $incomeShow->income_cheque }} </td>
                    {{-- <td class="align-middle"  style="text-align:center"> {{ $incomeShow->getIncomeCat->category_sector }} ->
                        {{ $incomeShow->getSubIncomeCat->sector_source }} @if ($incomeShow->getBotSubIncomeCat->sector !='' || $incomeShow->getBotSubIncomeCat->sector !=NULL)   
                        -> {{ $incomeShow->getBotSubIncomeCat->sector }}
                        @endif 
                       
                    </td> --}}
                    <td class="align-middle"  style="text-align:center"> {{ $incomeShow->income_date }}</td>
                    <td class="align-middle"  style="text-align:center">{{ $incomeShow->income_amount }}</td>
                    <td class="align-middle"  style="text-align:center">
                        <a  href="{{ route('challan.income',$incomeShow->id) }}" class="btn btn-success"><i class="fas fa-check-circle"></i>চালান ডাউনলোড <br>করুন </a>
                    
                    </td>


                </tr>
                <p hidden> {{ $sl++ }}</p>
            @endforeach

        </tbody>
         </table>
       </div>
  </div>
</div>

</div>

@endsection
