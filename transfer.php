<!DOCTYPE html>
<html lang="en">
    <head>
    <title>Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include 'topnav.php' ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <h2>Transfer Amount</h2>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="form-group">
                            <label for="">From Account : </label>
                            <select name="account1" class="form-control">
                                <option selected disabled>Choose Account..</option>
                                    <?php
                                        $arr=array();
                                        $a=array();
                                            
                                        $myfile = fopen("account.txt", "r") or die("Unable to open file!");
                                                
                                        while(!feof($myfile)) {
                                            $st=fgets($myfile);
                                            if($st!=""){
                                                $obj=json_decode($st,true);
                                                array_push($arr,$obj);
                                            }
                                        }
                                        fclose($myfile);
                                        if(count($arr)>0){
                                            foreach($arr as $arrs){
                                                array_push($a,$arrs);
                                            }
                                                
                                        }
                                        for($i=0;$i<count($a);$i++){
                                            echo "<option>".$a[$i]["Name"]."</option>";
                                        }
                                    ?>
                                </select>
                        </div>
                                
                        <div class="form-group">
                            <label for="">To Account : </label>
                            <select name="account2" class="form-control">
                                <option selected disabled>Choose Account..</option>
                                    <?php
                                       $arr=array();
                                       $a=array();
                                    
                                       $myfile = fopen("account.txt", "r") or die("Unable to open file!");
                                        
                                        while(!feof($myfile)) {
                        
                                            $st=fgets($myfile);
                                            if($st!=""){
                                                $obj=json_decode($st,true);
                                            
                                                array_push($arr,$obj);
                                        
                                            }
                                        }
                                        
                                        fclose($myfile);

                                            if(count($arr)>0){
                                                foreach($arr as $arrs){
                                                    array_push($a,$arrs);
                                                }
                                            
                                            }
                                        
                                        for($i=0;$i<count($a);$i++){
                                            echo "<option>".$a[$i]["Name"]."</option>";
                                        }
                                    ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="amt">Transfer Amount :</label>
                                    <input type="text" class="form-control" id="amt" placeholder="Enter amount to transfer...." name="amt">
                                </div>
                                
                                <button type="submit" class="btn btn-primary" name="transfer">Transfer</button>

                            </form>
                        </div class="col">
                    </div>
                </div>
            <hr>
        <?php
            include 'accclass.php';
            if(isset($_POST['transfer'])){
                $acc1=$_POST['account1'];
                $acc2=$_POST['account2'];
                $amt=$_POST['amt'];  
                
                fileRead();
                $a=array();
                $bal="";
                //$facc={};
                if(count($arr)>0){
                    foreach($arr as $arrs){
                       // print_r($arrs);
                        //echo "<br>";
                        
                        switch($arrs["Name"]){
                           case $acc1:
                                $n=$arrs["Name"];
                                $b=$arrs["Balance"];
                                $facc=new Account($n,$b);
                                echo "Account1 created!!<br>";
                           break;
                        
                            case $acc2:
                                $n1=$arrs["Name"];
                                $b1=$arrs["Balance"];
                                $tacc=new Account($n1,$b1);
                                echo "Account2 created!!<br>";
                            break;
                        }  
                    }
                }
                if(count($arr)>0){
                    foreach($arr as $arrs){
                        if($arrs["Name"]==$acc2){
                            $res = $facc->transfer($tacc,$amt);
                            echo "Acc2 Received Amount :".$res;
                            $bal = $facc->getBalance();
                            echo "<br>Acc1 current Amount:".$bal."<br>";
                            $arrs["Balance"] =$res;
                        }
                        array_push($a,$arrs);
                    }
                    $rr=array();
                    foreach($a as $av){
                        
                        if($av["Name"]==$acc1){
                            $av["Balance"] =$bal;
                        }
                        array_push($rr,$av);
                    }
                    print_r($rr);
                }

                fileClear();
                foreach($rr as $val){
                    //print_r($val);
                    //echo "<br>";
                    $res=json_encode($val);
                    print_r($res);
                    echo "<br>";
                    $myfile = fopen("account.txt", "a") or die("Unable to open file!");
                    fwrite($myfile, $res."\n");
                    fclose($myfile);
                }
            }

        ?>
    </body>
</html>
