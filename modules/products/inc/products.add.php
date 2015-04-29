<?php
/**
 * Add prd.
 *
 * @package products
 * @version 1.0.0
 * @author CMSWorks Team
 * @copyright Copyright (c) CMSWorks Team 2010-2013
 * @license BSD License
 */

defined('COT_CODE') or die('Wrong URL');

require_once cot_incfile('forms');

$id = cot_import('id', 'G', 'INT');
$c = cot_import('c', 'G', 'TXT');

if (!empty($c) && !isset($structure['products'][$c]))
{
	$c = '';
}

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = cot_auth('products', 'any');

/* === Hook === */
foreach (cot_getextplugins('products.add.first') as $pl)
{
	include $pl;
}
/* ===== */
cot_block($usr['auth_write']);

if ($structure['products'][$c]['locked'])
{
	cot_die_message(602, TRUE);
}

$sys['parser'] = $cfg['products']['parser'];
$parser_list = cot_get_parsers();

if ($a == 'add')
{
	cot_shield_protect();

	/* === Hook === */
	foreach (cot_getextplugins('products.add.add.first') as $pl)
	{
		include $pl;
	}
	/* ===== */

	$rprd = cot_products_import('POST', array(), $usr);

	list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = cot_auth('products', $rprd['prd_cat']);
	cot_block($usr['auth_write']);

	/* === Hook === */
	foreach (cot_getextplugins('products.add.add.import') as $pl)
	{
		include $pl;
	}
	/* ===== */

	cot_products_validate($rprd);

	/* === Hook === */
	foreach (cot_getextplugins('products.add.add.error') as $pl)
	{
		include $pl;
	}
	/* ===== */

	if (!cot_error_found())
	{
		$id = cot_products_add($rprd, $usr);

		switch ($rprd['prd_state'])
		{
			case 0:
				$urlparams = empty($rprd['prd_alias']) ?
					array('c' => $rprd['prd_cat'], 'id' => $id) :
					array('c' => $rprd['prd_cat'], 'al' => $rprd['prd_alias']);
				$r_url = cot_url('products', $urlparams, '', true);
				break;
			case 1:
				$r_url = cot_url('message', 'msg=300', '', true);
				break;
			case 2:
				cot_message('prd_savedasdraft');
				$r_url = cot_url('products', 'm=edit&id='.$id, '', true);
				break;
		}
		cot_redirect($r_url);
	}
	else
	{
		$c = ($c != $rprd['prd_cat']) ? $rprd['prd_cat'] : $c;
		cot_redirect(cot_url('products', 'm=add&c='.$c, '', true));
	}
}

// Products cloning support
$clone = cot_import('clone', 'G', 'INT');
if ($clone > 0)
{
	$rprd = $db->query("SELECT * FROM $db_products WHERE prd_id = ?", $clone)->fetch();
}

if (empty($rprd['prd_cat']) && !empty($c))
{
	$rprd['prd_cat'] = $c;
	$usr['isadmin'] = cot_auth('products', $rprd['prd_cat'], 'A');
}

$out['subtitle'] = $L['prd_addsubtitle'];
$out['head'] .= $R['code_noindex'];
$sys['sublocation'] = $structure['products'][$c]['title'];

$mskin = cot_tplfile(array('products', 'add', $structure['products'][$rprd['prd_cat']]['tpl']));

/* === Hook === */
foreach (cot_getextplugins('products.add.main') as $pl)
{
	include $pl;
}
/* ===== */

require_once $cfg['system_dir'].'/header.php';
$t = new XTemplate($mskin);

$prdadd_array = array(
	'PRDADD_FIRMTITLE' => $L['prd_addtitle'],
	'PRDADD_SUBTITLE' => $L['prd_addsubtitle'],
	'PRDADD_ADMINEMAIL' => "mailto:".$cfg['adminemail'],
	'PRDADD_FORM_SEND' => cot_url('products', 'm=add&a=add&c='.$c),
	'PRDADD_FORM_CAT' => cot_selectbox_structure('products', $rprd['prd_cat'], 'rprdcat'),
	'PRDADD_FORM_CAT_SHORT' => cot_selectbox_structure('products', $rprd['prd_cat'], 'rprdcat', $c),
	'PRDADD_FORM_KEYWORDS' => cot_inputbox('text', 'rprdkeywords', $rprd['prd_keywords'], array('size' => '32', 'maxlength' => '255')),
	'PRDADD_FORM_METATITLE' => cot_inputbox('text', 'rprdmetatitle', $rprd['prd_metatitle'], array('size' => '64', 'maxlength' => '255')),
	'PRDADD_FORM_METADESC' => cot_textarea('rprdmetadesc', $rprd['prd_metadesc'], 2, 64, array('maxlength' => '255')),
	'PRDADD_FORM_ALIAS' => cot_inputbox('text', 'rprdalias', $rprd['prd_alias'], array('size' => '32', 'maxlength' => '255')),
	'PRDADD_FORM_TITLE' => cot_inputbox('text', 'rprdtitle', $rprd['prd_title'], array('size' => '64', 'maxlength' => '255')),
	'PRDADD_FORM_DESC' => cot_textarea('rprddesc', $rprd['prd_desc'], 2, 64, array('maxlength' => '255')),
	'PRDADD_FORM_OWNER' => cot_build_user($usr['id'], htmlspecialchars($usr['name'])),
	'PRDADD_FORM_OWNERID' => $usr['id'],
	'PRDADD_FORM_EXPIRE' => cot_selectbox_date(0, 'long', 'rprdexpire'),
	'PRDADD_FORM_COST' => cot_inputbox('text', 'rprdcost', $rprd['prd_cost'], array('size' => '24', 'maxlength' => '100')),
	'PRDADD_FORM_TEXT' => cot_textarea('rprdtext', $rprd['prd_text'], 12, 80, '', 'input_textarea_editor'),
	'PRDADD_FORM_PARSER' => cot_selectbox($cfg['products']['parser'], 'rprdparser', $parser_list, $parser_list, false)
);

$t->assign($prdadd_array);

// Extra fields
foreach($cot_extrafields[$db_products] as $exfld)
{
	$uname = strtoupper($exfld['field_name']);
	$exfld_val = cot_build_extrafields('rprd'.$exfld['field_name'], $exfld, $rprd[$exfld['field_name']]);
	$exfld_title = isset($L['prd_'.$exfld['field_name'].'_title']) ?  $L['prd_'.$exfld['field_name'].'_title'] : $exfld['field_description'];
	$t->assign(array(
		'PRDADD_FORM_'.$uname => $exfld_val,
		'PRDADD_FORM_'.$uname.'_TITLE' => $exfld_title,
		'PRDADD_FORM_EXTRAFLD' => $exfld_val,
		'PRDADD_FORM_EXTRAFLD_TITLE' => $exfld_title
		));
	$t->parse('MAIN.EXTRAFLD');
}

// Error and message handling
cot_display_messages($t);

/* === Hook === */
foreach (cot_getextplugins('products.add.tags') as $pl)
{
	include $pl;
}
/* ===== */

if ($usr['isadmin'])
{
	if ($cfg['products']['autovalidateprd']) $usr_can_publish = TRUE;
	$t->parse('MAIN.ADMIN');
}

$t->parse('MAIN');
$t->out('MAIN');

require_once $cfg['system_dir'].'/footer.php';
