<!-- BEGIN: MAIN -->

		<div class="block">
			<h2 class="stats">{PLUGIN_TITLE}</h2>
			<div class="customform">
					<form id="search" name="search" action="{PLUGIN_SEARCH_ACTION}" method="get" class="form-inline">
						<input type="hidden" name="e" value="search" />
						<ul class="nav nav-tabs">
							<li<!-- IF !{PHP.tab} --> class="active"<!-- ENDIF -->><a href="{PHP|cot_url('plug','e=search')}">{PHP.L.plu_tabs_all}</a></li>
							<li<!-- IF {PHP.tab} == 'frm' --> class="active"<!-- ENDIF -->><a href="{PHP|cot_url('plug','e=search&amp;tab=frm')}">{PHP.L.Forums}</a></li>
							<li<!-- IF {PHP.tab} == 'pag' --> class="active"<!-- ENDIF -->><a href="{PHP|cot_url('plug','e=search&amp;tab=pag')}">{PHP.L.Pages}</a></li>
							<li<!-- IF {PHP.tab} == 'products' --> class="active"<!-- ENDIF -->><a href="{PHP|cot_url('plug','e=search&amp;tab=products')}">{PHP.L.Products}</a></li>
						</ul>

						<p class="margin10"><div class="input-append">{PHP.L.plu_search_req}: {PLUGIN_SEARCH_TEXT} <button type="submit" class="btn btn-success" >{PHP.L.plu_search_key}</button></div></p>
						<p class="margin10">{PHP.L.plu_other_date}: {PLUGIN_SEARCH_DATE_SELECT} {PLUGIN_SEARCH_DATE_FROM} - {PLUGIN_SEARCH_DATE_TO}</p>
						<p class="margin10">{PHP.L.plu_other_userfilter}: {PLUGIN_SEARCH_USER}</p>
<!-- BEGIN: PAGES_OPTIONS -->
						<h3>{PHP.L.Pages}</h3>
						<table class="main">
							<tr>
								<td class="width50">
									<p class="strong">{PHP.L.plu_pag_set_sec}:</p>
									<p>{PLUGIN_PAGE_SEC_LIST}</p>
									<p>{PLUGIN_PAGE_SEARCH_SUBCAT}</p>
									<p class="small">{PHP.L.plu_ctrl_list}</p>
								</td>
								<td class="width50">
									<p class="strong">{PHP.L.plu_other_opt}:</p>
									<p><label>{PLUGIN_PAGE_SEARCH_NAMES}</label></p>
									<p>{PLUGIN_PAGE_SEARCH_DESC}</p>
									<p>{PLUGIN_PAGE_SEARCH_TEXT}</p>
									<p>{PLUGIN_PAGE_SEARCH_FILE}</p>
									<p class="strong">{PHP.L.plu_res_sort}:</p>
									<p>{PLUGIN_PAGE_RES_SORT}</p>
									<p>{PLUGIN_PAGE_RES_SORT_WAY}</p>
								</td>
							</tr>
						</table>
<!-- END: PAGES_OPTIONS -->
<!-- BEGIN: FORUMS_OPTIONS -->
						<h3>{PHP.L.Forums}</h3>
						<table class="main">
							<tr>
								<td class="width50">
									<p class="strong">{PHP.L.plu_frm_set_sec}:</p>
									<p>{PLUGIN_FORUM_SEC_LIST}</p>
									<p>{PLUGIN_FORUM_SEARCH_SUBCAT}</p>
									<div class="small">{PHP.L.plu_ctrl_list}</div>
								</td>
								<td class="width50">
									<p class="strong">{PHP.L.plu_other_opt}:</p>
									<p>{PLUGIN_FORUM_SEARCH_NAMES}</p>
									<p>{PLUGIN_FORUM_SEARCH_POST}</p>
									<p>{PLUGIN_FORUM_SEARCH_ANSW}</p>
									<p class="strong">{PHP.L.plu_res_sort}:</p>
									<p>{PLUGIN_FORUM_RES_SORT}</p>
									<p>{PLUGIN_FORUM_RES_SORT_WAY}</p>

								</td>
							</tr>
						</table>
