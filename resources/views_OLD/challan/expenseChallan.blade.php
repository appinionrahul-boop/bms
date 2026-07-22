@php
 
class BanglaConverter {
    public static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    
    public static function bn2en($number) {
        return str_replace(self::$bn, self::$en, $number);
    }
    
    public static function en2bn($number) {
        return str_replace(self::$en, self::$bn, $number);
    }
}
@endphp

@extends('layouts.app')

@section('content')

<div class="card p-20 z-depth-0 waves-effect">
  <div class="card-header">
      
      {{-- <a href="/income/create" class="btn btn-success">Add New Income </a> --}}
      <div class="card-header-right">
          <ul class="list-unstyled card-option">
              <li><i class="feather icon-maximize full-card"></i></li>
              <li><i class="feather icon-minus minimize-card"></i></li>
              {{-- <li style="margin-right:28px"> <a href="/income/create" class="btn hor-grd btn-grd-success">নতুন আয় যোগ করুন  </a></li> --}}
              {{-- <li><i class="feather icon-trash-2 close-card"></i></li> --}}
          </ul>
      </div>
  </div>
<div class="card-block" style="margin-top:30px">
  <div class="table-responsive">
      <div class="dt-responsive table-responsive">
         <table id="res-config" class="table table-striped table-bordered nowrap">
          <thead>
            <tr>
                <!--<th class="th-sm" style="text-align:center">ক্রমিক নং </th>-->
                <th class="th-sm" style="text-align:center">ভাউচার নাম্বার</th>
                <th class="th-sm" style="text-align:center">চেক নাম্বার</th>
                {{-- <th class="th-sm" style="text-align:center">আয়ের উৎস </th> --}}
                <th class="th-sm" style="text-align:center">তারিখ</th>
                <th class="th-sm" style="text-align:center">টাকার পরিমাণ</th>
                <th class="th-sm" style="text-align:center">ভ্যাট</th>
                <th class="th-sm" style="text-align:center"> আয়কর </th>
                <th class="th-sm" style="text-align:center">সম্পাদনা </th>
             
            </tr>
        </thead>
        <tbody>
            <p hidden>{{ $sl = 1 }}</p>
            @foreach ($expense as $incomeShow)
                @if ($incomeShow->expense_vat!=NULL || $incomeShow->expense_tax!=NULL)
                    
            
                    <tr>
                        <!--<td class="align-middle" style="text-align:center">{{BanglaConverter::en2bn( $sl )}}</td>-->
                        <td class="align-middle" style="text-align:center"> {{ $incomeShow->voucher_no }} </td>
                        <td class="align-middle" style="text-align:center"> {{ $incomeShow->expense_cheque }} </td>
                        {{-- <td class="align-middle"  style="text-align:center"> {{ $incomeShow->getIncomeCat->category_sector }} ->
                            {{ $incomeShow->getSubIncomeCat->sector_source }} @if ($incomeShow->getBotSubIncomeCat->sector !='' || $incomeShow->getBotSubIncomeCat->sector !=NULL)   
                            -> {{ $incomeShow->getBotSubIncomeCat->sector }}
                            @endif 
                        
                        </td> --}}
                        <td class="align-middle"  style="text-align:center"> {{BanglaConverter::en2bn(  $incomeShow->expense_date) }}</td>
                        <td class="align-middle"  style="text-align:center">{{BanglaConverter::en2bn(  $incomeShow->expense_amount )}}</td>
                        <td class="align-middle"  style="text-align:center">{{BanglaConverter::en2bn(  $incomeShow->expense_vat )}}%</td>
                        <td class="align-middle"  style="text-align:center">{{BanglaConverter::en2bn(  $incomeShow->expense_tax )}}%</td>
                        <td class="align-middle"  style="text-align:center">
                            <a  href="{{ route('challan.expense',$incomeShow->id) }}" class="btn btn-success"><i class="icofont icofont-check-circled"></i>চালান ডাউনলোড <br>করুন </a>
                        
                        </td>


                    </tr>
                    <p hidden> {{ $sl++ }}</p>
                @endif
            @endforeach

        </tbody>
         </table>
       </div>
  </div>
</div>

</div>

@endsection
