<?php

class DB_Functions
{

    private $conn;

    // constructor
    function __construct()
    {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }

    // destructor
    function __destruct()
    {

    }


    public function getTableByName($table)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $table);
        $stmt->execute();
        $resultset = $stmt->get_result()->fetch_all(1);
        $stmt->close();
        return $resultset;
    }

    public function getScoresByNumber($sn)
    {
        $response = array();
        $result = array();
        $stmt = $this->conn->prepare("SELECT * FROM scores WHERE sn = " . $sn);
        $stmt->execute();
        $resultset = $stmt->get_result()->fetch_all(1);
        $stmt->close();
        $question = $this->getTableByName($resultset[0]['passed']);
        $i = 0;
        while ($i < sizeof($question)) {
            $result['sn'] = $i + 1;
            $result['question'] = $question[$i]['QUESTION'];
            $ans = $question[$i]['Answer'];
            $result['answer'] = $question[$i][$ans];
            $result['school_name'] = $resultset[0]['school_name'];
            $result['option'] = $ans;
            $result['pick'] = $resultset[0]['picked'];
            $result['scores'] = $resultset[0]['scores'];
            $i++;
            array_push($response, $result);
        }
        return $response;
    }

    public function insertSchool($school_name, $scores, $passed, $picked)
    {
        $sn = $this->getLastSN() + 1;

        $stmt = $this->conn->prepare("INSERT INTO `scores`(`sn`, `school_name`, `scores`, `passed`, `picked`) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $sn, $school_name, $scores, $passed, $picked);
        $result = array();
        if ($stmt->execute()) {
            $result['response'] = "You have successfully finished this stage <br> Your scores is " . $scores;
        } else {
            $result['response'] = "Error while saving your scores";
        }
        return $result;
    }

    public function getLastSN()
    {
        $stmt = $this->conn->prepare("SELECT * FROM scores ");
        $stmt->execute();
        $result = $stmt->get_result()->num_rows;
        $stmt->close();
        return $result;
    }
}

?>
