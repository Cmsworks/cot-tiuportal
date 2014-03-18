<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=admin.home.sidepanel
[END_COT_EXT]
==================== */

/**
 * Products manager & Queue of products
 *
 * @package Cotonti
 * @version 0.9.4
 * @author CMSWorks Team
 * @copyright Copyright (c) CMSWorks Team 2010-2013
 * @license BSD
 */
defined('COT_CODE') or die('Wrong URL');

$tt = new XTemplate(cot_tplfile('products.admin.home', 'module', true));

require_once cot_incfile('products', 'module');

	$productsqueued = $db->query("SELECT COUNT(*) FROM $db_products WHERE prd_state='1'");
	$productsqueued = $productsqueued->fetchColumn();
	$tt->assign(array(
		'ADMIN_HOME_URL' => cot_url('admin', 'm=products'),
		'ADMIN_HOME_PAGESQUEUED' => $productsqueued
	));

$tt->parse('MAIN');

$line = $tt->text('MAIN');
