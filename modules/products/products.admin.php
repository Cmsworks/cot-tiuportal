<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=admin
[END_COT_EXT]
==================== */

/**
 * Products manager & Queue of products
 *
 * @package Cotonti
 * @version 0.7.0
 * @author CMSWorks Team
 * @copyright Copyright (c) CMSWorks Team 2010-2013
 * @license BSD
 */

(defined('COT_CODE') && defined('COT_ADMIN')) or die('Wrong URL.');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = cot_auth('products', 'any');
cot_block($usr['isadmin']);

$t = new XTemplate(cot_tplfile('products.admin', 'module', true));

require_once cot_incfile('products', 'module');

$adminpath[] = array(cot_url('admin', 'm=extensions'), $L['Extensions']);
$adminpath[] = array(cot_url('admin', 'm=extensions&a=details&mod='.$m), $cot_modules[$m]['title']);
$adminpath[] = array(cot_url('admin', 'm='.$m), $L['Administration']);
$adminhelp = $L['adm_help_products'];
$adminsubtitle = $L['Products'];

$id = cot_import('id', 'G', 'INT');

list($pg, $d, $durl) = cot_import_pagenav('d', $cfg['maxrowsperpage']);

$sorttype = cot_import('sorttype', 'R', 'ALP');
$sorttype = empty($sorttype) ? 'id' : $sorttype;
$sort_type = array(
	'id' => $L['Id'],
	'type' => $L['Type'],
	'key' => $L['Key'],
	'title' => $L['Title'],
	'desc' => $L['Description'],
	'text' => $L['Body'],
	'ownerid' => $L['Owner'],
	'date' => $L['Date'],
	'expire' => $L['Expire'],
	'rating' => $L['Rating'],
	'count' => $L['Hits']
);
$sqlsorttype = 'prd_'.$sorttype;

$sortway = cot_import('sortway', 'R', 'ALP');
$sortway = empty($sortway) ? 'desc' : $sortway;
$sort_way = array(
	'asc' => $L['Ascending'],
	'desc' => $L['Descending']
);
$sqlsortway = $sortway;

$filter = cot_import('filter', 'R', 'ALP');
$filter = empty($filter) ? 'valqueue' : $filter;
$filter_type = array(
	'all' => $L['All'],
	'valqueue' => $L['adm_valqueue'],
	'validated' => $L['adm_validated'],
	'expired' => $L['adm_expired'],
);
if ($filter == 'all')
{
	$sqlwhere = "1 ";
}
elseif ($filter == 'valqueue')
{
	$sqlwhere = "prd_state=1";
}
elseif ($filter == 'validated')
{
	$sqlwhere = "prd_state=0";
}
elseif ($filter == 'expired')
{
	$sqlwhere = "prd_expire <> 0 AND prd_expire < {$sys['now']}";
}

$catsub = cot_structure_children('products', '');
if (count($catsub) < count($structure['products']))
{
	$sqlwhere .= " AND prd_cat IN ('" . join("','", $catsub) . "')";
}

/* === Hook  === */
foreach (cot_getextplugins('products.admin.first') as $pl)
{
	include $pl;
}
/* ===== */

