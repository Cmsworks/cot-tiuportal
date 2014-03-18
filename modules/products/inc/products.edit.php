<?php
/**
 * Edit products.
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

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = cot_auth('products', 'any');

/* === Hook === */
foreach (cot_getextplugins('products.edit.first') as $pl)
{
	include $pl;
}
/* ===== */

cot_block($usr['auth_read']);

if (!$id || $id < 0)
{
	cot_die_message(404);
}
$sql_products = $db->query("SELECT * FROM $db_products WHERE prd_id=$id LIMIT 1");
if($sql_products->rowCount() == 0)
{
	cot_die_message(404);
}
$row_prd = $sql_products->fetch();

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = cot_auth('products', $row_prd['prd_cat']);

$parser_list = cot_get_parsers();
$sys['parser'] = $row_prd['prd_parser'];

if ($a == 'update')
{
	/* === Hook === */
	foreach (cot_getextplugins('products.edit.update.first') as $pl)
	{
		include $pl;
	}
	/* ===== */

	cot_block($usr['isadmin'] || $usr['auth_write'] && $usr['id'] == $row_prd['prd_ownerid']);

	$rprd = cot_products_import('POST', $row_prd, $usr);

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$rprddelete = cot_import('rprddelete', 'P', 'BOL');
	}
	else
	{
		$rprddelete = cot_import('delete', 'G', 'BOL');
		cot_check_xg();
	}

	if ($rprddelete)
	{
		cot_products_delete($id, $row_prd);
		cot_redirect(cot_url('products', "c=" . $row_prd['prd_cat'], '', true));
	}

	/* === Hook === */
	foreach (cot_getextplugins('products.edit.update.import') as $pl)
	{
		include $pl;
	}
	/* ===== */

	cot_products_validate($rprd);

	/* === Hook === */
	foreach (cot_getextplugins('products.edit.update.error') as $pl)
	{
		include $pl;
	}
	/* ===== */

	if (!cot_error_found())
	{
		cot_products_update($id, $rprd);

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
				cot_message($L['prd_savedasdraft']);
				$r_url = cot_url('products', 'm=edit&id=' . $id, '', true);
				break;
		}
		cot_redirect($r_url);
	}
	else
	{
		cot_redirect(cot_url('products', "m=edit&id=$id", '', true));
	}
}

$prd = $row_prd;

$prd['prd_status'] = cot_products_status($prd['prd_state']);

cot_block($usr['isadmin'] || $usr['auth_write'] && $usr['id'] == $prd['prd_ownerid']);

$out['subtitle'] = $L['prd_edittitle'];
$out['head'] .= $R['code_noindex'];
$sys['sublocation'] = $structure['products'][$prd['prd_cat']]['title'];

$mskin = cot_tplfile(array('products', 'edit', $structure['products'][$prd['prd_cat']]['tpl']));

/* === Hook === */
foreach (cot_getextplugins('products.edit.main') as $pl)
{
	include $pl;
}
/* ===== */

require_once $cfg['system_dir'].'/header.php';
$t = new XTemplate($mskin);

