<?php
// run main function only if accessed directly. Not if accessed from another module via require_once()
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
    require_once('../base.php');
    getZipAPI();
}

function getZipAPI() {
    if (isset($_GET['zipcode'])) {
        $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);
        [$error, $zipinfo] = getZip($_GET['zipcode'], $conn);
        if (isset($error)) {
            echo "{'warning': '{$error}'}";
        }
        else {
            echo json_encode($zipinfo);
        }
    }
    else {
        echo "{'error': 'No Zip requested'}";
    }
    $conn->close();
}

function getZip($zipcode, $conn) {
    $stmt = $conn->prepare("SELECT ZipCodeID, City, StateID FROM ZipCodes WHERE ZipCodeID = ?");
    $stmt->bind_param('i', $zipcode);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if (isset($row['ZipCodeID'])) {
        return [NULL, $row];
    }
    else {
       return ['Zip Not Found', NULL] ;
    }
}

?>
