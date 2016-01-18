<!-- BEGIN: MAIN -->

<div class="breadcrumb"><a href="{USERS_DETAILS_USERSELECTED_GROUP_URL}">{USERS_DETAILS_USERSELECTED_GROUP_NAME}</a> / {USERS_DETAILS_NICKNAME}<!-- BEGIN: USERS_DETAILS_ADMIN --> &nbsp; [ {USERS_DETAILS_ADMIN_EDIT} ]<!-- END: USERS_DETAILS_ADMIN --></div>
<h1>{USERS_DETAILS_NAME}</h1>
<div class="row">
	<div class="col-md-3">
		<div class="thumbnail">{USERS_DETAILS_AVATAR}</div>
	</div>
	<div class="col-md-9">
		{PHP.urr.user_id|cot_products_list(10, '', 'index', 'prd_ownerid='$this, "prd_date DESC", true)}
	</div>
</div>

<!-- END: MAIN -->