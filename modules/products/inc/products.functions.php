<?php
/**
 * Products API
 *
 * @package products
 * @version 1.0.0
 * @author CMSWorks Team
 * @copyright Copyright (c) CMSWorks Team 2010-2013
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL.');

// Requirements
require_once cot_langfile('products', 'module');
require_once cot_incfile('products', 'module', 'resources');
require_once cot_incfile('forms');
require_once cot_incfile('extrafields');

// Global variables
global $cot_extrafields, $db_products, $db_x;
$db_products = (isset($db_products)) ? $db_products : $db_x . 'products';

$cot_extrafields[$db_products] = (!empty($cot_extrafields[$db_products]))	? $cot_extrafields[$db_products] : array();

$structure['products'] = (is_array($structure['products'])) ? $structure['products'] : array();

if (cot_plugin_active('mavatars'))
{
	require_once cot_incfile('mavatars', 'plug');
}

function cot_build_structure_products_tree($c = '', $allsublev = true, $custom_tpl = '', $col = 1)
{
	global $cot_extrafields, $db_structure, $structure, $cfg, $db, $sys;
	$t1 = new XTemplate(cot_tplfile(array('products', 'tree', $custom_tpl), 'module'));
	
	$kk = 0;
	$allsub = (empty($c)) ? cot_structure_children('products', '', $allsublev, false, true, false) : cot_structure_children('products', $c, $allsublev, false, true, false);
	$subcat = array_slice($allsub, $dc, $cfg['products']['maxlistsperpage']);
	
	/* === Hook - Part1 : Set === */
	$extp = cot_getextplugins('products.tree.rowcat.loop');
	/* ===== */
	foreach ($subcat as $x)
	{	
		$mtch = $structure['products'][$x]['path'].'.';
		$mtchlen = mb_strlen($mtch);
		$mtchlvl = mb_substr_count($mtch,".");

		if(empty($c) && !$allsublev && $mtchlvl == 1 || !empty($c))
		{
			$cats[] = $x;
		}
	}
	
	$colcount = floor(count($cats)/$col) + 1;
	
	if(is_array($cats))
	{
		foreach($cats as $cat)
		{
			$kk++;

			$cat_childs = cot_structure_children('products', $cat);
			$sub_count = 0;
			foreach ($cat_childs as $cat_child)
			{
				$sub_count += (int)$structure['products'][$cat_child]['count'];
			}

			$sub_url_path = $list_url_path;
			$sub_url_path['c'] = $cat;
			$t1->assign(array(
				'LIST_ROWCAT_URL' => cot_url('products', $sub_url_path),
				'LIST_ROWCAT_TITLE' => $structure['products'][$cat]['title'],
				'LIST_ROWCAT_DESC' => $structure['products'][$cat]['desc'],
				'LIST_ROWCAT_ICON' => $structure['products'][$cat]['icon'],
				'LIST_ROWCAT_COUNT' => $sub_count,
				'LIST_ROWCAT_ODDEVEN' => cot_build_oddeven($kk),
				'LIST_ROWCAT_NUM' => $kk,
				'LIST_ROWCAT_COL' => ($kk % $colcount == 0) ? 1 : 0,
			));

			// Extra fields for structure
			foreach ($cot_extrafields[$db_structure] as $exfld)
			{
				$uname = strtoupper($exfld['field_name']);
				$t1->assign(array(
					'LIST_ROWCAT_'.$uname.'_TITLE' => isset($L['structure_'.$exfld['field_name'].'_title']) ?  $L['structure_'.$exfld['field_name'].'_title'] : $exfld['field_description'],
					'LIST_ROWCAT_'.$uname => cot_build_extrafields_data('structure', $exfld, $structure['products'][$cat][$exfld['field_name']]),
					'LIST_ROWCAT_'.$uname.'_VALUE' => $structure['products'][$cat][$exfld['field_name']],
				));
			}

			/* === Hook - Part2 : Include === */
			foreach ($extp as $pl)
			{
				include $pl;
			}
			/* ===== */

			$t1->parse('MAIN.LIST_ROWCAT');
		}
	}
	
	$t1->parse("MAIN");
	return $t1->text("MAIN");
}


