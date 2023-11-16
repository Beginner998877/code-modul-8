<?php
    if(isset($_POST['upload'])) {
        include "config.php";
        $nama = htmlentities(trim($_POST['tnama']));
        $email = htmlentities(trim($_POST['temail']));
        $komentar = htmlentities(trim($_POST['tkomentar']));
        $date = date("j F Y, g:i a");
        $ip1 = $_SERVER["REMOTE_ADDR"];
        $ip2 = getenv("HTTP_X_FORWARD_FOR");
        $ip = $ip1 . "-" . $ip2;
        
        if((empty($nama)) || (empty($email)) || (empty($komentar))) {
            echo "Data tidak boleh kosong";
            exit;
        } else {
            $query = "INSERT INTO pengunjung (nama,email,komentar,date,ip)" . 
            "VALUES ('$nama','$email','$komentar','$date','$ip')";

            mysqli_query($conn, $query) or die('Error, query failed' . mysqli_error($conn));
            mysqli_close($conn);
            header('Location: admin.php');
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Bukutamu</title>
</head>
<body>
    <p>
        <form action="<?php $PHP_SELF ?>" method="post" name="uploadform" id="uploadform">
            <table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" class="content">
                <tr bgcolor="#FFDFAA">
                    <td colspan="3">
                        <div align="center"><strong>Input Bukutamu</strong></div>
                    </td>
                </tr>
                <tr>-
                    <td colspan="3" valign="top">
                        <div align="center"><a href="admin.php">Cancel</a></div>
                    </td>
                </tr>
                <tr>
                    <td width="26%" valign="top"><strong>Nama <span class="style1">*</span></strong></td>
                    <td width="2%">:</td>
                    <td width="72%"><input type="text" name="tnama" id="tnama" size="30" maxlength="30">
                        <span class="style1"> </span>
                    </td>
                </tr>
                <tr>
                    <td valign="top"><strong>Email <span class="style1">*</span></strong></td>
                    <td>:</td>
                    <td><input type="text" name="temail" id="temail" size="30" maxlength="30"></td>
                </tr>
                <tr>
                    <td valign="middle"><strong>Pesan <span class="style1">*</span></strong></td>
                    <td>:</td>
                    <td valign="top"><textarea name="tkomentar" id="tkomentar" cols="50" rows="5"></textarea></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="upload" id="uploadform" class="box" value="Submit"></td>
                </tr>
                <tr>
                    <td colspan="3"><span class="style1">*</span>: Harus mengisi data</td>
                </tr>
            </table>
        </form>
    </p>
</body>
</html>