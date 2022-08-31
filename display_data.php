<?php 
/* Start 1 : Getting all info about perticular order_id */
//  $order = wc_get_order( 561 );
//  echo "<pre>";
//  print_r($order);
//  exit;
 /* end 1 : Getting all info about perticular order_id */
 
 
global $wpdb;
//  global $table_prefix;
 $product_tbl = 'wp_wc_order_product_lookup';
 $customer_tbl = 'wp_wc_customer_lookup';
//  Testing 
//  $sql = "select ct.user_id, ct.first_name, ct.last_name, ct.email, pt.product_qty  from $product_tbl pt inner join $customer_tbl ct on pt.customer_id = ct.customer_id";
//  $res = $wpdb->query($sql);


/* Execute query return number of items */
$sql = "select * from wp_wc_customer_lookup";
$userData = $wpdb->get_results($sql);  // Execute and return resultset

 

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

    <style>
        .container{
            /*position : absolute;*/
            /*top : 150px;*/
            margin : 15px 15px;
            padding :10px;
            /*border : 1px solid black;*/
            background-color:white;
            box-shadow: 20px 20px 50px grey;
            box-shadow:inset 3px 0px #72aee6
            
        }
        h4{
            font-size:1.5rem;
        }
        
    </style>

</head>
<body>
    
<div class= "container">
    <h4>Ravi Mourya Task</h4>
    <button type="button" id="button">Export to CSV</button>
  <table id="example" class="display" style="width:100%">
  <thead>
     <tr>
        <th>User ID</th>
        <th>First Name</th>
        <th>Last  Name</th>
        <th>Email ID</th>
        <th>Billing Phone</th>
        <th>Total order count</th>
        <th>order number(separated by comma)</th>
    </tr>
    </thead>
    <tbody>
  <?php
    foreach($userData as $userRow):
        ?>
        <tr>
            <td><?= $userRow->customer_id?></td>
            <td><?= ucwords($userRow->first_name) ?></td>
            <td><?= ucwords($userRow->last_name) ?></td>
            <td><?= $userRow->email ?></td>
            <td><?= "N/A"?></td>
            <!--This loop is use for counting number of orders of perticular user-->
            <td>
                <?php 
                    $sql = "select * from $product_tbl where customer_id = $userRow->customer_id";
                    $countRes = $wpdb->get_results($sql);
                    echo count($countRes);
                ?>
            </td>
            <!--This loop is use for Order_id(s) -->
            <td><?php 
                    $sql = "select * from $product_tbl where customer_id = $userRow->customer_id";
                    $res = $wpdb->get_results($sql);
                    foreach($res as $orderRow){
                        echo "<a href='https://icscomputer.co.in/wp-admin/post.php?post=$orderRow->order_id&amp;action=edit' class='order-view'><strong>#$orderRow->order_id</strong></a>".", ";
                        // echo "[product_page id='$orderRow->order_id']".", "; 
                    }
                
                ?></td>
        </tr>
        <?php
    endforeach;
        ?>
  </tbody>
</table>
    </section>
    
</div>

</body>
</html>

<script>
/*Export to CSV using JAVASCRIPT*/
    function htmlToCSV(html, filename){
       var data = [];
       var rows =  document.querySelectorAll("table tr");
       for (var i = 0; i< rows.length; i++){
         var row =[], cols = rows[i].querySelectorAll("td, th");
         for(var j = 0 ; j < cols.length ; j++ ){
           
           row.push('"'+cols[j].innerText+'"');
           
         }
        data.push(row.join(','));
       }
       downloadCSVFile(data.join("\n"), filename);
    }
    
    function downloadCSVFile(csv,filename){
        var csv_file, download_link;
        csv_file = new Blob([csv], {type: "text/csv"});
        download_link = document.createElement("a"); 
        download_link.download = filename;
        download_link.href = window.URL.createObjectURL(csv_file);
        download_link.style.display = "none";
        document.body.appendChild(download_link);
        download_link.click();
    }
    
    document.getElementById("button").addEventListener("click", function(){
        var html =document.querySelector("table").outerHtml;
        htmlToCSV(html, "report.csv");
    });
 
</script>








