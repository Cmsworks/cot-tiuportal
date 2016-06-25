<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=market.add.add.done
[END_COT_EXT]
==================== */

/**
 * Link possibly uploaded files to prd
 *
 * @package FilesTIU
 * @author CMSWorks Team
 */
defined('COT_CODE') or die('Wrong URL');

if (cot_auth('files', 'a', 'W')){
    if($id) cot_files_linkFiles('market', $id);
}
