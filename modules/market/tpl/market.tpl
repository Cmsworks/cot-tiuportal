<!-- BEGIN: MAIN -->
<div class="breadcrumb">{PRD_TITLE}</div>
<h1><!-- IF {PRD_COST} > 0 --><div class="pull-right cost">{PRD_COST} {PHP.cfg.payments.valuta}</div><!-- ENDIF -->{PRD_SHORTTITLE}</h1>
<!-- IF {PRD_STATE} == 2 -->
<div class="alert alert-warning">{PHP.L.market_forreview}</div>
<!-- ENDIF -->
<!-- IF {PRD_STATE} == 1 -->
<div class="alert alert-warning">{PHP.L.market_hidden}</div>
<!-- ENDIF -->
<div class="row">
	<div class="col-md-9">
		<div class="media">	
			<!-- IF {PRD_ID|cot_files_count('market',$this,'mainlogo','images')} > 0 -->
			<div class="prd_slider">
				{PRD_ID|cot_files_display('market', $this, 'mainlogo', 'market.files.bootstrap-carousel_gallery')}
			</div>
			<!-- ENDIF -->
			<p class="date">[{PRD_DATE}]</p>
			<p class="location">{PRD_COUNTRY} {PRD_REGION} {PRD_CITY}</p>
			<p class="text">{PRD_TEXT}</p>
			<!-- IF {PRD_ID|cot_files_count('market',$this,'othersfiles')} > 0 -->
				 {PRD_ID|cot_files_display('market',$this,'othersfiles')}
			<!-- ENDIF -->
			<!-- IF {PHP.cot_plugins_active.tags} AND {PHP.cot_plugins_active.tagslance} AND {PHP.cfg.plugin.tagslance.market} -->
			<p>{PHP.L.Tags}: 
				<!-- BEGIN: PRD_TAGS_ROW --><!-- IF {PHP.tag_i} > 0 -->, <!-- ENDIF --><a href="{PRD_TAGS_ROW_URL}" title="{PRD_TAGS_ROW_TAG}" rel="nofollow">{PRD_TAGS_ROW_TAG}</a><!-- END: PRD_TAGS_ROW -->
				<!-- BEGIN: PRD_NO_TAGS -->{PRD_NO_TAGS}<!-- END: PRD_NO_TAGS -->
			</p>
			<!-- ENDIF -->
			
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