/**
 * Builds products category path
 *
 * @param string $cat Category code
 * @param bool $productslink Include productss main link
 * @return array
 * @see cot_breadcrumbs()
 */
function cot_products_buildpath($cat, $productslink = true)
{
	global $structure, $cfg, $L;
	$tmp = array();
	if ($productslink)
	{
		$tmp[] = array(cot_url('products'), $L['Products']);
	}
	if(!empty($cat) && $cat != 'all')
	{	
		$pathcodes = explode('.', $structure['products'][$cat]['path']);
		foreach ($pathcodes as $k => $x)
		{
			$tmp[] = array(cot_url('products', 'c=' . $x), $structure['products'][$x]['title']);
		}
	}
	return $tmp;
}


/**
 * Returns all prd tags for coTemplate
 *
 * @param mixed $prd_data Products Info Array or ID
 * @param string $tag_prefix Prefix for tags
 * @param int $textlength Text truncate
 * @param bool $admin_rights Products Admin Rights
 * @param bool $productspath_home Add home link for products path
 * @param string $emptytitle Products title text if products does not exist
 * @return array
 * @global CotDB $db
 */
function cot_generate_prdtags($prd_data, $tag_prefix = '', $textlength = 0, $admin_rights = null, $productspath_home = false, $emptytitle = '')
{
	global $db, $cot_extrafields, $cfg, $L, $Ls, $R, $db_products, $usr, $sys, $cot_yesno, $structure, $db_structure;

	static $extp_first = null, $extp_main = null;
	static $pag_auth = array();

	if (is_null($extp_first))
	{
		$extp_first = cot_getextplugins('productstags.first');
		$extp_main = cot_getextplugins('productstags.main');
	}

	/* === Hook === */
	foreach ($extp_first as $pl)
	{
		include $pl;
	}
	/* ===== */

	if (!is_array($prd_data))
	{
		$sql = $db->query("SELECT * FROM $db_products WHERE prd_id = '" . (int) $prd_data . "' LIMIT 1");
		$prd_data = $sql->fetch();
	}

	if ($prd_data['prd_id'] > 0 && !empty($prd_data['prd_title']))
	{
		if (is_null($admin_rights))
		{
			if (!isset($pag_auth[$prd_data['prd_cat']]))
			{
				$pag_auth[$prd_data['prd_cat']] = cot_auth('products', $prd_data['prd_cat'], 'RWA1');
			}
			$admin_rights = (bool) $pag_auth[$prd_data['prd_cat']][2];
		}
		$productspath = cot_products_buildpath($prd_data['prd_cat']);
		$catpath = cot_breadcrumbs($productspath, $productspath_home);
		$prd_data['prd_pageurl'] = (empty($prd_data['prd_alias'])) ? cot_url('products', 'c='.$prd_data['prd_cat'].'&id='.$prd_data['prd_id']) : cot_url('products', 'c='.$prd_data['prd_cat'].'&al='.$prd_data['prd_alias']);
		$prd_link[] = array($prd_data['prd_pageurl'], $prd_data['prd_title']);
		$prd_data['prd_fulltitle'] = cot_breadcrumbs(array_merge($productspath, $prd_link), $productspath_home);

		$date_format = 'datetime_medium';

		$text = cot_parse($prd_data['prd_text'], $cfg['products']['markup'], $prd_data['prd_parser']);
		$text_cut = ((int)$textlength > 0) ? cot_string_truncate($text, $textlength) : $text;
		$cutted = (mb_strlen($text) > mb_strlen($text_cut)) ? true : false;

		$cat_url = cot_url('products', 'c=' . $prd_data['prd_cat']);
		$validate_url = cot_url('admin', "m=products&a=validate&id={$prd_data['prd_id']}&x={$sys['xk']}");
		$unvalidate_url = cot_url('admin', "m=products&a=unvalidate&id={$prd_data['prd_id']}&x={$sys['xk']}");
		$edit_url = cot_url('products', "m=edit&id={$prd_data['prd_id']}");
		$delete_url = cot_url('products', "m=edit&a=update&delete=1&id={$prd_data['prd_id']}&x={$sys['xk']}");

		$prd_data['prd_status'] = cot_products_status($prd_data['prd_state']);

		$temp_array = array(
			'URL' => $prd_data['prd_pageurl'],
			'ID' => $prd_data['prd_id'],
			'TITLE' => $prd_data['prd_fulltitle'],
			'ALIAS' => $prd_data['prd_alias'],
			'STATE' => $prd_data['prd_state'],
			'STATUS' => $prd_data['prd_status'],
			'LOCALSTATUS' => $L['prd_status_'.$prd_data['prd_status']],
			'SHORTTITLE' => htmlspecialchars($prd_data['prd_title'], ENT_COMPAT, 'UTF-8', false),
			'CAT' => $prd_data['prd_cat'],
			'CATURL' => $cat_url,
			'CATTITLE' => htmlspecialchars($structure['products'][$prd_data['prd_cat']]['title']),
			'CATPATH' => $catpath,
			'CATPATH_SHORT' => cot_rc_link($cat_url, htmlspecialchars($structure['products'][$prd_data['prd_cat']]['title'])),
			'CATDESC' => htmlspecialchars($structure['products'][$prd_data['prd_cat']]['desc']),
			'CATICON' => $structure['products'][$prd_data['prd_cat']]['icon'],
			'KEYWORDS' => htmlspecialchars($prd_data['prd_keywords']),
			'DESC' => htmlspecialchars($prd_data['prd_desc']),
			'TEXT' => $text,
			'TEXT_CUT' => $text_cut,
			'TEXT_IS_CUT' => $cutted,
			'DESC_OR_TEXT' => (!empty($prd_data['prd_desc'])) ? htmlspecialchars($prd_data['prd_desc']) : $text,
			'MORE' => ($cutted) ? cot_rc('list_more', array('page_url' => $prd_data['prd_pageurl'])) : '',
			'OWNERID' => $prd_data['prd_ownerid'],
			'OWNERNAME' => htmlspecialchars($prd_data['user_name']),
			'DATE' => cot_date($date_format, $prd_data['prd_date']),
			'UPDATED' => cot_date($date_format, $prd_data['prd_updated']),
			'DATE_STAMP' => $prd_data['prd_date'],
			'UPDATED_STAMP' => $prd_data['prd_updated'],
			'EXPIRE_STAMP' => $prd_data['page_expire'],
			'COUNT' => $prd_data['prd_count'],
			'COST' => $prd_data['prd_cost'],
			'ADMIN' => $admin_rights ? cot_rc('list_row_admin', array('unvalidate_url' => $unvalidate_url, 'edit_url' => $edit_url)) : '',
		);

		// Admin tags
		if ($admin_rights)
		{
			$validate_confirm_url = cot_confirm_url($validate_url, 'products', 'prd_confirm_validate');
			$unvalidate_confirm_url = cot_confirm_url($unvalidate_url, 'products', 'prd_confirm_unvalidate');
			$delete_confirm_url = cot_confirm_url($delete_url, 'products', 'prd_confirm_delete');
			$temp_array['ADMIN_EDIT'] = cot_rc_link($edit_url, $L['Edit']);
			$temp_array['ADMIN_EDIT_URL'] = $edit_url;
			$temp_array['ADMIN_UNVALIDATE'] = $prd_data['prd_state'] == 1 ?
				cot_rc_link($validate_confirm_url, $L['Validate'], 'class="confirmLink"') :
				cot_rc_link($unvalidate_confirm_url, $L['Putinvalidationqueue'], 'class="confirmLink"');
			$temp_array['ADMIN_UNVALIDATE_URL'] = $prd_data['prd_state'] == 1 ?
				$validate_confirm_url : $unvalidate_confirm_url;
			$temp_array['ADMIN_DELETE'] = cot_rc_link($delete_confirm_url, $L['Delete'], 'class="confirmLink"');
			$temp_array['ADMIN_DELETE_URL'] = $delete_confirm_url;
		}
		else if ($usr['id'] == $prd_data['prd_ownerid'])
		{
			$temp_array['ADMIN_EDIT'] = cot_rc_link($edit_url, $L['Edit']);
			$temp_array['ADMIN_EDIT_URL'] = $edit_url;
		}

		if (cot_auth('products', 'any', 'W'))
		{
			$clone_url = cot_url('products', "m=add&c={$prd_data['prd_cat']}&clone={$prd_data['prd_id']}");
			$temp_array['ADMIN_CLONE'] = cot_rc_link($clone_url, $L['prd_clone']);
			$temp_array['ADMIN_CLONE_URL'] = $clone_url;
		}

		if (cot_plugin_active('mavatars'))
		{
			$mavatar = new mavatar('products', $prd_data['prd_cat'], $prd_data['prd_id']);
			$mavatars_tags = $mavatar->generate_mavatars_tags();
			$temp_array['MAVATAR'] = $mavatars_tags;
			$temp_array['MAVATARCOUNT'] = count($mavatars_tags);
		}
		
		// Extrafields
		if (isset($cot_extrafields[$db_products]))
		{
			foreach ($cot_extrafields[$db_products] as $exfld)
			{
				$tag = mb_strtoupper($exfld['field_name']);
				$temp_array[$tag.'_TITLE'] = isset($L['prd_'.$exfld['field_name'].'_title']) ?  $L['prd_'.$exfld['field_name'].'_title'] : $exfld['field_description'];
				$temp_array[$tag] = cot_build_extrafields_data('products', $exfld, $prd_data['prd_'.$exfld['field_name']], $prd_data['prd_parser']);
				$temp_array[$tag.'_VALUE'] = $prd_data['prd_'.$exfld['field_name']];
			}
		}

		// Extra fields for structure
		if (isset($cot_extrafields[$db_structure]))
		{
			foreach ($cot_extrafields[$db_structure] as $exfld)
			{
				$tag = mb_strtoupper($exfld['field_name']);
				$temp_array['CAT_'.$tag.'_TITLE'] = isset($L['structure_'.$exfld['field_name'].'_title']) ?  $L['structure_'.$exfld['field_name'].'_title'] : $exfld['field_description'];
				$temp_array['CAT_'.$tag] = cot_build_extrafields_data('structure', $exfld, $structure['products'][$prd_data['prd_cat']][$exfld['field_name']]);
				$temp_array['CAT_'.$tag.'_VALUE'] = $structure['products'][$prd_data['prd_cat']][$exfld['field_name']];
			}
		}

		/* === Hook === */
		foreach ($extp_main as $pl)
		{
			include $pl;
		}
		/* ===== */

	}
	else
	{
		$temp_array = array(
			'TITLE' => (!empty($emptytitle)) ? $emptytitle : $L['Deleted'],
			'SHORTTITLE' => (!empty($emptytitle)) ? $emptytitle : $L['Deleted'],
		);
	}

	$return_array = array();
	foreach ($temp_array as $key => $val)
	{
		$return_array[$tag_prefix . $key] = $val;
	}

	return $return_array;
}

