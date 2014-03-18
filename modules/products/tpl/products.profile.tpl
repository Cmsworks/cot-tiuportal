<!-- BEGIN: MAIN -->

	<!-- IF {PHP.usr.auth_write} -->
	<div class="pull-right"><a class="btn btn-primary" href="{LIST_SUBMITNEWPRD_URL}">{PHP.L.prd_submitnewprd}</a></div>
	<!-- ENDIF -->
	<div class="clear"></div>
	<hr/>
	<!-- BEGIN: LIST_ROW -->
	<div class="media<!-- IF {LIST_ROW_BOLD} > 0 --> adbold<!-- ENDIF --><!-- IF {LIST_ROW_VIP} > 0 --> prdip<!-- ENDIF -->">
		<div class="pull-right textright">
			<span class="label 
				  <!-- IF {LIST_ROW_STATUS} == 'published' -->label-success<!-- ENDIF -->
				  <!-- IF {LIST_ROW_STATUS} == 'pending' -->label-warning<!-- ENDIF -->">{LIST_ROW_LOCALSTATUS}</span>
			<br/>
			<br/>
			<p>{LIST_ROW_PAYVIP}</p>	  
			<p>{LIST_ROW_PAYTOP}</p>	  
			<p>{LIST_ROW_PAYBOLD}</p>	  
		</div>
		<!-- IF {LIST_ROW_MAVATAR.1} -->
		<a class="pull-left thumbnail" href="{LIST_ROW_URL}"><img src="{LIST_ROW_MAVATAR.1|cot_mav_thumb($this, 100, 100)}" /></a>	
		<!-- ENDIF -->
		<div class="media-body">
			<h4 class="media-heading"><a href="{LIST_ROW_URL}">{LIST_ROW_SHORTTITLE}</a></h4>
			<!-- IF {LIST_ROW_DESC} --><p class="small marginbottom10">{LIST_ROW_DESC}</p><!-- ENDIF -->
			<p class="small marginbottom10">{LIST_ROW_ADMIN_EDIT} ({LIST_ROW_COUNT})</p>
			<p class="small"><i class="icon-time"></i> {LIST_ROW_DATE}</p>
		</div>
	</div>	
	<br/>			
	<!-- END: LIST_ROW -->
	<!-- IF {LIST_TOP_PAGINATION} -->
	<p class="paging clear"><span>{PHP.L.Pages} {LIST_TOP_CURRENTPAGE} {PHP.L.Of} {LIST_TOP_TOTALPAGES}</span>{LIST_TOP_PAGEPREV}{LIST_TOP_PAGINATION}{LIST_TOP_PAGENEXT}</p>
	<!-- ENDIF -->

<!-- END: MAIN -->