<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Fight Arena</title>
    </head>
    <body>
        <p>
            If you're feeling ready to fight, click the button below!
        </p>
        <form method="post">
            <input type="submit" name="submit" class="submit" value="Fight!" />
        </form>
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
    </body>
</html>