@extends('layouts.app')

@section('content')


<div class="card">
  <div class="card-header">
      <h5>ব্যায়ের বিল রেজিস্ট্রার রিপোর্ট</h5>
 </div>
 <div class="card-block" style="margin-top: -40px">
	<div class="j-wrapper j-wrapper-640">
		<form action="/expense-billRegistar-report" method="post" class="j-pro" id="j-pro" enctype="multipart/form-data">
			<!-- end /.header-->
			{{ csrf_field() }}
			<div class="j-content">
				<div class="j-row">
					<div class="j-span6 j-unit">
						<label class="j-label">Start Date</label>
						<div class="j-input j-success-view">
							<label class="j-icon-right" for="date_from">
								<i class="icofont icofont-ui-calendar"></i>
							</label>
							<input type="text" id="date_from" name="income_start_date" readonly class="form-control">
						</div>
				  </div>
					<div class="j-span6 j-unit">
						<label class="j-label">End Date</label>
						<div class="j-input j-success-view">
							<label class="j-icon-right" for="date_from">
								<i class="icofont icofont-ui-calendar"></i>
							</label>
							<input type="text" id="date_to" name="income_end_date" readonly class="form-control">
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
