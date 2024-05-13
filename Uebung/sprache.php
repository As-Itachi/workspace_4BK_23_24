<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Language Website</title>
</head>
<body>
    <?php
    $lang_file = "lang_rs.php";
    if(isset($_GET['lang'])) {
        if($_GET['lang'] == 'de') {
            $lang_file = "lang_de.php";
        } elseif ($_GET['lang'] == 'en') {
            $lang_file = "lang_en.php";
        }
    }
    include($lang_file);
    ?>
    <h1><?php echo $lang['heading']; ?></h1>
    <p><?php echo $lang['label']; ?></p>
    <a href="?lang=en">English</a> | <a href="?lang=de">Deutsch</a> | <a href="?lang=rs">Српски</a>
    <button><?php echo $lang['button']; ?></button>
</body>
</html>
