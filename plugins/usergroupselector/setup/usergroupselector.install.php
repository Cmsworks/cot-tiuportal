<?php
/**
 * plugin User Group Selector for Cotonti Siena
 * 
 * @package usergroupselector
 * @version 1.0.0
 * @author CMSWorks Team
 * @copyright Copyright (c) CMSWorks.ru, littledev.ru
 * @license BSD
 *  */

defined('COT_CODE') or die('Wrong URL');

global $db_users, $db_groups, $db_auth, $db_config;

require_once cot_incfile('auth');

// Add field if missing
if (!$db->fieldExists($db_users, "user_usergroup"))
{
	$dbres = $db->query("ALTER TABLE `$db_users` ADD COLUMN `user_usergroup` int(11) NOT NULL default '0'");
}

// Дальше проверяем наличие групп в базе, если их нет, то создаем
$group_exists = (bool)$db->query("SELECT grp_id FROM $db_groups WHERE grp_id=4")->fetch();
if($group_exists)
{
	$rgroups['grp_name'] = 'Продавцы';
	$rgroups['grp_title'] = 'Продавец';
	$rgroups['grp_alias'] = 'sellers';

	$db->update($db_groups, $rgroups, 'grp_id=4');
}

$group_exists = (bool)$db->query("SELECT grp_id FROM $db_groups WHERE grp_alias='customers'")->fetch();
if(!$group_exists)
{
	$rgroups['grp_name'] = 'Покупатели';
	$rgroups['grp_title'] = 'Покупатель';
	$rgroups['grp_desc'] = '';
	$rgroups['grp_icon'] = '';
	$rgroups['grp_alias'] = 'customers';
	$rgroups['grp_level'] = 1;
	$rgroups['grp_disabled'] = 0;
	$rgroups['grp_maintenance'] = 0;
	$rgroups['grp_skiprights'] = 0;
	$rgroups['grp_ownerid'] = 1;

	$db->insert($db_groups, $rgroups);
	$customer_grp_id = $db->lastInsertId();
	cot_auth_add_group($customer_grp_id, 4);
	$db->update($db_auth, array('auth_rights' => 3), "auth_groupid=".$customer_grp_id." AND auth_code='products'");
}