<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveproduct.php" method="post">
<center><h4><i class="icon-plus-sign icon-large"></i> Add Product</h4></center>
<hr>
<div id="ac">
<span>Product Name : </span><input type="text" style="width:265px; height:30px;" name="code" ><br>
<span>Unit: </span><input type="text" style="width:265px; height:30px;" name="gen" Required/><br>
<span>Category: </span>
<select style="width:265px; height:50px;" name="name">
<option>Home care</option>
<option>Baby care</option>
<option>Apparel</option>
<option>Personal Care</option>
</select>
<br>
<span>Expiration Date: </span><input type="date" style="width:265px; height:30px;" name="exdate" /><br>
<span>Date Arrival: </span><input type="date" style="width:265px; height:30px;" name="date_arrival" /><br>
<span>Selling Price : </span><input type="text" id="txt1" style="width:265px; height:30px;" name="price" onkeyup="sum();" Required><br>
<span>Original Price : </span><input type="text" id="txt2" style="width:265px; height:30px;" name="o_price" onkeyup="sum();" Required><br>
<!-- <span>Profit : </span><input type="text" id="txt3" style="width:265px; height:30px;" name="profit" readonly><br> -->
<span>Supplier : </span><input type="text" style="width:265px; height:30px;" name="supplier" placeholder="Type supplier name" Required /><br>
<span>Quantity : </span><input type="number" style="width:265px; height:30px;" min="0" id="txt11" onkeyup="sum();" name="qty" Required ><br>
<span></span><input type="hidden" style="width:265px; height:30px;" id="txt22" name="qty_sold" Required ><br>

<div style="float:right; margin-right:10px;">
    <button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save</button>
    <button type="reset" class="btn btn-warning btn-block btn-large" style="width:267px; margin-top:10px;"><i class="icon icon-refresh icon-large"></i> Reset</button>
</div>
</div>
</form>
