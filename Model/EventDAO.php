<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('../config/config.php');

class EventDAO {

    private $db_connection = null;

    /*
     * this function takes in an event id md5 hash, and returns the exact event id value from the db
     * returns the id of event
     * incomplete
     */

    public function getEventIdFromHash($event_id_md5) {
        if (!$this->getDatabaseConnection()) {
            //echo failure on lousy connection
            return false;
        } else {
            $returnEventID = "";
            $query = 'select * from event where event_id_md5 = ?';
            $pstmt = $this->db_connection->prepare($query);
            if ($pstmt === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
                return false;
            }
            $pstmt->bind_param('s', $event_id_md5);
            $pstmt->execute();

            $pstmt->bind_result($event_id);

            while ($pstmt->fetch()) {
                $returnEventID = $event_id;
            }

            $this->db_connection->close();
            return $returnEventID;
        }
    }

    /*
     *
     * this method takes in the event id md5 hash and checks if this specific event requires extra fields to be filled in
     *
     * returns false if there are no additional fields to fill in
     * returns true if there are additional fields to fill in
     */

    public function needsToFillInExtraFields($event_id_md5) {

        $returnValue = false;
        if (!$this->getDatabaseConnection()) {
            //echo failure on lousy connection
            return "DB FAILURE";
        } else {

            $query = 'select additional_fields from event where event_id_md5 = ?';

            $pstmt = $this->db_connection->prepare($query);

            if ($pstmt === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
            }

            $pstmt->bind_param('s', $event_id_md5);
            $pstmt->execute();

            $pstmt->bind_result($additional_fields);

            while ($pstmt->fetch()) {

                if (strtolower($additional_fields) == "none") {
                    $retrnValue = false;
                } else {
                    $returnValue = true;
                }
            }


            $this->db_connection->close();
            return $returnValue;
        }
    }

    /*
     *
     * this method takes in the event hash and the email address of person who signed up and writes to the event participant table.
     * ONLY FOR SMUX MEMBERS
     *
     * retrns true if successfully inserted.
     */

    public function assignSMUXMEMBERParticipantToEvent($eventidmd5hash, $person_sign_up, $additionalfield) {
        if (!$this->getDatabaseConnection()) {
            //echo failure on lousy connection
            return false;
        } else {

            $eventid = $this->getEventIdFromHash($eventidmd5hash);

            if (strtolower($additionalfield) == "none") {
                //this one has no additional participant data to input to db
                $query = 'insert into event_participant(event_id, member) values(?,?)';

                $pstmt = $this->db_connection->prepare($query);

                if ($pstmt === false) {
                    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
                    return false;
                }
                $pstmt->bind_param('ss', $eventid, $person_sign_up);

                $pstmt->execute();

                $this->db_connection->close();
                return true;
            } else {
                //this includes additional participant info to input to db


                return true;
            }

            return false;
        }
    }

    /*
     *
     * this method takes in the event hash and the email address of person who signed up and writes to the event participant table.
     * ONLY FOR NON-SMUX MEMBERS
     */

    public function assignNONSMUXParticipantToEvent($eventidmd5hash, $person_sign_up) {

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