/**
 * Returns possible values for category sorting order
 */
function cot_products_config_order()
{
	global $cot_extrafields, $L, $db_products;

	$options_sort = array(
		'id' => $L['Id'],
		'type' => $L['Type'],
		'key' => $L['Key'],
		'title' => $L['Title'],
		'desc' => $L['Description'],
		'text' => $L['Body'],
		'ownerid' => $L['Owner'],
		'date' => $L['Date'],
		'update' => $L['Update']
	);

	foreach($cot_extrafields[$db_products] as $exfld)
	{
		$options_sort[$exfld['field_name']] = isset($L['prd_'.$exfld['field_name'].'_title']) ? $L['prd_'.$exfld['field_name'].'_title'] : $exfld['field_description'];
	}

	$L['cfg_order_params'] = array_values($options_sort);
	return array_keys($options_sort);
}

/**
 * Determines prd status
 *
 * @param int $prd_state
 * @return string 'draft', 'pending', 'published'
 */
function cot_products_status($prd_state)
{
	global $sys;

	if ($prd_state == 0)
	{
		return 'published';
	}
	elseif ($prd_state == 2)
	{
		return 'draft';
	}
	return 'pending';
}

/**
 * Recalculates products category counters
 *
 * @param string $cat Cat code
 * @return int
 * @global CotDB $db
 */
