<?php
if(!empty($_POST)){
    if(array_key_exists('set-submit',$_POST)){
    $name = $_POST["name"];
    $value = $_POST["value"];
    $time = $_POST["time"];
    if(ctype_digit(strval($time))){
        setcookie($name,$value,time() + $time);
    } else {
        echo "Невалидные данные";
    }
    
}
if(array_key_exists('delete-submit',$_POST)){
    $name = $_POST["name"];
    if($name != "")
    setcookie($name,"",time() - 100);
}
header("Location:index.php");
}

?>
<html>
<style>
body{
    text-align: center;
    align-items: center;
}
</style>
<body>
<form method='POST' action="index.php">
name<input type='text' name='name'/><br>
value<input type='text' name='value'/><br>
time<input type='text' name='time'/><br>
<input type='submit' value='Set' name='set-submit'/>
<input type='submit' value='Delete' name='delete-submit'/>
</form>
<?php
//    foreach($_COOKIE as $cookie)
//    echo $cookie . '<br>';
while($cookieValue = current($_COOKIE)){
    echo key($_COOKIE) . " : " . $cookieValue . "<br>";
    next($_COOKIE);
}
//    echo count($_COOKIE) . "<br>";

//       foreach($_COOKIE as $cookie)
//    echo $cookie . '<br>';



?>
</body>
</html>
