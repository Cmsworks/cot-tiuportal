<!-- BEGIN: MAIN -->

<div class="breadcrumb">{BREADCRUMBS}</div>
<h1>{PHP.L.myproducts_title}</h1>

<ul class="nav nav-tabs" id="myTab">
	<li<!-- IF !{PHP.status} --> class="active"<!-- ENDIF -->><a href="{PHP|cot_url('myproducts', '')}">{PHP.L.myproducts_status_public}</a></li>
	<li<!-- IF {PHP.status} == 'unvalidated' --> class="active"<!-- ENDIF -->><a href="{PHP|cot_url('myproducts', 'status=unvalidated')}">{PHP.L.myproducts_status_unvalidated}</a></li>
	<li<!-- IF {PHP.status} == 'closed' --> class="active"<!-- ENDIF -->><a href="{PHP|cot_url('myproducts', 'status=closed')}">{PHP.L.myproducts_status_closed}</a></li>
</ul>

<!-- BEGIN: LIST_ROW -->
	<div class="media<!-- IF {LIST_ROW_BOLD} > 0 --> adbold<!-- ENDIF --><!-- IF {LIST_ROW_TOP} > 0 --> adtop<!-- ENDIF -->">
		<!-- IF {LIST_ROW_COST} > 0 -->
		<div class="pull-right"><span class="label label-success">{LIST_ROW_COST|cot_products_costformat($this)} {PHP.L.valuta}</span></div>
		<!-- ENDIF -->
		<!-- IF {LIST_ROW_MAVATAR.1} -->
		<a class="pull-left thumbnail" href="{LIST_ROW_URL}"><img src="{LIST_ROW_MAVATAR.1|cot_mav_thumb($this, 100, 100)}" /></a>	
		<!-- ENDIF -->
		<div class="media-body">
			<h4 class="media-heading"><a href="{LIST_ROW_URL}">{LIST_ROW_SHORTTITLE}</a></h4>
			<p class="small"><i class="icon-time"></i> {LIST_ROW_DATE}</p>
			<!-- IF {PHP.cot_plugins_active.payprdtop} -->
			<p>{LIST_ROW_PAYTOP}</p>
			<!-- ENDIF -->
			<!-- IF {PHP.cot_plugins_active.payprdbold} -->
			<p>{LIST_ROW_PAYBOLD}</p>
			<!-- ENDIF -->
		</div>	
	</div>	
	<br/>
<!-- END: LIST_ROW -->

<!-- IF {LIST_TOP_PAGINATION} -->
	<p class="paging clear"><span>{PHP.L.Pages} {LIST_TOP_CURRENTPAGE} {PHP.L.Of} {LIST_TOP_TOTALPAGES}</span>{LIST_TOP_PAGEPREV}{LIST_TOP_PAGINATION}{LIST_TOP_PAGENEXT}</p>
<!-- ENDIF -->

<!-- END: MAIN -->