<!-- BEGIN: MAIN -->

<div class="breadcrumb">{USERS_DETAILS_TITLE}</div>
<h1>{USERS_DETAILS_NAME}</h1>
<div class="row">
	<div class="span3">
		<div class="thumbnail">{USERS_DETAILS_AVATAR}</div>
	</div>
	<div class="span9">
		{PHP.urr.user_id|cot_products_list(10, '', 'index', 'prd_ownerid='$this, "prd_date DESC", true)}
	</div>
</div>

<!-- END: MAIN -->