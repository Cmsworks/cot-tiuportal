<!-- BEGIN: MAIN -->
	
	<div class="well well-large">
		{PHP.L.index_text}
	</div>
	
	<!-- IF {PHP.cot_modules.products} -->
	{PHP|cot_products_list(12)}
	<!-- ENDIF -->
	
	<!-- IF {INDEX_NEWS} -->
	<br/>
	<div class="block">
		{INDEX_NEWS}
	</div>
	<!-- ENDIF -->
	
	<hr/>
	
	<div class="row">
		<div class="col-md-4">
			<!-- IF {INDEX_TAG_CLOUD} -->
			<div class="block">
				<div class="mboxHD tags">{PHP.L.Tags}</div>
				{INDEX_TAG_CLOUD}
			</div>
			<!-- ENDIF -->
		</div>

		<div class="col-md-4">
			<!-- IF {INDEX_POLLS} -->
			<div class="block">
				<div class="mboxHD polls">{PHP.L.Polls}</div>
				{INDEX_POLLS}
			</div>
			<!-- ENDIF -->
		</div>
		
		<div class="col-md-4">
			<!-- IF {PHP.out.whosonline} -->
			<div class="block">
				<div class="mboxHD online">{PHP.L.Online}</div>
				<a href="{PHP|cot_url('plug','e=whosonline')}">{PHP.out.whosonline}</a>
				<!-- IF {PHP.out.whosonline_reg_list} -->:<br />{PHP.out.whosonline_reg_list}<!-- ENDIF -->
			</div>
			<!-- ENDIF -->
		</div>
	</div>
	
<!-- END: MAIN -->