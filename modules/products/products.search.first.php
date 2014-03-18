<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=search.first
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

$rs['prdtitle'] = cot_import($rs['prdtitle'], 'D', 'INT');
$rs['prddesc'] = cot_import($rs['prddesc'], 'D', 'INT');
$rs['prdtext'] = cot_import($rs['prdtext'], 'D', 'INT');
$rs['prdfile'] = cot_import($rs['prdfile'], 'D', 'INT');
$rs['prdsort'] = cot_import($rs['prdsort'], 'D', 'ALP');
$rs['prdsort'] = (empty($rs['prdsort'])) ? 'date' : $rs['prdsort'];
$rs['prdsort2'] = (cot_import($rs['prdsort2'], 'D', 'ALP') == 'DESC') ? 'DESC' : 'ASC';
$rs['productssub'] = cot_import($rs['productssub'], 'D', 'ARR');
$rs['productssubcat'] = cot_import($rs['productssubcat'], 'D', 'BOL') ? 1 : 0;

if ($rs['prdtitle'] < 1 && $rs['prddesc'] < 1 && $rs['prdtext'] < 1)
{
	$rs['prdtitle'] = 1;
	$rs['prddesc'] = 1;
	$rs['prdtext'] = 1;
}

if (($tab == 'products' || empty($tab)) && cot_module_active('products'))
{
	require_once cot_incfile('products', 'module');

	// Making the category list
	$products_cat_list['all'] = $L['plu_allcategories'];
	foreach ($structure['products'] as $cat => $x)
	{
		if ($cat != 'all' && $cat != 'system' && cot_auth('products', $cat, 'R') && $x['group'] == 0)
		{
			$products_cat_list[$cat] = $x['tpath'];
			$prd_catauth[] = $db->prep($cat);
		}
	}
	if ($rs['productssub'][0] == 'all' || !is_array($rs['productssub']))
	{
		$rs['productssub'] = array();
		$rs['productssub'][] = 'all';
	}

	/* === Hook === */
	foreach (cot_getextplugins('search.products.catlist') as $pl)
	{
		include $pl;
	}
	/* ===== */

	$t->assign(array(
		'PLUGIN_PRODUCTS_SEC_LIST' => cot_selectbox($rs['productssub'], 'rs[productssub][]', array_keys($products_cat_list), array_values($products_cat_list), false, 'multiple="multiple" style="width:50%"'),
		'PLUGIN_PRODUCTS_RES_SORT' => cot_selectbox($rs['prdsort'], 'rs[prdsort]', array('date', 'title', 'count', 'cat'), array($L['plu_products_res_sort1'], $L['plu_products_res_sort2'], $L['plu_products_res_sort3'], $L['plu_products_res_sort4']), false),
		'PLUGIN_PRODUCTS_RES_SORT_WAY' => cot_radiobox($rs['prdsort2'], 'rs[prdsort2]', array('DESC', 'ASC'), array($L['plu_sort_desc'], $L['plu_sort_asc'])),
		'PLUGIN_PRODUCTS_SEARCH_NAMES' => cot_checkbox(($rs['prdtitle'] == 1 || count($rs['productssub']) == 0), 'rs[prdtitle]', $L['plu_products_search_names']),
		'PLUGIN_PRODUCTS_SEARCH_DESC' => cot_checkbox(($rs['prddesc'] == 1 || count($rs['productssub']) == 0), 'rs[prddesc]', $L['plu_products_search_desc']),
		'PLUGIN_PRODUCTS_SEARCH_TEXT' => cot_checkbox(($rs['prdtext'] == 1 || count($rs['productssub']) == 0), 'rs[prdtext]', $L['plu_products_search_text']),
		'PLUGIN_PRODUCTS_SEARCH_SUBCAT' => cot_checkbox($rs['productssubcat'], 'rs[productssubcat]', $L['plu_products_set_subsec']),
	));
	if ($tab == 'products' || (empty($tab) && $cfg['plugin']['search']['extrafilters']))
	{
		$t->parse('MAIN.PRODUCTS_OPTIONS');
	}
}

?>