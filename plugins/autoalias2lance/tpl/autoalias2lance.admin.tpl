<!-- BEGIN: MAIN -->
<h2>{PHP.L.AutoAlias2lance}</h2>
{FILE "{PHP.cfg.themes_dir}/{PHP.usr.theme}/warnings.tpl"}

<div class="block">{PHP.L.create_aliases_aa2f}</div>
<div class="btn-group">
  <!-- IF {PHP|cot_module_active('projects')} --><a href="{AUTOALIAS_PROJECTS_CREATE}" class="btn btn-info">{PHP.L.create_aliases_prj}</a><!-- ENDIF -->
  <!-- IF {PHP|cot_module_active('market')} --><a href="{AUTOALIAS_MARKET_CREATE}" class="btn btn-warning">{PHP.L.create_aliases_mrk}</a><!-- ENDIF -->
  <!-- IF {PHP|cot_module_active('folio')} --><a href="{AUTOALIAS_FOLIO_CREATE}" class="btn btn-primary">{PHP.L.create_aliases_flo}</a><!-- ENDIF -->
</div>
<!-- END: MAIN -->