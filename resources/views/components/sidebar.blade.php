	<div class="list-group">
						<a href="#" class="list-group-item active">Quick Link</a>
						<a href="/home" class="list-group-item">Home</a>
				    	<a href="/profile" class="list-group-item">Account Information</a>
				    	<a href="/transfer" class="list-group-item">Transfer</a>
				    	{{-- <a href="/withdrawal" class="list-group-item">Withdrawal</a> --}}
				    	<a href="/fund" class="list-group-item">Fund Account</a>
				    	<a href="/signout" class="list-group-item">Logout</a>
				  	</div>
			</div>
				<div class="col-md-9">
          <div class="row">
            <div class="col-md-4">
              <h6>Welcome back, {{Session('user_account')->surname}}, {{Session('user_account')->othername}}</h6>
            </div>
            {{-- {{dd($model)}} --}}
            <div class="col-md-8">
              <b>Account Type: {{Session('user_account')->account_type}}</b>&nbsp; / &nbsp;
                <b style="color: #666;font-size: 13px;">Account Number: {{Session('user_account')->account_number}}</b>
                &nbsp; / &nbsp;
                {{-- {{ array_sum(array_column(array_get($model, 'bank_account'), 'balance'))}} --}}
                <b style="font-size: 12px;">Total Balance: @money(array_sum(array_column(array_get($model, 'bank_account'), 'balance')), 'NGN')</b>
            </div>
          </div>