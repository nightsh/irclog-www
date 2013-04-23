<?php
    header('Content-type: text/html; charset=utf-8');
    require_once("./config.php");
    global $config;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='<?php echo $config['charset']; ?>'>
    <title>Logs</title>
    <link rel="stylesheet" href="./style.css" />
</head>

<body>
    <?php if (isset($_GET['f']) && file_exists($_GET['f'] . '.log')): ?>

    <div id="log">
    <h1> <?php echo $_GET['f'].'.log'; ?></h1>
         <?php echo nl2br(htmlentities(file_get_contents($_GET['f'] . '.log'))); ?>
    </div>

    <?php else: ?>

    <div id="page">

    <?php
    $files = array();
    foreach (glob($config['globPattern']) as $file) {
        $date = preg_replace(
            '/.*([0-9]{4})([0-9]{2})([0-9]{2}).*\.log$/',
            '\1-\2-\3', $file
        );
        $files["$date"] = $file;
        //$files["$date"] = str_replace('.log','',$file);
    }

    asort($files);
    $files = array_reverse($files);

    ?>

    <table>
    <?php
    foreach ($files as $date => $file) {
        printf(
            '<tr><td><span class="date">' . $date
            . '</span></td><td>'
            . '<a href="?f=%s" class="log_link">%s</a></td>',
            str_replace('.log', '', $file), $file
        );
    }
    ?>
    </table>

    </div>
    <?php endif; ?>
</body>
</html>
