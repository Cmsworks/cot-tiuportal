<?php defined('COT_CODE') or die('Wrong URL');

require_once cot_langfile('genderavatar', 'plug');
require_once cot_incfile('genderavatar', 'plug', 'resources');

/**
 * Generates a avatar selecteion Reload File module funct
 * Use it as CoTemplate callback.
 *
 * @param int $userId for admins only
 * @param string $tpl Template code
 * @return string
 *
 * @todo no cache parameter for css
 * @todo generate formUnikey
 */
function cot_files_avatarbox_ga($userId = null, $tpl = 'files.avatarbox' ){
    global $R, $cot_modules, $usr;

    list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = cot_auth('files', 'a');

    $source = 'pfs';
    $item = 0;
    $filed = '';

    $uid = cot::$usr['id'];
    if($usr['isadmin']){
        $uid = $userId;

        if(is_null($uid)) $uid = cot_import('uid', 'G', 'INT');
        if(is_null($uid)) $uid = $usr['id'];
    }

    $jsFunc = (!defined('COT_HEADER_COMPLETE')) ? 'linkFile': 'linkFileFooter';
    $nc = $cot_modules['files']["version"];

    // Подключаем jQuery-templates только один раз
//    static $jQtemlatesOut = false;
//    $jQtemlates = '';
    $modUrl = cot::$cfg['modules_dir'].'/files';

    // CSS to style the file input field as button and adjust the Bootstrap progress bars
    Resources::$jsFunc($modUrl.'/lib/upload/css/jquery.fileupload.css');
    Resources::$jsFunc($modUrl.'/lib/upload/css/jquery.fileupload-ui.css');

    /* === Java Scripts === */
    // The jQuery UI widget factory, can be omitted if jQuery UI is already included
    Resources::linkFileFooter($modUrl.'/lib/upload/js/vendor/jquery.ui.widget.js?nc='.$nc, 'js');
    Resources::linkFileFooter($modUrl.'/lib/upload/js/jquery.iframe-transport.js?nc='.$nc);
    Resources::linkFileFooter($modUrl.'/lib/upload/js/jquery.fileupload.js?nc='.$nc);

    $formId = "{$source}_{$item}_{$filed}";
    $type = array('image');

    $type = json_encode($type);

    // Get current avatar
    $user = cot_user_data($uid);
    $avatar = cot_files_user_avatar_ga($user['user_avatar'], $user);

    $t = new XTemplate(cot_tplfile($tpl, 'module'));

    $limits = cot_files_getLimits($usr['id'], $source, $item, '');

    $unikey = mb_substr(md5($formId . '_' . rand(0, 99999999)), 0, 15);
    $params = base64_encode(serialize(array(
        'source'  => $source,
        'item'    => $item,
        'field'   => '',
        'limit'   => $limits['count_max'],
        'type'    => $type,
        'avatar'  => 1,
        'unikey'  => $unikey
    )));

    $action = 'index.php?e=files&m=upload&source='.$source.'&item='.$item;
    if($uid != $usr['id']){
        $t->assign(array(
            'UPLOAD_UID'     => $uid,
        ));
        $action .= '&uid='.$uid;
    }

    // Metadata
    $t->assign(array(
        'AVATAR'         => $avatar,
        'UPLOAD_ID'      => $formId,
        'UPLOAD_SOURCE'  => $source,
        'UPLOAD_ITEM'    => $item,
        'UPLOAD_FIELD'   => '',
        'UPLOAD_LIMIT'   => $limits['count_max'],
        'UPLOAD_TYPE'    => $type,
        'UPLOAD_PARAM'   => $params,
        'UPLOAD_CHUNK'   => (int)cot::$cfg['files']['chunkSize'],
        'UPLOAD_EXTS'    => preg_replace('#[^a-zA-Z0-9,]#', '', cot::$cfg['files']['exts']),
//        'UPLOAD_ACCEPT'  => preg_replace('#[^a-zA-Z0-9,*/-]#', '',cot::$cfg['plugin']['attach2']['accept']),
        'UPLOAD_MAXSIZE' => $limits['size_maxfile'],
        'UPLOAD_ACTION'  => $action,
        'UPLOAD_X'       => cot::$sys['xk'],
    ));

    $t->parse();
    return $t->text();
}
/**
 * Get current avatar Reload File module funct
 * @param $file_id
 * @param array|int $urr
 * @param int $width
 * @param int $height
 * @param string $frame
 * @return string
 */
function cot_files_user_avatar_ga($file_id = 0, $urr = 0, $width = 0, $height = 0, $frame = ''){
	
	switch ($urr['user_gender']) {
		case 'M':
			$avatar = cot_rc('ga_user_default_avatar_m');
			break;
		case 'F':
			$avatar = cot_rc('ga_user_default_avatar_f');
			break;
		default:
			$avatar = cot_rc('ga_user_default_avatar_u');
			break;
	}
    if($file_id == 0 && is_array($urr) && isset($urr['user_avatar'])) $file_id = $urr['user_avatar'];
    $url = cot_files_user_avatar_url($file_id, $width, $height, $frame = '');
    $alt = cot::$L['Avatar'];
    if(is_array($urr)) $alt = htmlspecialchars(cot_user_full_name($urr));
    if($url){
        $avatar = cot_rc('files_user_avatar', array(
            'src'=> $url,
            'alt' => $alt,
        ));
    }
    return $avatar;
}