<?php
for ($s =$i = 0, $z = strlen($a ="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ")-1; $i != 16; $x = rand(0,$z), $s .= $a{$x}, $i++);
$key = $s;
echo $key;
?>
