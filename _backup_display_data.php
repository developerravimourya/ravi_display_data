<?php 

$order = wc_get_order( 561 );
echo "<pre>";
 print_r($order);
 exit;

?>

<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>Users List</h2>

<table>
  <thead>
        <th>User ID</th>
        <th>First Name</th>
        <th>Last  Name</th>
        <th>Email ID</th>
        <th>Billing Phone</th>
        <th>Total order count</th>
        <th>order number(separated by comma)</th>
    </thead>
    <tbody>
  <?php
    foreach($userData as $userRow):
        ?>
        <tr>
            <td><?= $userRow->customer_id?></td>
            <td><?= $userRow->first_name?></td>
            <td><?= $userRow->last_name?></td>
            <td><?= $userRow->email?></td>
            <td><?= $userRow->first_name?></td>
            <td>
                <?php 
                    $sql = "select * from $product_tbl where customer_id = $userRow->customer_id";
                    $countRes = $wpdb->get_results($sql);
                    echo count($countRes);
                ?>
            </td>
            <td><?php 
                    $sql = "select * from $product_tbl where customer_id = $userRow->customer_id";
                    $res = $wpdb->get_results($sql);
                    foreach($res as $orderRow){
                        echo $orderRow->order_id.", "; 
                    }
                
                ?></td>
        </tr>
        <?php
    endforeach;
        ?>
  </tbody>
</table>

</body>
</html>
























