<!-- BEGIN: MAIN -->

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">{USERS_REGISTER_TITLE}</div>
			<div class="panel-body">
				<div class="btn-group btn-group-justified">
					<!-- BEGIN: USERGROUP_ROW -->
					<a href="{USERGROUP_ROW_ALIAS|cot_url('users', 'm=register&usergroup='$this)}" class="btn btn-default btn-lg col-md-6<!-- IF {USERGROUP_ROW_ACTIVEID} --> active<!-- ENDIF -->">{USERGROUP_ROW_TITLE}</a>
					<!-- END: USERGROUP_ROW -->
				</div>
			</div>
		</div>
	</div>
</div>

<!-- END: MAIN -->