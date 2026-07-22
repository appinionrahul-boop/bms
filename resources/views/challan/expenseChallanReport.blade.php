@php
    
    use Rakibhstu\Banglanumber\NumberToBangla;
    $numto = new NumberToBangla();
    
@endphp
{{-- @php
    foreach ($expense as $expenseShow){
        $no1= $expenseShow->expense_amount+1;   
    }
   
    $no= $no1*$expenseShow->expense_vat/100; 

    $parts = explode('.', (string) $no);
@endphp --}}
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
    <title>Challan Report</title>

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
            /* font-size: x-small; */
            
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        
      
       /* table, tr, td {
            border: 1px solid black;
            text-align: center;
        }*/
       table {
        border-collapse: collapse;
        } 
        .p2{
            margin-top: -40px;
        }
        /* .invoice{
            margin-top: -50px;
        } */
        .t2{
            margin-right: -50px"
        }
       

        .hd1{
            margin-top: -40px;
        }

        /* .tdl{
            margin-left: 140px;
        } */
       
    </style>

</head>
<body>
    <!-- {{-- <a href="{{ route('generate-pdf',['download'=>'pdf']) }}">Download PDF</a> --}} -->
    <p hidden>{{ $r = " " }}</p>
    <div class="">
        <p style="text-align: center;font-size:23px">চালান ফরম </p>
        <table width="100%" style="border:0;">
           <tr class="csm">
            <td style="border: 0;font-size:30px;width:80%" class="tdl"> <p  class=""> </p></td>
                {{-- <td style="border: 0"> --}}
                
                    {{-- <td style="width:10%">১ম (মূল )কপি</td>
                    <td style="width:10%">২য় কপি </td>
                    <td style="width:10%"> ৩য় কপি </td> --}}
            
                {{-- </td> --}}
            </tr>
            <td style="border: 1" >১ম (মূল )কপি</td>
                    <td style="border: 1"  >২য় কপি </td>
                    <td style="border: 1" > ৩য় কপি </td>
            <tr style="border: 0" class="csm">
                <td style="border: 0;font-size:22px" class="tdl"> <p  class="" style="text-align: center"> 
                </td>
            </tr>
        
        </table>
        <p style="text-align: center;margin-top:-40px;font-size:20px">  টি আর ফরম নং ৬ (এস , আর ৩৭ দ্রষ্টব্য )<br><br>চালান নং.................................তারিখ .............................
            <br>বাংলাদেশ ব্যাংক /সোনালী ব্যাংকের পঞ্চগড় জেলার পঞ্চগড় শাখার টাকা জমা দেওয়ার চালান </p>
        <table  width="70%" style="text-align: center;margin-left:-45px">
            <tr >
                <td > কোড নং </td>
                <td style="border: 1;width"> ১ </td>
                <td style="border: 0;width">  </td>
                <td style="border: 1;width"> ১ </td>
                <td style="border: 1;width"> ১ </td>
                <td style="border: 1;width"> ৩ </td>
                <td style="border: 1;width"> ৩ </td>
                <td style="border: 0;width">  </td>
                <td style="border: 1;width">  ০  </td>
                <td style="border: 1;width"> ০ </td>
                <td style="border: 1;width"> ৪  </td>
                <td style="border: 1;width"> ৫</td>
                <td style="border: 0;width">  </td>
                <td style="border: 1;width"> ০ </td>
                <td style="border: 1;width">  ৩   </td>
                <td style="border: 1;width"> ১ </td>
                <td style="border: 1;width"> ১ </td>
                
             </tr>
        </table>
        
      
    </div>
    
    
    <br/>
    <div class="">
      
        <table width="100%" class=""  style="text-align: center;" >
             
            <tr style="border: 1">
                <td width="70%" style="border:1" >
                    জমা প্রদানকারী কর্তৃক পূরণ করতে হবে 
                </td>
                <td width="15%" style="border: 1">
                    টাকার অংক 
                </td>
                <td width="15%" style="border: 1">
                    বিভাগের নাম এবং চালানের পৃষ্ঠাঙ্কনকারী কর্মকর্তার নাম , পদবী ও দপ্তর। *  
                </td>
            </tr>
    
        </table>
        <table style="text-align: center;">
            <tr >
                <td width="18%" style="border: 1">
                    যাহার মারফত প্রদত্ত হইলো তাহার নাম ও ঠিকানা 
                </td>
                <td  width="22%" style="border: 1">
                    যে ব্যাক্তি /প্রতিষ্ঠানের পক্ষ হইতে টাকা প্রদত্ত হইলো তাহার নাম ,পদবি ও ঠিকানা 
                </td>
                <td  width="13%" style="border: 1">
                    কি বাবদ জমা দেওয়া হইলো তাহার বিবরণ 
                </td>
                <td  width="17%" style="border: 1">
                    মুদ্রা  ও নোটের বিবরণ /ড্রাফট , পে অর্ডার ও চেকের বিবরণ 
                </td>
                <td style="border: 1" width="8%">
                    টাকা 
                </td>
                <td style="border: 1" width="7%">
                    পয়সা
                </td>
                <td style="border: 1" width="15%"></td>
            </tr>
            <tr >
                <td width="18%" style="border: 1">
                    জেলা পরিষদ পঞ্চগড় 
                </td>
                @foreach ($expense as $expenseShow)
                <td  width="22%" style="border: 1;font-size:13px">
                  {{$expenseShow->descriptation}}
                </td>
                @endforeach
                @foreach ($expense as $expenseShow)
                <td  width="13%" style="border: 1">
                    {{BanglaConverter::en2bn($expenseShow->expense_vat)}}% &nbsp; ভ্যাট
                </td>
                @endforeach
                @foreach ($expense as $expenseShow)
                <td  width="17%" style="border: 1">
                  {{$expenseShow->vat_cheque_descriptation}}<br>
                 {{BanglaConverter::en2bn($expenseShow->expense_date ) }}
                </td>
                @endforeach
                @foreach ($expense as $expenseShow)
                <td style="border: 1" width="8%">
                   ={{$numto->bnnum($expenseShow->vat_amount)}}
                </td>
                @endforeach
                <td style="border: 1" width="7%">
                    {{-- {{ $numto->bnnum($parts[1])}} --}}
                </td>
                <td style="border: 1" width="15%">
                <br><br><br><br><br><br><br><br>
                </td>
            </tr>
            <tr>
                <td style="border: 1"></td>
                <td style="border: 1"></td>
                <td style="border: 1"></td>
                <td style="border: 1">মোট টাকা </td>
                @foreach ($expense as $expenseShow)
                  <td style="border: 1">={{$numto->bnnum($expenseShow->vat_amount)}}/-</td>
                @endforeach
                <td style="border: 1"></td>
                <td style="border: 1"></td>
            </tr>
        </table>
        <table width="100%" class=""   >
             
            <tr style="border: 1">
                @foreach ($expense as $expenseShow)
                    <td width="70%" style="border:1" >
                        টাকা (কথায়)={{$numto->bnMoney($expenseShow->vat_amount)}}মাত্র <br><br>টাকা পাওয়া গেল <br><br>তারিখঃ 
                    </td>
                @endforeach
                <td width="30%" style="border: 1;text-align:center"><br><br>
                    ম্যানেজার <br>
    বাংলাদেশ ব্যাংক /সোনালী ব্যাংক লিমিটেড 
    <br><br>
                </td>
                
            </tr>
            
        </table>
        <table>
            <tr>
                <td>
                    নোটঃ ১।সংশ্লিষ্ট দপ্তরের সহিত যোগাযোগ করিয়া কোড জানিয়া লইবেন <br>
               ২। *যে সকল ক্ষেত্রে কর্মকর্তা কর্তৃক পৃষ্ঠাংকন প্রয়োজন , সে সকল ক্ষেত্রে প্রযোজ্য হইবে 
                </td>
            </tr>
        </table>
    </div>
    <br><br>
