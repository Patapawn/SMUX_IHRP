<?php

require 'DBConnection.php';
$membertomark = sanitizeData($_GET['emailToMark']);

$markAsPaid = 'update member_flags set paid_membership = \'Y\' where smu_email = ?';
$pstmt = $con->prepare($markAsPaid);
if ($pstmt === false) {
    echo 'Wrong SQL: ' . $sql . ' Error: ';
}
$pstmt->bind_param('s', $membertomark);

$pstmt->execute();
$date = new DateTime();
$timestamp = $date->format('Y-m-d H:i:s');

$markAsPaid = 'update smux_members set smux_member_as_of = ? where smu_email = ?';
$pstmt = $con->prepare($markAsPaid);
if ($pstmt === false) {
    echo 'Wrong SQL: ' . $sql . ' Error: ';
}
$pstmt->bind_param('ss', $timestamp, $membertomark);
$pstmt->execute();



$pstmt->close();
$con->close();
$redirect_to = "../AdminPages/ApproveNewMember.php";

header('Location: ' . $redirect_to);
exit();

function sanitizeData($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>