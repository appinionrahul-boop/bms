@extends('layouts.app')

@section('content')


<div class="card">
  <div class="card-header">
      <h5> আয় এডিট করুন </h5>
 </div>
  <div class="card-block">
      <div class="j-wrapper j-wrapper-640">
        <form action = "/incomeEdit/<?php echo $income[0]->id; ?>" method = "post" class="j-pro" id="j-pro" enctype="multipart/form-data">
              <!-- end /.header-->
              {{ csrf_field() }}
              <div class="j-content">
                  <!-- start name -->
                  <div class="j-row">
                      <div class="j-span6 j-unit">
                        <label class="j-label">ভাউচার নাম্বার </label>
                          <div class="j-input">
                              <label class="j-icon-left" for="first_name">
                                  <i  class="icofont icofont-card"></i>
                              </label>
                              <input type="text"  id="voucher"  value = '<?php echo$income[0]->voucher_no; ?>' name="income_voucher" class="name-group">
                          </div>
                      </div>
                      <div class="j-span6 j-unit">
                        <label class="j-label">অর্থবছর</label>
                          <div class="j-input">
                            <label class="j-input j-select">
                              <select id="inputState" class="form-control" name="income_fiscalYear" required>
                                <option selected value="২০২০-২০২১">অর্থবছর বাছুন</option>
                                <option value="২০২০-২০২১">২০২০-২০২১</option>
                                <option value="২০২১-২০২২">২০২১-২০২২</option>
                                <option value="২০২২-২০২৩">২০২২-২০২৩</option>
                              </select>
                              <i></i>
                            </label>
                          </div>
                      </div>
                  </div>
                  <div class="j-unit">
                 
                      <div class="j-input">
                        <label class="j-label">চেক নাম্বার</label>
                          <div class="j-input">
                              <label class="j-icon-left" for="first_name">
                                  <i  class="icofont icofont-newspaper"></i>
                              </label>
                              <input type="text"  id="cheque" value = '<?php echo$income[0]->income_cheque; ?>' placeholder="চেক নাম্বার লিখুন" name="income_cheque" class="name-group">
                          </div>
                      </div>
                  </div>
                  <div class="j-divider j-gap-bottom-25"></div>

                  <div class="j-row">
                    <label class="j-label">টাকার পরিমাণ </label>
                    <div class="j-span6 j-unit">
                        <div class="j-input">
                            <label class="j-icon-left" for="first_name">
                                <i class="icofont icofont-cur-taka-minus"></i>
                            </label>
                            <input type="text"  id="amount" value = '<?php echo$income[0]->income_amount; ?>' placeholder="টাকার পরিমাণ লিখুন" name="income_amount"class="name-group">
                        </div>
                    </div>
                    <div class="j-span6 j-unit" style="margin-top: -19px">
                      <label class="j-label">তারিখ </label>
                      <div class="j-input j-success-view">
                          <label class="j-icon-right" for="date_from">
                              <i class="icofont icofont-ui-calendar"></i>
                          </label>
                          <input type="text" id="date_from" name="income_date" readonly class="form-control" required>
                      </div>
                  </div>
                </div>
                <div class="j-unit">
                 
                    <div class="j-input">
                      <label class="j-label">বিলের বিবরণ</label>
                        <div class="j-input">
                            <label class="j-icon-left" for="first_name">
                                <i  class="icofont icofont-file-text"></i>
                            </label>
                            <input type="text" placeholder="বিলের বিবরণ লিখুন" value= '<?php echo$income[0]->income_descriptation; ?>' id="message" name="income_message" class="name-group">
                        </div>
                    </div>
                </div>

              
                
               </div>
              
                
                  <div class="j-response"></div>
                  <!-- end response from server -->
              </div>
              <!-- end /.content -->
              <div class="j-footer">
                  <button type="submit" class="btn btn-primary" style="margin-left: 2px">Update</button>
                  <button type="reset" class="btn btn-warning">Reset</button>
              </div>
              <!-- end /.footer -->
          </form>
      </div>
  </div>
</div>



    <script type="text/javascript">
    
      $(document).ready(function () {
      $('#rootCat').on('change', function () {
      let id = $(this).val();
      $('#subCat').empty();
      $('#subCat').append(`<option value="0" disabled selected>Processing...</option>`);
      $.ajax({
      type: 'GET',
      url: 'getSubCatI/' + id,
      success: function (response) {
  
  
      $('#subCat').empty();
      response.forEach(element => {
          $('#subCat').append(`<option value="${element['id']}">${element['sector_source']}</option>`);
          });
          }
        });
      });
      });
    </script>

    <script type="text/javascript">
        
      $(document).ready(function () {
      $('#subCat').on('change', function () {
       // alert('erere');
      let id = $(this).val();
      $('#botSubCat').empty();
      $('#botSubCat').append(`<option value="0" disabled selected>Processing...</option>`);
      $.ajax({
      type: 'GET',
      url: 'getBotSubCat/' + id,
      success: function (response) {


      $('#botSubCat').empty();
      response.forEach(element => {
          $('#botSubCat').append(`<option value="${element['id']}">${element['sector']}</option>`);
          });
          }
        });
      });
      });
    </script>
@endsection
