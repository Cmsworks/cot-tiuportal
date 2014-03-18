<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=sitemap.main
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

if ($cfg['products']['productssitemap'])
{
	
	// Sitemap for products module
	require_once cot_incfile('products', 'module');

	// Projects categories
	$auth_cache = array();

	$category_list = $structure['products'];

	/* === Hook === */
	foreach (cot_getextplugins('sitemap.products.categorylist') as $pl)
	{
		include $pl;
	}
	/* ===== */

	foreach ($category_list as $c => $cat)
	{
		$auth_cache[$c] = cot_auth('products', $c, 'R');
		if (!$auth_cache[$c]) continue;
		// Pagination support
		$maxrowsperpage = ($cfg['products']['cat_' . $c]['maxrowsperpage']) ? $cfg['products']['cat_' . $c]['maxrowsperpage'] : $cfg['products']['cat___default']['maxrowsperpage'];
		$subs = floor($cat['count'] / $maxrowsperpage) + 1;
		foreach (range(1, $subs) as $pg)
		{
			$d = $cfg['easypagenav'] ? $pg : ($pg - 1) * $maxrowsperpage;
			$urlp = $pg > 1 ? "c=$c&d=$d" : "c=$c";
			sitemap_parse($t, $items, array(
				'url'  => cot_url('products', $urlp),
				'date' => '',
				'freq' => $cfg['products']['productssitemap_freq'],
				'prio' => $cfg['products']['productssitemap_prio']
			));
		}
	}

	// Projects
	$sitemap_join_columns = '';
	$sitemap_join_tables = '';
	$sitemap_where = array();
	$sitemap_where['state'] = 'prd_state = 0';

	/* === Hook === */
	foreach (cot_getextplugins('sitemap.products.query') as $pl)
	{
		include $pl;
	}
	/* ===== */

	$sitemap_where = count($sitemap_where) > 0 ? 'WHERE ' . join(' AND ', $sitemap_where) : '';
	$res = $db->query("SELECT f.prd_id, f.prd_cat $sitemap_join_columns
		FROM $db_products AS f $sitemap_join_tables
		$sitemap_where
		ORDER BY f.prd_cat, f.prd_id");
	foreach ($res->fetchAll() as $row)
	{
		if (!$auth_cache[$row['prd_cat']]) continue;
		$urlp = array('c' => $row['prd_cat']);
		empty($row['prd_alias']) ? $urlp['id'] = $row['prd_id'] : $urlp['al'] = $row['prd_alias'];
		sitemap_parse($t, $items, array(
			'url'  => cot_url('products', $urlp),
			'date' => $row['prd_date'],
			'freq' => $cfg['products']['productssitemap_freq'],
			'prio' => $cfg['products']['productssitemap_prio']
		));
	}
}

?>