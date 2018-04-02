
<!doctype html>
<html>
    <head> 
        <meta charset="utf-8" /> 
		<title>Request Form</title>
        <link rel="stylesheet" href="requestFormStyles.css" />
		
	</head>

	<body>
		<form action="processRequest.php" method="post">
            <fieldset>
				<h1>Order Request Form</h1>

                <b>Lastname: </b><input id="name" type="text" name="lastname" />
                <b>Firstname: </b><input id="name" type="text" name="firstname" />
				<br /><br />
				
                <b>Email: </b><input required="required" id="account" type="text" name="email" placeholder="example@notreal.notreal" /><br /><br />

                <b>Shipping Method:</b>
                <input type="radio" name="shippingmethod" id="UPS" value="UPS" /><label for="UPS">UPS</label>
				<input type="radio" name="shippingmethod" id="FedEx" value="FedEx" /><label for="FedEx">FedEX</label>
				<input type="radio" name="shippingmethod" id="USPS" value="USPS"  checked="checked" /><label for="USPS">USMAIL</label>
                <input type="radio" name="shippingmethod" id="Other" value="Other" /><label for="Other">OTHER</label>
				<br /><br>


				<b>Softwares:</b><br />
				<select style="height: 75px" name="softwaresselected[]" multiple="multiple">

				<?php
				include 'softwares.php';
				printSoftwares($softwares)
				?>
				</select>
                <br /><br />

				<b>Order Specifications </b>
				<br />

				<textarea name="specification" rows="5" cols="75" id ="specification"></textarea>
				<br /><br />



                <input type="reset" value="Reset Fields"/>
                <input type="submit" value="Submit Request"/>
            </fieldset>
        </form>
    </body>
</html>


<?php
	function printSoftwares($x) {
		
		foreach ($x as $key => $value) 
			print "<option value=$key> $key ($$value)";
			print "</option>";

	}
?>