function cot_products_sync($cat)
{
	global $db, $db_structure, $db_products, $cache, $sys;
	
	$parent = cot_structure_parents('board', $cat, 'first');
	$cats = cot_structure_children('board', $parent, true, true);
	foreach($cats as $c)
	{
		$subcats = cot_structure_children('products', $c, true, true);
		$count = $db->query("SELECT COUNT(*) FROM $db_products WHERE prd_cat IN ('".implode("','", $subcats)."') AND prd_state = 0")->fetchColumn();		
		$db->query("UPDATE $db_structure SET structure_count=".(int)$count." WHERE structure_area='products' AND structure_code = ?", $c);
		$summcount += $count;
		if($cat == $c) $catcount = $count;
	}
	$cache && $cache->db->remove('structure', 'system');
	
	return $catcount;
}

/**
 * Update products category code
 *
 * @param string $oldcat Old Cat code
 * @param string $newcat New Cat code
 * @return bool
 * @global CotDB $db
 */
function cot_products_updatecat($oldcat, $newcat)
{
	global $db, $db_structure, $db_products;
	return (bool) $db->update($db_products, array("prd_cat" => $newcat), "prd_cat='".$db->prep($oldcat)."'");
}

/**
 * Returns permissions for a prd category.
 * @param  string $cat Category code
 * @return array       Permissions array with keys: 'auth_read', 'auth_write', 'isadmin', 'auth_download'
 */
