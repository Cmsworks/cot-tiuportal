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

<!-- END: MAIN -->