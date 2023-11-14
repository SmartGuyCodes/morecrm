<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Simple Invoice</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        *{
            font-family: arial;
        }
        .invoice_container{
            padding: 10px 10px;
        }
        .invoice_header{
            display: flex;
            justify-content: space-between;
            width: 100%;
            background: #e7c9c9;
        }
        .logo_container{
            margin-top: auto;
            margin-bottom: auto;
            margin-left: 10px;
        }
        .company_address{
            margin-right: 10px;
        }
        .invoice_header h2{
            margin-bottom: 0;
        }
        .invoice_header p{
            margin-top: 10px;
        }
        .logo_container img{
            height: 60px;
        }
        .customer_container{
            padding: 0 10px;
            display: flex;
            justify-content: space-between;
        }
        .customer_container h2{
            margin-bottom: 10px;
        }
        .customer_container h4{
            margin-bottom: 10px;
            margin-top: 0;
        }
        .customer_container p{
            margin: 0;
        }
        .in_details{
            margin-top: auto;
            margin-bottom: auto;
        }
        .product_container{
            padding: 0 10px;
            margin-top: 10px;
        }
        .item_table{
            width: 100%;
            text-align: left;
        }
        .item_table td,th{
            padding: 5px 10px;
        }
        .invoice_footer{
            padding: 0 10px;
            display: flex;
            justify-content: space-between;
        }
        .invoice_footer h2{
            margin-bottom: 10px;
        }
        .note{
            width: 50%;
        }
        .invoice_footer_amount{
            margin: auto 0;
            background: #e7c9c9;
        }
        .amount_table td,th{
            padding: 5px 10px;
        }
        .in_head{
            margin: 0;
            text-align: center;
            background: #e7c9c9;
            padding: 5px;
        }
    </style>
</head>
<body>
	<div class="invoice_container">
		{{-- <div class="invoice_header">
			<div class="logo_container">
				<img src="https://webeecafe.com/public/assets/img/wclogo.png">
			</div>
			<div class="company_address">
				<h2>Webeecafe Ltd.</h2>
				<p>
					ATTN: Dennis Menees, CEO <br>
					Global Co. <br>
					90210 Broadway Blvd. <br>
					Nashville, TN 37011-5678
				</p>
			</div>
		</div>
		<div class="customer_container">
			<div>
				<h2>Billing To</h2>
				<h4>Bharathraj Talthaje</h4>
				<p>
					ATTN: Dennis Menees, CEO <br>
					Global Co. <br>
					90210 Broadway Blvd. <br>
					Nashville, TN 37011-5678
				</p>
			</div>
			<div class="in_details">
				<h1 class="in_head">Goods Received Note</h1>
				<table>
					<tr>
						<td>GRN No</td>
						<td>:</td>
						<td><b>#000001</b></td>
					</tr>
					<tr>
						<td>Due Date</td>
						<td>:</td>
						<td><b>26 October 2022</b></td>
					</tr>
					<tr>
						<td>Bill No</td>
						<td>:</td>
						<td><b>02500</b></td>
					</tr>
				</table>
			</div>
		</div> --}}
		<div class="product_container">
			<table class="item_table" border="1" cellspacing="0">
				<tr>
					<th>Sl. No.</th>
					<th>Item</th>
					<th>Price</th>
					<th>Qty</th>
					<th>Discount</th>
					<th>Total</th>
				</tr>
				<tr>
					<td>1</td>
					<td>Samsun M31 mobile</td>
					<td>20,000</td>
					<td>2</td>
					<td>2000</td>
					<td>38000</td>
				</tr>
				<tr>
					<td>2</td>
					<td>Samsun M31 mobile</td>
					<td>20,000</td>
					<td>2</td>
					<td>2000</td>
					<td>38000</td>
				</tr>
				<tr>
					<td>3</td>
					<td>Samsun M31 mobile</td>
					<td>20,000</td>
					<td>2</td>
					<td>2000</td>
					<td>38000</td>
				</tr>
				<tr>
					<td>4</td>
					<td>Samsun M31 mobile</td>
					<td>20,000</td>
					<td>2</td>
					<td>2000</td>
					<td>38000</td>
				</tr>
				<tr>
					<th colspan="4">Total</th>
					<th>8000</th>
					<th>152000</th>
				</tr>
			</table>
		</div>
		<div class="invoice_footer">
			<div class="note">
				<h2>Thank You!</h2>
				<p>
					Simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
				</p>
			</div>
			<div class="invoice_footer_amount">
				<table class="amount_table"   cellspacing="0">
					<tr>
						<td>Tax amount</td>
						<td>: <b>6000</b></td>
					</tr>
					<tr>
						<td>Grand Total</td>
						<td>: <b>160500</b></td>
					</tr>
					<tr>
						<td>Paid amount</td>
						<td>: <b>156000</b></td>
					</tr>
					<tr>
						<td>Due amount</td>
						<td>: <b>10000</b></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>