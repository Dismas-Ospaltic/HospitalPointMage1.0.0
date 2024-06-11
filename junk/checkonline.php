<html>
<head>
    <title>Check Internet Connection</title>
</head>
<body>
    <script type="text/javascript">
        function checkInternetConnection() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'check_connection.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    if (xhr.responseText === "online") {
                        // Internet connection is online
                        console.log("Online");
                    } else {
                        // Internet connection is offline
                        console.log("Offline");
                    }
                }
            }; 
            xhr.send();
        }

        checkInternetConnection();
    </script>
</body>
</html>
