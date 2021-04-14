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
    </style>
</head>

<body>

    <form method="POST">
        <h1>Введите текст</h1>
        <p><textarea rows="15"cols="50" name="text"></textarea></p>
        <p><input type="submit" value="Отправить"></p>
    </form>
  <?php
  function myRound($stringValue){
      echo '!' . $stringValue . '!';
      $floatValue = floatval($stringValue);
      $floatValue = round($floatValue,1);
      return $floatValue;
  }
    if (array_key_exists("text",$_POST)){
        $text = htmlentities($_POST["text"]);
        $text = preg_replace('/\n/',"\n<br>\n",$text);
        echo $text . '<br><br>';
        $text = preg_replace_callback_array(
            [
                '/((?<=\s|^)[+-]?\d+(?=\s|$))/' => function ($match) {
                    return "<span style='color: blue;'>$match[0]</span>";
                },
                '/((?<=\s|^)[+-]?(0|[1-9]\d*)\.(0|\d*[1-9])(?=\s|$))/' => function($match){
                    return "<span style='color: red;'>" . round(floatval($match[0]),1) . "</span>";
                },
                '/((?<=\s|^)[A-ZА-ЯЁ]\S*(?=\s|$))/' => function($match){
                    return "<span style='color:#00FF00;'>$match[0]</span>";
                }
            ],
            $text
        );
        echo $text;
    }
  ?>

</body>
</html>
