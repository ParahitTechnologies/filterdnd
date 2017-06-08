<?php
session_start();
$user_id = $_SESSION['employee'];
if (empty($_SESSION['employee'])) {
    header("Location:../index.php");
}
require_once("../common/connection.php"); ///date base connection
$query = "select t_upload,t_number,fix_number from emp_master where emp_id='$user_id'";
$result = mysql_query($query);
while ($rows = mysql_fetch_array($result)) {
    $r_file = $rows[0];
    $r_no = $rows[1];
    $fix_number = $rows[2];
}
?>
<link href="../css/style1.css" rel="stylesheet" type="text/css" />
<style>
    #progress { position:relative; width:200px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
    #bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
    #percent { position:absolute; display:inline-block; top:3px; left:48%; }
</style>
<script src="js/jquery.js"></script>
<script src="js/jquery.form.js"></script>
<script language="javascript">
    function reda_csv(fid, fname, tg)
    {
        var target = "cvs_read";
//        var url = "dnc_csv.php?target=" + target + "&fname=" + fname + "&fid=" + fid;
//        var xmlhttp = GetXmlHttpObject();
//        if (xmlhttp === null) {
//            alert("Your browser does not support AJAX!");
//            return;
//        }
//        document.getElementById(tg).innerHTML = '<img src=\"../images/loading.gif\">';
//        xmlhttp.onreadystatechange = function() {
//            if (xmlhttp.readyState === 4 || xmlhttp.readyState === "complete") {
//                document.getElementById(tg).innerHTML = xmlhttp.responseText;
//                document.getElementById(tg).innerHTML = '<img src=\"../images/pro.gif\">';
//            }
//            else
//            {
//                
//            }
//        }
//        xmlhttp.open("GET", url, true);
//        xmlhttp.send(null);
	    $("#"+tg).html('<img src=\"../images/loading.gif\">');
            $.ajax({
                url : "dnc_csv.php",
                type : "GET",
                data: {target : target,fname:fname,fid:fid}
            }); 
    }
    function GetXmlHttpObject() {
        var xmlhttp = null;
        try {
            // Firefox, Opera 8.0+, Safari
            xmlhttp = new XMLHttpRequest();
        }
        catch (e) {
            // Internet Explorer
            try {
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e) {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
        }
        return xmlhttp;
    }
    function formvalidation(th)
    {

        var file = document.getElementById("file").value;
        var r_file = document.getElementById("r_file").value;
        var r_dnc = document.getElementById("r_dnc").value;
        if (r_file == 0)
        {
            alert("Maximum Upload File is 10 only for one day...!");
            document.myForm.file.focus();
            return false;
        }
        var ext = file.split(".");
        var exten = ext[1];
        if (exten != 'csv')
        {
            alert("Please Select Only CSV File for upload...!");
            document.myForm.file.focus();
            return false;
        }
        if (file == '')
        {
            alert("Please Select CSV File for upload...!");
            document.myForm.file.focus();
            return false;
        }

    }
</script>
<script>
    var refreshId = setInterval(function()
    {
        $('#responsecontainer').fadeOut("slow").load('response.php').fadeIn("slow");
    }, 10000);
    var refreshId = setInterval(function()
    {
        $('#responsecontainer1').fadeOut("slow").load('response1.php').fadeIn("slow");
    }, 25000);

    function refresh_page()
    {
        var r_file = document.getElementById("r_file").value;
        var fix_number = document.getElementById("fix_number").value;
        var url = "refer_page.php";
        var xmlhttp = GetXmlHttpObject();
        if (xmlhttp == null) {
            alert("Your browser does not support AJAX!");
            return;
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 || xmlhttp.readyState == "complete") {
                var t_number = xmlhttp.responseText.trim();
                if (t_number == r_file)
                {
                    alert("Maxumum Upload Dnc is!" + fix_number);
                    window.location = '';
                }
                else
                {
                    window.location = '';
                }
            }
            else
            {
                document.getElementById('div_book').innerHTML = '<img src=\"../images/loading.gif\">';
            }
        }
        xmlhttp.open("GET", url, true);
        xmlhttp.send(null);
    }
    function GetXmlHttpObject() {
        var xmlhttp = null;
        try {
            // Firefox, Opera 8.0+, Safari
            xmlhttp = new XMLHttpRequest();
        }
        catch (e) {
            // Internet Explorer
            try {
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e) {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
        }
        return xmlhttp;
    }
</script>
<html>
    <head>
    <form id="myForm" class="ContactForm" name="myForm" action="upload.php" method="post" enctype="multipart/form-data" style="width:98%" onSubmit="return formvalidation(this)">
        <table width="98%" border="0" cellpadding="0" cellspacing="0">
            <tr><input type="hidden" id="fix_number" name="fix_number" value="<?= $fix_number; ?>"/>
            <td width="10%" align="right"><div class="tf"><span class="red">*</span>File Upload</div></td>
            <td width="20%">
                <input type="file" name="file" class="design_text" id="file"/>
            </td>
            <td width="7%">
                <input type="submit" name="Submit2" value="Upload" class="button" style="width:100px"/> 
            </td>
            <td width="12%">
                <input type="reset" name="Submit" value="Reset" class="button"  style="width:100px"/>
            </td>
            <td width="12%"><div id="progress" style="margin-top:3px">
                    <div id="bar"></div>
                    <div id="percent">0%</div >
                </div>
                <script>
    $(document).ready(function()
    {

        var options = {
            beforeSend: function()
            {
                $("#progress").show();
                //clear everything
                $("#bar").width('0%');
                $("#message").html("");
                $("#percent").html("0%");
            },
            uploadProgress: function(event, position, total, percentComplete)
            {
                $("#bar").width(percentComplete + '%');
                $("#percent").html(percentComplete + '%');


            },
            success: function()
            {
                $("#bar").width('100%');
                $("#percent").html('100%');
                refresh_page();
            },
            complete: function(response)
            {
                $("#message").html("<font color='green'>" + response.responseText + "</font>");
            },
            error: function()
            {
                $("#message").html("<font color='red'> ERROR: unable to upload files</font>");

            }

        };

        $("#myForm").ajaxForm(options);

    });

                </script></td>
            <td width="8%"><input type="hidden" name="r_file" id="r_file" value="<?= $r_file; ?>"/></td>
            <input type="hidden" name="r_dnc" class="design_text" id="r_dnc" value="<?= $r_no; ?>"/></td>
            </tr>
        </table>
        <div style="background:white;width:100%;height:320px; margin-top:5px; margin-left:12px;valign:middle;-moz-border-radius:0.6em;border:1px solid #EEEEFF; opacity:0.8; filter:alpha(opacity=80)">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">

                <tr>
                    <td width="50%" align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#663300;margin-left:10px">Uploaded File </span></td>

                    <td width="50%" align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#663300;margin-left:10px">Checked DNC File </span></td>
                </tr>
                <tr> 
                    <td align="center"><div  style="height:360px;overflow:auto" id="responsecontainer">
                            <table width="98%" cellpadding="0" cellspacing="1" border="0" bgcolor="#EEEEFF" style="margin-left:5px; margin-right:5px; margin-top:5px">
                                <tr bgcolor="#F2F2F2" height="22px">
                                    <td align="center" width="7%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">S.No.</span></td>
                                    <td align="left" width="39%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">File Name</span></td>
                                    <td align="center" width="13%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">File Size</span></td>
                                    <td align="center" width="26%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">Date</span></td>
                                    <td align="center" width="15%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">Action</span></td>
                                </tr>
                                <?php
                                $query = "select id,file_name,file_size,cdate,f_status from upload_file where agent='$user_id' and (f_status=1 || f_status=2)";
                                $result = mysql_query($query);
                                if (mysql_num_rows($result) > 0) {
                                    $sn = 1;
                                    while ($rows = mysql_fetch_array($result)) {
                                        ?>
                                        <tr bgcolor="white" height="21px">
                                            <td align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
                                                    <?= $sn; ?>
                                                    .</span></td>
                                            <td align="left"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
                                                    <?= $rows[1]; ?>
                                                </span></td>
                                            <td align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
                                                    <?= $rows[2]; ?>
                                                </span></td>
                                            <td align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
                                                    <?= $rows[3]; ?>
                                                </span></td>
                                            <td align="center"><?php
                                                if ($rows[4] == 1) {
                                                    ?>
                                                    <div id="c_dnc<?= $sn; ?>"><img src="../images/dnc.png" border="0" onclick="reda_csv('<?= $rows[0]; ?>', '<?= $rows[1]; ?>', 'c_dnc<?= $sn; ?>')" style="cursor:pointer"/>&nbsp;<a href="dnc_delete.php?act=<?php echo $rows[0]; ?>&fname=<?= $rows[1]; ?>" onclick="return confirm('Sure to delete.???');"><img src="../images/delete.png" border="0"/></a></div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="../images/pro.gif" border="0"/>
                                                    <?php
                                                }
                                                ?>                                           </td>
                                        </tr>
                                        <?php
                                        $sn = $sn + 1;
                                    }
                                }
                                ?>
                            </table>
                        </div></td>
                    <td align="center"><div  style="height:360px;overflow:auto" id="responsecontainer1">
                            <table width="98%" cellpadding="0" cellspacing="1" border="0" bgcolor="#EEEEFF" style="margin-left:5px; margin-right:5px; margin-top:5px">
                                <tr bgcolor="#F2F2F2" height="22px">
                                    <td align="center" width="7%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">S.No.</span></td>
                                    <td align="left" width="42%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">File Name</span></td>
                                    <td align="center" width="12%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">File Size</span></td>
                                    <td align="center" width="24%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">Date</span></td>
                                    <td align="center" width="15%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">Action</span></td>
                                </tr>
                                <?php
                                $query = "select id,dnc_f_name,file_size,cdate from upload_file where agent='$user_id' and f_status=0 and flag_delete=0";
                                $result = mysql_query($query);
                                if (mysql_num_rows($result) > 0) {
                                    $sn = 1;
                                    while ($rows = mysql_fetch_array($result)) {
                                        ?>
                                        <tr bgcolor="white" height="21px">
                                            <td align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
                                                    <?= $sn; ?>
                                                    .</span></td>
                                            <td align="left"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
                                                    <?= $rows[1]; ?>
                                                </span></td>
                                            <td align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
                                                    <?= $rows[2]; ?>
                                                </span></td>
                                            <td align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
                                                    <?= $rows[3]; ?>
                                                </span></td>
                                            <td align="center"><a style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px; text-decoration:none" href='/dnc/download.php?p=<?= $ZIP_DIR; ?>&f=<?php echo $rows['dnc_f_name']; ?>'">Download</a>&nbsp;<a href="dnd_delete.php?act=<?php echo $rows[0]; ?>" onclick="return confirm('Sure to delete.???');"><img src="../images/delete.png" border="0"/></a></td>
                                        </tr>
                                        <?php
                                        $sn = $sn + 1;
                                    }
                                }
                                ?>
                            </table>
                        </div></td>
                </tr>
            </table>
        </div>
    </form>
