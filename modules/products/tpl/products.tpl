<!-- BEGIN: MAIN -->

	<div class="breadcrumb">{PRD_CATPATH}</div>
	<div class="row">
		<div class="span9">
			<!-- IF {PRD_COST} --><div class="pull-right"><br/><span class="label label-success large">{PRD_COST|cot_products_costformat($this)} {PHP.L.valuta}</span></div><!-- ENDIF -->
			<h1>{PRD_SHORTTITLE}</h1>
			<p class="small"><i class="icon-time"></i> {PRD_DATE} <!-- IF {PRD_STATUS} == 'expired' --><i class="label">{PRD_LOCALSTATUS}</i><!-- ENDIF --></p>
			<!-- IF {PRD_DESC} --><p class="small">{PRD_DESC}</p><!-- ENDIF -->
			
			<!-- IF {PRD_MAVATAR} -->
			<div class="pull-left marginright10">
				<!-- IF {PRD_MAVATAR.1} -->
				<a href="{PRD_MAVATAR.1.FILE}"><div class="thumbnail"><img src="{PRD_MAVATAR.1|cot_mav_thumb($this, 200, 200, width)}" /></div></a>
				<!-- ENDIF -->

				<!-- IF {PRD_MAVATARCOUNT} -->
				<p>&nbsp;</p>
				<div class="row">
					<!-- FOR {KEY}, {VALUE} IN {PRD_MAVATAR} -->
					<!-- IF {KEY} != 1 -->
					<a href="{VALUE.FILE}" class="span1 pull-left"><img src="{VALUE|cot_mav_thumb($this, 100, 100)}" /></a>
					<!-- ENDIF -->
					<!-- ENDFOR -->
				</div>
				<!-- ENDIF -->
			</div>	
			<!-- ENDIF -->

			{PRD_TEXT}
			
			<!-- IF {PRD_COST} > 0 AND {PRD_STATE} == 0 -->
			<p>&nbsp;</p>
			<p>
				<!-- IF {PHP.cot_plugins_active.tiuorders} AND {PHP|cot_auth('plug', 'tiuorders', 'R')} -->
					<!-- IF {PRD_ORDER_ID} -->
						<a href="{PRD_ORDER_ID|cot_url('tiuorders', 'id='$this)}">{PHP.L.tiuorders_title}</a>
						<!-- IF {PRD_ORDER_DOWNLOAD} -->
						<p><a class="btn btn-success" href="{PRD_ORDER_DOWNLOAD}">{PHP.L.tiuorders_file_download}</a></p>
						<!-- ELSE -->
						<p><span class="label label-info">{PRD_ORDER_LOCALSTATUS}</span></p>
						<!-- ENDIF -->  
					 <!-- ELSE -->
						 <p><a class="btn btn-large btn-success" href="{PRD_ID|cot_url('tiuorders', 'm=neworder&pid='$this)}">{PHP.L.tiuorders_neworder_button}</a></p>
					 <!-- ENDIF -->
				<!-- ENDIF -->
			</p>
			<!-- ENDIF -->
			
			{PRD_COMMENTS_DISPLAY}

		</div>
		<div class="span3">
			
			<div class="well well-small">
				<h4>{PHP.L.prd_seller}</h4>
				<div class="media">
					<div class="pull-left">{PRD_OWNER_AVATAR}</div>
					<div class="media-body">
						<h4 class="media-heading">{PRD_OWNER_NAME}</h4>
					</div>	
				</div>	
			</div>
				
<!-- BEGIN: PRD_ADMIN -->
			<div class="well well-small">
				<h4>{PHP.L.Adminpanel}</h4>
				<ul class="nav">
					<!-- IF {PHP.usr.isadmin} -->
					<li><a href="{PHP|cot_url('admin')}">{PHP.L.Adminpanel}</a></li>
					<!-- ENDIF -->
					<li><a href="{PRD_CAT|cot_url('products','m=add&c=$this')}">{PHP.L.prd_addtitle}</a></li>
					<li>{PRD_ADMIN_UNVALIDATE}</li>
					<li>{PRD_ADMIN_EDIT}</li>
					<li>{PRD_ADMIN_CLONE}</li>
					<li>{PRD_ADMIN_DELETE}</li>
				</ul>
			</div>
<!-- END: PRD_ADMIN -->
		</div>
	</div>

<!-- END: MAIN -->