<?php
require "connection.php";

$item_id = $_SESSION['item_id'];

$sql = "
SELECT
    item_id,
    item_rate,
    COUNT(item_rate) AS total_ratings,
    ROUND((COUNT(item_rate) / (SELECT COUNT(*) FROM item_rate WHERE item_id = $item_id AND item_rate IS NOT NULL)) * 100, 2) AS percentage
FROM
    item_rate
WHERE
    item_id = $item_id AND item_rate IS NOT NULL
GROUP BY
    item_id, item_rate;
";

$result = DB()->query($sql);
if($result){
    if ($result->num_rows > 0) {
        $itemRatings = array();
        while ($row = $result->fetch_assoc()) {
            $itemRatings[] = $row;
        }
        echo json_encode($itemRatings);
    } else {
        echo json_encode(array("error" => "No item ratings found for item ID: $item_id"));
    }
} else {
    echo json_encode("ERRRROR");
}

?>