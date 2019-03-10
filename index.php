<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Fight Arena</title>
        <link href="css/style.css" rel="stylesheet">
        <script src="js/script.js"></script>
    </head>
    <body>
        <div class="container">
            <p>
                If you're feeling ready to fight, click the button below!
            </p>
            <form method="post">
                <input id="fight" type="submit" name="submit" value="Fight!" />
            </form>
        </div>
        <div class="container">
            <?php
            if(!empty($_POST)) {
                require_once('Game/Application.php');
                try {
                    $app = \Game\Application::getInstance();
                    $app->run();
                } catch (\Exception $exception) {
                    echo $exception->getMessage();
                }
            }
            ?>
        </div>
    </body>
</html>