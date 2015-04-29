<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=products.add.tags,products.edit.tags
 * Tags=products.add.tpl:{PRDADD_FORM_MAVATAR};products.edit.tpl:{PRDEDIT_FORM_MAVATAR}
 * [END_COT_EXT]
 */

defined('COT_CODE') or die('Wrong URL');

global $cfg;

require_once cot_incfile('mavatars', 'plug');

if ((int) $id > 0)
{
	$code = $prd['prd_id'];
	$category = $prd['prd_cat'];
	$mavpr = 'EDIT';
}
else
{
	$code = '';
	$category = $rprd['prd_cat'];
	$mavpr = 'ADD';
}
$mavatar = new mavatar('products', $category, $code);

$t->assign('PRD'.$mavpr.'_FORM_MAVATAR', $mavatar->upload_form());