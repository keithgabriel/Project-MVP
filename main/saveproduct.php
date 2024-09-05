<?php
session_start();
include('../connect.php');

// Retrieve form data with default values for optional fields
$a = isset($_POST['code']) ? $_POST['code'] : '';
$b = isset($_POST['name']) ? $_POST['name'] : '';
$c = isset($_POST['exdate']) ? $_POST['exdate'] : '';
$d = isset($_POST['price']) ? $_POST['price'] : '';
$e = isset($_POST['supplier']) ? $_POST['supplier'] : '';
$f = isset($_POST['qty']) ? $_POST['qty'] : '';
$g = isset($_POST['o_price']) ? $_POST['o_price'] : '';
$h = isset($_POST['profit']) ? $_POST['profit'] : '0'; // Default to '0' if not set
$i = isset($_POST['gen']) ? $_POST['gen'] : '';
$j = isset($_POST['date_arrival']) ? $_POST['date_arrival'] : '';
$k = isset($_POST['qty_sold']) ? $_POST['qty_sold'] : '';

// Prepare SQL statement
$sql = "INSERT INTO products (product_code, product_name, expiry_date, price, supplier, qty, o_price, profit, gen_name, date_arrival, qty_sold) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :k)";
$q = $db->prepare($sql);

// Execute the statement with bound parameters
try {
    $q->execute(array(
        ':a' => $a,
        ':b' => $b,
        ':c' => $c,
        ':d' => $d,
        ':e' => $e,
        ':f' => $f,
        ':g' => $g,
        ':h' => $h, // Ensure this is not null
        ':i' => $i,
        ':j' => $j,
        ':k' => $k
    ));
    header("Location: products.php");
    exit(); // Ensure the script stops after redirection
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
