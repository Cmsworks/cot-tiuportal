<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=products.list.loop
Tags=products.list.tpl:{LIST_ROW_COMMENTS}
[END_COT_EXT]
==================== */

/**
 * Comments system for Products module
 *
 * @package commentsproducts
 * @version 1.0
 * @author CrazyFreeMan
 * @copyright Copyright (c) CrazyFreeMan 2015
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

$page_urlp = empty($prd['prd_alias']) ? array('c' => $prd['prd_cat'], 'id' => $prd['prd_id']) : array('c' => $prd['prd_cat'], 'al' => $prd['prd_alias']);
$t->assign(array(
	'LIST_ROW_COMMENTS' => cot_comments_link('products', $page_urlp, 'products', $prd['prd_id'], $c, $pag),
	'LIST_ROW_COMMENTS_COUNT' => cot_comments_count('products', $prd['prd_id'], $pag)
));