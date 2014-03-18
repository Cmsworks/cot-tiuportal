<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=rss.create
 * [END_COT_EXT]
 */

/**
 * Products module
 *
 * @package products
 * @version 1.0.0
 * @author CMSWorks Team
 * @copyright Copyright (c) CMSWorks Team 2013
 * @license BSD
 */
defined('COT_CODE') or die('Wrong URL');

if ($m == "products")
{
	require_once cot_incfile('products', 'module');
	
	$default_mode = false;
	
	if($c == $m) unset($c);
	
	if (!empty($c) && isset($structure['products'][$c]))
	{
		$mtch = $structure['products'][$c]['path'].".";
		$mtchlen = mb_strlen($mtch);
		$catsub = array();
		$catsub[] = $c;

		foreach ($structure['products'] as $i => $x)
		{
			if (mb_substr($x['path'], 0, $mtchlen) == $mtch)
			{
				$catsub[] = $i;
			}
		}

		$sql = $db->query("SELECT f.*, u.* FROM $db_products AS f
				LEFT JOIN $db_users AS u ON f.prd_ownerid = u.user_id
			WHERE prd_state=0 AND prd_cat IN ('".implode("','", $catsub)."') 
			ORDER BY prd_date DESC LIMIT ".$cfg['rss']['rss_maxitems']);
	}
	else
	{
		$sql = $db->query("SELECT f.*, u.* FROM $db_products AS f
				LEFT JOIN $db_users AS u ON f.prd_ownerid = u.user_id
			WHERE prd_state=0
			ORDER BY prd_date DESC LIMIT ".$cfg['rss']['rss_maxitems']);
	}
	$i = 0;
	while ($row = $sql->fetch())
	{
		$row['prd_pageurl'] = (empty($row['prd_alias'])) ? cot_url('products', 'c='.$row['prd_cat'].'&id='.$row['prd_id'], '', true) : cot_url('products', 'c='.$row['prd_cat'].'&al='.$row['prd_alias'], '', true);

		$items[$i]['title'] = $row['prd_title'];
		$items[$i]['link'] = COT_ABSOLUTE_URL . $row['prd_pageurl'];
		$items[$i]['pubDate'] = cot_date('r', $row['prd_date']);
		$items[$i]['description'] = cot_parse($row['prd_text']);
		$items[$i]['fields'] = cot_generate_prdtags($row);

		$i++;
	}
	$sql->closeCursor();
}

?>