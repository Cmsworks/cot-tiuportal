<?php

/* ====================
  [BEGIN_COT_EXT]
 * Hooks=standalone
  [END_COT_EXT]
  ==================== */

defined('COT_CODE') && defined('COT_PLUG') or die('Wrong URL');

require_once cot_incfile('products', 'module');

$id = cot_import('id', 'G', 'INT');
$status = cot_import('status', 'G', 'ALP');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = cot_auth('plug', 'myproducts');
cot_block($usr['auth_read']);

if($cfg['plugin']['myproducts']['maxrowsperpage'] > 0)
{
	list($pn, $d, $d_url) = cot_import_pagenav('d', $cfg['plugin']['myproducts']['maxrowsperpage']);
}

/* === Hook === */
$extp = cot_getextplugins('myproducts.first');
foreach ($extp as $pl)
{
	include $pl;
}
/* ===== */

$out['subtitle'] = $L['myproducts_title'];
$out['head'] .= $R['code_noindex'];

$mskin = cot_tplfile(array('myproducts'), 'plug');

/* === Hook === */
foreach (cot_getextplugins('myproducts.main') as $pl)
{
	include $pl;
}
/* ===== */

$t = new XTemplate($mskin);

$where['userid'] = "prd_ownerid=" . $usr['id'];

switch($status)
{
	case 'unvalidated':
		$where['prd_state'] = "prd_state=1";
		break;
	
	case 'closed':
		$where['prd_state'] = "prd_state=2";
		break;
	
	default: // public
		$where['prd_state'] = "prd_state=0";
		break;
}

$order['date'] = 'prd_date DESC';

/* === Hook === */
foreach (cot_getextplugins('myproducts.query') as $pl)
{
	include $pl;
}
/* ===== */

$where = ($where) ? 'WHERE ' . implode(' AND ', $where) : '';
$order = ($order) ? 'ORDER BY ' . implode(', ', $order) : '';
$query_limit = ($cfg['plugin']['myproducts']['maxrowsperpage'] > 0) ? "LIMIT $d, ".$cfg['plugin']['myproducts']['maxrowsperpage'] : '';

$totalitems = $db->query("SELECT COUNT(*) FROM $db_products AS p
	" . $where . "")->fetchColumn();

$sql = $db->query("SELECT * FROM $db_products AS p
	" . $where . "
	" . $order . "
	" . $query_limit . "");

$pagenav = cot_pagenav('myproducts', 'status=' . $status, $d, $totalitems, $cfg['plugin']['myproducts']['maxrowsperpage']);
	
$t->assign(array(
	"LIST_TOP_TOTALPAGES" => $totalitems,
	"LIST_TOP_CURRENTPAGE" => $pagenav['current'],
	"LIST_TOP_PAGINATION" => $pagenav['main'],
	"LIST_TOP_PAGEPREV" => $pagenav['prev'],
	"LIST_TOP_PAGENEXT" => $pagenav['next'],
));

$catpatharray[] = array(cot_url('products'), $L['Products']);
$catpatharray[] = array('', $L['myproducts_title']);

$catpath = cot_breadcrumbs($catpatharray, $cfg['homebreadcrumb'], true);

$t->assign(array(
	"BREADCRUMBS" => $catpath,
));

/* === Hook === */
$extp = cot_getextplugins('myproducts.loop');
/* ===== */

while ($prd = $sql->fetch())
{
	$t->assign(cot_generate_prdtags($prd, 'LIST_ROW_'));

	/* === Hook - Part2 : Include === */
	foreach ($extp as $pl)
	{
		include $pl;
	}
	/* ===== */
	
	$t->parse("MAIN.LIST_ROW");
}

/* === Hook === */
foreach (cot_getextplugins('myproducts.tags') as $pl)
{
	include $pl;
}
/* ===== */