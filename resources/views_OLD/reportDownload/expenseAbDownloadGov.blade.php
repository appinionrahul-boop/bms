@php
    
    use Rakibhstu\Banglanumber\NumberToBangla;
    $numto = new NumberToBangla();
@endphp

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

<!doctype html>

<html >
    
    
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Expense Report</title>

    <style type="text/css">
    @font-face {
        font-family: 'FreeSerif', sans-serif; 
    }
        body {
            margin: 0px;
            font-family: 'FreeSerif', sans-serif;
        }
   
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
            
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
      
       table, tr, td {
            border: 1px solid black;
            text-align: center;
        }
       table {
        border-collapse: collapse;
        }
        .p2{
            margin-top: -40px;
        }
        .invoice{
            margin-top: -50px;
        }
        .t2{
            margin-right: -50px"
        }
       
    </style>

</head>
<body>
    {{-- <a href="{{ route('generate-pdf',['download'=>'pdf']) }}">Download PDF</a> --}}
{{-- <div class="">
   <p style="font-size: 24x; text-align:center"> জেলা পরিষদ পঞ্চগড় <br>Abstract Report <br>নিজস্ব ব্যায়   </p>
   <p style="font-size: 24px"> অর্থবছর :২০২০-২০২১</p>
</div> --}}


<br/>

<div class="invoice" style="margin-top: 40px">
    
    <table width="100%" class="detail">
        <thead>
        <tr>
            <td style="width: 7%">ক্রমিক নং:</td>
            {{-- <td style="width: 20%">ব্যায়ের  খাত সমূহ </td> --}}
            <td style="width: 13%"> ভাউচার নাম্বার <br>ও তারিখ </td>
            {{-- <td style="width: 10%">ভাউচার নাম্বার </td> --}}
            <td style="width: 20%">চেক নাম্বার <br>ও তারিখ </td>
            <td style="width: 45%">বিলের বিবরণ </td>
            <td style="width: 20%">টাকার পরিমাণ </td>
            {{-- <td style="width: 15%">কর্মকর্তার স্বাক্ষর  </td>
            <td style="width: 15%">চেয়ারম্যানের স্বাক্ষর</td>
            <td style="width: 15%">চেক গ্রহণকারীর<br> স্বাক্ষর </td> --}}
        </tr>
        </tr>
        </thead>
        <tbody>
            <p hidden>{{ $sum = 0 }}</p>
            <p hidden>{{ $sl = 1 }}</p>
                @foreach ($expense as $expenseShow)
                    <tr>
                        <td class="align-middle" style="text-align:center" style="width: 7%">{{ $numto->bnNum($sl) }}</td>
                    
                        <td style="text-align: center" style="width: 13%">{{ $expenseShow->voucher_no }}<br>{{BanglaConverter::en2bn($expenseShow->expense_date ) }} </td>
                    
                        <td style="text-align: center" style="width: 20%">{{ $expenseShow->expense_cheque }}
                        
                    
                        </td>
                        <td style="text-align: center" style="width: 45%">{{ $expenseShow->descriptation }} 
                        
                        </td>
                        <td style="text-align: center" style="width: 20%">{{ $numto->bnNum($expenseShow->expense_amount)   }}
                            
                        </td>
                        
                        <p hidden> {{ $sl++ }}</p> 
                    </tr>
                    @if ($expenseShow->vat_cheque_descriptation!=NULL)
                    <tr>
                        <td class="align-middle" style="text-align:center" style="width: 7%">{{ $numto->bnNum($sl) }}</td>
                        
                        <td style="text-align: center" style="width: 13%">{{ $expenseShow->voucher_no }}<br>{{BanglaConverter::en2bn($expenseShow->expense_date ) }} </td>

                        <td style="text-align: center" style="width: 20%">{{ $expenseShow->vat_cheque_descriptation }}
                        
                        
                    
                        </td>
                        <td style="text-align: center" style="width: 45%">{{ $expenseShow->expense_folio}} 
                            
                        </td>
                        <td style="text-align: center" style="width: 20%">{{ $numto->bnNum($expenseShow->vat_amount)   }}
                        
                        </td>
                    
                        
                    <p hidden> {{ $sl++ }}</p> 
                    @endif
                    @if ($expenseShow->tax_cheque_descriptation!=NULL)
                    <tr>
                        <td class="align-middle" style="text-align:center" style="width: 7%">{{ $numto->bnNum($sl) }}</td>
                        
                        <td style="text-align: center" style="width: 13%">{{ $expenseShow->voucher_no }}<br>{{BanglaConverter::en2bn($expenseShow->expense_date ) }} </td>

                        <td style="text-align: center" style="width: 20%">{{ $expenseShow->tax_cheque_descriptation }}
                        
                        
                        
                        </td>
                        <td style="text-align: center" style="width: 45%">{{ $expenseShow->tax_desriptation}} 
                            
                        </td>
                        <td style="text-align: center" style="width: 20%">{{ $numto->bnNum($expenseShow->tax_amount)   }}
                            
                        </td>
                    </tr>
                    
            <p hidden> {{ $sl++ }}</p> 
            @endif
            @endforeach
        </tbody>
       
        </tfoot>
    </table>
</div>

<div class="" style="position: absolute; bottom: 40;">
    <table width="100%" style="border:0">
        <tr style="border: 0">
            <td align="center" style="width: 30%;" style="border: 0">
              
                <p class="t2"><br>হিসাবরক্ষক<br>জেলা পরিষদ পঞ্চগড় </p>
           </td>
            <td align="center" style="width: 30%;" style="border: 0">
              
                 <p class="t2"><br>প্রধান নির্বাহী কর্মকর্তা <br>জেলা পরিষদ পঞ্চগড় </p>
            </td>
            <td align="center" style="width: 40%;" style="border: 0">
                <p class="t2"> <br>চেয়ারম্যান<br>জেলা পরিষদ পঞ্চগড় </p>
            </td>
        </tr>

    </table>
</div>
</body>
</html>