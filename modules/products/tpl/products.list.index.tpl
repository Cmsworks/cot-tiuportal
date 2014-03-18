<!-- BEGIN: MAIN -->
<div class="row">
	<!-- BEGIN: PRD_ROW -->
	<div class="span4">
		<div class="media">
			<!-- IF {PRD_ROW_MAVATAR.1} -->
			<a class="pull-left thumbnail" href="{PRD_ROW_URL}"><img src="{PRD_ROW_MAVATAR.1|cot_mav_thumb($this, 100, 100)}" /></a>	
			<!-- ENDIF -->
			<div class="media-body">
				<h4 class="media-heading"><a href="{PRD_ROW_URL}">{PRD_ROW_SHORTTITLE}</a></h4>
				<!-- IF {PRD_ROW_COST} > 0 -->
				<div><span class="label label-success">{PRD_ROW_COST|cot_products_costformat($this)} {PHP.L.valuta}</span></div>
				<!-- ENDIF -->
			</div>	
		</div>
		<br/>
	</div>		
	<!-- END: PRD_ROW -->
</div>	
<!-- END: MAIN -->