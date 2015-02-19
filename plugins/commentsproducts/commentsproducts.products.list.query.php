<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=products.list.query
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

global $db_com;

require_once cot_incfile('comments', 'plug');

$join_columns .= ", (SELECT COUNT(*) FROM `$db_com` WHERE com_area = 'products' AND com_code = p.prd_id) AS com_count";