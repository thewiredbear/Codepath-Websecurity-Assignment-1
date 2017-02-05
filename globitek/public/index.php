<html>
<head><link rel="stylesheet" type="text/css" href="styles.css"></head>
<body>
<div id="topBar"><p style="">Tip Calculator</p></div>
<div id="mainBox">
	<div id="contentBox">
		<div id="headingBox">Tip Calculator</div>
		<div id="inputBox">
			<form action="" method="POST">
				<?php
					if(isset($_POST["submitButton"])){
						if($_POST["subTotal"]>0){
							echo "Bill Subtotal : <input type=\"number\" min=\"0\" step=\"0.01\" name=\"subTotal\" value=\"".$_POST["subTotal"]."\"><br><br>";
						}else{
							echo "Bill Subtotal : <input type=\"number\" min=\"0\" step=\"0.01\" name=\"subTotal\"><br><br>";
						}
					}else{
							echo "Bill Subtotal : <input type=\"number\" min=\"0\" step=\"0.01\" name=\"subTotal\"><br><br>";
						}
				?>
				Tip Percentage : <br>
				<?php
					for($i=1;$i<=3;$i++){
						$percent = $i*5 + 5;
						if(isset($_POST["submitButton"])){
							if($_POST["subTotal"]>0 && $_POST["val"]==$percent){
								echo "<input type=\"radio\" name=\"val\" value=\"".$percent."\" checked>".$percent."%";
							}else{
								echo "<input type=\"radio\" name=\"val\" value=\"".$percent."\">".$percent."%";
							}
						}else{
								echo "<input type=\"radio\" name=\"val\" value=\"".$percent."\">".$percent."%";
							}
					}
					if(isset($_POST["submitButton"]) && $_POST["subTotal"] && $_POST["val"]=="custom" && isset($_POST["splits"])){
						$textInput = "<input type=\"number\" step=\"0.01\" name=\"customTip\" value=\"".$_POST["customTip"]."\">";
						echo "<input type=\"radio\" name=\"val\" value=\"custom\" checked>"."Custom".$textInput;
						echo "<br>";
						echo "Split: <input type=\"number\" name=\"splits\" id=\"splits\" min=\"1\" value=".$_POST["splits"]."> person(s)";
					}else{
						$textInput = "<input type=\"number\" step=\"0.01\" name=\"customTip\">";
						echo "<input type=\"radio\" name=\"val\" value=\"custom\">"."Custom".$textInput;
						echo "<br>";
						echo "Split: <input type=\"number\" name=\"splits\" id=\"splits\" min=\"1\" value=".$_POST["splits"]."> person(s)";
					}
				?>
				<br><br>
				<input style="margin-left:150px;" type="submit" name="submitButton" Value="Submit">
			</form>
		</div>
		<?php
				if(isset($_POST["submitButton"])){
					$givenValue = $_POST["subTotal"];
					$tipValue = $_POST["val"];
					if($tipValue=="custom"){
						$tempTip = (double)$_POST["customTip"];
						$type = gettype($tempTip);
						if($type=="double" || $type=="integer"){
							$tipValue=$tempTip;
						}else{
							$tipValue=-1;
						}
					}
					if($givenValue>0 && $tipValue>0 && $_POST["splits"]>0){
						$finalTip = $givenValue * ($tipValue/100);
						if($_POST["splits"]=="1"){
							echo "<div id=\"resultBox\">";
							echo "<p class=\"result\">Final Tip: ".(round($finalTip,2))."</p>";
							echo "<p class=\"result\">Final Bill: ".(round($givenValue+$finalTip,2))."</p>";
							echo "</div>";
						}else{
							echo "<div id=\"resultBox\"";
							echo "<p class=\"result\">Final Tip: ".(round($finalTip,2))."</p>";
							echo "<p class=\"result\">Final Bill: ".(round($givenValue+$finalTip,2))."</p>";
							echo "<p class=\"result\">Each Tip: ".(round($finalTip/$_POST["splits"],2))."</p>";
							echo "<p class=\"result\">Each Total: ".(round(($givenValue+$finalTip)/$_POST["splits"],2))."</p>";
							echo "</div>";
						}
					}
				}
			?>
	</div>
	<div id="linkBox">
		<a href="Week1/globitek/public/salesperson.php">Week 1</a>
	</div>
</div>
</body>
</html>
