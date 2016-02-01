<!-- BEGIN: MAIN -->

  <div class="row titles">
    <div class="col-md-12">
      <h4>{PHP.L.market_add_product_title}</h4>
    </div>
  </div>
  <div class="row main">

		<div class="col-md-12">
			  {FILE "{PHP.cfg.themes_dir}/{PHP.usr.theme}/warnings.tpl"}
			  <form action="{PRDADD_FORM_SEND}" method="post" name="prdform" id="prdform" enctype="multipart/form-data">
			    <div class="row">				    
				     <div class="col-md-6">
				        <div class="form-group">
				          <label>{PHP.L.Title}:</label>
				          {PRDADD_FORM_TITLE}
				        </div>
				    </div>	
				    <div class="col-md-6">
				      <div class="form-group">
				        <label>{PHP.L.Category}:</label>
				        {PRDADD_FORM_CAT}
				      </div>
				    </div>		     
			    </div>
			    <div class="form-group">
			      <div class="panel-group" id="accordion">
			        <div class="panel panel-default">
			          <div class="panel-heading">
			            <h4 class="panel-title">
			              <a data-toggle="collapse" data-parent="#accordion" href="#pa-options">
			                {PHP.L.Options} <span class="caret"></span>
			              </a>
			            </h4>
			          </div>
			          <div class="panel-collapse collapse" id="pa-options">
			            <div class="panel-body">
			              <div class="row">
			                <!-- BEGIN: TAGS -->
			                <div class="col-md-6">
			                  <div class="form-group">
			                    <label>{PRDADD_FORM_TAGS_TITLE}:<span class="text-muted">({PRDADD_FORM_TAGS_HINT})</span></label>
			                    {PRDADD_FORM_TAGS|cot_rc_modify($this,"class='form-control'")}
			                  </div>
			                </div>
			                <!-- END: TAGS -->
			                <div class="col-md-6 <!-- IF !{PHP.usr.isadmin} --> hidden<!-- ENDIF -->">
			                  <div class="form-group">
			                    <label>{PHP.L.Parser}:</label>
			                    {PRDADD_FORM_PARSER}
			                  </div>
			                </div>
			                <!-- IF {PHP.usr.isadmin} -->
			                <div class="col-md-6">
			                  <div class="form-group">
			                    <label>{PHP.L.Alias}:</label>
			                    {PRDADD_FORM_ALIAS}
			                  </div>
			                </div>
			                 <!-- ENDIF -->
			                <!-- IF {PRDADD_FORM_LOCATION} -->
			                <div class="col-md-6">
			                  <div class="form-group">
			                    <label>{PHP.L.market_location}:</label>
			                    {PRDADD_FORM_LOCATION}
			                  </div>
			                </div>
			                <!-- ENDIF -->
			              </div>
			            </div>
			          </div>
			        </div>			      
			      </div>
			    </div>
			    <div class="form-group">
			      {PRDADD_FORM_TEXT}
			      <!-- IF {PRDADD_FORM_PFS} --><small>{PRDADD_FORM_PFS}</small><!-- ENDIF -->
			      <!-- IF {PRDADD_FORM_SFS} --><small>{PRDADD_FORM_SFS}</small><!-- ENDIF -->
			    </div>
		        <div class="row">				    
		    	     <div class="col-md-6">
		    	        <div class="form-group">
		    	          <label>{PHP.L.market_price} ({PHP.cfg.payments.valuta}):</label>
		    	          {PRDADD_FORM_COST} 
		    	        </div>
		    	    </div>	
		    	     <!-- IF {PHP.cot_plugins_active.marketorders} -->			    	       				    
	    	    	     <div class="col-md-6">
	    	    	        <div class="form-group">
	    	    	          <label>{PHP.L.marketorders_file}:</label>
	    	    	          {PRDADD_FORM_FILE}
	    	    	        </div>
	    	    	    </div>		
		    	    <!-- ENDIF -->	     
		        </div>		    
			    <!-- IF {PHP|cot_module_active('files')} -->
		       		<div class="form-group">
		       		   <div class="panel-group" id="accordionimg">
		       		     <div class="panel panel-default">
		       		       <div class="panel-heading">
		       		         <h4 class="panel-title">
		       		           <a data-toggle="collapse" data-parent="#accordionimg" href="#pa-downloadimg">
		       		             {PHP.L.Image} <span class="caret"></span>
		       		           </a>
		       		         </h4>
		       		       </div>
		       		       <div class="panel-collapse collapse" id="pa-downloadimg">
		       		         <div class="panel-body">
		       		           <div class="row">
		       		             <div class="col-md-12">
		       		               <div class="form-group">
		       		                 <label>Картинка в списке (миниатюра статьи):</label>
		       		                  {PHP|cot_files_filebox('market', 0, 'mainlogo','image',2)}
		       		               </div>
		       		             </div>
		       		           </div>
		       		         </div>
		       		       </div>
		       		     </div>
		       		   </div>
		       		 </div>
			       
			        <div class="panel panel-default">
			          <div class="panel-heading">
			            <h4 class="panel-title">
			              <a data-toggle="collapse" data-parent="#accordion" href="#pa-download">
			                {PHP.L.Download} <span class="caret"></span>
			              </a>
			            </h4>
			          </div>
			          <div class="panel-collapse collapse" id="pa-download">
			            <div class="panel-body">
			              <div class="row">
			                <div class="col-md-12">
			                  <div class="form-group">
			                    <label>{PHP.L.page_file}</label>
			                   {PHP|cot_files_filebox('market', 0, 'othersfiles')}
			                  </div>
			                </div>
			              </div>
			            </div>
			          </div>
			        </div>
			        <!-- ENDIF -->
			    <div class="form-group">
			      <button class="btn btn-success" type="submit">{PHP.L.Submit}</button>
			    </div>
			  </form>
		</div>
</div>

<!-- END: MAIN -->