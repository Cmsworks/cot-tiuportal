<?php defined('COT_CODE') or die('Wrong URL');
/* ====================
[BEGIN_COT_EXT]
Hooks=header.user.tags
[END_COT_EXT]
==================== */

$t->assign(array(
	'HEADER_USER_MYMARKET_URL' => cot_url('users', 'm=details&id=' . $urr['user_id'] . '&u=' . $urr['user_name'] . '&tab=market')
));