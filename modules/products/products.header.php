<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=header.main
[END_COT_EXT]
==================== */

/**
 * Header notices for new products
 *
 * @package Cotonti
 * @version 0.7.0
 * @author CMSWorks Team
 * @copyright Copyright (c) CMSWorks Team 2010-2013
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

require_once cot_incfile('products', 'module');

if ($usr['id'] > 0 && cot_auth('products', 'any', 'A'))
{
	$sql_prd_queued = $db->query("SELECT COUNT(*) FROM $db_products WHERE prd_state=1");
	$sys['productsqueued'] = $sql_prd_queued->fetchColumn();

	if ($sys['productsqueued'] > 0)
	{
		$out['notices_array'][] = array(cot_url('admin', 'm=products'), cot_declension($sys['productsqueued'], $Ls['unvalidated_products']));
	}
}
elseif ($usr['id'] > 0 && cot_auth('products', 'any', 'W'))
{
	$sys['productsqueued'] = (int) $db->query("SELECT COUNT(*) FROM $db_products WHERE prd_state=1 AND prd_ownerid = " . $usr['id'])->fetchColumn();

	if ($sys['productsqueued'] > 0)
	{
		$out['notices_array'][] = array(cot_url('products', 'c=unvalidated'), cot_declension($sys['productsqueued'], $Ls['unvalidated_products']));
	}
}

if ($usr['id'] > 0 && cot_auth('products', 'any', 'W'))
{
	$sys['productsindrafts'] = (int) $db->query("SELECT COUNT(*) FROM $db_products WHERE prd_state=2 AND prd_ownerid = " . $usr['id'])->fetchColumn();

	if ($sys['productsindrafts'] > 0)
	{
		$out['notices_array'][] = array(cot_url('products', 'c=saved_drafts'), cot_declension($sys['productsindrafts'], $Ls['prd_in_drafts']));
	}
}
