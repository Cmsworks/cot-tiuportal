<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=products.list.tags
Tags=products.list.tpl:{LIST_COMMENTS},{LIST_COMMENTS_DISPLAY}
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

require_once cot_incfile('comments', 'plug');

$t->assign(array(
	'LIST_COMMENTS' => cot_comments_link('products', 'c='.$c, 'products', $c),
	'LIST_COMMENTS_COUNT' => cot_comments_count('products', $c),
	'LIST_COMMENTS_DISPLAY' => cot_comments_display('products', $c, $c)
));