@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header">
      <div class="card-header-right">
          <ul class="list-unstyled card-option">
              <li><i class="feather icon-maximize full-card"></i></li>
              <li><i class="feather icon-minus minimize-card"></i></li>
              {{-- <li style="margin-right:28px"> <a href="/income/create" class="btn hor-grd btn-grd-success">Add New Income </a></li> --}}
              {{-- <li><i class="feather icon-trash-2 close-card"></i></li> --}}
          </ul>
      </div>
      <h5>ADD Income Category</h5>
  </div>
 
  <div class="card-block" style="margin-top: -40px">
      <div class="j-wrapper j-wrapper-640">
          <form action="/income-category/createSub" method="post" class="j-pro" id="j-pro" enctype="multipart/form-data">
              <!-- end /.header-->
              {{ csrf_field() }}
              <div class="j-content">
                  <div class="j-row">
                      <div class="j-span6 j-unit">
                        <label class="j-label">Income Category</label>
                        <div class="j-input">
                          <label class="j-input j-select">
                            <select id="rootCat" class="form-control" name="root_cat">
                              <option selected>Choose...</option>

                                @foreach ($incomeCategory as $incomeCategory)

                                  @if ($incomeCategory->category_sector!='')
                                  <option  value="{{$incomeCategory->id}}">{{$incomeCategory->category_sector}}</option>
                                  @endif
                                  
                                @endforeach
                            
                            </select>
                            <i></i>
                          </label>
                        </div>
                    </div>
                      <div class="j-span6 j-unit">
                        <label class="j-label">Income Sub Category</label>
                          <div class="j-input">
                              <label class="j-icon-left" for="first_name">
                                  <i  class="icofont icofont-tree"></i>
                              </label>
                              <input type="text" class="form-control" id="Sector" placeholder="Sector" name="sector">
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

@endsection
