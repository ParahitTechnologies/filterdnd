<?php
session_start();
$user_id = $_SESSION['employee'];
if (empty($_SESSION['employee'])) {
    header("Location:../login/index.php");
}
require_once("../common/connection.php"); ///date base connection
?>
<table width="98%" cellpadding="0" cellspacing="1" border="0" bgcolor="#EEEEFF">
    <?php
    $query = "select id,file_name,file_size,file_rows,cdate,f_status from upload_file where agent='$user_id' and (f_status=1 || f_status=2) order by id desc";
    $result = mysql_query($query);
    if (mysql_num_rows($result) > 0) {
        $sn = 1;
        while ($rows = mysql_fetch_array($result)) {
            ?>
            <tr bgcolor="white" height="21px">
                <td align="center" width="7%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px"><?= $sn; ?>.</span></td>
                <td align="left" width="39%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px"><?= $rows[1]; ?></span></td>
                <td align="center" width="13%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px"><?= $rows[2]; ?></span></td>
                <td align="center" width="13%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px"><?= $rows[3]; ?></span></td>
                <td align="center" width="26%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px"><?= $rows[4]; ?></span></td>
                <td align="center" width="15%" nowrap>
                    <?php
                    if ($rows[5] == '1') {
                        ?>
                        <div id="c_dnc<?= $sn; ?>"><img src="../images/dnc.png" border="0" title="Click to Filter DND File" onClick="return reda_csv('<?= $rows[0]; ?>', '<?= $rows[1]; ?>', 'c_dnc<?= $sn; ?>', '<?= $rows[3]; ?>', '<?= $MAX_LINES; ?>')" style="cursor:pointer"/>&nbsp;<a href="dnc_delete.php?act=<?php echo $rows[0]; ?>&fname=<?= $rows[1]; ?>" title="Delete File" onClick="return confirm('Sure to delete.???');"><img src="../images/delete.png" border="0"/></a></div>			
                                <?php
                            } else {
                                ?>
                        <img src="../images/pro.gif" border="0"/>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
            $sn = $sn + 1;
        }
    }
    ?> 
</table>