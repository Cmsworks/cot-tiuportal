<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=products.tags
Tags=products.tpl:{PRD_COMMENTS},{PRD_COMMENTS_DISPLAY},{PRD_COMMENTS_COUNT},{PRD_COMMENTS_RSS}
[END_COT_EXT]
==================== */

/**
 * Comments system for Tiuportal (Cotonti)
 *
 * @package commentsprdtiu
 * @version 1.0
 * @author CrazyFreeMan
 * @copyright Copyright (c) CrazyFreeMan 2015
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

require_once cot_incfile('comments', 'plug');

$t->assign(array(
	'PRD_COMMENTS' => cot_comments_link('products', $pageurl_params, 'products', $id , $prd['prd_cat'], $pag),
	'PRD_COMMENTS_DISPLAY' => cot_comments_display('products', $id , $prd['prd_cat']),
	'PRD_COMMENTS_COUNT' => cot_comments_count('products', $id , $pag),
	'PRD_COMMENTS_RSS' => cot_url('rss', 'm=comments&id=' . $id)
));