<div class="">
    <p style="text-align: center;font-size:23px">চালান ফরম </p>
    <table width="100%" style="border:0;">
       <tr  class="csm">
        <td style="border: 0;font-size:30px;width:80%" class="tdl"> <p  class=""> </p></td>
            {{-- <td style="border: 0"> --}}
            
                {{-- <td style="width:10%">১ম (মূল )কপি</td>
                <td style="width:10%">২য় কপি </td>
                <td style="width:10%"> ৩য় কপি </td> --}}
        
            {{-- </td> --}}
        </tr>
        <td style="border: 1" >১ম (মূল )কপি</td>
                <td style="border: 1"  >২য় কপি </td>
                <td style="border: 1" > ৩য় কপি </td>
        <tr style="border: 0" class="csm">
            <td style="border: 0;font-size:22px" class="tdl"> <p  class="" style="text-align: center"> 
            </td>
        </tr>
    
    </table>
    <p style="text-align: center;margin-top:-40px;font-size:20px">  টি আর ফরম নং ৬ (এস , আর ৩৭ দ্রষ্টব্য )<br><br>চালান নং.................................তারিখ .............................
        <br>বাংলাদেশ ব্যাংক /সোনালী ব্যাংকের পঞ্চগড় জেলার পঞ্চগড় শাখার টাকা জমা দেওয়ার চালান </p>
    <table  width="70%" style="text-align: center;margin-left:-45px">
        <tr >
            <td > কোড নং </td>
            <td style="border: 1;"> ১ </td>
            <td style="border: 0;width"> {{$r=" "}} </td>
            <td style="border: 1;width"> ১ </td>
            <td style="border: 1;width"> ১ </td>
            <td style="border: 1;width"> ৪ </td>
            <td style="border: 1;width"> ১ </td>
            <td style="border: 0;width">  </td>
            <td style="border: 1;width">  ০  </td>
            <td style="border: 1;width"> ০ </td>
            <td style="border: 1;width"> ৬  </td>
            <td style="border: 1;width"> ৫</td>
            <td style="border: 0;width">  </td>
            <td style="border: 1;width"> ০ </td>
            <td style="border: 1;width">  ১  </td>
            <td style="border: 1;width"> ১ </td>
            <td style="border: 1;width"> ১ </td>
            
         </tr>
    </table>
    
  
