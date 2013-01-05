<?php

require_once("config.php");
require_once(WWW_DIR."/lib/postprocess.php");

$db = new DB();
$query = "select count(rn.releaseID) from releasenfo rn left outer join releases r ON r.ID = rn.releaseID WHERE rn.nfo IS NULL AND rn.attempts < 5";

$i=1;
while($i=1)
{
  $result = mysql_query($query);

  if (empty($result)) {
    $result = $db->queryDirect($query);
    if (empty($result)) {
      $message  = 'Invalid query: ' . mysql_error() . "\n";
      $message .= 'Whole query: ' . $query;
      die($message);
    }
  }

  while ($row = mysql_fetch_assoc($result)) {
    $count = $row['count(rn.releaseID)'];
  }
  if ($count > 0) {
    $postprocess = new PostProcess(true);
    $postprocess->processNfos();
  } else {
    echo "NfoPrc  : Processing $count nfos\n";
    sleep(10);
  }
}

mysql_free_result($result);

?>

