<div class="modal fade connect popup" id="global-connect-popup" tabindex="-1" role="dialog" aria-labelledby="global-connect-popup">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
				<div class="page-header mt-025">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h1 class="mt-0">Connect</h1>
				</div>

        <div>

          <!-- Nav tabs -->
          <ul class="nav nav-tabs mb-1" role="tablist">
             <li role="presentation"><a href="#register" aria-controls="register" role="tab" data-toggle="tab">Register</a></li>
            <li role="presentation" class="active"><a href="#login" aria-controls="login" role="tab" data-toggle="tab">Login</a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane" id="register">

              <form id="registerForm" data-parsley-validate>
                {!! Form::token() !!}
                <ul class="form-errors"></ul>
      					<div class="form-group">
                  <div class="row">
                    <div class="col-sm-6">
          						<label>Firstname</label>
          						<input type="text" name="firstname" class="form-control" placeholder="firstname" data-parsley-type="alphanum" required>
                    </div>
                    <div class="col-sm-6">
          						<label>Lastname</label>
          						<input type="text" name="lastname" class="form-control" placeholder="lastname" data-parsley-type="alphanum" required>
                    </div>
                  </div>
      					</div>
      					<div class="form-group">
      						<label>Email</label>
      						<input type="email" name="email" class="form-control" placeholder="email" required>
      					</div>
      					<div class="form-group">
      						<label>Password</label>
      						<input type="password" name="password1" class="form-control" placeholder="password" minlength="6" maxlength="30" required>
							<label>Retype Password</label>
							<input type="password" name="password2" class="form-control" placeholder="password" minlength="6" maxlength="30" required>
      					</div>
    						<input type="hidden" name="referrer" class="form-control">
      					<!-- <div class="form-group">
      						<label>Check</label>
      						<div class="g-recaptcha" data-sitekey="6LeM9wgTAAAAABKpSC1jMgiw0bArsCa7z_R2_5Ut"></div>
      						<script src='https://www.google.com/recaptcha/api.js'></script>
      					</div> -->
      					<button type="submit" class="btn btn-secondary btn-block">Submit</button>
      				</form>

            </div>
            <div role="tabpanel" class="tab-pane active" id="login">
              <form id="loginForm" data-parsley-validate>
                {!! Form::token() !!}
                <ul class="form-errors"></ul>
                <div class="form-group">
                  <label>Email address</label>
                  <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-secondary btn-block">Submit</button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>
