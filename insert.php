<?php
include '../online_shop/dbConnect.php';

if (isset($_POST['saveData'])) {
	
	$productName = $_POST['productnameTF'];
    $productDescription = $_POST['productDecriptionTF'];
	$origPrice = $_POST['originalPriceTF'];
	$salePrice = 0;
    $category = $_POST['categoryTF'];
	$productStock = $_POST['productStockTF'];
	$status = "";
	$supplier = $_POST['supplierTF'];
    $supplierContact = $_POST['supplierContactNumberTF'];

	$salePrice = $origPrice + ($origPrice * .25);

	if ($productStock <= 25) {
		$status = "Refill stock";
	} else {
		$status = "Adequate stock";
	}
	
	$stmt = $connection->prepare(" INSERT INTO `products` (`productName`, `productDescription`, `originalPrice`, `salePrice`, `category`, `productStock`, `productStatus`, `productSupplier`, `supplierContactNumber`)
	VALUES (?,?,?,?,?,?,?,?,?) ");
	$res = $stmt->execute([$productName,$productDescription, $origPrice, $salePrice, $category, $productStock, $status, $supplier, $supplierContact]);

	if ($res) {
		echo "<br> Successfully save";
	}else{
		echo "<br> Failed to save";
	}

}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Insert Data</title>
</head>
<body>

	<center>
		<form method="post">
			<input type="text" name="productnameTF" placeholder="Product name"> <br> <br>
			<textarea type="text" name="productDecriptionTF" placeholder="Product description" rows="5"></textarea> <br> <br>
			<input type="number" name="originalPriceTF" placeholder="Original price"> <br> <br>
		    <input type="text" name="categoryTF" placeholder="Product category"> <br> <br>
			<input type="number" name="productStockTF" placeholder="Product stock"> <br> <br>
			<input type="text" name="supplierTF" placeholder="Product supplier"> <br> <br>
			<input type="text" name="supplierContactNumberTF" placeholder="Supplier contact number"> <br> <br>
			<input type="submit" name="saveData" value="SAVE">
		</form>
	</center>

</body>
</html>

