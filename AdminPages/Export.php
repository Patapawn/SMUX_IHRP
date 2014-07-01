<?php require_once('../config/config.php'); ?>
<?PHP

// Original PHP code by Chirp Internet: www.chirp.com.au
// Please acknowledge use of this code by including this header.
$colnames = array(
    'smu_email' => "SMU Email",
    'full_name' => "Full Name",
    'contact_number' => "Contact Number",
    'nric' => "NRIC",
    'gender' => "Gender",
    'nationality' => "Nationality",
    'dob' => "D.O.B",
    'diet' => "Diet",
    'allergies' => "Allergies",
    'blood_type' => "Blood Type",
    'shirt_size' => "Shirt Size",
    'primary_team' => "Primary Team",
    'secondary_team' => "Secondary Team",
    'alumni' => "Alumni",
    'driving_license' => "Driving License",
    'smux_member_as_of' => "Smux Member As Of",
    'nok_name' => "NOK Name",
    'nok_relation' => "NOK Relation",
    'nok_contact' => "NOK Contact",
    'address' => "Address",
    'postal_code' => "Postal Code"
);

function map_colnames($input) {
    global $colnames;
    return isset($colnames[$input]) ? $colnames[$input] : $input;
}

function cleanData(&$str) {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';
}

// filename for download
//$tbl_name = "smux_members"; // table name of the selected db

$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Could not connect: ' . mysql_error());
mysql_select_db(DB_NAME) or die('Could not select database');

//$select = "SELECT * FROM `".$tbl_name."`";
$select = "select sm.smu_email, sm.full_name, sm.contact_number, sm.nric, sm.gender, sm.nationality, sm.dob, sm.diet, sm.allergies_medical, sm.blood_type, sm.shirt_size, sm.primary_team, sm.secondary_team, sm.alumni,  sm.driving_license, sm.smux_member_as_of, mn.nok_name, mn.nok_relation, mn.nok_contact, ma.address, ma.postal_code from `smux_members` sm
inner join member_nok mn on sm.smu_email = mn.smu_email
inner join member_address ma on sm.smu_email = ma.smu_email
inner join member_flags mf on sm.smu_email = mf.smu_email";

mysql_query('SET NAMES utf8;');
$result = mysql_query($select);

$fields = mysql_num_fields($result);

$filename = "SMUX MemberList" . date('Ymd') . ".csv";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: text/csv");

$out = fopen("php://output", 'w');

$flag = false;
//$result = pg_query("SELECT * FROM table ORDER BY field") or die('Query failed!');

while (false !== ($row = mysql_fetch_assoc($result))) {
    if (!$flag) { // display field/column names as first row
        $firstline = array_map("map_colnames", array_keys($row));
        fputcsv($out, $firstline, ',', '"');
        //fputcsv($out, array_keys($row), ',', '"');
        $flag = true;
        //echo implode("\t", array_keys($row)) . "\r\n"; $flag = true;
    }

    array_walk($row, 'cleanData');
    fputcsv($out, array_values($row), ',', '"');
    //echo implode("\t", array_values($row)) . "\r\n";
}
fclose($out);
exit;
?>