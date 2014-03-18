<?php
/**
 * Russian Language File for the Products Module (products.ru.lang.php)
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

$L['cfg_autovalidateprd'] = 'Автоматическое утверждение товаров';
$L['cfg_autovalidateprd_hint'] = 'Автоматически утверждать публикацию товаров, созданных пользователем с правом администрирования раздела';
$L['cfg_count_admin'] = 'Считать посещения администраторов';
$L['cfg_count_admin_hint'] = 'Включить посещения администраторов в статистику посещаемости сайта';
$L['cfg_maxlistsperpage'] = 'Макс. количество категорий на странице';
$L['cfg_maxlistsperpage_hint'] = ' ';
$L['cfg_order'] = 'Поле сортировки';
$L['cfg_title_products'] = 'Формат заголовка товара';
$L['cfg_title_prd_hint'] = 'Опции: {TITLE}, {CATEGORY}';
$L['cfg_way'] = 'Направление сортировки';
$L['cfg_truncateprdtext'] = 'Ограничить размер текста в списках товаров';
$L['cfg_truncateprdtext_hint'] = '0 для отключения';
$L['cfg_keywords'] = 'Ключевые слова';

$L['info_desc'] = 'Управление контентом: товары и услуги';

/**
 * Structure Confing
 */

$L['cfg_order_params'] = array(); // Redefined in cot_products_config_order()
$L['cfg_way_params'] = array($L['Ascending'], $L['Descending']);

/**
 * Admin Products Section
 */

$L['adm_queue_deleted'] = 'Товар удален в корзину';
$L['adm_valqueue'] = 'В очереди на утверждение';
$L['adm_validated'] = 'Утвержденные';
$L['adm_structure'] = 'Структура (категории)';
$L['adm_sort'] = 'Сортировать';
$L['adm_sortingorder'] = 'Порядок сортировки по умолчанию в категории';
$L['adm_showall'] = 'Показать все';
$L['adm_help_prd'] = '';

/**
 * Products add and edit
 */

$L['prd_addtitle'] = 'Добавить товар';
$L['prd_addsubtitle'] = 'Заполните необходимые поля и нажмите "Отправить" для продолжения';
$L['prd_edittitle'] = 'Информация о товаре';
$L['prd_editsubtitle'] = 'Измените необходимые поля и нажмите "Отправить" для продолжения';

$L['prd_aliascharacters'] = 'Недопустимо использование символов \'+\', \'/\', \'?\', \'%\', \'#\', \'&\' в алиасах';
$L['prd_catmissing'] = 'Код категории отсутствует';
$L['prd_clone'] = 'Клонировать товара';
$L['prd_conproducts_delete'] = 'Вы действительно хотите удалить этот товар?';
$L['prd_conproducts_validate'] = 'Хотите утвердить этот товар?';
$L['prd_conproducts_unvalidate'] = 'Вы действительно хотите отправить этот товар в очередь на утверждение?';
$L['prd_drafts'] = 'Черновики';
$L['prd_drafts_desc'] = 'ТОвары, сохраненные в ваших черновиках';
$L['prd_notavailable'] = 'Товар будет опубликован через';
$L['prd_textmissing'] = 'Описание товара не должно быть пустым';
$L['prd_titletooshort'] = 'Заголовок товара слишком короткий либо отсутствует';
$L['prd_validation'] = 'Ожидают утверждения';
$L['prd_validation_desc'] = 'Ваши товары, которые еще не утверждены администратором';

$L['prd_title'] = 'Заголовок товара';
$L['prd_desc'] = 'Краткое описание';

$L['prd_metakeywords'] = 'Ключевые слова';
$L['prd_metatitle'] = 'Meta-заголовок';
$L['prd_metadesc'] = 'Meta-описание';

$L['prd_cost'] = 'Цена';

$L['prd_formhint'] = 'После заполнения формы товар будет помещено в очередь на утверждение и будет скрыто до тех пор, пока модератор или администратор не утвердят его публикацию в соответствующем разделе. Внимательно проверьте правильность заполнения полей формы. Если вам понадобится изменить содержание товара, то вы сможете сделать это позже, но товар вновь будет отправлен на утверждение.';

$L['prd_prdid'] = 'ID товара';
$L['prd_deleteproducts'] = 'Удалить товар';

$L['prd_savedasdraft'] = 'Товар сохранен в черновиках';

/**
 * Products statuses
 */

$L['prd_status_draft'] = 'Черновик';
$L['prd_status_pending'] = 'На рассмотрении';
$L['prd_status_approved'] = 'Утверждено';
$L['prd_status_published'] = 'Опубликовано';

/**
 * Moved from theme.lang
 */

$L['prd_linesperpage'] = 'Записей на страницу';
$L['prd_linesinthissection'] = 'Записей в разделе';

$L['Products'] = "Товары";
$L['products_catalog'] = "Каталог товаров";
$L['products_new'] = "Новые товары";

$Ls['products'] = "товар,товара,товаров";
$Ls['unvalidated_products'] = "неутвержденный товар,неутвержденные товары,неутвержденных товаров";
$Ls['prd_in_drafts'] = "товар в черновиках,товара в черновиках,товаров в черновиках";

$L['prd_submitnewprd'] = 'Добавить товар';

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

$L['prd_error_wrongcost'] = 'Ошибочная цена';

$L['prd_seller'] = 'Продавец';