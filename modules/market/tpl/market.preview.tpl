<!-- BEGIN: MAIN -->
<div class="breadcrumb">{PRD_TITLE}</div>
<h1><!-- IF {PRD_COST} > 0 --><div class="pull-right cost">{PRD_COST} {PHP.cfg.payments.valuta}</div><!-- ENDIF -->{PRD_SHORTTITLE}</h1>
<div class="row">
	<div class="col-md-9">
		<div class="media">
				
			<p class="date">[{PRD_DATE}]</p>
			<p class="location">{PRD_COUNTRY} {PRD_REGION} {PRD_CITY}</p>
			<p class="text">{PRD_TEXT}</p>

			<!-- IF {PRD_ID|cot_files_count('market',$this,'othersfiles')} > 0 -->
				 {PRD_ID|cot_files_display('market',$this,'othersfiles')}
			<!-- ENDIF -->

			<hr/>
			<p>
				<a href="{PRD_SAVE_URL}" class="btn btn-success"><span>{PHP.L.Publish}</span></a> 
				<a href="{PRD_EDIT_URL}" class="btn btn-info"><span>{PHP.L.Edit}</span></a>
			</p>	
		</div>	
	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-body text-center">
				<div >
					{PRD_OWNER_AVATAR|cot_rc_modify($this,'style="display:inline;"')}
					<div class="owner">{PRD_OWNER_NAME}</div>
					<div class="pull-right"><span class="label label-info">{PRD_OWNER_USERPOINTS}</span></div>
				</div>					
				<!-- IF {PRD_USER_IS_ADMIN} -->
				<hr>
				<div class="well well-small">
					{PRD_ADMIN_EDIT} &nbsp; 
					<!-- IF {PRD_STATE} != 2 -->
						<a href="{PRD_HIDEPRODUCT_URL}">{PRD_HIDEPRODUCT_TITLE}</a>
					<!-- ENDIF -->
				</div>
				<!-- ENDIF -->	

			</div>
		</div>	
	</div>	
</div>

<!-- END: MAIN -->