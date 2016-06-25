<!-- BEGIN: MAIN -->
	<h4><!-- IF {PHP.usr.id} == {PHP.urr.user_id} AND {ADDPRD_SHOWBUTTON} --><div class="pull-right"><a href="{PRD_ADDPRD_URL}" class="btn btn-success">{PHP.L.market_add_product}</a></div><!-- ENDIF -->{PHP.L.market}</h4>
	
	<ul class="nav nav-pills">
	  <li>
	 	  <a href="{PHP.urr.user_id|cot_url('users', 'm=details&id=$this&tab=market')}">{PHP.L.All}</a>
	  </li>
	  	<!-- BEGIN: CAT_ROW -->
	  		<li class="centerall <!-- IF {PRD_CAT_ROW_SELECT} -->active<!-- ENDIF -->">
	  				<a href="{PRD_CAT_ROW_URL}">
	  						<!-- IF {PRD_ROW_CAT_ICON} -->
	  							<img src="{PRD_CAT_ROW_ICON}" alt="{PRD_CAT_ROW_TITLE} ">
	  						<!-- ENDIF -->
	  						{PRD_CAT_ROW_TITLE} 
	  					<span class="badge badge-inverse">{PRD_CAT_ROW_COUNT_MARKET}</span>
	  				</a>
	  		</li>
	  	<!-- END: CAT_ROW -->
	</ul>
	<hr>
	<div class="row">
	<!-- BEGIN: PRD_ROWS -->
		<div class="col-md-4 pull-left">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h5><a href="{PRD_ROW_URL}">{PRD_ROW_SHORTTITLE}</a></h5>
				</div>
				<div class="panel-body text-center">
					
					<!-- IF {PRD_ROW_ID|cot_files_count('market',$this,'mainlogo','images')} > 0 -->
					<div class="text-center">
						<a href="{PRD_ROW_URL}"><img src="{PRD_ROW_ID|cot_files_get('market',$this,'mainlogo')|cot_files_thumb($this,200,200,'crop')}" /></a>
					</div>
					<!-- ENDIF -->
					<hr>		
					<p class="type"><a href="{PRD_ROW_CATURL}">{PRD_ROW_CATTITLE}</a></p>
					<p class="owner"><span class="date">{PRD_ROW_DATE_STAMP|cot_date("d M Y",$this)}</span>&nbsp; {PRD_ROW_EDIT_URL}</p>
					<!-- IF {PRD_ROW_USER_IS_ADMIN} --><p><span class="label label-info">{PRD_ROW_LOCALSTATUS}</span></p><!-- ENDIF -->
				</div>
				<div class="panel-footer text-center">
					<!-- IF {PRD_ROW_COST} > 0 -->
						<h4>
							<div class="cost">{PRD_ROW_COST} {PHP.cfg.payments.valuta}</div>
						</h4>
					<!-- ENDIF -->
					<!-- IF {PRD_ROW_USER_IS_ADMIN} --><a href="{PRD_ROW_ADMIN_EDIT_URL}" class="btn btn-info">{PHP.L.Edit}</a><!-- ENDIF -->	
				</div>
			</div>
		</div>
	<!-- END: PRD_ROWS -->
	</div>
	
	<!-- IF {PAGENAV_COUNT} > 0 -->	
	<div class="pagination">{PAGENAV_PAGES}</div>
	<!-- ELSE -->
	<div class="alert">{PHP.L.market_empty}</div>
	<!-- ENDIF -->

<!-- END: MAIN -->