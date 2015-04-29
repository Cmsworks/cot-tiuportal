<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=products.add.add.done,products.edit.update.done
 * [END_COT_EXT]
 */

defined('COT_CODE') or die('Wrong URL');
global $cfg;

require_once cot_incfile('mavatars', 'plug');

if (!cot_error_found())
{
	$mavatar = new mavatar('products', $rprd['prd_cat'], $id);
	$mavatar->update();
	$mavatar->upload();	
}