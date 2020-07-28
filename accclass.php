<?php
    class Account{
        public $name;
        public $balance;

        public function __construct($name,$balance)
        {
            $this->name=$name;
            $this->balance=$balance;
        }

        public function setBalance($bala){
            $this->balance=$bala;
        }

        public function getBalance(){
            return $this->balance;
        }

        function credit($amount):String{
            $this->balance += $amount;
            echo "Amount successfully added.<br>";
            echo "New Balance :".$this->balance;
            return $this->balance;
        }
        public function debit($amount){
            if($this->balance > $amount){
                $this->balance -= $amount;
                echo "Amount successfully substracted.<br>";
                echo "New Balance :".$this->balance;
                return $this->balance;
            }else{
                echo "Amount not sufficient!!";
            }    
        }

        public function transfer($account,$amount){
            if($amount <= $this->balance){
                $newb=$account->balance+$amount;
                echo "Amount transferred!<br>";
               // echo $newb;
                $this->balance -= $amount;
                return $newb;
            }else{
                echo "Amount exceed!!<br>";
                echo "Current Balance is ".$this->balance;
            }
            
        }


    }

    function fileRead(){   
        $myfile = fopen("account.txt", "r") or die("Unable to open file!");
        $arr=array();                  
        while(!feof($myfile)) {

            $st=fgets($myfile);
            if($st!=""){
                $obj=json_decode($st,true);
                array_push($arr,$obj);
            }
        }    
        fclose($myfile);
    }

    function fileClear(){
        $handle = fopen("account.txt", "w+");
        fwrite($handle , '');
        fclose($handle);
    }

?>