</div>


<br/>
<div class="">
  
    <table width="100%" class=""  style="text-align: center;" >
         
        <tr style="border: 1">
            <td width="70%" style="border:1" >
                জমা প্রদানকারী কর্তৃক পূরণ করতে হবে 
            </td>
            <td width="15%" style="border: 1">
                টাকার অংক 
            </td>
            <td width="15%" style="border: 1">
                বিভাগের নাম এবং চালানের পৃষ্ঠাঙ্কনকারী কর্মকর্তার নাম , পদবী ও দপ্তর। *  
            </td>
        </tr>

    </table>
    <table style="text-align: center;">
        <tr >
            <td width="18%" style="border: 1">
                যাহার মারফত প্রদত্ত হইলো তাহার নাম ও ঠিকানা 
            </td>
            <td  width="22%" style="border: 1">
                যে ব্যাক্তি /প্রতিষ্ঠানের পক্ষ হইতে টাকা প্রদত্ত হইলো তাহার নাম ,পদবি ও ঠিকানা 
            </td>
            <td  width="13%" style="border: 1">
                কি বাবদ জমা দেওয়া হইলো তাহার বিবরণ 
            </td>
            <td  width="17%" style="border: 1">
                মুদ্রা  ও নোটের বিবরণ /ড্রাফট , পে অর্ডার ও চেকের বিবরণ 
            </td>
            <td style="border: 1" width="8%">
                টাকা 
            </td>
            <td style="border: 1" width="7%">
                পয়সা
            </td>
            <td style="border: 1" width="15%"></td>
        </tr>
        <tr >
            <td width="18%" style="border: 1">
                জেলা পরিষদ পঞ্চগড় 
            </td>
            @foreach ($expense as $expenseShow)
            <td  width="22%" style="border: 1;font-size:13px">
                {{$expenseShow->descriptation}}
            </td>
            @endforeach
            @foreach ($expense as $expenseShow)
            <td  width="13%" style="border: 1">
                {{$numto->bnnum($expenseShow->expense_tax)}}% &nbsp; আয়কর
            </td>
            @endforeach
            @foreach ($expense as $expenseShow)
            <td  width="17%" style="border: 1">
              {{$expenseShow->tax_cheque_descriptation}}<br>
            {{BanglaConverter::en2bn($expenseShow->expense_date ) }}
            </td>
            @endforeach
            @foreach ($expense as $expenseShow)
                <td style="border: 1" width="8%">
                    ={{$numto->bnnum($expenseShow->tax_amount)}}
                </td>
            @endforeach
            <td style="border: 1" width="7%">
                {{-- {{ $numto->bnnum($parts[1])}} --}}
            </td>
            <td style="border: 1" width="15%">
            <br><br><br><br><br><br><br><br>
            </td>
        </tr>
        <tr>
            <td style="border: 1"></td>
            <td style="border: 1"></td>
            <td style="border: 1"></td>
            <td style="border: 1">মোট টাকা </td>
            @foreach ($expense as $expenseShow)
                <td style="border: 1" width="8%">
                    ={{$numto->bnnum($expenseShow->tax_amount)}}/-
                </td>
            @endforeach
            <td style="border: 1"></td>
            <td style="border: 1"></td>
        </tr>
    </table>
    <table width="100%" class=""   >
         
        <tr style="border: 1">
            @foreach ($expense as $expenseShow)
                <td width="70%" style="border:1" >
                    টাকা (কথায়)={{$numto->bnMoney($expenseShow->tax_amount)}}মাত্র <br><br>টাকা পাওয়া গেল <br><br>তারিখঃ 
                </td>
            @endforeach
            <td width="30%" style="border: 1;text-align:center"><br><br>
                ম্যানেজার <br>
বাংলাদেশ ব্যাংক /সোনালী ব্যাংক লিমিটেড 
<br><br>
            </td>
            
        </tr>
        
    </table>
    <table>
        <tr>
            <td>
                নোটঃ ১।সংশ্লিষ্ট দপ্তরের সহিত যোগাযোগ করিয়া কোড জানিয়া লইবেন <br>
           ২। *যে সকল ক্ষেত্রে কর্মকর্তা কর্তৃক পৃষ্ঠাংকন প্রয়োজন , সে সকল ক্ষেত্রে প্রযোজ্য হইবে 
            </td>
        </tr>
    </table>
</div>

    <!-- {{-- <div class="" style="position: absolute; bottom: 20;">
    <table width="100%" style="border:0">
        <tr style="border: 0">
            <td align="left" style="width: 50%;" style="border: 0">
                
                    <p>------------------------- <br>প্রধান নির্বাহী কর্মকর্তা <br>জেলা পরিষদ পঞ্চগড় </p>
            </td>
            <td align="center" style="width: 40%;" style="border: 0">
                <p class="t2">----------------- <br>চেয়ারম্যান<br>জেলা পরিষদ পঞ্চগড় </p>
            </td>
        </tr>

    </table>
    </div> --}} -->
</body>
</html>
