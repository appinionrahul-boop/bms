@extends('layouts.app')

@section('content')

<style>
    .edtBTN {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    </style>

<div class="card">
    
    <div class="card-header">
        <div class="card-header-right">
            <ul class="list-unstyled card-option">
                <li><i class="fas fa-expand-arrows-alt full-card"></i></li>
                <li><i class="fas fa-minus minimize-card"></i></li>
                {{-- <li style="margin-right:28px"> <a href="/income/create" class="btn hor-grd btn-grd-success">Add New Income </a></li> --}}
                {{-- <li><i class="fas fa-trash close-card"></i></li> --}}
            </ul>
        </div>
        <h5>ADD Expense Sub Category</h5>
    </div>
   
    <div class="card-block" style="margin-top: -40px">
        <div class="j-wrapper j-wrapper-640">
            <form action="/expense_category" method="post" class="j-pro" id="j-pro" enctype="multipart/form-data">
                <!-- end /.header-->
                {{ csrf_field() }}
                <div class="j-content">
                    <div class="j-row">
                        <div class="j-span6 j-unit">
                          <label class="j-label">Expense Category</label>
                          <div class="j-input">
                            <label class="j-input j-select">
                              <select id="rootCat" class="form-control" name="expense_category">
                                <option selected>Choose Expense Category</option>
                                  @foreach ($expenseCategory as $expenseCategory)
                                    
                                      <option  value="{{$expenseCategory->id}}">{{$expenseCategory->expense_category}}</option>
                                    
                                  @endforeach
                              </select>
                              <i></i>
                            </label>
                          </div>
                      </div>
                        <div class="j-span6 j-unit">
                          <label class="j-label">Expense Sub Category</label>
                            <div class="j-input">
                                <label class="j-icon-left" for="first_name">
                                    <i class="fas fa-sitemap"></i>
                                </label>
                                <input type="text"  id="voucher" placeholder="Enter Sub Category" name="expense_subCat" class="name-group">
                            </div>
                        </div>
                    </div>
                                     
                    <div class="j-response"></div>
                    <!-- end response from server -->
                </div>
                <!-- end /.content -->
                <div class="j-footer">
                    <button type="submit" class="btn btn-primary" style="margin-left: 2px">Submit</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                </div>
                <!-- end /.footer -->
            </form>
        </div>
    </div>
  </div>

<div class="card p-20 z-depth-0 waves-effect">
  <div class="card-header">
      
      {{-- <a href="/income/create" class="btn btn-success">Add New Income </a> --}}
      <div class="card-header-right">
          <ul class="list-unstyled card-option">
              <li><i class="fas fa-expand-arrows-alt full-card"></i></li>
              <li><i class="fas fa-minus minimize-card"></i></li>
              {{-- <li style="margin-right:28px"> <a href="/income/create" class="btn hor-grd btn-grd-success">Add New Income </a></li> --}}
              {{-- <li><i class="fas fa-trash close-card"></i></li> --}}
          </ul>
        
      </div>
        <h5>Expense Category List</h5>
  </div>
<div class="card-block" style="margin-top:30px">
  <div class="table-responsive">
      <div class="dt-responsive table-responsive">
         <table id="res-config" class="table table-striped table-bordered nowrap">
          <thead>
            <tr>
                <th class="th-sm" style="text-align:center">Sl No</th>
                <th class="th-sm" style="text-align:center">Expense Category</th>
                <th class="th-sm" style="text-align:center">Expense Sub Category</th>
                <th class="th-sm" style="text-align:center">Action</th>
            </tr>
        </thead>
        <tbody>
            <p hidden>{{ $sl = 1 }}</p>
            @foreach ($expenseSubCategory as $item)
                <tr>
                    <td class="align-middle" style="text-align:center">{{ $sl }}</td>
                    <td class="align-middle" style="text-align:center" >{{$item->expenseSubCat->expense_category}}</td>
                    <td class="align-middle" style="text-align:center">
                        
                        @if ($item->expense_subCategory!=NULL || $item->expense_subCategory!='')
                          {{$item->expense_subCategory}}
                        @endif
                    </td>
                    
                    <td class="align-middle edtBTN">
            
                        <a class="mb-2 mr-2 btn-icon btn-icon-only btn btn-success" href="" data-toggle="tooltip" data-placement="top" title="Edit " ><i class="fas fa-edit" style="color: white"></i></a>
                        <a class="mb-2 mr-2 btn-icon btn-icon-only btn btn-danger" href="" data-toggle="tooltip" data-placement="top" title="Delete" ><i class="fas fa-trash" style="color: white"></i></a>
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
