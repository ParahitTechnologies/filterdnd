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
    function reda_csv(fid, fname, tg, fr, ml) {
        if ((fr * 1) > (ml * 1)) {
            alert("File (" + fr + ") rows exeded limit rows (" + ml + ")");
            return false;
        } else {
            var target = "cvs_read";
            $("#" + tg).html('<img src=\"../images/loading.gif\">');
            $.ajax({
                url: "dnc_csv.php",
                type: "GET",
                data: {target: target, fname: fname, fid: fid}
            });
        }
    }
    function GetXmlHttpObject() {
        var xmlhttp = null;
        try {
            // Firefox, Opera 8.0+, Safari
            xmlhttp = new XMLHttpRequest();
        } catch (e) {
            // Internet Explorer
            try {
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
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
            //alert("Maximum Upload File is 10 only for one day...!");
            //document.myForm.file.focus();
            //return false;
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
    var refreshId = setInterval(function ()
    {
        $('#responsecontainer').fadeOut("slow").load('response.php').fadeIn("slow");
    }, 10000);
    var refreshId = setInterval(function ()
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
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 || xmlhttp.readyState == "complete") {
                var t_number = xmlhttp.responseText.trim();
                //if (t_number == r_file)
                // {
                //    alert("Maxumum Upload Dnc is!" + fix_number);
                //    window.location = '';
                // }
                // else
                // {
                window.location = '';
                //}
            } else
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
        } catch (e) {
            // Internet Explorer
            try {
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
        }
        return xmlhttp;
    }
</script>

<script type="text/javascript" language="javascript">
    $(document).ready(function () {
        $("#file").change(function (event) {
            $('#file_name').val($(":file").val());
        });
    });
</script>
<style>
    .form input[type="file"]{
        z-index: 999;
        line-height: 0;
        font-size: 50px;
        position: absolute;
        opacity: 0;
        filter: alpha(opacity = 0);-ms-filter: "alpha(opacity=0)";
        cursor: pointer;
        _cursor: hand;
        margin: 0;
        padding:0;
        left:0;
    }
    .add-photo-btn{
        position:relative;
        overflow:hidden;
        cursor:pointer;
        text-align:left;
        background:#e25101; border-color:#d04c03;  width:100px!important; font-weight:bold; color:#fff!important; cursor:pointer!important; font-size:16px!important; font-family:"Open Sans", Helvetica, Arial, sans-serif!important; border-radius: 0 !important; border: none!important; border-radius:3px!important;
        color:#fff;
        display:block;
        width:85px;
        height:31px;
        font-size:18px;
        line-height:30px;
        float:left;
        border-radius:0.2em;
    }

    .add-photo-btn img {
        float: left;
        padding-left: 6px;
        padding-top: 4px;
        width: 19px;
    }

</style>
<html>
    <head>
    <form id="myForm" class="ContactForm" name="myForm" action="upload.php" method="post" enctype="multipart/form-data" style="width:98%" onSubmit="return formvalidation(this)">
        <table width="98%" border="0" cellpadding="0" cellspacing="0">
            <tr><input type="hidden" id="fix_number" name="fix_number" value="<?= $fix_number; ?>"/>
            <td width="8%" align="right"><p class="form" style="margin-left:20px">
                    <label class="add-photo-btn"><img src="../images/p.png" style="margin-left:0px; margin-right:5px; margin-top:2px"/><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">Browse</span>
                        <span>
                            <input type="file" id="file" name="file" />
                        </span>
                    </label>
                </p></td>
            <td width="19%">
                <input type="text" name="file_name" id="file_name" style="width:200px;margin-left:5px"/> 
            </td>
            <td width="10%">
                <input type="submit" name="Submit2" value="Upload" class="button" style="width:100px"/> 
            </td>
            <td width="14%">
                <input type="reset" name="Submit" value="Reset" class="button"  style="width:100px"/>
            </td>
            <td width="19%"><div id="progress" style="margin-top:3px">
                    <div id="bar"></div>
                    <div id="percent">0%</div >
                </div>
                <script>
                    $(document).ready(function () {
                        var options = {
                            beforeSend: function () {
                                $("#progress").show();
                                $("#bar").width('0%');
                                $("#message").html("");
                                $("#percent").html("0%");
                            },
                            uploadProgress: function (event, position, total, percentComplete) {
                                $("#bar").width(percentComplete + '%');
                                $("#percent").html(percentComplete + '%');
                            },
                            success: function () {
                                $("#bar").width('100%');
                                $("#percent").html('100%');
                                refresh_page();
                            },
                            complete: function (response) {
                                var f = response.responseText;
                                //alert(f);
                                $("#message").html("<font color='green'>san" + f + "</font>");
                            },
                            error: function () {
                                $("#message").html("<font color='red'> ERROR: unable to upload files</font>");
                            }
                        };
                        $("#myForm").ajaxForm(options);
                    });

                </script></td>
            <td width="8%"><input type="hidden" name="r_file" id="r_file" value="<?= $r_file; ?>"/></td>
            <input type="hidden" name="r_dnc" class="design_text" id="r_dnc" value="<?= $r_no; ?>"/><td width="22%"></td>
            </tr>
        </table>
        <div style="background:white;width:100%;height:320px; margin-top:5px; margin-left:12px;valign:middle;-moz-border-radius:0.6em;border:1px solid #ebebeb; opacity:0.8; filter:alpha(opacity=80)">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">

                <tr class="row1">
                    <td width="50%" align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#226b73;margin-left:10px">Uploaded File </span></td>

                    <td width="50%" align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#226b73;margin-left:10px">Checked DNC File </span></td>
                </tr>
                <tr> 
                    <td align="center">
                        <table width="98%" cellpadding="0" cellspacing="1" border="0" bgcolor="#ebebeb" style="margin-left:5px; margin-right:5px; margin-top:5px">
                            <tr bgcolor="#ebebeb" height="22px">
                                <td align="center" width="7%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">S.No.</span></td>
                                <td align="left" width="39%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">File Name</span></td>
                                <td align="center" width="13%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">File Size</span></td>
                                <td align="center" width="13%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">File Rows</span></td>
                                <td align="center" width="26%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">Date</span></td>
                                <td align="center" width="15%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">Action</span></td>
                            </tr>
                        </table>
                        <div  style="height:295px;overflow:auto" id="responsecontainer">
                            <table width="98%" cellpadding="0" cellspacing="1" border="0" bgcolor="#ebebeb">
                                <?php
                                $query = "select id,file_name,file_size,file_rows,cdate,f_status from upload_file where agent='$user_id' and (f_status=1 || f_status=2) order by id desc";
                                $result = mysql_query($query);
                                if (mysql_num_rows($result) > 0) {
                                    $sn = 1;
                                    while ($rows = mysql_fetch_array($result)) {
                                        ?>
                                        <tr bgcolor="white" height="21px">
                                            <td align="center" width="7%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
        <?= $sn; ?>
                                                    .</span></td>
                                            <td align="left" width="39%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
        <?= $rows[1]; ?>
                                                </span></td>
                                            <td align="center" width="13%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
        <?= $rows[2]; ?>
                                                </span></td>
                                            <td align="center" width="13%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
        <?= $rows[3]; ?>
                                                </span></td>
                                            <td align="center" width="26%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
        <?= $rows[4]; ?>
                                                </span></td>
                                            <td align="center" width="15%" nowrap>Wait...</td>
                                        </tr>
                                        <?php
                                        $sn = $sn + 1;
                                    }
                                }
                                ?>
                            </table>
                        </div></td>
                    <td align="center">
                        <table width="98%" cellpadding="0" cellspacing="1" border="0" bgcolor="#ebebeb" style="margin-left:5px; margin-right:5px; margin-top:5px">
                            <tr bgcolor="#ebebeb" height="22px">
                                <td align="center" width="7%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">S.No.</span></td>
                                <td align="left" width="42%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">File Name</span></td>
                                <td align="center" width="12%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">File Size</span></td>
                                <td align="center" width="24%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">Date</span></td>
                                <td align="center" width="15%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">Action</span></td>
                            </tr>
                        </table>
                        <div  style="height:295px;overflow:auto" id="responsecontainer1">
                            <table width="98%" cellpadding="0" cellspacing="1" border="0" bgcolor="#ebebeb">
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
                                            <td align="center"  width="12%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
        <?= $rows[2]; ?>
                                                </span></td>
                                            <td align="center" width="24%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px">
        <?= $rows[3]; ?>
                                                </span></td>
                                            <td align="center" width="15%"><a style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px; text-decoration:none" href='download.php?p=<?= $ZIP_DIR; ?>&f=<?php echo $rows['dnc_f_name']; ?>' title="Download Files">Download</a>&nbsp;<a href="dnd_delete.php?act=<?php echo $rows[0]; ?>" title="Delete File" onclick="return confirm('Sure to delete.???');"><img src="../images/delete.png" border="0"/></a></td>
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
    <span style="font-size: 11px;font-weight: bold;color: red">Note 1: Upload CSV file without caption, only phone numbers will be allowed.</span>
    <br>
    <span style="font-size: 11px;font-weight: bold;color: red">Note 2: Only <?= $MAX_LINES; ?> rows allowed per file.</span>