if ($a == 'validate')
{
	cot_check_xg();

	/* === Hook  === */
	foreach (cot_getextplugins('products.admin.validate') as $pl)
	{
		include $pl;
	}
	/* ===== */

	$sql_products = $db->query("SELECT prd_cat FROM $db_products WHERE prd_id = $id AND prd_state != 0");
	if ($row = $sql_products->fetch())
	{
		$usr['isadmin_local'] = cot_auth('products', $row['prd_cat'], 'A');
		cot_block($usr['isadmin_local']);
		$sql_products = $db->update($db_products, array('prd_state' => 0), "prd_id = $id");
		$sql_products = $db->query("UPDATE $db_structure SET structure_count=structure_count+1 WHERE structure_code=".$db->quote($row['prd_cat']));

		cot_log($L['Products'].' #'.$id.' - '.$L['adm_queue_validated'], 'adm');

		if ($cache)
		{
			if ($cfg['cache_products'])
			{
				$cache->products->clear('products/' . str_replace('.', '/', $structure['products'][$row['prd_cat']]['path']));
			}
			if ($cfg['cache_index'])
			{
				$cache->products->clear('index');
			}
		}

		cot_message('#'.$id.' - '.$L['adm_queue_validated']);
	}
	else
	{
		cot_die();
	}
}
elseif ($a == 'unvalidate')
{
	cot_check_xg();

	/* === Hook  === */
	foreach (cot_getextplugins('products.admin.unvalidate') as $pl)
	{
		include $pl;
	}
	/* ===== */

	$sql_products = $db->query("SELECT prd_cat FROM $db_products WHERE prd_id=$id");
	if ($row = $sql_products->fetch())
	{
		$usr['isadmin_local'] = cot_auth('products', $row['prd_cat'], 'A');
		cot_block($usr['isadmin_local']);

		$sql_products = $db->update($db_products, array('prd_state' => 1), "prd_id=$id");
		$sql_products = $db->query("UPDATE $db_structure SET structure_count=structure_count-1 WHERE structure_code=".$db->quote($row['prd_cat']));

		cot_log($L['Products'].' #'.$id.' - '.$L['adm_queue_unvalidated'], 'adm');

		if ($cache)
		{
			if ($cfg['cache_products'])
			{
				$cache->products->clear('products/' . str_replace('.', '/', $structure['products'][$row['prd_cat']]['path']));
			}
			if ($cfg['cache_index'])
			{
				$cache->products->clear('index');
			}
		}

		cot_message('#'.$id.' - '.$L['adm_queue_unvalidated']);
	}
	else
	{
		cot_die();
	}
}
elseif ($a == 'delete')
{
	cot_check_xg();

	/* === Hook  === */
	foreach (cot_getextplugins('products.admin.delete') as $pl)
	{
		include $pl;
	}
	/* ===== */

	$sql_products = $db->query("SELECT * FROM $db_products WHERE prd_id=$id LIMIT 1");
	if ($row = $sql_products->fetch())
	{
		if ($row['prd_state'] == 0)
		{
			$sql_products = $db->query("UPDATE $db_structure SET structure_count=structure_count-1 WHERE structure_code=".$db->quote($row['prd_cat']));
		}

		foreach($cot_extrafields[$db_products] as $exfld)
		{
			cot_extrafield_unlinkfiles($row['prd_'.$exfld['field_name']], $exfld);
		}

		$sql_products = $db->delete($db_products, "prd_id=$id");

		cot_log($L['Products'].' #'.$id.' - '.$L['Deleted'], 'adm');

		/* === Hook === */
		foreach (cot_getextplugins('products.admin.delete.done') as $pl)
		{
			include $pl;
		}
		/* ===== */

		if ($cache)
		{
			if ($cfg['cache_products'])
			{
				$cache->products->clear('products/' . str_replace('.', '/', $structure['products'][$row['prd_cat']]['path']));
			}
			if ($cfg['cache_index'])
			{
				$cache->products->clear('index');
			}
		}

		cot_message('#'.$id.' - '.$L['adm_queue_deleted']);
	}
	else
	{
		cot_die();
	}
}
elseif ($a == 'update_checked')
{
	$paction = cot_import('paction', 'P', 'TXT');

	if ($paction == $L['Validate'] && is_array($_POST['s']))
	{
		cot_check_xp();
		$s = cot_import('s', 'P', 'ARR');

		$perelik = '';
		$notfoundet = '';
		foreach ($s as $i => $k)
		{
			if ($s[$i] == '1' || $s[$i] == 'on')
			{
				/* === Hook  === */
				foreach (cot_getextplugins('products.admin.checked_validate') as $pl)
				{
					include $pl;
				}
				/* ===== */

				$sql_products = $db->query("SELECT * FROM $db_products WHERE prd_id=".(int)$i);
				if ($row = $sql_products->fetch())
				{
					$id = $row['prd_id'];
					$usr['isadmin_local'] = cot_auth('products', $row['prd_cat'], 'A');
					cot_block($usr['isadmin_local']);

					$sql_products = $db->update($db_products, array('prd_state' => 0), "prd_id=$id");
					$sql_products = $db->query("UPDATE $db_structure SET structure_count=structure_count+1 WHERE structure_code=".$db->quote($row['prd_cat']));

					cot_log($L['Products'].' #'.$id.' - '.$L['adm_queue_validated'], 'adm');

					if ($cache && $cfg['cache_products'])
					{
						$cache->products->clear('products/' . str_replace('.', '/', $structure['products'][$row['prd_cat']]['path']));
					}

					$perelik .= '#'.$id.', ';
				}
				else
				{
					$notfoundet .= '#'.$id.' - '.$L['Error'].'<br  />';
				}
			}
		}

		if ($cache && $cfg['cache_index'])
		{
			$cache->products->clear('index');
		}

		if (!empty($perelik))
		{
			cot_message($notfoundet.$perelik.' - '.$L['adm_queue_validated']);
		}
	}
	elseif ($paction == $L['Delete'] && is_array($_POST['s']))
	{
		cot_check_xp();
		$s = cot_import('s', 'P', 'ARR');

		$perelik = '';
		$notfoundet = '';
		foreach ($s as $i => $k)
		{
			if ($s[$i] == '1' || $s[$i] == 'on')
			{
				/* === Hook  === */
				foreach (cot_getextplugins('products.admin.checked_delete') as $pl)
				{
					include $pl;
				}
				/* ===== */

				$sql_products = $db->query("SELECT * FROM $db_products WHERE prd_id=".(int)$i." LIMIT 1");
				if ($row = $sql_products->fetch())
				{
					$id = $row['prd_id'];
					if ($row['prd_state'] == 0)
					{
						$sql_products = $db->query("UPDATE $db_structure SET structure_count=structure_count-1 WHERE structure_code=".$db->quote($row['prd_cat']));
					}

					$sql_products = $db->delete($db_products, "prd_id=$id");

					cot_log($L['Products'].' #'.$id.' - '.$L['Deleted'],'adm');

					if ($cache && $cfg['cache_products'])
					{
						$cache->products->clear('products/' . str_replace('.', '/', $structure['products'][$row['prd_cat']]['path']));
					}

					/* === Hook === */
					foreach (cot_getextplugins('products.admin.delete.done') as $pl)
					{
						include $pl;
					}
					/* ===== */
					$perelik .= '#'.$id.', ';
				}
				else
				{
					$notfoundet .= '#'.$id.' - '.$L['Error'].'<br  />';
				}
			}
		}

		if ($cache && $cfg['cache_index'])
		{
			$cache->products->clear('index');
		}

		if (!empty($perelik))
		{
			cot_message($notfoundet.$perelik.' - '.$L['adm_queue_deleted']);
		}
	}
}

