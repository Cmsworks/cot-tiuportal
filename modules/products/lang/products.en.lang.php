<?php
/**
 * English Language File for the Products Module (products.en.lang.php)
 *
 * @package products
 * @version 0.9.6
 * @author CMSWorks Team
 * @copyright Copyright (c) CMSWorks Team 2010-2013
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL.');

/**
 * Module Config
 */

$L['cfg_autovalidateprd'] = 'Autovalidate products';
$L['cfg_autovalidateprd_hint'] = 'Autovalidate products if poster has admin rights for products category';
$L['cfg_count_admin'] = 'Count Administrators\' hits';
$L['cfg_count_admin_hint'] = '';
$L['cfg_maxlistsperpage'] = 'Max. lists per page';
$L['cfg_maxlistsperpage_hint'] = ' ';
$L['cfg_order'] = 'Sorting column';
$L['cfg_title_prd'] = 'Product title tag format';
$L['cfg_title_prd_hint'] = 'Options: {TITLE}, {CATEGORY}';
$L['cfg_way'] = 'Sorting direction';
$L['cfg_truncateprdtext'] = 'Set truncated product text length in list';
$L['cfg_truncateprdtext_hint'] = 'Zero to disable this feature';
$L['cfg_keywords'] = 'Keywords';

$L['info_desc'] = 'Enables website content through prd and prd categories';

/**
 * Structure Confing
 */

$L['cfg_order_params'] = array(); // Redefined in cot_prd_config_order()
$L['cfg_way_params'] = array($L['Ascending'], $L['Descending']);

/**
 * Admin Products Section
 */

$L['adm_queue_deleted'] = 'Products was deleted in to the trash can';
$L['adm_valqueue'] = 'Waiting for validation';
$L['adm_validated'] = 'Already validated';
$L['adm_structure'] = 'Structure of the products (categories)';
$L['adm_sort'] = 'Sort';
$L['adm_sortingorder'] = 'Set a default sorting order for the categories';
$L['adm_showall'] = 'Show all';
$L['adm_help_prd'] = 'The product that belong to the category &quot;system&quot; are not displayed in the public listings, it\'s to make standalone product.';

/**
 * Products add and edit
 */

$L['prd_addtitle'] = 'Submit new product';
$L['prd_addsubtitle'] = 'Fill out all required fields and hit "Sumbit" to continue';
$L['prd_edittitle'] = 'Product properties';
$L['prd_editsubtitle'] = 'Edit all required fields and hit "Sumbit" to continue';

$L['prd_aliascharacters'] = 'Characters \'+\', \'/\', \'?\', \'%\', \'#\', \'&\' are not allowed in aliases';
$L['prd_catmissing'] = 'The category code is missing';
$L['prd_clone'] = 'Clone product';
$L['prd_confirm_delete'] = 'Do you really want to delete this product?';
$L['prd_confirm_validate'] = 'Do you want to validate this product?';
$L['prd_confirm_unvalidate'] = 'Do you really want to put this product back to the validation queue?';
$L['prd_drafts'] = 'Drafts';
$L['prd_drafts_desc'] = 'Products saved in your drafts';
$L['prd_notavailable'] = 'This product will be published in ';
$L['prd_textmissing'] = 'The text about product must not be empty';
$L['prd_titletooshort'] = 'The product title is too short or missing';
$L['prd_validation'] = 'Awaiting validation';
$L['prd_validation_desc'] = 'Your product which have not been validated by administrator yet';

$L['prd_title'] = 'Product title';
$L['prd_desc'] = 'Short description';

$L['prd_metakeywords'] = 'Meta keywords';
$L['prd_metatitle'] = 'Meta title';
$L['prd_metadesc'] = 'Meta description';

$L['prd_cost'] = 'Cost';

$L['prd_formhint'] = 'Once your submission is done, the product will be placed in the validation queue and will be hidden, awaiting confirmation from a site administrator or global moderator before being displayed in the right section. Check all fields carefully. If you need to change something, you will be able to do that later. But submitting changes puts a product into validation queue again.';

$L['prd_prdid'] = 'Product ID';
$L['prd_deleteprd'] = 'Delete this product';

$L['prd_savedasdraft'] = 'Product saved as draft.';

/**
 * Products statuses
 */

$L['prd_status_draft'] = 'Draft';
$L['prd_status_pending'] = 'Pending';
$L['prd_status_approved'] = 'Approved';
$L['prd_status_published'] = 'Published';

/**
 * Moved from theme.lang
 */

$L['prd_linesperpage'] = 'Lines per page';
$L['prd_linesinthissection'] = 'Lines in this section';

$L['Products'] = "Products";
$L['products_catalog'] = "Products catalog";
$L['products_new'] = "New products";

$Ls['prd'] = "product,products";
$Ls['unvalidated_prd'] = "unvalidated product,unvalidated products";
$Ls['prd_in_drafts'] = "product in drafts,products in drafts";

$L['prd_submitnewprd'] = 'Add product';

// Параметры поиск товаров
$L['plu_products_set_sec'] = 'Разделы';
$L['plu_products_res_sort1'] = 'Дате публикации';
$L['plu_products_res_sort2'] = 'Заголовку';
$L['plu_products_res_sort3'] = 'Популярности';
$L['plu_products_res_sort3'] = 'Категории';
$L['plu_products_search_names'] = 'Поиск в названиях';
$L['plu_products_search_desc'] = 'Поиск в кратком описании';
$L['plu_products_search_text'] = 'Поиск в описании';
$L['plu_products_set_subsec'] = 'Поиск в подразделах';

$L['prd_error_wrongcost'] = 'Invalid cost';

$L['prd_seller'] = 'Seller';