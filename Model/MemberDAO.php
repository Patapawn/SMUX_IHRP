<?php

ob_start();
/*
 * this class to be responsible for member management, updating particulars etcetc.
 */
require_once('../config/config.php');

class MemberDAO {

    private $db_connection = null;

    public function getMemberDetails($smu_email) {

        $returnArray = array();
        if (!$this->getDatabaseConnection()) {
            //echo failure on lousy connection
            return "DB FAILURE";
        } else {

            //echo $smu_email;

            $query = 'select smu_email, full_name, contact_number, nric, gender, nationality, dob, diet, allergies_medical, blood_type, shirt_size, primary_team, secondary_team, alumni, driving_license from smux_members where smu_email=?';
            $pstmt = $this->db_connection->prepare($query);
            if ($pstmt === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
            }
            $pstmt->bind_param('s', $smu_email);
            $pstmt->execute();
            $pstmt->bind_result($smu_email, $full_name, $contact_number, $nric, $gender, $nationality, $dob, $diet, $allergies_medical, $blood_type, $shirt_size, $primary_team, $secondary_team, $alumni, $driving_license);
            while ($pstmt->fetch()) {
                array_push($returnArray, $smu_email);
                array_push($returnArray, $full_name);
                array_push($returnArray, $contact_number);
                array_push($returnArray, $nric);
                array_push($returnArray, $gender);
                array_push($returnArray, $nationality);
                array_push($returnArray, $dob);
                array_push($returnArray, $diet);
                array_push($returnArray, $allergies_medical);
                array_push($returnArray, $blood_type);
                array_push($returnArray, $shirt_size);
                array_push($returnArray, $primary_team);
                array_push($returnArray, $secondary_team);
                array_push($returnArray, $alumni);
                array_push($returnArray, $driving_license);
            }

            $query = 'select address, postal_code from member_address where smu_email=?';
            $pstmt = $this->db_connection->prepare($query);
            if ($pstmt === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
            }
            $pstmt->bind_param('s', $smu_email);
            $pstmt->execute();
            $pstmt->bind_result($address, $postal_code);
            while ($pstmt->fetch()) {
                array_push($returnArray, $address);
                array_push($returnArray, $postal_code);
            }



            $query = 'select nok_name, nok_relation, nok_contact from member_nok where smu_email=?';
            $pstmt = $this->db_connection->prepare($query);
            if ($pstmt === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
            }
            $pstmt->bind_param('s', $smu_email);
            $pstmt->execute();
            $pstmt->bind_result($nok_name, $nok_relation, $nok_contact);
            while ($pstmt->fetch()) {
                array_push($returnArray, $nok_name);
                array_push($returnArray, $nok_relation);
                array_push($returnArray, $nok_contact);
            }
        }
        //print_r($returnArray);

        $this->db_connection->close();
        return $returnArray;
    }

    private function getDatabaseConnection() {
        if (
                $this->db_connection != null) {
            return true;
        } else {

            $this->db_connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if ($this->db_connection != null) {
                return true;
            }
        }
        return false;
    }

}

?>