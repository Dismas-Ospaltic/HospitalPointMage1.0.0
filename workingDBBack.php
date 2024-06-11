<?php
//  $dbhost = 'localhost';
//  $dbuser = 'root';
//  $dbpass = 'Mida!2022';
//  $dbname = 'hpt_mage_sys_data';
//  $dataPath = 'C:/backupdata/';
//  $backup_file = $dataPath . $dbname . date("Y-m-d-H-i-s") . '.sql';
//  $command = "mysqlidump --opt -h $dbhost -u $dbuser -p $dbpass -d $dbname > $backup_file";
 
//  system($command);




    // // include_once(dirname(__FILE__) . '/mysqldump-php-2.0.0/src/Ifsnop/Mysqldump/Mysqldump.php');
    // include_once "Mysqldump.php";

    // $dump = new Ifsnop\Mysqldump\Mysqldump('mysql:host=localhost;dbname=hpt_mage_sys_data', 'root', 'Mida!2022');
    // // $dump->start('storage/work/dump.sql');
    // $dump->start('C:/backupdata/dump.sql');
    
    
    // include the necessary files
    // require_once(dirname(__FILE__) . '/mysqldump-php-2.0.0/src/Ifsnop/Mysqldump/Mysqldump.php');



    // include the necessary files
    // require_once(dirname(__FILE__) . '/mysqldump-php-2.0.0/src/Ifsnop/Mysqldump/Mysqldump.php');
    include_once "Mysqldump.php";
    use Ifsnop\Mysqldump\Mysqldump;
    
    // Database connection parameters
    $host = 'localhost';
    $dbname = 'hpt_mage_sys_data';
    $username = 'root';
    $password = 'Mida!2022';
    

    
    // Backup file path
    $backupFilePath = 'C:/backupdata/dump.sql.enc'; // Change the path and filename as needed
    
    // Create a new Mysqldump instance
    $dump = new Mysqldump("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Dump the database to a file
    try {
        $dump->start($backupFilePath);
        echo "Database backup saved successfully to: $backupFilePath\n";
    
        // Encrypt the backup using OpenSSL
        $encryptionKey = 'key123'; // Replace with your encryption key
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encryptedBackup = openssl_encrypt(file_get_contents($backupFilePath), 'aes-256-cbc', $encryptionKey, 0, $iv);
        
        // Save the encrypted backup back to the file
        if (file_put_contents($backupFilePath, $iv . $encryptedBackup)) {
            echo "Encrypted backup saved successfully.\n";
        } else {
            echo "Failed to save the encrypted backup.\n";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
    



    


?>