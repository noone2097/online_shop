<?php

include '../online_shop/dbConnect.php';

if(isset($_GET['idNumberToUpdate'])){

	$stmt = $connection->prepare("SELECT * FROM `products` WHERE `productID` = ?");
	$stmt->execute([$_GET['idNumberToUpdate']]);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


}


if(isset($_POST['updateBTN'])){


	$productName = $_POST['productnameTF'];
    $productDescription = $_POST['productDescriptionTF'];
	$origPrice = $_POST['originalPriceTF'];
	$salePrice = 0;
    $category = $_POST['categoryTF'];
	$productStock = $_POST['productStockTF'];
	$status = "";
	$supplier = $_POST['supplierTF'];
    $supplierContact = $_POST['supplierContactNumberTF'];
    $productID = $_GET['idNumberToUpdate'];

    $salePrice = $origPrice + ($origPrice * .25);

	if ($productStock <= 25) {
		$status = "Refill stock";
	} else {
		$status = "Adequate stock";
	}

	$stmt = $connection->prepare("UPDATE `products` SET `productName` =?, `productDescription`=?, `originalPrice`=?, `salePrice`=?, `category`=?, `productStock` =?, `productStatus` =?, `productSupplier` =?, `supplierContactNumber` =? WHERE `productID`=?");
	$result = $stmt->execute([$productName,$productDescription, $origPrice, $salePrice, $category, $productStock, $status, $supplier, $supplierContact, $productID]);

	if($result){
		header("location:d_u_d.php");
	}else{
		echo "Failed to Update!";
	}
}




?>



<!DOCTYPE html>
<html>
<head>
	<title>UPDATE DATA</title>
</head>
<body>

	<form method="post" action="">
		<?php foreach ($result as $getRow) { ?>

		<input type="text" name="productnameTF" placeholder="Product name" value="<?php if(isset($getRow['productName'])) { echo $getRow['productName']; } ?>" /> <br />
		<textarea type="text" name="productDescriptionTF" placeholder="Product description" rows="5" value=""><?php if(isset($getRow['productDescription'])) { echo $getRow['productDescription'];} ?></textarea> <br />
		<input type="number" name="originalPriceTF" placeholder="Original price" value="<?php if(isset($getRow['originalPrice'])) { echo $getRow['originalPrice']; } ?>"/><br />
		<input type="text" name="categoryTF" placeholder="Product category" value="<?php if(isset($getRow['category'])) { echo $getRow['category']; } ?>"/><br />
		<input type="category" name="productStockTF" placeholder="Product stock" value="<?php if(isset($getRow['productStock'])) { echo $getRow['productStock']; } ?>"/><br />
		<input type="text" name="supplierTF" placeholder="Product supplier" value="<?php if(isset($getRow['productSupplier'])) { echo $getRow['productSupplier']; } ?>"/><br />
		<input type="text" name="supplierContactNumberTF" placeholder="Supplier contact number" value="<?php if(isset($getRow['supplierContactNumber'])) { echo $getRow['supplierContactNumber']; } ?>"/><br />
        <button type="submit" name="updateBTN">UPDATE</button>

		<?php } ?>
	</form>

</body>
</html>