$productsedit_array = array(
	'PRDEDIT_FIRMTITLE' => $L['prd_edittitle'],
	'PRDEDIT_SUBTITLE' => $L['prd_editsubtitle'],
	'PRDEDIT_FORM_SEND' => cot_url('products', "m=edit&a=update&id=".$prd['prd_id']),
	'PRDEDIT_FORM_ID' => $prd['prd_id'],
	'PRDEDIT_FORM_STATE' => $prd['prd_state'],
	'PRDEDIT_FORM_STATUS' => $prd['prd_status'],
	'PRDEDIT_FORM_LOCALSTATUS' => $L['prd_status_'.$prd['prd_status']],
	'PRDEDIT_FORM_CAT' => cot_selectbox_structure('products', $prd['prd_cat'], 'rprdcat'),
	'PRDEDIT_FORM_CAT_SHORT' => cot_selectbox_structure('products', $prd['prd_cat'], 'rprdcat', $c),
	'PRDEDIT_FORM_KEYWORDS' => cot_inputbox('text', 'rprdkeywords', $prd['prd_keywords'], array('size' => '32', 'maxlength' => '255')),
	'PRDEDIT_FORM_METATITLE' => cot_inputbox('text', 'rprdmetatitle', $prd['prd_metatitle'], array('size' => '64', 'maxlength' => '255')),
	'PRDEDIT_FORM_METADESC' => cot_textarea('rprdmetadesc', $prd['prd_metadesc'], 2, 64, array('maxlength' => '255')),
	'PRDEDIT_FORM_ALIAS' => cot_inputbox('text', 'rprdalias', $prd['prd_alias'], array('size' => '32', 'maxlength' => '255')),
	'PRDEDIT_FORM_TITLE' => cot_inputbox('text', 'rprdtitle', $prd['prd_title'], array('size' => '64', 'maxlength' => '255')),
	'PRDEDIT_FORM_DESC' => cot_textarea('rprddesc', $prd['prd_desc'], 2, 64, array('maxlength' => '255')),
	'PRDEDIT_FORM_DATE' => cot_selectbox_date($prd['prd_date'], 'long', 'rprddate').' '.$usr['timetext'],
	'PRDEDIT_FORM_DATENOW' => cot_checkbox(0, 'rprddatenow'),
	'PRDEDIT_FORM_UPDATED' => cot_date('datetime_full', $prd['prd_updated']).' '.$usr['timetext'],
	'PRDEDIT_FORM_EXPIRE' => cot_selectbox_date($prd['prd_expire'], 'long', 'rprdexpire').' '.$usr['timetext'],
	'PRDEDIT_FORM_COST' => cot_inputbox('text', 'rprdcost', $prd['prd_cost'], array('size' => '24', 'maxlength' => '100')),
	'PRDEDIT_FORM_TEXT' => cot_textarea('rprdtext', $prd['prd_text'], 12, 80, '', 'input_textarea_editor'),
	'PRDEDIT_FORM_DELETE' => cot_radiobox(0, 'rprddelete', array(1, 0), array($L['Yes'], $L['No'])),
	'PRDEDIT_FORM_PARSER' => cot_selectbox($prd['prd_parser'], 'rprdparser', cot_get_parsers(), cot_get_parsers(), false),
);
if ($usr['isadmin'])
{
	$productsedit_array += array(
		'PRDEDIT_FORM_OWNERID' => cot_inputbox('text', 'rprdownerid', $prd['prd_ownerid'], array('size' => '24', 'maxlength' => '24')),
		'PRDEDIT_FORM_PRDCOUNT' => cot_inputbox('text', 'rprdcount', $prd['prd_count'], array('size' => '8', 'maxlength' => '8')),
	);
}

$t->assign($productsedit_array);

// Extra fields
foreach($cot_extrafields[$db_products] as $exfld)
{
	$uname = strtoupper($exfld['field_name']);
	$exfld_val = cot_build_extrafields('rprd'.$exfld['field_name'], $exfld, $prd['prd_'.$exfld['field_name']]);
	$exfld_title = isset($L['prd_'.$exfld['field_name'].'_title']) ?  $L['prd_'.$exfld['field_name'].'_title'] : $exfld['field_description'];

	$t->assign(array(
		'PRDEDIT_FORM_'.$uname => $exfld_val,
		'PRDEDIT_FORM_'.$uname.'_TITLE' => $exfld_title,
		'PRDEDIT_FORM_EXTRAFLD' => $exfld_val,
		'PRDEDIT_FORM_EXTRAFLD_TITLE' => $exfld_title
	));
	$t->parse('MAIN.EXTRAFLD');
}

if(cot_plugin_active('mavatars'))
{
	$mavatar = new mavatar('products', $prd['prd_cat'], $prd['prd_id']);
	$t->assign('PRDEDIT_FORM_MAVATAR', $mavatar->generate_upload_form());
}

// Error and message handling
cot_display_messages($t);

/* === Hook === */
foreach (cot_getextplugins('products.edit.tags') as $pl)
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
