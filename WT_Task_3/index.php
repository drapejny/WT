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

    .container{
        display: flex;
        justify-content: space-between;
        max-width: 900px;
        margin: auto;
    }
    </style>
</head>

<body>

  <h1>Введите путь к каталогу:</h1>
  <form method="POST">
  <input class="input" type="text" name="path"/>
  <input class="submit-btn" type="submit"/>

  <?php
  function recursion($path)
  {
      $out = array();
      foreach(glob($path . '/*') as $file) {
          if (is_dir($file)) {
              $out = array_merge($out, recursion($file));
          } else {
              $out[] = $file;
          }
      }
   
      return $out;
  }

  function is_correct_path($path){
      if(!file_exists($path)){
          echo "<h1>Введён неверный путь к каталогу.</h1>";
          return false;
      }
      if(is_file($path)){
          echo "<h1>Введён путь к файлу. Введите путь к каталогу.</h1>";
          return false;
      }
      return true;
  }
  if(array_key_exists("path",$_POST)){
      if(is_correct_path($_POST["path"])){
        $files = recursion($_POST["path"]);
        $size_of_files = 0;
        $file_counter = 0;
        foreach($files as $file){
            $size_of_files += filesize($file);
            $file_counter++;
            echo "<div class='container'>
                    <span class='container__item'>"
                     . $file .
                      "</span>
                    <span class='container__item'>"
                     . filesize($file) .
                      "</span></div>";

        }
        if ($file_counter == 0){
            echo "<br><h1>Файлов не найдено</h1>";
        } else
            echo "<br>Общий размер файлов: $size_of_files";
      }
  
    }
  ?>

</body>
</html>
