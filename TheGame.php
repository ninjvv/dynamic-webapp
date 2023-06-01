<style> body {background_color = white; text-align: center; } </style>

<?php
session_start();
if (isset($_POST['set_color']))
    setcookie('color', $_POST['color'], time() + 15, "/");
if (isset($_COOKIE['color'])) echo "<body style=background-color:".$_COOKIE['color'].">";
if (isset($_POST['set_name']))
    setcookie('name', $_POST['name'], time() + 15, "/");
if (isset($_COOKIE['name'])) echo "<h3>Hello ".$_COOKIE['name']."!</h3>";
?>

<form method="POST" action="TheGame.php">
    <p>Background color: <select name='color' id='color'>
        <option value="red">red</option>
        <option value="blue">blue</option>
        <option value="green">green</option>
        <option value="yellow">yellow</option>
    </select>
    <input type="submit" name="set_color" value="Set"></p>
</form>

<form method="POST" action="TheGame.php">
    <p>Name: <input type="text" name="name">
    <input type="submit" name="set_name" value="Set"></p>
</form>

<h3>Guessing game</h3>
<form method="POST" action="TheGame.php">
    <p>Upper limit: <input type="number" name="n" value=1 min=1>
    <input type="submit" name="set_limit" value="Set"></p>
</form>

<?php
if (isset($_POST['set_limit']) && $_POST['n'] != '') {
    $_SESSION['history'] = array();
    $_SESSION['n'] = $_POST['n'];
    $_SESSION['number'] = rand(0, $_SESSION['n']);
}
$max = 0;
if (isset($_SESSION['n']) && $_SESSION['n'] != '') {
    echo "<p>Guess the number from [0, ".$_SESSION['n']."]</p>";
    $max = $_SESSION['n'];
}
?>

<form method="POST" action="TheGame.php">
    <p>Guess the number: <input type="number" name="guess" value=0 min=0 max=<?php echo $max?>>
    <input type="submit" name="set_guess" value="Guess"></p>
</form>

<?php
if (isset($_POST['set_guess']) && isset($_SESSION['number'])) {
    $guess = $_POST['guess'];
    array_push($_SESSION['history'], $guess);
    if ($guess < $_SESSION['number']) {
        echo "<h4> Your Guessed Number is Too Low </h4>";
    } else if ($guess > $_SESSION['number']) {
        echo "<h4> Your Guessed Number is Too High </h4>";
    } else if ($guess == $_SESSION['number']) {
        echo "<h4> You Guessed The Correct Number " . $guess . "</h4>";
        echo "<script>
            setTimeout(function(){ alert('Congratulations'); }, 2000);
        </script>";
        header('refresh: 3; url=TheGame.php');
        session_destroy();
    }
    $stringArray = implode(" ", $_SESSION['history']);
    echo "<p>History: " . $stringArray . "</p>";
}
?>
<br><br>
<a href="Cookies.php"><img src="cookies.png" alt="The cookie button"></a>