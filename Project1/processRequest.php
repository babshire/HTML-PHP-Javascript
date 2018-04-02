<!doctype html>
<html>
    <head> 
        <meta charset="utf-8" /> 
		<title>Order Confirmation</title>	
        <link rel="stylesheet" href="requestFormStyles.css" />
	</head>

	<body>
        <fieldset>
		    <?php 
                $firstnameSubmitted = $_POST['firstname'];
                $lastnameSubmitted = $_POST['lastname'];
                $email = $_POST['email'];
                $shippingMethod = $_POST['shippingmethod'];
                $specifications = $_POST['specification'];
                $softwareList = $_POST["softwaresselected"];
            

                echo "<h1>Order Confirmation</h1>";
                echo "<b>Lastname:</b>" .trim($lastnameSubmitted). ", &nbsp;&nbsp;";
                echo "<b>Firstname:</b>" .trim($firstnameSubmitted). ", &nbsp;&nbsp;";
                echo "<b>Email:</b> $email";
                echo "<br/><br/>";

                echo "<b>Shipping Method:</b> $shippingMethod";
                echo "<p></p>";



                include 'softwares.php';
                echo "<b>Software Order: </b><p></p>";
                echo "<table border=\"1\">";
                    echo "<tr>";
                        echo "<td><b>Software</b></td>";
                        echo "<td><b>Cost</b></td>";
                        foreach($softwares as $key=>$value) {
                            if (in_array($key, $softwareList)) {
                                echo "<tr>";
                                    echo "<td>$key</td>";
                                    echo "<td>$$value</td>";
                                echo "</tr>";
                            }
                        }
                    echo "<tr>";
                        echo "<td>Total</td>";
                        $sum=0;
                        foreach($softwares as $key=>$value) {
                            if (in_array($key, $softwareList)) {
                                $sum = $sum + $value;
                            }
                        }
                        echo "<td>$$sum</td>";
                    echo "</tr>";
                echo "</table><br />";

                
                
                echo "<b>Order Specifications: </b>";
                echo "<br />";
                echo "<i>" .nl2br($specifications). "</i>";


            ?>		
        </fieldset>
   </body>
</html>