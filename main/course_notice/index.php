<?php

/**
 * Displays courses tools activities in RSS format.
 *
 * @license see /license.txt
 * @author Laurent Opprecht <laurent@opprecht.info> for the Univesity of Geneva
 */

require_once dirname(__FILE__) . '/../inc/global.inc.php';

$controller = CourseNoticeController::instance();
KeyAuth::enable_services($controller);

$controller->run();