<!-- END: FORUMS_OPTIONS -->
<!-- BEGIN: PRODUCTS_OPTIONS -->
						<h3>{PHP.L.Products}</h3>
						<table class="main">
							<tr>
								<td class="width50">
									<p class="strong">{PHP.L.plu_products_set_sec}:</p>
									<p>{PLUGIN_PRODUCTS_SEC_LIST}</p>
									<p>{PLUGIN_PRODUCTS_SEARCH_SUBCAT}</p>
									<p class="small">{PHP.L.plu_ctrl_list}</p>
								</td>
								<td class="width50">
									<p class="strong">{PHP.L.plu_other_opt}:</p>
									<p><label>{PLUGIN_PRODUCTS_SEARCH_NAMES}</label></p>
									<p>{PLUGIN_PRODUCTS_SEARCH_DESC}</p>
									<p>{PLUGIN_PRODUCTS_SEARCH_TEXT}</p>
									<p>{PLUGIN_PRODUCTS_SEARCH_FILE}</p>
									<p class="strong">{PHP.L.plu_res_sort}:</p>
									<p>{PLUGIN_PRODUCTS_RES_SORT}</p>
									<p>{PLUGIN_PRODUCTS_RES_SORT_WAY}</p>
								</td>
							</tr>
						</table>
<!-- END: PRODUCTS_OPTIONS -->
					</form>
				</div>

				{FILE "{PHP.cfg.themes_dir}/{PHP.cfg.defaulttheme}/warnings.tpl"}

<!-- BEGIN: RESULTS -->
<!-- BEGIN: PAGES -->
				<h3>{PHP.L.Pages}</h3>
				<table class="cells">
					<tr>
						<td colspan="2" class="coltop">{PHP.L.plu_result}: {PHP.L.plu_tabs_pag}
						</td>
					</tr>
<!-- BEGIN: ITEM -->
					<tr>
						<td colspan="2" class="{PLUGIN_PR_ODDEVEN}">{PLUGIN_PR_TITLE}</td>
					</tr>
					<tr>
						<td colspan="2" class="{PLUGIN_PR_ODDEVEN}">{PLUGIN_PR_TEXT}</td>
					</tr>
					<tr>
						<td class="{PLUGIN_PR_ODDEVEN} width50"><p class="small">{PHP.L.plu_last_date}: {PLUGIN_PR_TIME}</p></td>
						<td class="{PLUGIN_PR_ODDEVEN} textright width50"><p class="small">{PHP.L.plu_section}: {PLUGIN_PR_CATEGORY}</p></td>
					</tr>
<!-- END: ITEM -->
				</table>
<!-- END: PAGES -->

<!-- BEGIN: FORUMS -->
				<h3>{PHP.L.Forums}</h3>
				<table class="cells">
					<tr>
						<td colspan="2" class="coltop">{PHP.L.plu_result}: {PHP.L.plu_tabs_frm}
						</td>
					</tr>
<!-- BEGIN: ITEM -->
					<tr>
						<td colspan="2" class="{PLUGIN_FR_ODDEVEN}">{PLUGIN_FR_TITLE}</td>
					</tr>
					<!-- IF {PLUGIN_FR_TEXT} --><tr>
						<td colspan="2" class="{PLUGIN_FR_ODDEVEN}">{PLUGIN_FR_TEXT}</td>
					</tr><!-- ENDIF -->
					<tr>
						<td class="{PLUGIN_FR_ODDEVEN} width50"><p class="small">{PHP.L.plu_last_date}: {PLUGIN_FR_TIME}</p></td>
						<td class="{PLUGIN_FR_ODDEVEN} textright width50"><p class="small">{PHP.L.plu_section}: {PLUGIN_FR_CATEGORY}</p></td>
					</tr>
<!-- END: ITEM -->
				</table>

<!-- END: FORUMS -->

<!-- BEGIN: PRODUCTS -->
				<h3>{PHP.L.Products}</h3>
				<table class="cells">
					<tr>
						<td colspan="2" class="coltop">{PHP.L.plu_result}: {PHP.L.Products}
						</td>
					</tr>
<!-- BEGIN: ITEM -->
					<tr>
						<td colspan="2" class="{PLUGIN_PRODUCTSRES_ODDEVEN}">{PLUGIN_PRODUCTSRES_TITLE}</td>
					</tr>
					<tr>
						<td colspan="2" class="{PLUGIN_PRODUCTSRES_ODDEVEN}">{PLUGIN_PRODUCTSRES_TEXT}</td>
					</tr>
					<tr>
						<td class="{PLUGIN_PRODUCTSRES_ODDEVEN} width50"><p class="small">{PHP.L.plu_last_date}: {PLUGIN_PRODUCTSRES_TIME}</p></td>
						<td class="{PLUGIN_PRODUCTSRES_ODDEVEN} textright width50"><p class="small">{PHP.L.plu_section}: {PLUGIN_PRODUCTSRES_CATEGORY}</p></td>
					</tr>
<!-- END: ITEM -->
				</table>
<!-- END: PRODUCTS -->

<!-- END: RESULTS -->
				<div class="pagination"><ul>{PLUGIN_PAGEPREV}{PLUGIN_PAGENAV}{PLUGIN_PAGENEXT}</ul></div>
		</div>

<!-- END: MAIN -->