<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=market.add.tags,market.edit.tags
Tags=market.add.tpl:{PRDADD_FORM_PFS},{PRDADD_FORM_SFS},{PRDADD_FORM_URL_PFS},{PRDADD_FORM_URL_SFS};market.edit.tpl:{PRDEDIT_FORM_PFS},{PRDEDIT_FORM_SFS},{PRDEDIT_FORM_URL_PFS},{PRDEDIT_FORM_URL_SFS}
[END_COT_EXT]
==================== */

/**
 * PFS link on market.add
 *
 * @package FilesTIU
 * @author CMSWorks Team
 */
defined('COT_CODE') or die('Wrong URL.');

if(cot_auth('files', 'a', 'W')){

    require_once cot_incfile('files', 'module');

    if (cot_get_caller() == 'market.add')
    {
        $pfs_tag = 'PRDADD';
    }
    else
    {
        $pfs_tag = 'PRDEDIT';
    }

    $t->assign(array(
        $pfs_tag . '_FORM_PFS' => cot_files_buildPfs($usr['id'], 'prdform', 'formtext',$L['Mypfs'], $sys['parser']),
        $pfs_tag . '_FORM_SFS' => (cot_auth('files', 'a', 'A')) ? cot_files_buildPfs(0, 'prdform', 'rtext',
                                $L['SFS'], $sys['parser']) : '',
        // Унифицированные теги
        'PRD_FORM_PFS' => cot_files_buildPfs($usr['id'], 'prdform', 'formtext',$L['Mypfs'], $sys['parser']),
        'PRD_FORM_SFS' => (cot_auth('files', 'a', 'A')) ? cot_files_buildPfs(0, 'prdform', 'rtext', $L['SFS'], $sys['parser']) : ''
    ));
}