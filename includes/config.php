    <?php

    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = '';
    const DB_NAME = 'leave_staff';
    const LEAVE_DAYS = 28;
    define("BASE_PATH", $_SERVER['SERVER_NAME'].'/'.$_SERVER['REQUEST_URI']);

    $conn = mysqli_connect('localhost','root','','leave_staff') or die(mysqli_error());

    // Establish database connection.
    try
    {
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch (PDOException $e)
    {
    exit("Error: " . $e->getMessage());
    }


    ?>
