<?php
/**
 * Install script
 *
 * @package Cotonti
 * @version 0.9.0
 * @author Cotonti Team
 * @copyright Copyright (c) Cotonti Team 2008-2013
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

// Modules and plugins checked by default
$default_modules = array('index', 'files', 'page', 'users', 'rss', 'payments', 'market');
$default_plugins = array('ckeditor', 'cotontilib', 'cleaner', 'html', 'htmlpurifier', 'ipsearch', 'mcaptcha', 'useragreement', 'usergroupselector', 'filestiu');

$cfg['defaultlang'] = 'ru';

$L['install_body_message1'] = "Добро пожаловать в скрипт установки Торговой площадки (Tiuportal 2.0) от CMSWorks.ru<br/><br/>".$L['install_body_message1'];

function cot_install_step2_tags()
{
	global $t, $db_name;
	$db_x = "tiu_";
	
	$t->assign(array(
		'INSTALL_DB_X' => $db_x,
		'INSTALL_DB_X_INPUT' => cot_inputbox('text', 'db_x',  $db_x, 'size="32"'),	
		'INSTALL_DB_NAME_INPUT' => cot_inputbox('text', 'db_name',  is_null($db_name) ? 'tiuportal' : $db_name, 'size="32"'),
	));
}

function cot_install_step3_tags()
{
	global $t, $rtheme, $rscheme;

	$rtheme = 'market';
	$t->assign(array(
			'INSTALL_THEME_SELECT' => cot_selectbox_theme($rtheme, $rscheme, 'theme'),
	));
}

function cot_install_step3_setup()
{
	global $file;
	$config_contents = file_get_contents($file['config']);
	cot_install_config_replace($config_contents, 'admintheme', 'fusion');
	file_put_contents($file['config'], $config_contents);
}