@extends('layouts.app')

@section('content')


<div class="card">
  <div class="card-header">
      <h5>নতুন ব্যায় যোগ করুন</h5>
 </div>
  <div class="card-block">
      <div class="j-wrapper j-wrapper-640">
        <form action = "/expenseEdit/<?php echo $expense[0]->id; ?>" method = "post" class="j-pro" id="j-pro" enctype="multipart/form-data">
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
                              <input type="text"  id="voucher" value = '<?php echo $expense[0]->voucher_no; ?>' placeholder="ভাউচার নাম্বার লিখুন" name="expense_voucher" class="name-group">
                          </div>
                      </div>
                      <div class="j-span6 j-unit">
                        <label class="j-label">অর্থবছর</label>
                          <div class="j-input">
                            <label class="j-input j-select">
                              <select id="inputState" class="form-control" name="expense_fiscalYear">
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
                            <input type="text"  id="cheque" value = '<?php echo $expense[0]->expense_cheque; ?>' placeholder="চেক নাম্বার লিখুন" name="expense_cheque" class="name-group">
                        </div>
                    </div>
                </div>
                 
 
                  <div class="j-divider j-gap-bottom-25"></div>

                  <div class="j-row">
                    <label class="j-label">টাকার পরিমাণ</label>
                    <div class="j-span6 j-unit">
                        <div class="j-input">
                            <label class="j-icon-left" for="first_name">
                                <i class="icofont icofont-cur-taka-minus"></i>
                            </label>
                            <input type="text" value = '<?php echo $expense[0]->expense_amount; ?>' id="amount" placeholder="টাকার পরিমাণ লিখুন" name="expense_amount"class="name-group">
                        </div>
                    </div>
                    <div class="j-span6 j-unit" style="margin-top: -19px">
                      <label class="j-label">ব্যায়ের তারিখ</label>
                      <div class="j-input j-success-view">
                          <label class="j-icon-right" for="date_from">
                              <i class="icofont icofont-ui-calendar"></i>
                          </label>
                          <input type="text" id="date_from" name="expense_date" readonly class="form-control">
                      </div>
                  </div>
                </div>
                <div class="j-unit">
                 
                    <div class="j-input">
                      <label class="j-label">ব্যায়ের বিবরণ</label>
                        <div class="j-input">
                            <label class="j-icon-left" for="first_name">
                                <i  class="icofont icofont-file-text"></i>
                            </label>
                            <input type="text" placeholder="ব্যায়ের বিবরণ লিখুন" value= '<?php echo $expense[0]->descriptation; ?>' id="message" name="expense_message" class="name-group">
                        </div>
                    </div>
                </div>

              <div class="j-response j-footer"></div>
                <div class="j-row">
                  <div class="j-span6 j-unit">
                    <label class="j-label">ব্যায়ের ভ্যাট </label>
                      <div class="j-input">
                          <label class="j-icon-left" for="first_name">
                              <i  class="icofont icofont-mathematical-alt-2"></i>
                          </label>
                          <input type="text" value= '<?php echo $expense[0]->expense_vat; ?>'  id="voucher" placeholder="ভ্যাটে কতো % লিখুন " name="expense_vat" class="name-group">
                      </div>
                  </div>
                  <div class="j-span6 j-unit">
                    <label class="j-label">ভ্যাটের টাকার পরিমাণ  </label>
                    
                      <div class="j-input">
                          <label class="j-icon-left" for="first_name">
                              <i class="icofont icofont-barcode"></i>
                          </label>
                          <input type="text" value= '<?php echo $expense[0]->vat_amount; ?>' id="vat_am" placeholder="ভ্যাটের পরিমাণ " name="vat_amount"class="name-group">
                      </div>
                 
                  </div>
                  
              </div>
              <div class="j-unit">
                 
                <div class="j-input">
                  <label class="j-label">ভ্যাটের চেকের বিবরণ</label>
                    <div class="j-input">
                        <label class="j-icon-left" for="first_name">
                            <i  class="icofont icofont-file-text"></i>
                        </label>
                        <input type="text" placeholder="ব্যায়ের বিবরণ লিখুন" value= '<?php echo $expense[0]->vat_cheque_descriptation; ?>' id="message" name="vat_cheque_descriptation" class="name-group">
                    </div>
                </div>
            </div>
            <div class="j-unit">
                 
                <div class="j-input">
                  <label class="j-label">ভ্যাটের বিবরণ</label>
                    <div class="j-input">
                        <label class="j-icon-left" for="first_name">
                            <i  class="icofont icofont-file-text"></i>
                        </label>
                        <input type="text" placeholder="ব্যায়ের বিবরণ লিখুন" value= '<?php echo $expense[0]->expense_folio; ?>' id="message" name="expense_folio" class="name-group">
                    </div>
                </div>
            </div>    

            <div class="j-response"></div>
            <div class="j-row">
              <div class="j-span6 j-unit">
                <label class="j-label">আয়কর % </label>
                  <div class="j-input">
                      <label class="j-icon-left" for="first_name">
                        <i class="icofont icofont-barcode"></i>
                      </label>
                      <input type="text"    id="tax_p" placeholder="আয়কর কতো % লিখুন   " value= '<?php echo $expense[0]->expense_tax; ?>' name="expense_tax" class="name-group">
                  </div>
              </div>
              <div class="j-span6 j-unit">
                <label class="j-label">আয়করের টাকার পরিমাণ  </label>
                
                  <div class="j-input">
                      <label class="j-icon-left" for="first_name">
                          <i class="icofont icofont-barcode"></i>
                      </label>
                      <input type="text"  id="tax_am" value= '<?php echo $expense[0]->tax_amount; ?>' placeholder="আয়করের পরিমাণ " name="tax_amount"class="name-group">
                  </div>
             
              </div>
          </div>
          <div class="j-unit">
                 
            <div class="j-input">
              <label class="j-label">আয়করের চেকের বিবরণ</label>
                <div class="j-input">
                    <label class="j-icon-left" for="first_name">
                        <i  class="icofont icofont-file-text"></i>
                    </label>
                    <input type="text" placeholder="আয়করের চেকের বিবরণ লিখুন" value= '<?php echo $expense[0]->tax_cheque_descriptation; ?>' id="message" name="tax_cheque_descriptation" class="name-group">
                </div>
            </div>
        </div>
        <div class="j-unit">
             
            <div class="j-input">
              <label class="j-label">আয়করের বিবরণ</label>
                <div class="j-input">
                    <label class="j-icon-left" for="first_name">
                        <i  class="icofont icofont-file-text"></i>
                    </label>
                    <input type="text" placeholder="আয়করের বিবরণ লিখুন" value= '<?php echo $expense[0]->tax_desriptation; ?>' id="message" name="tax_desriptation" class="name-group">
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
        $('#subCat').append(`<option value="${element['id']}">${element['expense_subCategory']}</option>`);
        });
        }
    });
    });
    });
</script>

    
@endsection
