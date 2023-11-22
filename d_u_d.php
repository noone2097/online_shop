<?php

include 'dbConnect.php';

$stmt = $connection->prepare("SELECT * FROM products");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


if (isset($_GET['idNumberToDelete'])) {

    $idNumberToDelete = $_GET['idNumberToDelete'];
    $stmt = $connection->prepare("DELETE FROM products WHERE productID= ?");
    $stmt->execute([$idNumberToDelete]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($stmt) {
        echo "Delete Successful!";
        header("location:d_u_d.php");
    } else {
        echo "Delete Failed!";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>DISPLAY UPDATE DELETE DATA </title>
</head>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th,
    td {
        text-align: center;
    }
</style>

<body>

    <h3>DISPLAY UPDATE DELETE DATA FROM DATABASE USING TABLE</h3>
    <table>
        <tr>
            <th>PRODUCT ID</th>
            <th>PRODUCT NAME</th>
            <th>PRODUCT DESCRIPTION</th>
            <th>ORIGINAL PRICE</th>
            <th>SALE PRICE</th>
            <th>CATEGORY</th>
            <th>PRODUCT STOCK</th>
            <th>PRODUCT STATUS</th>
            <th>SUPPLIER</th>
            <th>SUPPLIER CONTACT NUMBER</th>
            <th colspan="2">ACTION</th>
        </tr>

        <?php foreach ($result as $perRow) { ?>

            <tr>
                <td><?php echo $perRow['productID']; ?></td>
                <td><?php echo $perRow['productName']; ?></td>
                <td><?php echo $perRow['productDescription']; ?></td>
                <td><?php echo $perRow['originalPrice']; ?></td>
                <td><?php echo $perRow['salePrice']; ?></td>
                <td><?php echo $perRow['category']; ?></td>
                <td><?php echo $perRow['productStock']; ?></td>
                <td><?php echo $perRow['productStatus']; ?></td>
                <td><?php echo $perRow['productSupplier']; ?></td>
                <td><?php echo $perRow['supplierContactNumber']; ?></td>
                <td><a href="d_u_d.php?idNumberToDelete=<?php echo $perRow['productID']; ?>">DELETE</td>
                <td><a href="editData.php?idNumberToUpdate=<?php echo $perRow['productID']; ?>">UPDATE</td>

            </tr>
        <?php } ?>
    </table>
</body>

</html>
