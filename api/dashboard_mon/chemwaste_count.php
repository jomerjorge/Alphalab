<?php

require("../../lib/core.php");
require("../../functions/dashboard_samp_monitoring.php");

$getOngoing_pc = getOngoing_pc();
$getHold_pc = getHold_pc();
$getforChecking_pc = getforChecking_pc();
$getCompleted_pc = getCompleted_pc();

$getOngoing_w = getOngoing_w();
$getHold_w = getHold_w();
$getforChecking_w = getforChecking_w();
$getCompleted_w = getCompleted_w();

  $dataCount = array(
    "success" => array(
      "Ongoing_Data_pc" => $getOngoing_pc,
      "Hold_Data_pc" => $getHold_pc,
      "forChecking_Data_pc" => $getforChecking_pc,
      "Completed_Data_pc" => $getCompleted_pc,
      "Ongoing_pc" => count($getOngoing_pc),
      "Hold_pc" => count($getHold_pc),
      "forChecking_pc" => count($getforChecking_pc),
      "Completed_pc" => count($getCompleted_pc),

      "Ongoing_Data_w" => $getOngoing_w,
      "Hold_Data_w" => $getHold_w,
      "forChecking_Data_w" => $getforChecking_w,
      "Completed_Data_w" => $getCompleted_w,
      "Ongoing_w" => count($getOngoing_w),
      "Hold_w" => count($getHold_w),
      "forChecking_w" => count($getforChecking_w),
      "Completed_w" => count($getCompleted_w)
    )
  );


echo json_encode($dataCount);

?>