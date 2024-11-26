<?php
    class DBClass
    {
        public  $server = "localhost";
        public  $username = "u826879810_arman";
        public  $password = "Arman@11";
        public  $dbname = "u826879810_armantraders";

        public function getdata($query)
        {//for a select query....
            $con = mysqli_connect($this->server, $this->username, $this->password, $this->dbname);
            $result = mysqli_query($con, $query);
            return $result;
        }

        public function executequery($query)
        {//for all queries instead of select query....
            $con = mysqli_connect($this->server, $this->username, $this->password, $this->dbname);
            mysqli_query($con, $query);
        }

        public function checkifexists($query)
        {//for whether the record avalaible or not, check record in database....
            $con = mysqli_connect($this->server, $this->username, $this->password, $this->dbname);
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0)
                return true;
            else
                return false;
        }

        public function getsinglevalue($query)
        {//get single value frorm database
            $con = mysqli_connect($this->server, $this->username, $this->password, $this->dbname);
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0)
            {
                $row = mysqli_fetch_assoc($result);
                return $row["svalue"];
            }
            else{
                return "";
            }
        }
    }
?>