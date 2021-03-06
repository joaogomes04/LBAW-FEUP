<?php
include_once('../config/init.php');
include_once($BASE_DIR . 'database/users.php');
include_once($BASE_DIR . 'database/content.php');



$resultsPerPage = intval(htmlspecialchars($_GET['resultsPerPage']));
if (!is_integer($resultsPerPage) || $resultsPerPage < 1)
    $resultsPerPage = 5;

$page = intval(htmlspecialchars($_GET['page']));
if (!is_integer($page) || $page < 1)
    $page = 1;

$offset = $resultsPerPage * ($page - 1);

$smarty->assign('resultsPerPage', $resultsPerPage);
$smarty->assign('currentPage', $page);

$userId = $smarty->getTemplateVars('USERID');


$results = getOrderedAllBannedUsers($offset, $resultsPerPage);
$smarty->assign('numResults', $results['numResults']);
$smarty->assign('users', $results['users']);


$smarty->display('content/common/admin_tab.tpl');