function cot_products_auth($cat = null)
{
	if (empty($cat))
	{
		$cat = 'any';
	}
	$auth = array();
	list($auth['auth_read'], $auth['auth_write'], $auth['isadmin'], $auth['auth_download']) = cot_auth('products', $cat, 'RWA1');
	return $auth;
}

/**
 * Imports prd data from request parameters.
 * @param  string $source Source request method for parameters
 * @param  array  $rprd  Existing prd data from database
 * @param  array  $auth   Permissions array
 * @return array          Products data
 */
function cot_products_import($source = 'POST', $rprd = array(), $auth = array())
{
	global $cfg, $db_products, $cot_extrafields, $usr, $sys;

	if (count($auth) == 0)
	{
		$auth = cot_products_auth($rprd['prd_cat']);
	}

	if ($source == 'D' || $source == 'DIRECT')
	{
		// A trick so we don't have to affect every line below
		global $_PATCH;
		$_PATCH = $rprd;
		$source = 'PATCH';
	}

	$rprd['prd_cat']      = cot_import('rprdcat', $source, 'TXT');
	$rprd['prd_keywords'] = cot_import('rprdkeywords', $source, 'TXT');
	$rprd['prd_alias']    = cot_import('rprdalias', $source, 'TXT');
	$rprd['prd_title']    = cot_import('rprdtitle', $source, 'TXT');
	$rprd['prd_desc']     = cot_import('rprddesc', $source, 'TXT');
	$rprd['prd_text']     = cot_import('rprdtext', $source, 'HTM');
	$rprd['prd_parser']   = cot_import('rprdparser', $source, 'ALP');
	
	$rprd['prd_cost']   = cot_import('rprdcost', $source, 'TXT');
	
	$rprddatenow           = cot_import('rprddatenow', $source, 'BOL');
	$rprd['prd_date']     = cot_import_date('rprddate', true, false, $source);
	$rprd['prd_date']     = ($rprddatenow || is_null($rprd['prd_date'])) ? $sys['now'] : (int)$rprd['prd_date'];
	$rprd['prd_updated']  = $sys['now'];

	$rprd['prd_keywords'] = cot_import('rprdkeywords', $source, 'TXT');
	$rprd['prd_metatitle'] = cot_import('rprdmetatitle', $source, 'TXT');
	$rprd['prd_metadesc'] = cot_import('rprdmetadesc', $source, 'TXT');

	$rpublish               = cot_import('rpublish', $source, 'ALP'); // For backwards compatibility
	$rprd['prd_state']    = ($rpublish == 'OK') ? 0 : cot_import('rprdtate', $source, 'INT');

	if ($auth['isadmin'] && isset($rprd['prd_ownerid']))
	{
		$rprd['prd_count']     = cot_import('rprdcount', $source, 'INT');
		$rprd['prd_ownerid']   = cot_import('rprdownerid', $source, 'INT');
	}
	else
	{
		$rprd['prd_ownerid'] = $usr['id'];
	}

	$parser_list = cot_get_parsers();

	if (empty($rprd['prd_parser']) || !in_array($rprd['prd_parser'], $parser_list) || $rprd['prd_parser'] != 'none' && !cot_auth('plug', $rprd['prd_parser'], 'W'))
	{
		$rprd['prd_parser'] = isset($sys['parser']) ? $sys['parser'] : $cfg['products']['parser'];
	}

	// Extra fields
	foreach ($cot_extrafields[$db_products] as $exfld)
	{
		$rprd['prd_'.$exfld['field_name']] = cot_import_extrafields('rprd'.$exfld['field_name'], $exfld, $source, $rprd['prd_'.$exfld['field_name']]);
	}

	return $rprd;
}

