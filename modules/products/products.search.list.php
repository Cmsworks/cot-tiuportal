<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=search.list
 * [END_COT_EXT]
 */

/**
 * Products module
 *
 * @package products
 * @version 1.0.0
 * @author CMSWorks Team
 * @copyright Copyright (c) CMSWorks Team 2010-2013
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL.');

if (($tab == 'products' || empty($tab)) && cot_module_active('products') && !cot_error_found())
{
	$where_and = array();
	$where_or = array();
	
	if ($rs['productssub'][0] != 'all' && count($rs['productssub']) > 0)
	{
		if ($rs['productssubcat'])
		{
			$tempcat = array();
			foreach ($rs['productssub'] as $scat)
			{
				$tempcat = array_merge(cot_structure_children('products', $scat), $tempcat);
			}
			$tempcat = array_unique($tempcat);
			$where_and['cat'] = "prd_cat IN ('".implode("','", $tempcat)."')";
		}
		else
		{
			$tempcat = array();
			foreach ($rs['productssub'] as $scat)
			{
				$tempcat[] = $db->prep($scat);
			}
			$where_and['cat'] = "prd_cat IN ('".implode("','", $tempcat)."')";
		}
	}
	else
	{
		$where_and['cat'] = "prd_cat IN ('".implode("','", $prd_catauth)."')";
	}
	$where_and['state'] = "prd_state = 0";
	$where_and['date'] = ($rs['setlimit'] > 0) ? "prd_date >= ".$rs['setfrom']." AND prd_date <= ".$rs['setto'] : "";
	$where_and['users'] = (!empty($touser)) ? "prd_ownerid ".$touser_ids : "";

	$where_or['title'] = ($rs['prdtitle'] == 1) ? "prd_title LIKE '".$db->prep($sqlsearch)."'" : "";
	$where_or['desc'] = (($rs['prddesc'] == 1)) ? "prd_desc LIKE '".$db->prep($sqlsearch)."'" : "";
	$where_or['text'] = (($rs['prdtext'] == 1)) ? "prd_text LIKE '".$db->prep($sqlsearch)."'" : "";
	// String query for addition products fields.
	foreach (explode(',', trim($cfg['plugin']['search']['addfields'])) as $addfields_el)
	{
		$addfields_el = trim($addfields_el);
		$where_or[$addfields_el] .= ( (!empty($addfields_el))) ? $addfields_el." LIKE '".$sqlsearch."'" : "";
	}
	$where_or = array_diff($where_or, array(''));
	count($where_or) || $where_or['title'] = "prd_title LIKE '".$db->prep($sqlsearch)."'";
	$where_and['or'] = '('.implode(' OR ', $where_or).')';
	$where_and = array_diff($where_and, array(''));
	$where = implode(' AND ', $where_and);

	/* === Hook === */
	foreach (cot_getextplugins('search.products.query') as $pl)
	{
		include $pl;
	}
	/* ===== */

	if (!$db->fieldExists($db_products, 'prd_'.$rs['prdsort']))
	{
		$rs['prdsort'] = 'date';
	}

	$sql = $db->query("SELECT SQL_CALC_FOUND_ROWS p.* $search_join_columns
		FROM $db_products AS p $search_join_condition
		WHERE $where
		ORDER BY prd_".$rs['prdsort']." ".$rs['prdsort2']."
		LIMIT $d, ".$cfg_maxitems
			.$search_union_query);

	$items = $sql->rowCount();
	$totalitems[] = $db->query('SELECT FOUND_ROWS()')->fetchColumn();
	$jj = 0;
	/* === Hook - Part 1 === */
	$extp = cot_getextplugins('search.products.loop');
	/* ===== */
	foreach ($sql->fetchAll() as $row)
	{
		$url_cat = cot_url('products', 'c='.$row['prd_cat']);
		$url_prd = empty($row['prd_alias']) ? cot_url('products', 'c='.$row['prd_cat'].'&id='.$row['prd_id'].'&highlight='.$hl) : cot_url('prd', 'c='.$row['prd_cat'].'&al='.$row['prd_alias'].'&highlight='.$hl);
		$t->assign(cot_generate_prdtags($row, 'PLUGIN_PRODUCTSRES_'));
		$t->assign(array(
			'PLUGIN_PRODUCTSRES_CATEGORY' => cot_rc_link($url_cat, $structure['products'][$row['prd_cat']]['tpath']),
			'PLUGIN_PRODUCTSRES_CATEGORY_URL' => $url_cat,
			'PLUGIN_PRODUCTSRES_TITLE' => cot_rc_link($url_prd, htmlspecialchars($row['prd_title'])),
			'PLUGIN_PRODUCTSRES_TEXT' => cot_clear_mark($row['prd_text'], $words),
			'PLUGIN_PRODUCTSRES_TIME' => cot_date('datetime_medium', $row['prd_date']),
			'PLUGIN_PRODUCTSRES_TIMESTAMP' => $row['prd_date'],
			'PLUGIN_PRODUCTSRES_ODDEVEN' => cot_build_oddeven($jj),
			'PLUGIN_PRODUCTSRES_NUM' => $jj
		));
		/* === Hook - Part 2 === */
		foreach ($extp as $pl)
		{
			include $pl;
		}
		/* ===== */
		$t->parse('MAIN.RESULTS.PRODUCTS.ITEM');
		$jj++;
	}
	if ($jj > 0)
	{
		$t->parse('MAIN.RESULTS.PRODUCTS');
	}
	unset($where_and, $where_or, $where);
}

?>