
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
    <style>
    </style>
    </head>
        <body>
            <?php include 'topnav.php' ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            <h2>Account Credit&Debit</h2>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                            <div class="form-group">
                            <label for="">Choose Account : </label>
                                <select name="account" class="form-control">
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
                                            $n=$a[$i]["Name"];
                                            echo "<option value='".$n."'>".$n."</option>";
                                        }
                                    ?>
                                </select>

                            </div>

                                <div class="form-group">
                                    <label for="id">Amount :</label>
                                    <input type="text" class="form-control" id="amt" placeholder="Enter amount to change balance...." name="amt">
                                </div>
                                
                                <button type="submit" class="btn btn-primary" name="increase">Increase Balance</button>
                                <button type="submit" class="btn btn-primary" name="decrease">Decrease Balance</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            <hr>
            <?php
                include 'accclass.php';

                if(isset($_POST['increase'])){
                    $acc=$_POST['account'];
                    $amt=$_POST['amt'];

                    fileRead();
                    $a=array();
                    if(count($arr)>0){
                        foreach($arr as $arrs){
                            //print_r($arrs);
                            global $acc;
                            if($arrs["Name"]==$acc){
                                $n=$arrs["Name"];
                                $b=$arrs["Balance"];
                                echo "Current balance :".$b."<br>";
                                $nacc=new Account($n,$b);
                                $newamt=$nacc->credit($amt);
                                $arrs["Balance"] =$newamt;
                            }
                            array_push($a,$arrs);
                        }
                        print_r($a);   
                    }
                     
                    fileClear();
                    
                    foreach($a as $val){
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

                if(isset($_POST['decrease'])){
                    $acc=$_POST['account'];
                    $amt=$_POST['amt'];
                    fileRead();
                    $a=array();
                    if(count($arr)>0){
                        foreach($arr as $arrs){
                            //print_r($arrs);
                            global $acc;
                            if($arrs["Name"]==$acc){
                                $n=$arrs["Name"];
                                $b=$arrs["Balance"];
                                echo "Current balance :".$b."<br>";
                                $nacc=new Account($n,$b);
                                $newamt=$nacc->debit($amt);
                                $arrs["Balance"] =$newamt;
                            }
                            array_push($a,$arrs);
                        }
                        print_r($a);   
                    }
                    
                    fileClear();
                    foreach($a as $val){
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
