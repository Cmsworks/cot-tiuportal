<!-- BEGIN: MAIN -->

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">{USERS_REGISTER_TITLE}</div>
			<div class="panel-body">
				{FILE "{PHP.cfg.themes_dir}/{PHP.cfg.defaulttheme}/warnings.tpl"}
				<form name="login" action="{USERS_REGISTER_SEND}" method="post" enctype="multipart/form-data" class="form-horizontal">
					<!-- IF {USERS_REGISTER_GROUPSELECT} -->
					<div class="form-group">
						<label class="fontrol-label col-md-4">{PHP.L.profile_group}:</label>
						<div class="col-md-8">{USERS_REGISTER_GROUPSELECT}</div>
					</div>
					<!-- ENDIF -->
					<div class="form-group">
						<label class="fontrol-label col-md-4">{PHP.L.Username}:</label>
						<div class="col-md-8">{USERS_REGISTER_USER}</div>
					</div>
					<!-- IF {PHP.cot_plugins_active.locationselector} -->
					<div class="form-group">
						<label class="fontrol-label col-md-4">{PHP.L.Country}:</label>
						<div class="col-md-8">{USERS_REGISTER_LOCATION}</div>
					</div>
					<!-- ELSE -->
					<div class="form-group">
						<label class="fontrol-label col-md-4">{PHP.L.Country}:</label>
						<div class="col-md-8">{USERS_REGISTER_COUNTRY}</div>
					</div>
					<!-- ENDIF -->
					<div class="form-group">
						<label class="fontrol-label col-md-4">{PHP.L.users_validemail}:</label>
						<div class="col-md-8">
							{USERS_REGISTER_EMAIL}
							<p class="small">{PHP.L.users_validemailhint}</p>
						</div>
					</div>
					<div class="form-group">
						<label class="fontrol-label col-md-4">{PHP.L.Password}:</label>
						<div class="col-md-8">{USERS_REGISTER_PASSWORD}</div>
					</div>
					<div class="form-group">
						<label class="fontrol-label col-md-4">{PHP.L.users_confirmpass}:</label>
						<div class="col-md-8">{USERS_REGISTER_PASSWORDREPEAT}</div>
					</div>
					<div class="form-group">
						<label class="fontrol-label col-md-4">{USERS_REGISTER_VERIFYIMG}</label>
						<div class="col-md-8">{USERS_REGISTER_VERIFYINPUT}</div>
					</div>
					<!-- IF {USERS_REGISTER_USERAGREEMENT} -->
					<div class="form-group">
						<label class="fontrol-label col-md-4">{PHP.L.useragreement}</label>
						<div class="col-md-8"><label class="checkbox">{USERS_REGISTER_USERAGREEMENT}</label></div>
					</div>
					<!-- ENDIF -->
					<div class="form-group">
						<label class="fontrol-label col-md-4"></label>
						<div class="col-md-8">
							<button class="btn btn-primary btn-large">{PHP.L.Submit}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- END: MAIN -->