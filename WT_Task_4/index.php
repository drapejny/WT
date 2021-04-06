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
        text-align: center;
        align-items: center;
    }

    .int-num{
        color:blue;
    }

    .float-num{
        color:red;
    }
    .uppercase-letter-word{
        color: green;
    }

    </style>
</head>

<body>

    <form method="POST">
        <h1>Введите текст</h1>
        <p><textarea rows="15"cols="50" name="text"></textarea></p>
        <p><input type="submit" value="Отправить"></p>
    </form>
  <?php
    if (array_key_exists("text",$_POST)){
        $text = htmlentities($_POST["text"]);
        $words = preg_split('/\s+/',$text);
        echo "$text <br><br>";
        foreach($words as $word){
            if(preg_match('/^[+-]?\d+$/',$word))
                 echo "<span class='int-num'>$word</span> ";
            else if(preg_match('/^[-+]?[0-9]*[.,][0-9]+(?:[eE][-+]?[0-9]+)?$/',$word)){
                $rounded_num = round($word,1);
                echo "<span class='float-num'>$rounded_num</span> ";
            }
            else
                if(preg_match('/^[A-ZА-ЯЁ].*$/',$word))
                echo "<span class='uppercase-letter-word'>$word</span> ";
                else
                echo "$word ";
        }
    }
  ?>

</body>
</html>
