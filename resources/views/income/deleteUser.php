@extends('layouts.app')



@section('content')


<div class="card">
  <div class="card-header">
      <h5>Submit Request for Delete User Data</h5>
 </div>
  <div class="card-block">
      <div class="j-wrapper j-wrapper-640">
          <form action="/income/create" method="post" class="j-pro" id="j-pro" enctype="multipart/form-data">
              <!-- end /.header-->
              {{ csrf_field() }}
              <div class="j-content">
                  <!-- start name -->
                  <div class="j-row">
                      <div class="j-span6 j-unit">
                        <label class="j-label">ভাউচার নাম্বার </label>
                          <div class="j-input">
                              <label class="j-icon-left" for="first_name">
                                  <i class="fas fa-id-card"></i>
                              </label>
                              <input type="text"  id="voucher" placeholder="ভাউচার নাম্বার লিখুন" name="income_voucher" class="name-group">
                          </div>
                      </div> 
                      </div> 
                      </div> 
                      </div> 

</div>
                     
@endsection