$totalitems = $db->query("SELECT COUNT(*) FROM $db_products WHERE ".$sqlwhere)->fetchColumn();
$pagenav = cot_pagenav('admin', 'm=products&sorttype='.$sorttype.'&sortway='.$sortway.'&filter='.$filter, $d, $totalitems, $cfg['maxrowsperpage'], 'd', '', $cfg['jquery'] && $cfg['turnajax']);

$sql_products = $db->query("SELECT p.*, u.user_name
	FROM $db_products as p
	LEFT JOIN $db_users AS u ON u.user_id=p.prd_ownerid
	WHERE $sqlwhere
		ORDER BY $sqlsorttype $sqlsortway
		LIMIT $d, ".$cfg['maxrowsperpage']);

$ii = 0;
/* === Hook - Part1 : Set === */
$extp = cot_getextplugins('products.admin.loop');
/* ===== */
foreach ($sql_products->fetchAll() as $row)
{
	$sql_prd_subcount = $db->query("SELECT SUM(structure_count) FROM $db_structure WHERE structure_path LIKE '".$db->prep($structure['products'][$row["prd_cat"]]['rpath'])."%' ");
	$sub_count = $sql_prd_subcount->fetchColumn();
	$row['prd_file'] = intval($row['prd_file']);
	$t->assign(cot_generate_prdtags($row, 'ADMIN_PRD_', 200));
	$t->assign(array(
		'ADMIN_PRD_ID_URL' => cot_url('products', 'c='.$row['prd_cat'].'&id='.$row['prd_id']),
		'ADMIN_PRD_OWNER' => cot_build_user($row['prd_ownerid'], htmlspecialchars($row['user_name'])),
		'ADMIN_PRD_FILE_BOOL' => $row['prd_file'],
		'ADMIN_PRD_URL_FOR_VALIDATED' => cot_confirm_url(cot_url('admin', 'm=products&a=validate&id='.$row['prd_id'].'&d='.$durl.'&'.cot_xg()), 'products', 'prd_confirm_validate'),
		'ADMIN_PRD_URL_FOR_UNVALIDATE' => cot_confirm_url(cot_url('admin', 'm=products&a=unvalidate&id='.$row['prd_id'].'&d='.$durl.'&'.cot_xg()), 'products', 'prd_confirm_unvalidate'),
		'ADMIN_PRD_URL_FOR_DELETED' => cot_confirm_url(cot_url('admin', 'm=products&a=delete&id='.$row['prd_id'].'&d='.$durl.'&'.cot_xg()), 'products', 'prd_confirm_delete'),
		'ADMIN_PRD_URL_FOR_EDIT' => cot_url('products', 'm=edit&id='.$row['prd_id']),
		'ADMIN_PRD_ODDEVEN' => cot_build_oddeven($ii),
		'ADMIN_PRD_CAT_COUNT' => $sub_count
	));
	$t->assign(cot_generate_usertags($row['prd_ownerid'], 'ADMIN_PRD_OWNER_'), htmlspecialchars($row['user_name']));

	/* === Hook - Part2 : Include === */
	foreach ($extp as $pl)
	{
		include $pl;
	}
	/* ===== */

	$t->parse('MAIN.PRD_ROW');
	$ii++;
}

$is_row_empty = ($sql_products->rowCount() == 0) ? true : false ;

$totaldbproducts = $db->countRows($db_products);
$sql_prd_queued = $db->query("SELECT COUNT(*) FROM $db_products WHERE prd_state=1");
$sys['productsqueued'] = $sql_prd_queued->fetchColumn();

$t->assign(array(
	'ADMIN_PRD_URL_CONFIG' => cot_url('admin', 'm=config&n=edit&o=module&p=products'),
	'ADMIN_PRD_URL_ADD' => cot_url('products', 'm=add'),
	'ADMIN_PRD_URL_EXTRAFIELDS' => cot_url('admin', 'm=extrafields&n='.$db_products),
	'ADMIN_PRD_URL_STRUCTURE' => cot_url('admin', 'm=structure&n=products'),
	'ADMIN_PRD_FORM_URL' => cot_url('admin', 'm=products&a=update_checked&sorttype='.$sorttype.'&sortway='.$sortway.'&filter='.$filter.'&d='.$durl),
	'ADMIN_PRD_ORDER' => cot_selectbox($sorttype, 'sorttype', array_keys($sort_type), array_values($sort_type), false),
	'ADMIN_PRD_WAY' => cot_selectbox($sortway, 'sortway', array_keys($sort_way), array_values($sort_way), false),
	'ADMIN_PRD_FILTER' => cot_selectbox($filter, 'filter', array_keys($filter_type), array_values($filter_type), false),
	'ADMIN_PRD_TOTALDBFIRMS' => $totaldbproducts,
	'ADMIN_PRD_PAGINATION_PREV' => $pagenav['prev'],
	'ADMIN_PRD_PAGNAV' => $pagenav['main'],
	'ADMIN_PRD_PAGINATION_NEXT' => $pagenav['next'],
	'ADMIN_PRD_TOTALITEMS' => $totalitems,
	'ADMIN_PRD_ON_FIRM' => $ii
));

cot_display_messages($t);

/* === Hook  === */
foreach (cot_getextplugins('products.admin.tags') as $pl)
{
	include $pl;
}
/* ===== */

$t->parse('MAIN');
$adminmain = $t->text('MAIN');
