<!-- BEGIN: MAIN -->

		<div class="block">
			<h2 class="products">{PRDEDIT_FIRMTITLE} #{PRDEDIT_FORM_ID}</h2>
			{FILE "{PHP.cfg.themes_dir}/{PHP.cfg.defaulttheme}/warnings.tpl"}
			<div class="customform">
				<form action="{PRDEDIT_FORM_SEND}" enctype="multipart/form-data" method="post" name="productsform">
					<table class="table">
						<tr>
							<td class="width30">{PHP.L.Category}:</td>
							<td class="width70">{PRDEDIT_FORM_CAT}</td>
						</tr>
						<tr>
							<td>{PHP.L.prd_title}:</td>
							<td>{PRDEDIT_FORM_TITLE}</td>
						</tr>
						<tr>
							<td>{PHP.L.Date}:</td>
							<td>{PRDEDIT_FORM_DATE}</td>
						</tr>
						<tr>
							<td>{PHP.L.Status}:</td>
							<td>{PRDEDIT_FORM_LOCALSTATUS}</td>
						</tr>
	<!-- BEGIN: TAGS -->
						<tr>
							<td>{PRDEDIT_TOP_TAGS}:</td>
							<td>{PRDEDIT_FORM_TAGS} ({PRDEDIT_TOP_TAGS_HINT})</td>
						</tr>
	<!-- END: TAGS -->
	<!-- BEGIN: ADMIN -->
						<tr>
							<td>{PHP.L.Alias}:</td>
							<td>{PRDEDIT_FORM_ALIAS}</td>
						</tr>
						<tr>
							<td>{PHP.L.prd_desc}:</td>
							<td>{PRDEDIT_FORM_DESC}</td>
						</tr>
						<tr>
							<td>{PHP.L.prd_metakeywords}:</td>
							<td>{PRDEDIT_FORM_KEYWORDS}</td>
						</tr>
						<tr>
							<td>{PHP.L.prd_metatitle}:</td>
							<td>{PRDEDIT_FORM_METATITLE}</td>
						</tr>
						<tr>
							<td>{PHP.L.prd_metadesc}:</td>
							<td>{PRDEDIT_FORM_METADESC}</td>
						</tr>
						<tr>
							<td>{PHP.L.Owner}:</td>
							<td>{PRDEDIT_FORM_OWNERID}</td>
						</tr>
						<tr>
							<td>{PHP.L.Hits}:</td>
							<td>{PRDEDIT_FORM_PRDCOUNT}</td>
						</tr>
	<!-- END: ADMIN -->
						<tr>
							<td>{PHP.L.Parser}:</td>
							<td>{PRDEDIT_FORM_PARSER}</td>
						</tr>
						<tr>
							<td colspan="2">
								{PRDEDIT_FORM_TEXT}
								<!-- IF {PRDEDIT_FORM_PFS} -->{PRDEDIT_FORM_PFS}<!-- ENDIF -->
								<!-- IF {PRDEDIT_FORM_SFS} --><span class="spaced">{PHP.cfg.separator}</span>{PRDEDIT_FORM_SFS}<!-- ENDIF -->
							</td>
						</tr>	
						<tr>
							<td>{PHP.L.prd_cost}:</td>
							<td><div class="form-inline">{PRDEDIT_FORM_COST} {PHP.L.valuta}</div></td>
						</tr>			
						<!-- IF {PHP.cot_plugins_active.mavatars} -->
						<tr>
							<td>{PHP.L.Image}:</td>
							<td>{PRDEDIT_FORM_MAVATAR}</td>
						</tr>
						<!-- ENDIF -->
						<tr>
							<td>{PHP.L.prd_deleteproducts}:</td>
							<td>{PRDEDIT_FORM_DELETE}</td>
						</tr>
						<tr>
							<td colspan="2">
								<!-- IF {PHP.usr_can_publish} -->
								<button type="submit" class="btn btn-success" name="rprdtate" value="0">{PHP.L.Publish}</button>
								<button type="submit" class="btn btn-success" name="rprdtate" value="2" class="submit">{PHP.L.Saveasdraft}</button>
								<!-- ELSE -->
								<button type="submit" class="btn btn-success" name="rprdtate" value="1">{PHP.L.Publish}</button>
								<!-- ENDIF -->
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>

<!-- END: MAIN -->