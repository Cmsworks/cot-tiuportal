<?php defined('COT_CODE') or die('Wrong URL');
/* ====================
[BEGIN_COT_EXT]
Hooks=users.profile.tags,users.edit.tags
Order=11
[END_COT_EXT]
==================== */

$t->assign(array(
    $avatarTagPrefix.'AVATAR' => cot_files_avatarbox_ga($uid),
));