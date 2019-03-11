@extends('layouts.app')
@section('content')
<script src="/plugin/app.js"></script>
<script>
        $(function() {
          $('#start-camera').on('click', function() {
            let ml = new MLModule('verify');
          });
        });
</script>
	<div class="container">
		<div style="margin-top: 50px;">
			<div class="row">
				<div class="col-md-3">
				  @include('components.sidebar')

					<hr>
          <div class="alert alert-info">
            <b>Transfer Fund </b>
          </div>

          {{-- <form method="post" action="/transfer-fund"> --}}
            <div class="form-group">
              <label>Account Number</label>
              <input type="text" class="form-control" name="receiver" id="account_number" required>
              <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
            </div>
            <div class="form-group">
              <label>Account Name</label>
              <input type="text" class="form-control" name="" id="acct_name" disabled>
            </div>
            <div class="form-group">
              <label>Amount &nbsp; <span id="amount-preview" style="color: red"></span></label>
              <input type="number" class="form-control" name="amount" id="amount" value="0.0" required>
            </div>
            <div class="form-group">
              <label>Transaction Description</label>
              <textarea class="form-control" name="desc" id="desc"></textarea>
            </div>
            <div class="form-group">
              <button class="btn btn-success btn-lg" id="submit-btn">Submit</button>
            </div>
          {{-- </form> --}}

				</div>

			</div>
		</div>
		<hr>
	</div>
  @include('components.modal')
<script>
  $(function() {
      $('#account_number').on('blur', function(e) {
        const acct_num = $(this)
        const token = $('#token').val();
        const dataString = { _token: token, acct_num: acct_num.val() };
        if (acct_num.val() === '') return false;
        $('#acct_name').val('PLEASE WAIT...')
        $.post({
          url: '/fetch-acctdetails',
          data: dataString
        }).then(function(response) {
          if (response.hasOwnProperty('account_number')) {
            $('#acct_name').val(`${response.othername}, ${response.surname}`)
          } else {
            alert('Account Details Not found ')
          }
        });
      })

      $('#amount').on('blur', function() {
        const val = $(this).val();
        const preview = $('#amount-preview');

        if (val == '') {
          preview.html("<small>amount is required</small>");
        } else {
          $.post('/get-balance', { amount: val, _token: $('#token').val()})
          .then(function(resp) {
            preview.text((resp.status =='failed') ? 'Insufficient Fund' : '');
            if (resp.status == 'failed') {
              $('#submit-btn').attr('disabled', '');
            } else {
              $('#submit-btn').removeAttr('disabled');
            }
          }).catch(function(error) {
            console.log(error)
          })
        }
      });

      $('#submit-btn').on('click', function(e) {
        const desc = $('#desc');
        const amount = $('#amount');
        const acct_num = $('#account_number');

        if (acct_num.val() == '') {
          acct_num.focus();
          return false;
        } else if (amount.val() == '') {
          amount.focus();
          return false;
        } else if (!amount.val().match(/^[0-9.]+$/)) {
          alert("please enter valid amount");
          amount.focus();
          return false;
        } else if (amount.val() < 1){
          alert("please enter valid amount");
          amount.focus();
          return false;
        } else {
          $('#cameraModal').modal('show');
        }
      });
  });
</script>
@stop