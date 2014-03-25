<!-- BEGIN: MAIN -->

	<div class="breadcrumb">{USERS_REGISTER_TITLE}</div>
	<div class="well" style="padding-left: 50px;">
		<div class="input-prepend input-append">
			<div class="btn-group">
				<!-- BEGIN: USERGROUP_ROW -->
				<a href="{USERGROUP_ROW_ALIAS|cot_url('users', 'm=register&usergroup='$this)}" class="btn btn-large span5<!-- IF {USERGROUP_ROW_ACTIVEID} --> active<!-- ENDIF -->">{USERGROUP_ROW_TITLE}</a>
				<!-- END: USERGROUP_ROW -->
			</div>
		</div>
	</div>
	<div class="well">
		{FILE "{PHP.cfg.themes_dir}/{PHP.cfg.defaulttheme}/warnings.tpl"}
		<form name="login" action="{PHP.usergroup|cot_url('users', 'm=register&a=add&usergroup='$this)}" method="post" enctype="multipart/form-data">
			<input type="hidden" name="ruserusergroup" value="{PHP.usergroupid}" />
			<table class="table">
				<tr>
					<td class="width30">{PHP.L.Username}:</td>
					<td>{USERS_REGISTER_USER} *</td>
				</tr>
				<tr>
					<td>{PHP.L.users_validemail}:</td>
					<td>
						{USERS_REGISTER_EMAIL} *
						<p class="small">{PHP.L.users_validemailhint}</p>
					</td>
				</tr>
				<tr>
					<td>{PHP.L.Password}:</td>
					<td>{USERS_REGISTER_PASSWORD} *</td>
				</tr>
				<tr>
					<td>{PHP.L.users_confirmpass}:</td>
					<td>{USERS_REGISTER_PASSWORDREPEAT} *</td>
				</tr>
				<tr>
					<td>{USERS_REGISTER_VERIFYIMG}</td>
					<td>{USERS_REGISTER_VERIFYINPUT} *</td>
				</tr>
				<!-- IF {USERS_REGISTER_USERAGREEMENT} -->
				<tr>
					<td>{PHP.L.useragreement}</td>
					<td><label class="checkbox">{USERS_REGISTER_USERAGREEMENT} *</label></td>
				</tr>
				<!-- ENDIF -->
				<tr>
					<td colspan="2" class="valid">
						<input type="submit" class="btn btn-primary btn-large" value="{PHP.L.Submit}" />
					</td>
				</tr>
			</table>
		</form>
	</div>

<!-- END: MAIN -->