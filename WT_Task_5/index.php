<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
    body{
        font-family: "Helvetica";
        display: flex;
        flex-direction: column;
        text-align: center;
        align-items: center;
    }

    table{
        border-spacing: 15px 10px;
    }
    </style>
</head>

<body>
    <form method="get">
        <input type="text" name="number"/>
        <input type="submit" value="Вывод из owners" name="submit-owners"/>
        <input type="submit" value="Вывод из pets" name="submit-pets"/>
    </form>

<?php

require_once 'connection.php';
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Error " . mysqli_error($link));

//Вывод данных по заданию из таблицы owners
if(array_key_exists("number",$_GET) && array_key_exists("submit-owners",$_GET)){
    $number = trim( $_GET["number"]);
    if(ctype_digit(strval($number))){
        $query = "SELECT * FROM owners ORDER BY RAND() LIMIT $number";
        $result = mysqli_query($link,$query) or die("Error" . mysqli_error($link));
        if($result){
            echo "<table><tr><th>Id</th><th>FirstName</th><th>LastName</th><th>Phone</th><th>BirthDay</th></tr>";
            for($i = 0; $i < mysqli_num_rows($result); $i++){
                $row = mysqli_fetch_row($result);
                echo "<tr>";
                for($j = 0; $j < 5; $j++){
                    echo "<td>$row[$j]</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    } else {
        echo "Введено не целое число";
    }
}
//Вывод данных по заданию из таблицы pets
if(array_key_exists("number",$_GET) && array_key_exists("submit-pets",$_GET)){
    $number = trim( $_GET["number"]);
    if(ctype_digit(strval($number))){
        $query = "SELECT * FROM pets ORDER BY RAND() LIMIT $number";
        $result = mysqli_query($link,$query) or die("Error" . mysqli_error($link));
        if($result){
            echo "<table><tr><th>Id</th><th>OwnerId</th><th>Type</th><th>IsVaccined</th></tr>";
            for($i = 0; $i < mysqli_num_rows($result); $i++){
                $row = mysqli_fetch_row($result);
                echo "<tr>";
                for($j = 0; $j < 4; $j++){
                    echo "<td>$row[$j]</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    } else {
        echo "Введено не целое число";
    }
}

$query = "SELECT * FROM owners ORDER BY FirstName";
$result = mysqli_query($link,$query) or die("Error" . mysqli_error($link));

//Вывод таблицы owners
if($result){
    $rowsNum = mysqli_num_rows($result);
    echo "<table><tr><th>Id</th><th>FirstName</th><th>LastName</th><th>Phone</th><th>BirthDay</th></tr>";
    for($i = 0; $i < $rowsNum; $i++){
        $row = mysqli_fetch_row($result);
        echo "<tr>";
        for($j = 0; $j < 5; $j++){
            echo "<td>$row[$j]</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
mysqli_free_result($result);

$query = "SELECT * FROM pets ORDER BY OwnerId";
$result = mysqli_query($link,$query) or die("Error" . mysqli_error($link));

//Вывод таблицы pets
if($result){
    $rowsNum = mysqli_num_rows($result);
    echo "<table><tr><th>Id</th><th>OwnerId</th><th>Type</th><th>IsVaccined</th></tr>";
    for($i = 0; $i < $rowsNum; $i++){
        $row = mysqli_fetch_row($result);
        echo "<tr>";
        for($j = 0; $j < 4; $j++){
            echo "<td>$row[$j]</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
mysqli_free_result($result);

$query1 = "SELECT  FirstName, LastName, Id FROM owners ORDER BY FirstName";
$result1 = mysqli_query($link,$query1) or die("Error" . mysqli_error($link));

//Вывод по владельцам
if($result1){
    for($i = 0; $i < mysqli_num_rows($result1); $i++){
        $owner = mysqli_fetch_row($result1);
        echo "<h2>$owner[0] $owner[1]($owner[2])</h2>";
        $query2 = "SELECT Type, IsVaccined FROM pets WHERE OwnerId = $owner[2]";
        $result2 = mysqli_query($link,$query2) or die("Error" . mysqli_error($link));
        if($result2){
            if(mysqli_num_rows($result2) > 0){
                echo "<table><tr><th>Type</th><th>IsVaccined</th></tr>";
                for($j = 0; $j < mysqli_num_rows($result2); $j++){
                    $pet = mysqli_fetch_row($result2);
                    echo "<tr><td>$pet[0]</td><td>$pet[1]</td></tr>";                
                }
                echo "</table>";
            } else{
                echo "Питомцы отсутствуют";
            }
        }
        mysqli_free_result($result2);
    }
}
mysqli_free_result($result1);
mysqli_close($link);
?>
</body>
</html>
