<?php
    // include the necessary files
    // require_once(dirname(__FILE__) . '/mysqldump-php-2.0.0/src/Ifsnop/Mysqldump/Mysqldump.php');
    include_once "Mysqldump.php";
    use Ifsnop\Mysqldump\Mysqldump;
    
    // Database connection parameters
    $host = 'localhost';
    $dbname = 'hpt_mage_sys_data';
    $username = 'root';
    $password = 'Mida!2022';
    
    $conn = mysqli_connect( $host, $username, $password, $dbname);
    if($conn){

    // Specify the directory path where you want to store the backup and encrypted files
    $backup_directory = 'http://ospalticsoftware.000webhostapp.com/MedvinaData/';
    $databKName = "medvina";
   
    // Ensure the directory exists, create it if not
    if (!is_dir($backup_directory)) {
        mkdir($backup_directory, 0777, true);
    }

$backupFilePath = $backup_directory . $databKName . date("Y-m_H-m-s") . '.sql.enc';

// Create a new Mysqldump instance
$dump = new Mysqldump("mysql:host=$host;dbname=$dbname", $username, $password);

// Dump the database to a file
try {
    $dump->start($backupFilePath);
    // echo "Database backup saved successfully\n";

    // Encrypt the backup using OpenSSL
    $encryptionKey = 'Dicy!2020'; // Replace with your encryption key
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encryptedBackup = openssl_encrypt(file_get_contents($backupFilePath), 'aes-256-cbc', $encryptionKey, 0, $iv);
    
    // Save the encrypted backup back to the file
    if (file_put_contents($backupFilePath, $iv . $encryptedBackup)) {
        echo "Encrypted backup saved successfully.\n";

        // setcookie('online_back_triger' ,'online_back_value',time() + 60 * 60 * 24 * 30, '/');
        setcookie('online_back_triger' ,'online_back_value',time() + 60, '/');
    } else {
        echo "Failed to save the encrypted backup.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

    }else{
        echo "Seems we are not connected to our database.";
    }
    
?>