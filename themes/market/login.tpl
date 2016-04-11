<!-- BEGIN: MAIN -->

		<!-- BEGIN: USERS_AUTH_MAINTENANCE -->
			<div class="error clear">
				<h4>{PHP.L.users_maintenance1}</h4>
				<p>{PHP.L.users_maintenance2}</p>
			</div>
		<!-- END: USERS_AUTH_MAINTENANCE -->

		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">{USERS_AUTH_TITLE}</div>
					<div class="panel-body">
						<form name="login" action="{USERS_AUTH_SEND}" method="post" class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-md-4">{PHP.L.Username}:</label>
								<div class="col-md-8">{USERS_AUTH_USER}</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4">{PHP.L.Password}:</label>
								<div class="col-md-8">{USERS_AUTH_PASSWORD}</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4"></label>
								<div class="col-md-8">
									<div class="checkbox">
										<label>{USERS_AUTH_REMEMBER}&nbsp; {PHP.L.users_rememberme}</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4"></label>
								<div class="col-md-8">
									<button type="submit" name="rlogin" class="btn btn-large btn-primary" value="0">{PHP.L.Login}</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

<!-- END: MAIN -->