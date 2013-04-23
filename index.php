<?php
    require_once 'config.php';
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
    <?php if ($_GET['f'] && file_exists($_GET['f'] . '.log')): ?>

    <div id="log">
    <h1> <?php echo $_GET['f'].'.log'; ?></h1>
        <?php echo nl2br(htmlentities(file_get_contents($_GET['f'] . '.log'))); ?>
    </div>

    <?php else: ?>

    <div id="page">

    <?php
    foreach (glob($config['globPattern']) as $file) {
        printf(
            '<a href="?f=%s" class="log_link">%s</a><br>',
            str_replace('.log', '', $file), $file
        );
    }
    ?>

    </div>
    <?php endif; ?>
</body>
</html>
