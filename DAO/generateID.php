<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include './queryAll.php';
$row = generateID();

$count = $row+1 ;
$count_s = sprintf("%01d", $count);

$tz = new DateTimeZone('Asia/Colombo');
$date = new DateTime('now', $tz);
$msgtme = $date->format('d-m-Y g:ia');
$msgtmo = $date->format('dmY');
$id = $count_s.$msgtmo ;
echo json_encode($id);