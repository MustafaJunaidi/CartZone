<?php

function getCommentSection($itemID){
    $commentSectionSQL = "SELECT customer_id,comment,item_rate FROM item_rate WHERE item_id = '$itemID'";
    $commentSectionResult = DB()->query($commentSectionSQL);
    $commentCount = $commentSectionResult->num_rows;

    while ($row = $commentSectionResult->fetch_assoc()) {
        $customerID = $row['customer_id'];
        $customerName = getName($customerID);
        $comment = $row['comment'];
        $rate = $row['item_rate'];
        
        if(!isset($rate)){
            $rate = 'Not Rated yet';
        } else {
            $rate .= "<i class='fas fa-star'></i>";
        }
        if(isset($comment)){
           echo 
            "<div class='comment-container'>
                <div class='comment-header'>
                    <span class='profile-pic'><i class='fas fa-user'></i></span>
                    <span class='customer-name'>$customerName</span>
                    <span class='item-rate'>$rate</i></span>
                </div>
                <div class='comment-body'>
                    <p class='comment-text'>$comment</p>
                </div>
            </div>";
        }

    }
}


?>