/**
 * Validates prd data.
 * @param  array   $rprd Imported prd data
 * @return boolean        TRUE if validation is passed or FALSE if errors were found
 */
function cot_products_validate($rprd)
{
	global $db, $db_users, $cfg, $structure, $usr;
	cot_check(empty($rprd['prd_cat']), 'prd_catmissing', 'rprdcat');
	if ($structure['products'][$rprd['prd_cat']]['locked'])
	{
		global $L;
		require_once cot_langfile('message', 'core');
		cot_error('msg602_body', 'rprdcat');
	}
	cot_check(mb_strlen($rprd['prd_title']) < 2, 'prd_titletooshort', 'rprdtitle');

	cot_check(!empty($rprd['prd_alias']) && preg_match('`[+/?%#&]`', $rprd['prd_alias']), 'prd_aliascharacters', 'rprdalias');

	$allowemptyprdtext = isset($cfg['products']['cat_' . $rprd['prd_cat']]['allowemptyprdtext']) ?
							$cfg['products']['cat_' . $rprd['prd_cat']]['allowemptyprdtext'] : $cfg['products']['cat___default']['allowemptytext'];
	cot_check(!$allowemptyprdtext && empty($rprd['prd_text']), 'prd_textmissing', 'rprdtext');
	
	if (!empty($rprd['prd_cost']) && !is_numeric($rprd['prd_cost']))	cot_error('prd_error_wrongcost', 'rprdcost');
	
	//if (empty($rprd['prd_phone']))	cot_error('prd_error_emptyphone', 'rprdphone');
	
		
	if($usr['id'] == 0)
	{
		if (!cot_check_email($rprd['prd_email']))	cot_error('aut_emailtooshort', 'rprdemail');
		$email_exists = (bool)$db->query("SELECT user_id FROM $db_users WHERE user_id!=".$usr['id']." AND user_email = ? LIMIT 1", array($rprd['prd_email']))->fetch();
		if ($email_exists) cot_error('aut_emailalreadyindb', 'rprdemail');
	}
	else
	{
		if(!empty($rprd['prd_email']))
		{
			if (!cot_check_email($rprd['prd_email']))	cot_error('aut_emailtooshort', 'rprdemail');
			$email_exists = (bool)$db->query("SELECT user_id FROM $db_users WHERE user_id!=".$usr['id']." AND user_email = ? LIMIT 1", array($rprd['prd_email']))->fetch();
			if ($email_exists) cot_error('aut_emailalreadyindb', 'rprdemail');
		}
	}
	
	return !cot_error_found();
}

/**
 * Adds a new prd to the CMS.
 * @param  array   $rprd Products data
 * @param  array   $auth  Permissions array
 * @return integer        New products ID or FALSE on error
 */
