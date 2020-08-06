<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code




//error

//접근
define('_ERR_LOCATION_', 'abnormal_access'); // 정상적인 접근이 아닙니다.

//register
define('_ERR_ID_OVER_', 'id_over'); // 이미 존재하는 아이디입니다.
define('_ERR_NICK_OVER_', 'nick_over'); // 이미 존재하는 닉네임입니다.
define('_ERR_PW_INSERT_', 'pw_insert'); // 비밀번호를 입력하세요.
define('_ERR_PW_NOTMATCH_', 'pw_fail'); //비밀번호가 일치하지 않습니다.
define('_ERR_OPW_FAIL_', 'origin_pw_fail'); // 기존 비밀번호가 일치하지 않습니다.
define('_ERR_PW_NOTCHANGE_', 'pw_change_fail'); // 비밀번호가 변경에 실패하였습니다.
define('_ERR_NICK_NOTCHANGE_', 'nick_change_fail'); //닉네임 변경에 실패하였습니다.
define('_ERR_SEARCH_PW_', 'search_pw_fail'); //비밀번호가 변경에 실패하였습니다.
define('_ERR_SECESSION_FAIL_', 'secession_fail'); //탈퇴에 실패했습니다.


//success
//register
define('_SUC_ID_SIGN_', 'id_sign'); //사용 가능한 아이디입니다.
define('_SUC_NICK_SIGN_', 'nick_sign'); //사용 가능한 닉네임입니다!
define('_SUC_PW_CHECK_', 'pw_check'); //비밀번호가 일치합니다.
define('_SUC_PW_CHANGE_', 'pw_change'); //비밀번호 변경에 성공했습니다.
define('_SUC_NICK_CHANGE', 'nick_change'); //닉네임이 변경되었습니다.
define('_SUC_SEARCH_PW_', 'search_pw'); //비밀번호가 변경되었습니다.
define('_SUC_SECESSION_', 'secession_success'); //성공적으로 탈퇴했습니다.
define('_SUC_DEL_POSTS_', 'success_post'); //개 글을 삭제 성공했습니다.
define('_SUC_LIKE_', 'success_like'); //좋아요

