<?php

require("../../lib/core.php");
require("../../functions/dashboard_samp_monitoring.php");

$getOngoing_m = getOngoing_m();
$getHold_m = getHold_m();
$getforChecking_m = getforChecking_m();
$getDone_m = getDone_m();

$getOngoing_mw = getOngoing_mw();
$getHold_mw = getHold_mw();
$getforChecking_mw = getforChecking_mw();
$getDone_mw = getDone_mw();

  $dataCount = array(
    "success" => array(
      "Ongoing_Data_m" => $getOngoing_m,
      "Hold_Data_m" => $getHold_m,
      "forChecking_Data_m" => $getforChecking_m,
      "Done_Data_m" => $getDone_m,
      "Ongoing_m" => count($getOngoing_m),
      "Hold_m" => count($getHold_m),
      "forChecking_m" => count($getforChecking_m),
      "Done_m" => count($getDone_m),

      "Ongoing_Data_mw" => $getOngoing_mw,
      "Hold_Data_mw" => $getHold_mw,
      "forChecking_Data_mw" => $getforChecking_mw,
      "Done_Data_mw" => $getDone_mw,
      "Ongoing_mw" => count($getOngoing_mw),
      "Hold_mw" => count($getHold_mw),
      "forChecking_mw" => count($getforChecking_mw),
      "Done_mw" => count($getDone_mw)
    )
  );


echo json_encode($dataCount);

?>