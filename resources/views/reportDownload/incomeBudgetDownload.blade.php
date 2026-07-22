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
    <title>Income Budget Report</title>

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
            font-size: 14px;
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
<div class="">
   <p style="font-size: 18x; text-align:center"> জেলা পরিষদ পঞ্চগড় <br>ফরম -"খ"<br> {বিধি ৪ দ্রষ্টব্য}
   <br> ১ম  অংশ ( রাজস্ব ও উন্নয়ন খাতে আয় )  </p>
   <!--<p> অর্থবছর :২০২১-২০২২</p>-->

     <p> অর্থবছর:২০২৬-২০২৭</p>
</div>


<br/>

<div class="invoice">
    <table  width="100%" class="detail">
        <tr>
         <td style="width: 32%">আয়ের খাত সমূহ </td>
           <td style="width: 17%">{{ $fy1 }} সনের<br> বাজেট বরাদ্দ </td>
            <td style="width: 17%">{{ $fy }} সনের <br>সংশোধিত বাজেট  </td>
            <td style="width: 17%">{{ $fy2 }} সনের <br>প্রকৃত বাজেট  </td>
            <td style="width: 17%">মন্তব্য</td>           
            
        </tr>

        <tr>
            <td style="width: 32%">১ </td>
            <td style="width: 17%">২ </td>
            <td style="width: 17%">৩ </td>
            <td style="width: 17%">৪ </td>
            <td style="width: 17%">৫</td>
        </tr>
        <tr>
            <td  style="text-align: left;font-size: 16px">প্রথম অংশ চলতি হিসাব </td>
        </tr>
        <tr>
            <td style="text-align: left">ক. বিভিন্ন খাতের নিজস্ব তহবিল:</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">১। স্থানীয় কর <br>ক) স্থাবর সম্পত্তি হস্তাস্তর কর</td>
           
            <td>
                @if ($local1p!='')
                {{$numto->bnNum($local1p)}}
                 @endif
              </td>
            <td>
                @if ($local1!='')
                {{$numto->bnNum($local1)}}
                 @endif
              </td>
            {{-- <td></td> --}}
            <td>
                @if ($local1prv!='')
                {{$numto->bnNum($local1prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left"> খ) অন্যান্য কর</td>
           
            <td>
                @if ($local2p!='')
                {{$numto->bnNum($local2p)}}
                 @endif
            </td>
            <td>
                @if ($local2!='')
                {{$numto->bnNum($local2)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                <td>
                    @if ($local2prv!='')
                    {{$numto->bnNum($local2prv)}}
                     @endif
                </td>
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">২। মাসুল (টোল)<br>ক) ফেরীঘাট/খেয়াঘাট/আন্ত:জেলা খেয়াঘাট ইজারা বাবদ</td>
           
            <td>
                @if ($mT1p!='')
                {{$numto->bnNum($mT1p)}}
                 @endif
            </td>
            <td>
                @if ($mT1!='')
                {{$numto->bnNum($mT1)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($mT1prv!='')
                {{$numto->bnNum($mT1prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left"> খ) রাস্তা/ব্রীজের মাসুল (টোল) বাবদ</td>
           
            <td>
                @if ($mT2p!='')
                {{$numto->bnNum($mT2p)}}
                 @endif
            </td>
            <td>
                @if ($mT2!='')
                {{$numto->bnNum($mT2)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($mT2prv!='')
                {{$numto->bnNum($mT2prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৩। ফি<br>ক) ঠিকাদার তালিকাভূক্তি ও নবায়ন ফি</td>
            
            <td>
                @if ($fee1p!='')
                {{$numto->bnNum($fee1p)}}
                 @endif
            </td>
            <td>
                @if ($fee1!='')
                {{$numto->bnNum($fee1)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($fee1prv!='')
                {{$numto->bnNum($fee1prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left"> খ) জনগণের ব্যবহার্যে সম্পাদিত কাজের জন্য ধার্যকৃত ফি</td>
           
            <td>
                @if ($fee2p!='')
                {{$numto->bnNum($fee2p)}}
                 @endif
            </td>
            <td>
                @if ($fee2!='')
                {{$numto->bnNum($fee2)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($fee2prv!='')
                {{$numto->bnNum($fee2prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">গ) অন্যান্য</td>
           
            <td>
                @if ($fee3p!='')
                {{$numto->bnNum($fee3p)}}
                 @endif
            </td>
            <td>
                @if ($fee3!='')
                {{$numto->bnNum($fee3)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($fee3prv!='')
                {{$numto->bnNum($fee3prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৪। সম্পত্তি হতে প্রাপ্ত আয়<br>ক) জমি ইজারা বাবদ আয়</td>
          
            <td>
                @if ($sIncome1p!='')
                {{$numto->bnNum($sIncome1p)}}
                 @endif
            </td>
            <td>
                @if ($sIncome1!='')
                {{$numto->bnNum($sIncome1)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($sIncome1prv!='')
                {{$numto->bnNum($sIncome1prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">খ)পুকুর ইজারা বাবদ আয় </td>
           
            <td>
                @if ($sIncome2p!='')
                {{$numto->bnNum($sIncome2p)}}
                 @endif
            </td>
            <td>
                @if ($sIncome2!='')
                {{$numto->bnNum($sIncome2)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($sIncome2prv!='')
                {{$numto->bnNum($sIncome2prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">গ)ডাকবাংলো হতে প্রাপ্ত যায়</td>
            
            <td>
                @if ($sIncome3p!='')
                {{$numto->bnNum($sIncome3p)}}
                 @endif
            </td>
            <td>
                @if ($sIncome3!='')
                {{$numto->bnNum($sIncome3)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($sIncome3prv!='')
                {{$numto->bnNum($sIncome3prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">ঘ)অডিটরিয়াম/মিলনায়তন ভাড়া বাবদ আয় </td>
           
            <td>
                @if ($sIncome4p!='')
                {{$numto->bnNum($sIncome4p)}}
                 @endif
            </td>
            <td>
                @if ($sIncome4!='')
                {{$numto->bnNum($sIncome4)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($sIncome4prv!='')
                {{$numto->bnNum($sIncome4prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">ঙ)মার্কেট / দোকান/যাত্রী ছাউনি/গোডাউন হতে আয়</td>
           
            <td>
                @if ($sIncome5p!='')
                {{$numto->bnNum($sIncome5p)}}
                 @endif
            </td>
            <td>
                @if ($sIncome5!='')
                {{$numto->bnNum($sIncome5)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($sIncome5prv!='')
                {{$numto->bnNum($sIncome5prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">চ)দোকান ভাড়া সেলামী </td>
           
            <td>
                @if ($sIncome6p!='')
                {{$numto->bnNum($sIncome6p)}}
                 @endif
            </td>
            <td>
                @if ($sIncome6!='')
                {{$numto->bnNum($sIncome6)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($sIncome6prv!='')
                {{$numto->bnNum($sIncome6prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">ছ)পার্ক/পিকনিক সেন্টার হতে আয় </td>
          
            <td>
                @if ($sIncome7p!='')
                {{$numto->bnNum($sIncome7p)}}
                 @endif
            </td>
            <td>
                @if ($sIncome7!='')
                {{$numto->bnNum($sIncome7)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($sIncome7prv!='')
                {{$numto->bnNum($sIncome7prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">জ)বাসটার্মিনাল হতে আয়</td>
           
            <td>
                @if ($sIncome8p!='')
                {{$numto->bnNum($sIncome8p)}}
                 @endif
            </td>
            <td>
                @if ($sIncome8!='')
                {{$numto->bnNum($sIncome8)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($sIncome8prv!='')
                {{$numto->bnNum($sIncome8prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">ঝ)আবাসিক এলাকা</td>
           
            <td>
                @if ($sIncome9p!='')
                {{$numto->bnNum($sIncome9p)}}
                 @endif
            </td>
            <td>
                @if ($sIncome9!='')
                {{$numto->bnNum($sIncome9)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($sIncome9prv!='')
                {{$numto->bnNum($sIncome9prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">ঞ)শিক্ষা/কারিগরী প্রতিষ্ঠান হতে আয়</td>
          
            <td>
                @if ($sIncome10p!='')
                {{$numto->bnNum($sIncome10p)}}
                 @endif
            </td>
            <td>
                @if ($sIncome10!='')
                {{$numto->bnNum($sIncome10)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($sIncome10prv!='')
                {{$numto->bnNum($sIncome10prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">ট)অন্যন্য সম্পত্তি/ভবন ভাড়া বাবদ আয়</td>
           
            <td>
                @if ($sIncome11p!='')
                {{$numto->bnNum($sIncome11p)}}
                 @endif
            </td>
            <td>
                @if ($sIncome11!='')
                {{$numto->bnNum($sIncome11)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($sIncome11prv!='')
                {{$numto->bnNum($sIncome11prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">ঠ)রোড রোলার/অন্যান্য যন্ত্রপাতি হতে প্রাপ্ত আয় </td>
            
            <td>
                @if ($sIncome12p!='')
                {{$numto->bnNum($sIncome12p)}}
                 @endif
            </td>
            <td>
                @if ($sIncome12!='')
                {{$numto->bnNum($sIncome12)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($sIncome12prv!='')
                {{$numto->bnNum($sIncome12prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">ড)পরিত্যক্ত দালান কোঠা/যানবাহন/যন্ত্রপাতি/মালামাল/গাছপালা ইত্যাদি বিক্রয় বাবদ আয় </td>
         
            <td>
                @if ($sIncome13p!='')
                {{$numto->bnNum($sIncome13p)}}
                 @endif
            </td>
            <td>
                @if ($sIncome13!='')
                {{$numto->bnNum($sIncome13)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($sIncome13prv!='')
                {{$numto->bnNum($sIncome13prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">ঢ)দরপত্র ফরম ও অন্যাণ্য ফরম বিক্রি</td>
          
            <td>
                @if ($sIncome14p!='')
                {{$numto->bnNum($sIncome14p)}}
                 @endif
            </td>
            <td>
                @if ($sIncome14!='')
                {{$numto->bnNum($sIncome14)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($sIncome14prv!='')
                {{$numto->bnNum($sIncome14prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">ণ)অন্যান্য অপ্রত্যাশিত প্রাপ্তি/বিবিধ আয় </td>
           
            <td>
                @if ($sIncome15p!='')
                {{$numto->bnNum($sIncome15p)}}
                 @endif
            </td>
            <td>
                @if ($sIncome15!='')
                {{$numto->bnNum($sIncome15)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($sIncome15prv!='')
                {{$numto->bnNum($sIncome15prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৫। কোনো স্থানীয় কর্তৃপক্ষ বা অন্য কোনো প্রতিষ্ঠান বা ব্যাক্তি কর্তৃক প্রদত্ত অনুদান</td>
           
            <td>
                @if ($onudanp!='')
                {{$numto->bnNum($onudanp)}}
                 @endif
            </td>
            <td>
                @if ($onudan!='')
                {{$numto->bnNum($onudan)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($onudanprv!='')
                {{$numto->bnNum($onudanprv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৬। অর্থ বিনিয়োগ হতে আয়<br>(ব্যাংকের জমাকৃত টাকার উপর সুদ )</td>
         
            <td>
                @if ($orthoInp!='')
                {{$numto->bnNum($orthoInp)}}
                 @endif
            </td>
            <td>
                @if ($orthoIn!='')
                {{$numto->bnNum($orthoIn)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($orthoInprv!='')
                {{$numto->bnNum($orthoInprv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৭। বিবিধ</td>
          
            <td>
                @if ($etcp!='')
                {{$numto->bnNum($etcp)}}
                 @endif
            </td>
            <td>
                @if ($etc!='')
                {{$numto->bnNum($etc)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($etcprv!='')
                {{$numto->bnNum($etcprv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">মোট আয়<br>(বিভিন্ন খাতে নিজস্ব তহবিল)
          </td>
          
            <td style="color:blue">
                @if ($sumOwnIncomep!='')
                {{$numto->bnNum($sumOwnIncomep)}}
                 @endif
            </td>
            <td style="color:blue">
                @if ($sumOwnIncome!='')
                {{$numto->bnNum($sumOwnIncome)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($sumOwnIncomeprv!='')
                {{$numto->bnNum($sumOwnIncomeprv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">খ )সরকারি অনুদান<br>(১)বিভিন্ন প্রকল্প বাস্তবায়নে সরকারি সাধারণ মঞ্জুরী</td>
           
            <td >
                @if ($gov1p!='')
                {{$numto->bnNum($gov1p)}}
                 @endif
            </td>
            <td>
                @if ($gov1!='')
                {{$numto->bnNum($gov1)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($gov1prv!='')
                {{$numto->bnNum($gov1prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">(২)বিভিন্ন প্রকল্প বাস্তবায়নে সরকারি বিশেষ মঞ্জুরী</td>
            
            <td>
                @if ($gov2p!='')
                {{$numto->bnNum($gov2p)}}
                 @endif
            </td>
            <td>
                @if ($gov2!='')
                {{$numto->bnNum($gov2)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($gov2prv!='')
                {{$numto->bnNum($gov2prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">(৩) বেতন ভাতা খাতে মঞ্জুরী</td>
            
            <td>
                @if ($gov3p!='')
                {{$numto->bnNum($gov3p)}}
                 @endif
            </td>
            <td>
                @if ($gov3!='')
                {{$numto->bnNum($gov3)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>@if ($gov3prv!='')
                {{$numto->bnNum($gov3prv)}}
                 @endif</td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">(৪)অন্যান্য মঞ্জুরী</td>
           
            <td>
                @if ($gov4p!='')
                {{$numto->bnNum($gov4p)}}
                 @endif
            </td>
            <td>
                @if ($gov4!='')
                {{$numto->bnNum($gov4)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($gov4prv!='')
                {{$numto->bnNum($gov4prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">সরকারি মোট অনুদান: </td>
           
            <td style="color:blue">
                @if ($sumGovp!='')
                {{$numto->bnNum($sumGovp)}}
                 @endif
            </td>
            <td style="color:blue">
                @if ($sumGov!='')
                {{$numto->bnNum($sumGov)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($sumGovprv!='')
                {{$numto->bnNum($sumGovprv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left" >মোট=( ক +খ ): </td>
           
            <td style="color:blue">
              {{$numto->bnNum($sumOwnIncomep+$sumGovp)}}
            </td>
            <td style="color:blue">
              {{$numto->bnNum($sumOwnIncome+$sumGov)}}
            </td>
            {{-- <td></td> --}}
             <td style="color:blue">
                    {{$numto->bnNum($sumOwnIncomeprv+$sumGovprv)}}
             </td>
            
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">২য় অংশ - মূলধন হিসাব : </td>
            <td>
            
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">১। গচ্ছিত তহবিল <br>২। জামানত প্রাপ্তি <br>৩। অগ্রিম সমন্বয়</td>
            
            <td style="color:blue">
                @if ($mul1p+$mul2p+$mul3p!='')
                {{$numto->bnNum($mul1p+$mul2p+$mul3p)}}
                 @endif
            </td>
            <td style="color:blue">
                @if ($mul1+$mul2+$mul3!='')
                {{$numto->bnNum($mul1+$mul2+$mul3)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($mul1prv+$mul2prv+$mul3prv!='')
                {{$numto->bnNum($mul1prv+$mul2prv+$mul3prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">	
                ৪। ভ্যাট</td>
            
            <td>
                @if ($mul4p!='')
                {{$numto->bnNum($mul4p)}}
                 @endif
            </td>
            <td>
                @if ($mul4!='')
                {{$numto->bnNum($mul4)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($mul4prv!='')
                {{$numto->bnNum($mul4prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left"> ৫। আয়কর</td>
            
            <td>
                @if ($mul5p!='')
                {{$numto->bnNum($mul5p)}}
                 @endif
            </td>
            <td>
                @if ($mul5!='')
                {{$numto->bnNum($mul5)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($mul5prv!='')
                {{$numto->bnNum($mul5prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৬। স্থাপনা নির্মানের সেলামী</td>
            
            <td>
                @if ($mul6p!='')
                {{$numto->bnNum($mul6p)}}
                 @endif
            </td>
            <td>
                @if ($mul6!='')
                {{$numto->bnNum($mul6)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($mul6prv!='')
                {{$numto->bnNum($mul6prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">৭। অন্যান্য</td>
         
            <td>
                @if ($mul7p!='')
                {{$numto->bnNum($mul7p)}}
                 @endif
            </td>
            <td>
                @if ($mul7!='')
                {{$numto->bnNum($mul7)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($mul7prv!='')
                {{$numto->bnNum($mul7prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">    মোট :<br>( ১ হইতে ৭ এর যোগফল )</td>
            
            <td style="color:blue">
                @if ($mul1p+$mul2p+$mul3p+$mul4p+$mul5p+$mul6p+$mul7p!='')
                {{$numto->bnNum($mul1p+$mul2p+$mul3p+$mul4p+$mul5p+$mul6p+$mul7p)}}
                 @endif
            </td>
            <td style="color:blue">
                @if ($mul1+$mul2+$mul3+$mul4+$mul5+$mul6+$mul7!='')
                {{$numto->bnNum($mul1+$mul2+$mul3+$mul4+$mul5+$mul6+$mul7)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($mul1prv+$mul2prv+$mul3prv+$mul4prv+$mul5prv+$mul6prv+$mul7prv!='')
                {{$numto->bnNum($mul1prv+$mul2prv+$mul3prv+$mul4prv+$mul5prv+$mul6prv+$mul7prv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td  style="text-align: left">মোট আয়<br> (১ম অংশ + ২য় অংশ )</td>
            
            <td style="color:blue">
                @if ($mul1p+$mul2p+$mul3p+$mul4p+$mul5p+$mul6p+$mul7p+$sumOwnIncomep+$sumGovp!='')
                {{$numto->bnNum($mul1p+$mul2p+$mul3p+$mul4p+$mul5p+$mul6p+$mul7p+$sumOwnIncomep+$sumGovp)}}
                 @endif
            </td>
            <td style="color:blue">
                @if ($mul1+$mul2+$mul3+$mul4+$mul5+$mul6+$mul7+$sumOwnIncome+$sumGov!='')
                {{$numto->bnNum($mul1+$mul2+$mul3+$mul4+$mul5+$mul6+$mul7+$sumOwnIncome+$sumGov)}}
                 @endif
            </td>
            {{-- <td></td> --}}
            <td>
                @if ($mul1prv+$mul2prv+$mul3prv+$mul4prv+$mul5prv+$mul6prv+$mul7prv+$sumOwnIncomeprv+$sumGovprv!='')
                {{$numto->bnNum($mul1prv+$mul2prv+$mul3prv+$mul4prv+$mul5prv+$mul6prv+$mul7prv+$sumOwnIncomeprv+$sumGovprv)}}
                 @endif
            </td>
            <td></td>
        </tr>
        
       
    </table>
    
</div>

</body>
</html>
