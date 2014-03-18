<?php

/* ====================
  [BEGIN_COT_EXT]
  Hooks=admin.extrafields.first
  [END_COT_EXT]
  ==================== */

/**
 * Products module
 *
 * @package products
 * @version 0.7.0
 * @author CMSWorks Team
 * @copyright Copyright (c) CMSWorks Team 2010-2013
 * @license BSD
 */
defined('COT_CODE') or die('Wrong URL');

require_once cot_incfile('products', 'module');
$extra_whitelist[$db_products] = array(
	'name' => $db_products,
	'caption' => $L['Module'].' Products',
	'type' => 'module',
	'code' => 'products',
	'tags' => array(
		'products.list.tpl' => '{LIST_ROW_XXXXX}, {LIST_TOP_XXXXX}',
		'products.tpl' => '{PRD_XXXXX}, {PRD_XXXXX_TITLE}',
		'products.add.tpl' => '{PRDADD_FORM_XXXXX}, {PRDADD_FORM_XXXXX_TITLE}',
		'products.edit.tpl' => '{PRDEDIT_FORM_XXXXX}, {PRDEDIT_FORM_XXXXX_TITLE}',
		'news.tpl' => '{PRD_ROW_XXXXX}',
		'recentitems.products.tpl' => '{PRD_ROW_XXXXX}',
	)
);