function cot_products_add(&$rprd, $auth = array())
{
	global $cache, $cfg, $db, $db_products, $db_structure, $structure, $L;
	if (cot_error_found())
	{
		return false;
	}

	if (count($auth) == 0)
	{
		$auth = cot_products_auth($rprd['prd_cat']);
	}

	if (!empty($rprd['prd_alias']))
	{
		$prd_count = $db->query("SELECT COUNT(*) FROM $db_products WHERE prd_alias = ?", $rprd['prd_alias'])->fetchColumn();
		if ($prd_count > 0)
		{
			$rprd['prd_alias'] = $rprd['prd_alias'].rand(1000, 9999);
		}
	}

	if ($rprd['prd_state'] == 0)
	{
		if ($auth['isadmin'] && $cfg['products']['autovalidateprd'])
		{
			$db->query("UPDATE $db_structure SET structure_count=structure_count+1 WHERE structure_area='products' AND structure_code = ?", $rprd['prd_cat']);
			$cache && $cache->db->remove('structure', 'system');
		}
		else
		{
			$rprd['prd_state'] = 1;
		}
	}

	/* === Hook === */
	foreach (cot_getextplugins('products.add.add.query') as $pl)
	{
		include $pl;
	}
	/* ===== */

	if ($db->insert($db_products, $rprd))
	{
		$id = $db->lastInsertId();

		cot_extrafield_movefiles();
	}
	else
	{
		$id = false;
	}

	if (cot_plugin_active('mavatars'))
	{
		$mavatar = new mavatar('products', $rprd['prd_cat'], $id);
		$mavatar->upload();
		$mavatar->update();
	}

	/* === Hook === */
	foreach (cot_getextplugins('products.add.add.done') as $pl)
	{
		include $pl;
	}
	/* ===== */

	if ($rprd['prd_state'] == 0 && $cache)
	{
		if ($cfg['cache_products'])
		{
			$cache->products->clear('products/' . str_replace('.', '/', $structure['products'][$rprd['prd_cat']]['path']));
		}
		if ($cfg['cache_index'])
		{
			$cache->products->clear('index');
		}
	}
	cot_shield_update(30, "r products");
	cot_log("Add products #".$id, 'adm');

	return $id;
}

/**
 * Removes a prd from the CMS.
 * @param  int     $id    Products ID
 * @param  array   $rprd prd data
 * @return boolean        TRUE on success, FALSE on error
 */
function cot_products_delete($id, $rprd = array())
{
	global $db, $db_products, $db_structure, $cache, $cfg, $cot_extrafields, $structure, $L;
	if (!is_numeric($id) || $id <= 0)
	{
		return false;
	}
	$id = (int)$id;
	if (count($rprd) == 0)
	{
		$rprd = $db->query("SELECT * FROM $db_products WHERE prd_id = ?", $id)->fetch();
		if (!$rprd)
		{
			return false;
		}
	}

	if ($rprd['prd_state'] == 0)
	{
		$db->query("UPDATE $db_structure SET structure_count=structure_count-1 WHERE  structure_area='products' AND structure_code = ?", $rprd['prd_cat']);
	}

	foreach ($cot_extrafields[$db_products] as $exfld)
	{
		cot_extrafield_unlinkfiles($rprd['prd_' . $exfld['field_name']], $exfld);
	}

	$db->delete($db_products, "prd_id = ?", $id);
	cot_log("Deleted products #" . $id, 'adm');

	if (cot_plugin_active('mavatars'))
	{
		$mavatar = new mavatar('products', $rprd['prd_cat'], $id);
		$mavatar->delete_all_mavatars();
		$mavatar->get_mavatars();
	}

	/* === Hook === */
	foreach (cot_getextplugins('products.edit.delete.done') as $pl)
	{
		include $pl;
	}
	/* ===== */

	if ($cache)
	{
		if ($cfg['cache_products'])
		{
			$cache->products->clear('products/' . str_replace('.', '/', $structure['products'][$rprd['prd_cat']]['path']));
		}
		if ($cfg['cache_index'])
		{
			$cache->products->clear('index');
		}
	}

	return true;
}

/**
 * Updates a prd in the CMS.
 * @param  integer $id    Products ID
 * @param  array   $rprd Products data
 * @param  array   $auth  Permissions array
 * @return boolean        TRUE on success, FALSE on error
 */
