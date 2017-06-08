<?php
$file = fopen("responseText.txt", "r");
$read = '';
while(!feof($file)){
    $read .= fgets($file)."\n";
}
fclose($file);
?>
<table>
    <tr>
        <td>
            <?php echo nl2br($read); ?>
        </td>
    </tr>
</table>