<?php

$text = (! empty ($_POST ['text'])) ? $_POST ['text'] : '';
?>

<h2>Text to decode:</h2>

<form method = "post">
<textarea rows = "10" cols = "70" name = "text"><?=$text;?></textarea>
<br>
<input type = "submit">
</form>



<?php

$lines = explode ("\n", $text);

foreach ($lines as & $line) {
    $line = trim ($line);
    $comments = array ("//", "#");
    foreach ($comments as $comment) {
        if (($pos = strpos ($line, $comment)) !== false) {
            $line = substr ($line, 0, $pos);
        }
    }
}

$text = join (' ', $lines);

$text = base64_decode($text);
?>

<h2>Result:</h2>

<textarea rows = "10" cols = "70" name = "text"><?=$text;?></textarea>
