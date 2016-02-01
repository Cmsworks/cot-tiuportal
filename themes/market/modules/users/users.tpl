<!-- BEGIN: MAIN -->

<div class="breadcrumb">{USERS_TITLE}</div>
<h1>{USERS_SHORTTITLE}</h1>
<div class="row">
	<!-- BEGIN: USERS_ROW -->
	<div class="col-md-3 pull-left">
		<div class="panel panel-default text-center">			
			<div class="panel-body ">
				<a href="{USERS_ROW_DETAILSLINK}">{USERS_ROW_AVATAR|cot_rc_modify($this,'style="display:inline;"')}</a>
			</div>
			<div class="panel-footer">{USERS_ROW_NAME}</div>
		</div>
	</div>
	<!-- END: USERS_ROW -->
</div>
<div class="pagination"><ul>{USERS_TOP_PAGEPREV}{USERS_TOP_PAGNAV}{USERS_TOP_PAGENEXT}</ul></div>

<!-- END: MAIN -->