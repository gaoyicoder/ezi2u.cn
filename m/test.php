<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 5/2/16
 * Time: 3:38 PM
 */
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
<br />
<br />
<br />
<br />
<br />
<br />
<a href="javascript:;" class="btn" onclick="test();">Scan Code</a>
<script type="text/javascript">
    function test(){
        alert('111');
    }
</script>

<a href="javascript:;" class="btn" onclick="scanCode();">Scan Code</a>
<script type="text/javascript">
    function scanCode() {
        cordova.plugins.barcodeScanner.scan(
            function (result) {
                alert("We got a barcode\n" +
                    "Result: " + result.text + "\n" +
                    "Format: " + result.format + "\n" +
                    "Cancelled: " + result.cancelled);
            },
            function (error) {
                alert("Scanning failed: " + error);
            }
        );
    }
</script>
<script type="text/javascript" src="cordova.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</body>
</html>