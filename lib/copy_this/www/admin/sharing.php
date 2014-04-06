<?php
require_once("config.php");
require_once(WWW_DIR."/lib/adminpage.php");
require_once(WWW_DIR."/lib/framework/db.php");

$page = new AdminPage();
$page->title = 'Sharing Settings';

$db = new DB();

$offset = (isset($_GET['offset']) ? $_GET['offset'] : 0);

$allSites = $db->query(sprintf('SELECT * FROM sharing_sites ORDER BY ID LIMIT %d OFFSET %d', 25, $offset));
if (count($allSites) === 0) {
	$allSites = false;
}

$ourSite = $db->queryOneRow('SELECT * FROM sharing');

if (!empty($_POST)) {
	if (!empty($_POST['sharing_name']) && !preg_match('/\s+/', $_POST['sharing_name']) && strlen($_POST['sharing_name']) < 255) {
		$site_name = trim($_POST['sharing_name']);
	} else {
		$site_name = $ourSite['site_name'];
	}
	if (!empty($_POST['sharing_maxpush']) && is_numeric($_POST['sharing_maxpush'])) {
		$max_push = trim($_POST['sharing_maxpush']);
	} else {
		$max_push = $ourSite['max_push'];
	}
	if (!empty($_POST['sharing_maxpull']) && is_numeric($_POST['sharing_maxpush'])) {
		$max_pull = trim($_POST['sharing_maxpull']);
	} else {
		$max_pull = $ourSite['max_pull'];
	}
	$db->exec(sprintf('UPDATE sharing SET site_name = %s, max_push = %d, max_pull = %d', $db->escapeString($site_name), $max_push, $max_pull));
	$ourSite = $db->queryOneRow('SELECT * FROM sharing');
}

$total = $db->queryOneRow('SELECT COUNT(*) AS total FROM sharing_sites');

$page->smarty->assign('pagertotalitems', ($total === false ? 0 : $total['total']));
$page->smarty->assign('pageroffset', $offset);
$page->smarty->assign('pageritemsperpage', 25);
$page->smarty->assign('pagerquerybase', WWW_TOP . "/sharing.php?offset=");

$pager = $page->smarty->fetch("pager.tpl");
$page->smarty->assign('pager', $pager);

$page->smarty->assign(array('local' => $ourSite, 'sites' => $allSites));

$page->content = $page->smarty->fetch('sharing.tpl');
$page->render();