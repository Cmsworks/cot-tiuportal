<!-- BEGIN: NEWS -->

<div class="row">
<!-- BEGIN: PAGE_ROW -->
	<div class="span4">
		<h4><a href="{PAGE_ROW_URL}" title="{PAGE_ROW_SHORTTITLE}">{PAGE_ROW_SHORTTITLE}</a></h4>
		<!-- IF {PAGE_ROW_DESC} --><p class="small">{PAGE_ROW_DESC}</p><!-- ENDIF -->

		<div class="textbox">
			{PAGE_ROW_TEXT_CUT}
			<!-- IF {PAGE_ROW_TEXT_IS_CUT} -->{PAGE_ROW_MORE}<!-- ENDIF -->
		</div>

		<div class="clear">
			<p class="small">
				{PAGE_ROW_COMMENTS} | {PAGE_ROW_DATE} | {PAGE_ROW_CATPATH}
			</p>
		</div>
	</div>
<!-- END: PAGE_ROW -->
</div>

<div class="pagination">
	<ul>
		{PAGE_PAGEPREV}{PAGE_PAGENAV}{PAGE_PAGENEXT}
	</ul>	
</div>

<!-- END: NEWS -->