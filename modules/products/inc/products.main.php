<?php
/**
 * Products display.
 *
 * @package products
 * @version 1.0.0
 * @author CMSWorks Team
 * @copyright Copyright (c) CMSWorks Team 2010-2013
 * @license BSD License
 */

defined('COT_CODE') or die('Wrong URL');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = cot_auth('products', 'any');
cot_block($usr['auth_read']);

$id = cot_import('id', 'G', 'INT');
$al = $db->prep(cot_import('al', 'G', 'TXT'));
$c = cot_import('c', 'G', 'TXT');
$pg = cot_import('pg', 'G', 'INT');

/* === Hook === */
foreach (cot_getextplugins('products.first') as $pl)
{
	include $pl;
}
/* ===== */

if ($id > 0 || !empty($al))
{
	$where = (!empty($al)) ? "prd_alias='".$al."'" : 'prd_id='.$id;
	$sql_products = $db->query("SELECT p.*, u.* $join_columns
		FROM $db_products AS p $join_condition
		LEFT JOIN $db_users AS u ON u.user_id=p.prd_ownerid
		WHERE $where LIMIT 1");
}

if(!$id && empty($al) || !$sql_products || $sql_products->rowCount() == 0)
{
	cot_die_message(404, TRUE);
}
$prd = $sql_products->fetch();

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = cot_auth('products', $prd['prd_cat'], 'RWA');
cot_block($usr['auth_read']);

$al = empty($prd['prd_alias']) ? '' : $prd['prd_alias'];
$id = (int) $prd['prd_id'];
$cat = $structure['products'][$prd['prd_cat']];

$sys['sublocation'] = $prd['prd_title'];

$prd['prd_pageurl'] = empty($al) ? cot_url('products', array('c' => $prd['prd_cat'], 'id' => $id)) : cot_url('products', array('c' => $prd['prd_cat'], 'al' => $al));

if (($prd['prd_state'] == 1
		|| ($prd['prd_state'] == 2))
	&& (!$usr['isadmin'] && $usr['id'] != $prd['prd_ownerid']))
{
	cot_log("Attempt to directly access an un-validated prd", 'sec');
	cot_die_message(403, TRUE);
}
if (!$usr['isadmin'] || $cfg['products']['count_admin'])
{
	$prd['prd_count']++;
	$sql_prd_update =  $db->query("UPDATE $db_products SET prd_count='".$prd['prd_count']."' WHERE prd_id=$id");
}

$title_params = array(
	'TITLE' => empty($prd['prd_metatitle']) ? $prd['prd_title'] : $prd['prd_metatitle'],
	'CATEGORY' => $cat['title']
);
$out['subtitle'] = cot_title($cfg['products']['title_products'], $title_params);

$out['desc'] = empty($prd['prd_metadesc']) ? strip_tags($prd['prd_desc']) : strip_tags($prd['prd_metadesc']);
$out['keywords'] = strip_tags($prd['prd_keywords']);

// Building the canonical URL
$prdurl_params = array('c' => $prd['prd_cat']);
empty($al) ? $prdurl_params['id'] = $id : $prdurl_params['al'] = $al;
if ($pg > 0)
{
	$prdurl_params['pg'] = $pg;
}
$out['canonical_uri'] = cot_url('products', $prdurl_params);

$mskin = cot_tplfile(array('products', $cat['tpl']));

/* === Hook === */
foreach (cot_getextplugins('products.main') as $pl)
{
	include $pl;
}
/* ===== */

require_once $cfg['system_dir'] . '/header.php';
require_once cot_incfile('users', 'module');
$t = new XTemplate($mskin);

$t->assign(cot_generate_prdtags($prd, 'PRD_', 0, $usr['isadmin'], $cfg['homebreadcrumb']));
$t->assign('PRD_OWNER', cot_build_user($prd['prd_ownerid'], htmlspecialchars($prd['user_name'])));
$t->assign(cot_generate_usertags($prd, 'PRD_OWNER_'));

/* === Hook === */
foreach (cot_getextplugins('products.tags') as $pl)
{
	include $pl;
}
/* ===== */
if ($usr['isadmin'] || $usr['id'] == $prd['prd_ownerid'])
{
	$t->parse('MAIN.PRD_ADMIN');
}
$t->parse('MAIN');
$t->out('MAIN');

require_once $cfg['system_dir'] . '/footer.php';

if ($cache && $usr['id'] === 0 && $cfg['cache_products']
	&& (!isset($cfg['cache_prd_blacklist']) || !in_array($prd['prd_cat'], $cfg['cache_prd_blacklist'])))
{
	$cache->products->write();
}
