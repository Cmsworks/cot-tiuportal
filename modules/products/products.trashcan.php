<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=trashcan.api
[END_COT_EXT]
==================== */

/**
 * Trash can support for products
 *
 * @package products
 * @version 0.9.0
 * @author CMSWorks Team
 * @copyright Copyright (c) CMSWorks Team 2010-2013
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

require_once cot_incfile('products', 'module');

// Register restoration table
$trash_types['products'] = $db_products;

/**
 * Sync products action
 *
 * @param array $data trashcan item data
 * @return bool
 * @global Cache $cache
 */
function cot_trash_prd_sync($data)
{
	global $cache, $cfg, $db_structure;

	cot_products_sync($data['prd_cat']);
	($cache && $cfg['cache_products']) && $cache->products->clear('products');
	return true;
}
