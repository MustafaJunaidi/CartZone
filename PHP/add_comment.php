<?php 
require "./connection.php";
$itemID = $_SESSION['item_id'];
$customerID = $_SESSION['user_id'];
$Rate_SQL = "SELECT comment FROM item_rate WHERE item_id='$itemID' AND customer_id='$customerID' ";
$Rate_Result = DB()->query($Rate_SQL);
$row = $Rate_Result->fetch_assoc();
if ($Rate_Result->num_rows <= 0) {
    echo "
    <script>
        alert('You must rate item before commenting');
    </script>";
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $comment = $_POST["comment"];

        $sql = "UPDATE item_rate
        SET comment = '$comment'
        WHERE item_id='$itemID' AND customer_id='$customerID';
        ";
        
        
        if (DB()->query($sql) === TRUE) {
            if($row['comment'] == NULL){
                echo "
                <script>
                    alert('Comment Added Successfully');
                </script>";
            } else {
                echo "
                <script>
                    alert('Comment Edited Successfully');
                </script>";
            }
        } else {
            echo "Error: " . $sql . "<br>" . DB()->error;
        }
        

    }
}

header("refresh:0; url=../item_view.php?id=$itemID");

?>