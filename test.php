<!DOCTYPE html>
<?php
require "./PHP/connection.php";
require "./PHP/functions.php";
require "./PHP/SimilarityCode.php"

?>
<html lang="en">
<head>
    <link rel="stylesheet" href="style/style.css" />
    <link rel="stylesheet" href="style/test.css" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST</title>
</head>
<body>
    <div>
        <table>
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php


            

            for($j=1; $j<=13; $j++){
                    $sim = similarityTwoUsers(1,$j);
                    echo "USER 1 SIMILARITY TO ".$j." IS ".$sim."<br>";

                }

            // $c = 1;
            // for($j=1; $j<=2; $j++){
            //     $prediction = itemPredictionForUser($j,1);
            //    // if($prediction != "Item Already Rated"){
            //         echo "Prediction Number ".$c."<br>";
            //         echo "customer ID = 1"."<br>";
            //         echo "item ID = ".$j."<br>";
            //         echo "Prediction = ", $prediction."<br>"."<span style='font-weight:bolder; font-size:30px;'>------------------------</span>"."<br>";
            //         $c = $c + 1;
            //    //}
            // }
                // echo "<br>";

         //  echo "Prediction = ", itemPredictionForUser(50,12)."<br>"."<span style='font-weight:bolder; font-size:30px;'>------------------------</span>"."<br>";

            ?>
        </tbody>
    </table>
    </div>
</body>
</html>