<!-- BEGIN: MARKET -->
<div class="mboxHD">{PHP.L.market} </div>
<hr>
<div class="row">
	<!-- BEGIN: PRD_ROWS -->
	<div class="col-md-3 pull-left">
		<div class="panel panel-default">
		<div class="panel-heading text-center"><h5><a href="{PRD_ROW_URL}">{PRD_ROW_SHORTTITLE}</a></h5></div>
			<div class="panel-body text-center">
				
				<!-- IF {PRD_ROW_ID|cot_files_count('market',$this,'mainlogo','images')} > 0 -->
				<div class="text-center">
					<a href="{PRD_ROW_URL}"><img src="{PRD_ROW_ID|cot_files_get('market',$this,'mainlogo')|cot_files_thumb($this,200,200,'crop')}" /></a>
				</div>
				<!-- ENDIF -->
				<hr>		
				<p class="type"><a href="{PRD_ROW_CATURL}">{PRD_ROW_CATTITLE}</a></p>
				<p class="owner"><span class="date">{PRD_ROW_DATE_STAMP|cot_date("d M Y",$this)}</span>&nbsp; {PRD_ROW_EDIT_URL}</p>
			</div>
			<div class="panel-footer text-center">
				<!-- IF {PRD_ROW_COST} > 0 -->
					<h4>
						<div class="cost">{PRD_ROW_COST} {PHP.cfg.payments.valuta}</div>
					</h4>
				<!-- ENDIF -->	
			</div>
		</div>
	</div>
	<!-- END: PRD_ROWS -->
</div>
<div class="pagination">{PAGENAV_PAGES}</div>
<!-- END: MARKET -->