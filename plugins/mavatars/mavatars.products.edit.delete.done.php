<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=products.edit.delete.done
 * [END_COT_EXT]
 */

defined('COT_CODE') or die('Wrong URL');

global $cfg;

require_once cot_incfile('mavatars', 'plug');	
$mavatar = new mavatar('products', $rprd['prd_cat'], $id);
$mavatar->delete_all_mavatars();
$mavatar->get_mavatars();
