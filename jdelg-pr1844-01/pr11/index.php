
<?php
    if ( (!isset($_POST["fbase"])) or (!isset($_POST["faltura"])) ) {
        echo "<h1>Caso 1</h1>";
        // echo "El valor de !isset(\$_POST[\"fbase\"]) es: ";
        // var_dump(!isset($_POST["fbase"]));
        // echo "<br>";
        // echo "El valor de !isset(\$_POST[\"faltura\"]) es: ";
        // var_dump(!isset($_POST["faltura"]));
        
        // var_dump($_POST["fbase"]);
        // echo "<p>El valor de \$_POST[\"fbase\"] es: ". var_dump($_POST["fbase"]) . "</p>";
        // echo "<p>El valor de \$_POST[\"faltura\"] es: ". var_dump($_POST["faltura"]) . "</p>";
        

        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <meta http-equiv='X-UA-Compatible' content='ie=edge'>
            <title>Problema 11 jdelg-pr1844-01</title>

            <!-- bootstrap 4 -->
            <!-- Latest compiled and minified CSS -->
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
        </head>
        <body>
        <div class='container'>
        <h2>Calculadora de área de un triángulo</h2>
        <p>Introduzca la base y la altura del triángulo</p>
        <form action='http://localhost/jdelg-pr1844-01/pr11/index.php' method='post'>
            <div class='form-group'>
            <input type='number' class='form-control' placeholder='Introduzca la base del triángulo' name='fbase'>
            </div>
            <div class='form-group'>
            <input type='number' class='form-control' placeholder='Introduzca la altura del triángulo' name='faltura'>
            </div>
            <button type='submit' class='btn btn-primary'>Calcular</button>
        </form>
        </div> ";       


    } else {
        echo "<h1>Caso 2</h1>";
       
        if (($_POST["fbase"] == "") or ($_POST["faltura"] == 0)) {
             echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <meta http-equiv='X-UA-Compatible' content='ie=edge'>
            <title>Problema 11 jdelg-pr1844-01</title>

            <!-- bootstrap 4 -->
            <!-- Latest compiled and minified CSS -->
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
        </head>
        <body>
        <div class='container'>
        <h2>Calculadora de área de un triángulo</h2>
        <p>Introduzca la base y la altura del triángulo</p>
        <form action='http://localhost/jdelg-pr1844-01/pr11/index.php' method='post'>
            <div class='form-group'>
            <input type='number' class='form-control' placeholder='Introduzca la base del triángulo' name='fbase'>
            </div>
            <div class='form-group'>
            <input type='number' class='form-control' placeholder='Introduzca la altura del triángulo' name='faltura'>
            </div>
            <button type='submit' class='btn btn-primary'>Calcular</button>
        </form>
        </div> 
        <h3>Introduzca los datos completos</h3>";       
        } else {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <meta http-equiv='X-UA-Compatible' content='ie=edge'>
            <title>Problema 11 jdelg-pr1844-01</title>

            <!-- bootstrap 4 -->
            <!-- Latest compiled and minified CSS -->
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
        </head>
        <body>
        <div class='container'>
        <h2>Calculadora de área de un triángulo</h2>
        <p>Introduzca la base y la altura del triángulo</p>
        <form action='http://localhost/jdelg-pr1844-01/pr11/index.php' method='post'>
            <div class='form-group'>
            <input type='number' class='form-control' placeholder='Introduzca la base del triángulo' name='fbase'>
            </div>
            <div class='form-group'>
            <input type='number' class='form-control' placeholder='Introduzca la altura del triángulo' name='faltura'>
            </div>
            <button type='submit' class='btn btn-primary'>Calcular</button>
        </form>
        </div> ";
        $base= $_POST["fbase"];
        $altura= $_POST["faltura"];
        $area= ($base * $altura) / 2;
        echo "<h3>El área del triángulo es: $area </h3>";        }

        

        // echo "<p>El valor de !isset(\$_POST[\"fbase\"] es: ". var_dump(!isset($_POST["fbase"])) . "</p>";
        // echo "<p>El valor de \$_POST[\"fbase\"] es: ". var_dump($_POST["fbase"]) . "</p>";
        // echo "<p>El valor de !isset(\$_POST[\"faltura\"] es: ". var_dump(!isset($_POST["faltura"])) . "</p>";
        // echo "<p>El valor de \$_POST[\"faltura\"] es: ". var_dump($_POST["faltura"]) . "</p>";

        




        
    }
?>











<!-- ********* scripts de bootstrap 4 ****** -->
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    
</body>
</html>