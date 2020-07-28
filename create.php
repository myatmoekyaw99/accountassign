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
                        <h2>Create Account</h2>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="form-group">
                                <label for="n">Account Name : </label>
                                <input type="text" class="form-control" id="n" placeholder="Enter name" name="n">
                            </div>
                            <div class="form-group">
                                <label for="bal">Balance Amount: </label>
                                <input type="number" class="form-control" id="bal" placeholder="Enter Balance" name="balance">
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        <hr>
        <?php
            
            include 'accclass.php';
            if(isset($_POST['submit'])){
             
                $name=$_POST['n'];
                $balance=$_POST['balance'];

                $acc=new Account($name,$balance);
                echo "Account successfully created!!";
                
                $n = $acc->name;
                $b = $acc->balance;
                
                $arr=array("Name"=>$name,"Balance"=>$balance);
                $res=json_encode($arr);

                $myfile = fopen("account.txt", "a") or die("Unable to open file!");
                fwrite($myfile, $res."\n");
                fclose($myfile);
                
            }
 
            /*if(isset($_POST['show'])){
                $myfile = fopen("account.txt", "r") or die("Unable to open file!");
    
    
                echo "<table class='table table-dark table-hover'>";
                echo "<thead class='thead-light'><tr><th>Id</th><th>Name</th><th>Balance</th></tr></thead>";
                echo "<tbody>";
                
                while(!feof($myfile)) {
                    
                    $st=fgets($myfile);
                    if($st!=""){
                        $obj=json_decode($st,true);
                        echo "<tr>";
                        array_walk($obj,"myfunction");
                        echo "</tr>";
                    }
                }
                fclose($myfile);
                echo "</tbody>";
                echo "</table>";
            }
            function myfunction($value,$key)
            {
                echo "<td>".$value."</td>";
            }*/

        ?>

        </body>
</html>