function cot_products_update($id, &$rprd, $auth = array())
{
	global $cache, $cfg, $db, $db_products, $db_structure, $structure, $L;
	if (cot_error_found())
	{
		return false;
	}

	if (count($auth) == 0)
	{
		$auth = cot_products_auth($rprd['prd_cat']);
	}

	if (!empty($rprd['prd_alias']))
	{
		$prd_count = $db->query("SELECT COUNT(*) FROM $db_products WHERE prd_alias = ? AND prd_id != ?", array($rprd['prd_alias'], $id))->fetchColumn();
		if ($prd_count > 0)
		{
			$rprd['prd_alias'] = $rprd['prd_alias'].rand(1000, 9999);
		}
	}

	$row_products = $db->query("SELECT * FROM $db_products WHERE prd_id = ?", $id)->fetch();

	if ($row_products['prd_cat'] != $rprd['prd_cat'] && $row_products['prd_state'] == 0)
	{
		$db->query("UPDATE $db_structure SET structure_count=structure_count-1 WHERE structure_code = ? AND structure_area = 'products'", $row_products['prd_cat']);
	}

	//$usr['isadmin'] = cot_auth('products', $rprd['prd_cat'], 'A');
	if ($rprd['prd_state'] == 0)
	{
		if ($auth['isadmin'] && $cfg['products']['autovalidateprd'])
		{
			if ($row_products['prd_state'] != 0 || $row_products['prd_cat'] != $rprd['prd_cat'])
			{
				$db->query("UPDATE $db_structure SET structure_count=structure_count+1 WHERE structure_code = ? AND structure_area = 'products'", $rprd['prd_cat']);
			}
		}
		else
		{
			$rprd['prd_state'] = 1;
		}
	}

	if ($rprd['prd_state'] != 0 && $row_products['prd_state'] == 0)
	{
		$db->query("UPDATE $db_structure SET structure_count=structure_count-1 WHERE structure_code = ?", $rprd['prd_cat']);
	}
	$cache && $cache->db->remove('structure', 'system');

	if (!$db->update($db_products, $rprd, 'prd_id = ?', $id))
	{
		return false;
	}

	cot_extrafield_movefiles();

	if (cot_plugin_active('mavatars'))
	{
		$mavatar = new mavatar('products', $rprd['prd_cat'], $id);
		$mavatar->upload();
		$mavatar->update();
	}

	/* === Hook === */
	foreach (cot_getextplugins('products.edit.update.done') as $pl)
	{
		include $pl;
	}
	/* ===== */

	if (($rprd['prd_state'] == 0  || $rprd['prd_cat'] != $row_products['prd_cat']) && $cache)
	{
		if ($cfg['cache_products'])
		{
			$cache->products->clear('products/' . str_replace('.', '/', $structure['products'][$rprd['prd_cat']]['path']));
			if ($rprd['prd_cat'] != $row_products['prd_cat'])
			{
				$cache->products->clear('products/' . str_replace('.', '/', $structure['products'][$row_products['prd_cat']]['path']));
			}
		}
		if ($cfg['cache_index'])
		{
			$cache->products->clear('index');
		}
	}

	return true;
}


function cot_products_list($limit, $c = '', $template = 'index', $sqlsearch = '', $order = "prd_date DESC", $pnav = FALSE)
{
	global $db, $db_products, $db_users, $cfg;
	list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = cot_auth('products', 'any', 'RWA');

	$t = new XTemplate(cot_tplfile(array('products', 'list', $template), 'module'));
	
	$sqlsearch = !empty($sqlsearch) ? "prd_state=0 AND " . $sqlsearch : 'prd_state=0';
	
	if(!empty($c))
	{
		$categories = implode("','", cot_structure_children('products', $c));
		$sqlsearch .= " AND prd_cat IN ('$categories')";
	}
	
	$totalitems = $db->query("SELECT COUNT(*) FROM $db_products WHERE " . $sqlsearch)->fetchColumn();

	$sql = $db->query("SELECT * FROM $db_products AS b LEFT JOIN $db_users AS u ON u.user_id=b.prd_ownerid 
	WHERE " . $sqlsearch . " ORDER BY $order LIMIT " . (int)$limit);

	while ($prd = $sql->fetch())
	{
		$jj++;
		$t->assign(cot_generate_usertags($prd, 'PRD_ROW_OWNER_'));
		$t->assign(cot_generate_prdtags($prd, 'PRD_ROW_', $cfg['products']['cat___default']['truncateprdtext'], $usr['isadmin'],
										 $cfg['homebreadcrumb']));

		$t->assign(array(
			"PRD_ROW_ODDEVEN" => cot_build_oddeven($jj),
		));
		$t->parse("MAIN.PRD_ROW");
	}
	
	$t->assign(array(
		"TOTALITEMS" => $totalitems,
	));

	$t->parse("MAIN");
	return $t->text('MAIN');
}



function cot_products_costformat($cost)
{
	if(strstr($cost, ','))
	{
		return number_format($cost, 2, '.', ' ');
	}
	else
	{	
		return number_format($cost, 0, '.', ' ');
	}
}
