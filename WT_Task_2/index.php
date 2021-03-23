<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body{
            display: flex;
            flex-direction: column;
            align-content: center;
            justify-content: center;
            text-align: center;
            font-size: 20px;
        }

        .menu__list{
             display: flex;
            flex-direction: row;
            align-content: center;
            justify-content: center;
            list-style-type:none;
        }

        .menu__list > li {
            margin: 0 20px 0 20px;
        }

        .menu__list > li > input{
            font-size:20px;
            border:none;
            padding: 10px;
        }

        .menu__list > li > input:hover{
            cursor: pointer;
            background: red;
        }
        </style>
</head>
<body>
    <form method="get">
        <nav class="menu">
            <ul class="menu__list">
                <li><input class="main" type="submit" name="main" id="main" value="Главная"/></li>
                <li><input class="products" type="submit" name="products" value="Товары"/></li>
                <li><input class="news" type="submit" name="news" value="Новости"/></li>
                <li><input class="aboutus" type="submit" name="aboutus" value="О нас"/></li>
                <li><input class="contacts" type="submit" name="contacts" value="Контакты"/></li> 
            </ul>
        </nav>
        
    </form>

    
    <?php

    function select($id){
        echo "<style>  
                    .$id {
                        background: red;
                    }
                </style>";
    }

    function is_correct_massive(...$massive){
        foreach($massive as $number){
            if(!is_numeric($number)){
                return false;
            }
            if(strpos($number,".")){
                return false;
            }
        }
        return true;
    }
    
    function main_func(){
        if(array_key_exists("massive_1",$_GET) && array_key_exists("massive_2",$_GET)){
            if($_GET["massive_2"] == "" && $_GET["massive_1"] == "" ){
                echo "<h1>Оба массива пусты</h1>";
                return;
            }
            if($_GET["massive_2"] == ""){
                echo "<h1>Второй массив пуст</h1>";
                return;
            }
            if($_GET["massive_1"] == ""){
                echo "<h1>Первый массив пуст</h1>";
                return;
            }
            
            $massive_1=explode(" ",trim($_GET["massive_1"]));
            $massive_2=explode(" ",trim($_GET["massive_2"]));


            if(!is_correct_massive(...$massive_1) || !is_correct_massive(...$massive_2)){
                echo "<h1>Введены некорректные данные</h1>";
                return;
            }

            $massive = [];

            foreach($massive_1 as $element){
                $massive[] = $element;
            }

            foreach($massive_2 as $element){
                $massive[] = $element;
            }

            print_r($massive_1);
            echo "<br>";
            print_r($massive_2);
            echo "<br>";
            
            $counter = 0;
            foreach($massive as $element){
                if($element % 2 == 0){
                    echo "$element ";
                    $counter++;
                }
            }

            if($counter == 0){
                echo "<h1>Чётных чисел не обнаружено</h1>";
            }

                
        } else{
            echo "<h1> Введите через пробел элементы массивов целых чисел:</h1>
                    <form method='GET'>
                    Massive_1 : <input type='text' name='massive_1'/>
                    Massive_2 : <input type='text' name='massive_2'/>
                    <input type='submit'/>
                    </form>";
        }
    }

    function products_func(){
        echo "<h1>Товары</h1>";
    }

    function news_func(){
        echo "<h1>Новости</h1>";
    }

    function aboutus_func(){
        echo "<h1>О нас</h1>";
    }

    function contacts_func(){
        echo "<h1>Контакты</h1>";
    }

    if(array_key_exists('main',$_GET)){
        main_func();
        select("main");
    }

    if(array_key_exists('massive_1',$_GET) && array_key_exists("massive_2",$_GET)){
        main_func();
        select("main");
    }

    if(array_key_exists("products",$_GET)){
        products_func();
        select("products");
    }

    if(array_key_exists("news",$_GET)){
        news_func();
        select("news");
    }

    if(array_key_exists("aboutus",$_GET)){
        aboutus_func();
        select("aboutus");
    }
    if(array_key_exists("contacts",$_GET)){
        contacts_func();
        select("contacts");
    }
    ?>
</body>
</html>
