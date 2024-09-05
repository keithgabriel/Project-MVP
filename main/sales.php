<!DOCTYPE html>
<html>
<head>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <script src="lib/jquery.js" type="text/javascript"></script>
    <script src="vendors/bootstrap.js"></script>
    <title>POS</title>
    <?php require_once('auth.php'); ?>
    <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }
    </style>
</head>
<body>
    <?php include('navfixed.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span2">
                <div class="well sidebar-nav">
                    <ul class="nav nav-list">
                        <li><a href="index.php"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li> 
                        <li class="active"><a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><i class="icon-shopping-cart icon-2x"></i> Sales</a></li>             
                        <li><a href="products.php"><i class="icon-list-alt icon-2x"></i> Products</a></li>
                        <li><a href="customer.php"><i class="icon-group icon-2x"></i> Customers</a></li>
                        <li><a href="supplier.php"><i class="icon-group icon-2x"></i> Suppliers</a></li>
                        <li><a href="salesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"></i> Sales Report</a></li>
                    </ul>
                </div>
            </div>
            <div class="span10">
                <div class="contentheader">
                    <i class="icon-money"></i> Sales
                </div>
                <ul class="breadcrumb">
                    <a href="index.php"><li>Dashboard</li></a> /
                    <li class="active">Sales</li>
                </ul>

                <div style="margin-top: -19px; margin-bottom: 21px;">
                    <a href="index.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
                </div>

                <!-- Add Sales Button -->
                <button class="btn btn-primary btn-large" id="addSalesBtn"><i class="icon icon-plus icon-large"></i> Add Sales</button>

                <!-- Sales Form -->
                <div id="salesForm" style="display:none; margin-top: 20px;">
                    <form action="save_sales.php" method="post">
                        <div class="form-group">
                            <label for="transaction_id">Transaction ID:</label>
                            <input type="text" name="transaction_id" class="form-control" value="<?php echo $finalcode; ?>" readonly />
                        </div>
                        <div class="form-group">
                            <label for="invoice_number">Invoice Number:</label>
                            <input type="text" name="invoice_number" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="product">Product:</label>
                            <select name="product" class="form-control" required>
                                <!-- Add options from the database dynamically -->
                                <?php
                                    include('../connect.php');
                                    $result = $db->prepare("SELECT * FROM products");
                                    $result->execute();
                                    while ($row = $result->fetch()) {
                                        echo "<option value='" . $row['product_name'] . "'>" . $row['product_name'] . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="unit">Unit:</label>
                            <select name="unit" class="form-control" required>
                                <option value="pcs">Pieces</option>
                                <option value="box">Box</option>
                                <option value="kg">Kilogram</option>
                                <!-- Add more units as needed -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="qty">Quantity:</label>
                            <input type="number" name="qty" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="unit_price">Unit Price:</label>
                            <input type="number" name="unit_price" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="total_amount">Total Amount:</label>
                            <input type="number" name="total_amount" class="form-control" readonly />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-large btn-block"><i class="icon icon-save icon-large"></i> Save</button>
                        </div>
                    </form>
                </div>

                <!-- Sales Table -->
                <table class="table table-bordered" id="resultTable" data-responsive="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Unit</th>
                            <th>Unit Price</th>
                            <th>Qty</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $id=$_GET['invoice'];
                            include('../connect.php');
                            $result = $db->prepare("SELECT * FROM sales_order WHERE invoice= :userid");
                            $result->bindParam(':userid', $id);
                            $result->execute();
                            while ($row = $result->fetch()) {
                        ?>
                        <tr class="record">
                            <td><?php echo $row['product']; ?></td>
                            <td><?php echo $row['unit']; ?></td>
                            <td><?php echo $row['unit_price']; ?></td>
                            <td><?php echo $row['qty']; ?></td>
                            <td><?php echo $row['total_amount']; ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Show/Hide Sales Form Script -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#addSalesBtn').click(function() {
                $('#salesForm').toggle();
            });

            $('input[name="qty"], input[name="unit_price"]').on('input', function() {
                var qty = parseFloat($('input[name="qty"]').val()) || 0;
                var unit_price = parseFloat($('input[name="unit_price"]').val()) || 0;
                $('input[name="total_amount"]').val(qty * unit_price);
            });
        });
    </script>
</body>
</html>
