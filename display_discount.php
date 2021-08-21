<?php
	//GET POSTs FROM INDEX.PHP
	$product_description = filter_input(INPUT_POST, 'product_description');
	$list_price = filter_input(INPUT_POST, 'list_price');
	$discount_percent = filter_input(INPUT_POST, 'discount_percent');

	//VALIDATE DATA
	if (empty($product_description)) {
		$error_message = 'Product Description must have a valid entry';
	} elseif (empty($list_price)) {
		$error_message = 'List Price must have a valid entry';
	} elseif (empty($discount_percent)) {
		$error_message = 'Discount Percent must have a valid entry';
	} elseif (!is_numeric($list_price)) {
		$error_message = 'List Price must be a number';
	} elseif ($list_price < 0) {
		$error_message = 'List Price must be greater than or equal to 0';
	} elseif (!is_numeric($discount_percent)) {
		$error_message = 'Discount Percent must be a number';
	} elseif ($discount_percent < 0) {
		$error_message = 'Discount Percent must be greater than or equal to 0';
	} else {
		$error_message = '';
	}

	//ROUTE TO INDEX.PHP IF ERROR MESSAGE EXISTS
	if ($error_message != '') {
		include('index.php');
		exit();
	}

	//CALCULATE DISCOUNT AMOUNT & PRICE
	$discount = $list_price * $discount_percent * .01;
	$discount_price = $list_price - $discount;

	//SALES TAX VARIABLES
	$sales_tax_rate = 8;
	$tax_amount = $discount_price * $sales_tax_rate * .01;
	$total_price = $discount_price + $tax_amount;


	//VARIABLE FORMATTING
	$list_price_formatted = '$'.number_format($list_price, 2);
	$discount_percent_formatted = $discount_percent.'%';
	$discount_formatted = '$'.number_format($discount, 2);
	$discount_price_formatted = '$'.number_format($discount_price, 2);

	$sales_tax_rate_formatted = $sales_tax_rate.'%';
	$tax_amount_formatted = '$'.number_format($tax_amount, 2);
	$total_price_formatted = '$'.number_format($total_price, 2);	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
    <div id="content">
        <h1>Product Discount Calculator</h1>

        <label>Product Description:</label>
        <span><?php echo htmlspecialchars($product_description); ?></span><br />

        <label>List Price:</label>
        <span><?php echo htmlspecialchars($list_price_formatted); ?></span><br />

        <label>Standard Discount:</label>
        <span><?php echo htmlspecialchars($discount_percent_formatted); ?></span><br />

        <label>Discount Amount:</label>
        <span><?php echo $discount_formatted; ?></span><br />

        <label>Discount Price:</label>
        <span><?php echo $discount_price_formatted; ?></span><br />

				<p>&nbsp;</p>

				<label>Tax Rate:</label>
        <span><?php echo $sales_tax_rate_formatted; ?></span><br />

				<label>Tax Amount:</label>
        <span><?php echo $tax_amount_formatted; ?></span><br />

				<label>Total Price:</label>
        <span><?php echo $total_price_formatted; ?></span><br />

        <p>&nbsp;</p>
    </div>
</body>
</html>