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
                        <h2>Account List</h2>
                        <table class='table table-dark table-hover'>
                            <thead class='thead-light'><tr>
                                <th>Name</th><th>Balance</th></tr>
                            </thead>
                            <tbody>
                            <?php
                                    $myfile = fopen("account.txt", "r") or die("Unable to open file!");
                                      
                                        while(!feof($myfile)) { 
                                            $st=fgets($myfile);
                                                if($st!=""){
                                                    $obj=json_decode($st,true);
                                                    echo "<tr>";  
                                                    array_walk($obj,"myfunction");
                                                    echo "</tr>";   
                                                }
                                        }
                                    
                                        function myfunction($value,$key){
                                            echo "<td>".$value."</td>";
                                        }
                                    fclose($myfile);
                            ?>
                            </tbody>
                        </table>
                    </div>
            </div>

        </body>
</html>
