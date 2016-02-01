<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=market.edit.delete.done
[END_COT_EXT]
==================== */

/**
 * Delete attached files on market deletes
 *
 * @package FilesTIU
 * @author CMSWorks Team
 */
defined('COT_CODE') or die('Wrong URL');

if (cot_auth('files', 'a', 'W')){

    require_once cot_incfile('files', 'module');

    $filesCond = array(
        array('file_source', 'market'),
        array('file_item', $id),
    );
    $files = files_model_File::find($filesCond);
    if($files){
        foreach($files as $fileRow) $fileRow->delete();
    }
}
