<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=productstags.main
 * [END_COT_EXT]
 */

defined('COT_CODE') or die('Wrong URL');
global $cfg, $mavatar, $mav_rowset_list;

require_once cot_incfile('mavatars', 'plug');

$mavatar = new mavatar('products', $prd_data['prd_cat'], $prd_data['prd_id'], $mav_rowset_list);
$mavatars_tags = $mavatar->tags();
$temp_array['MAVATAR'] = $mavatars_tags;
$temp_array['MAVATARCOUNT'] = count($mavatars_tags);
