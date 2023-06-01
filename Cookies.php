<style> body {background_color = white; text-align: center; } </style>

<?php
session_start();
?>
<h3>Cookies:</h3>
<?php
if ($_COOKIE) {
    foreach ($_COOKIE as $key => $value) {
        echo $key . ': ' . $value . "<br>";
    }
} else {
   echo "COOKIE is not set";    
}
?>
<a href="TheGame.php">Back to Guessing game</a>