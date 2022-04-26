<h3> Schemers </h3>
<br>
<br>
<?php   
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PWD", "");
    define("DB_NAME", "addresstable");
    
    
    $mysqli = new mysqli(DB_SERVER, DB_USER, DB_PWD, DB_NAME);
    
    if($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

    $sql = "SELECT * FROM MOCK_ADDRESS;";

    $result= $mysqli->query($sql);
    if (!$result) {
        exit("Database query failed.");
    }

?>


<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <table class="list">
        <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['AddressID']; ?></td>
                <td><?php echo $row['ZipCodeID']; ?></td>
                <td><?php echo $row['TimeStamp']; ?></td>
                <td><?php echo $row['StreetAddress']; ?></td>
            </tr>
       <?php } ?>
    </table>
</body>

</html>


<?php
$result->free_result();
if(is_resource($mysqli)) {
    $mysqli->close();
}
?>