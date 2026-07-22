@extends('layouts.app')

@section('js')
  
@endsection

@section('content')

<div class="card p-20 z-depth-0 waves-effect">
  <div class="card-header">
      
      {{-- <a href="/income/create" class="btn btn-success">Add New Income </a> --}}
      <div class="card-header-right">
          <ul class="list-unstyled card-option">
              <li><i class="feather icon-maximize full-card"></i></li>
              <li><i class="feather icon-minus minimize-card"></i></li>
              <li style="margin-right:28px"> <a href="/income-category/create" class="btn hor-grd btn-grd-success">Add Sub Sector</a></li>
              <li style="margin-right:28px"> <a href="/income-category/createS" class="btn hor-grd btn-grd-success">Add  Sector</a></li>
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
              {{-- <th class="th-sm" style="text-align:center">Sl No</th> --}}
              <th class="th-sm">Source of Sector</th>
              <th class="th-sm">Sub Source of Sector</th>
              <th class="th-sm">Sector</th>
            </tr>
        </thead>
        <tbody>
            <p hidden>{{ $sl = 1 }}</p>
            @foreach ($incomeCat as $incomeCat)
                <tr>
                    @if ( $incomeCat->getSubIncomeCat->sector_source!='' &&  $incomeCat->sector!='')
                    {{-- <td class="align-middle" style="text-align:center">{{ $sl }}</td> --}}

                    <td class="align-middle" >{{ $incomeCat->getIncomeCat->category_sector }}</td>
                
                    <td class="align-middle" >{{  $incomeCat->getSubIncomeCat->sector_source }}</td>
                    <td class="align-middle" >{{ $incomeCat->sector}}</td>
                        
                    @endif
                    <td hidden class="align-middle" >{{ $incomeCat->getIncomeCat->category_sector }}</td>
                
                    <td hidden class="align-middle" >{{  $incomeCat->getSubIncomeCat->sector_source }}</td>
                    <td hidden class="align-middle" >{{ $incomeCat->sector}}</td>
                </tr>
                <p hidden> {{ $sl++ }}</p>
              @endforeach

        </tbody>
         </table>
       </div>
  </div>
</div>
</div>




{{-- <div class="container">
    <div class="row mt-5">
      <div class="col-md-12">
        @include('layouts.message')
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Income Category</h3>
                
            <div class="card-tools">
                <a href="/income-category/create" class="btn btn-success">Add New Category </a>

            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0 col text-center">

            <table id="res-config" class="table table-striped table-bordered nowrap" style="padding: 15px">
              <thead>
                <tr>
                  <th class="th-sm">Source of Sector</th>
                  <th class="th-sm">Sub Source of Sector</th>
                  <th class="th-sm">Sector</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($incomeCat as $incomeCat)
                <tr>
                  @if ( $incomeCat->getSubIncomeCat->sector_source!='' &&  $incomeCat->sector!='')

                  <td class="align-middle" >{{ $incomeCat->getIncomeCat->category_sector }}</td>
               
                  <td class="align-middle" >{{  $incomeCat->getSubIncomeCat->sector_source }}</td>
                  <td class="align-middle" >{{ $incomeCat->sector}}</td>
                      
                  @endif
                  @endforeach
                  
                </tr>
             
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
 </div>
 
</div> --}}

@endsection
