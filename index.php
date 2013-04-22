<!DOCTYPE html>
<html>
<head>
    <title>Logs</title>
    <link rel="stylesheet" href="./style.css" />
</head>

<body>
    <?php if ($_GET['f'] && file_exists($_GET['f'] . '.log')): ?>

    <div id="log">
    <h1> <?php echo $_GET['f'].'.log'; ?></h1>
        <?php echo nl2br(file_get_contents($_GET['f'] . '.log')); ?>
    </div>

    <?php else: ?>

    <div id="page">

    <?php
    foreach (glob('*.log') as $file) {
        if(!preg_match("/^ChanServ.*/", $file))
            printf(
                '<a href="?f=%s" class="log_link">%s</a><br>',
                str_replace('.log','',$file), $file
            );
    }
    ?>

    </div>
    <?php endif; ?>
</body>
</html>
