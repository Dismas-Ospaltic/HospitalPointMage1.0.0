<?php
// Backup file path
$backupFilePath = 'C:/backupdata/medvina2023-08_22-08-53.sql.enc'; // Change the path and filename as needed

// Encryption key used for encryption
$encryptionKey = 'Dicy!2020'; // Should match the key you used for encryption

// Read the encrypted backup from the file
$encryptedBackup = file_get_contents($backupFilePath);

// Extract the initialization vector (IV) and encrypted data
$ivLength = openssl_cipher_iv_length('aes-256-cbc');
$iv = substr($encryptedBackup, 0, $ivLength);
$encryptedData = substr($encryptedBackup, $ivLength);

// Decrypt the data using OpenSSL
$decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $encryptionKey, 0, $iv);

// Save the decrypted data to a .sql file
$decryptedFilePath = 'C:/backupdata/decdata.sql'; // Change the path and filename as needed

if (file_put_contents($decryptedFilePath, $decryptedData)) {
    echo "Decrypted SQL dump saved successfully to: $decryptedFilePath\n";
} else {
    echo "Failed to save the decrypted SQL dump.\n";
}
?>
