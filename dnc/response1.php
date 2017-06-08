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
    $query = "select id,dnc_f_name,file_size,cdate from upload_file where agent='$user_id' and f_status=0 and flag_delete=0 order by id desc";
    $result = mysql_query($query);
    if (mysql_num_rows($result) > 0) {
        $sn = 1;
        while ($rows = mysql_fetch_array($result)) {
            ?>
            <tr bgcolor="white" height="21px">
                <td align="center" width="7%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
            <?= $sn; ?>
                        .</span></td>
                <td align="left" width="42%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
                        <?= $rows[1]; ?>
                    </span></td>
                <td align="center" width="12%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
                        <?= $rows[2]; ?>
                    </span></td>
                <td align="center" width="24%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
                        <?= $rows[3]; ?>
                    </span></td>
                <td align="center" width="15%"><a style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px; text-decoration:none" href='download.php?p=<?= $ZIP_DIR; ?>&f=<?php echo $rows['dnc_f_name']; ?>' title="Download File">Download</a>&nbsp;<a href="dnd_delete.php?act=<?php echo $rows[0]; ?>" title="Delete File" onclick="return confirm('Sure to delete.???');"><img src="../images/delete.png" border="0"/></a></td>
            </tr>
        <?php
        $sn = $sn + 1;
    }
}
?>
</table>
