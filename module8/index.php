<html>
<head>
    <title>
        Buku Tamu
    </title>
</head>

<body>
    <h2 align= "center">Selamat Datang di Bukutamu</h2>
    <div align= "center">
<tr>
    <td>
        <a href="login.php">login</a>
    </td>
    <td>
<!-- ini untuk input databuku -->
    </td>  
    <td>
        <a href="input_user.php">InputUser</a>
    </td> 
</tr>
</div>    
<p>
    <?php
    include "config.php";
    $rowsPerPage = 5;
    $pageNum = 1;
    
    if(isset($_GET['page']))
    {
        $pageNum = $_GET['page'];
    }
     
    $offset = ($pageNum -1) * $rowsPerPage;
    $query = "SELECT * FROM pengunjung ORDER BY 'id' DESC LIMIT $offset, $rowsPerPage";
    $result = mysqli_query($conn, $query) or die('Error, query failed 1');

    $query1 = "SELECT COUNT(id) AS numrows FROM pengunjung";
    $result1 = mysqli_query($conn, $query1) or die('Error , query failed 2');
    $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
    $numrows = $row1['numrows'];
   
    ?>
</p>
<table width="50%" border="0" align="center" cellpadding="10" cellpacing="0" class="content"> 
    <tr valign="top">
        <td>
            <?php echo "Total nomor buku : $numrows";?>
        </td>
    </tr>
</table>
<?php 
$no = 1;
while ($hasil = mysqli_fetch_array($result))
{
    ?>
    <table width="50%" border="0" align="center" cellpadding="2" cellpacing="0" class="content">
        <tr valign="top">
            <td bgcolor="#FFDFFF">
                <span class="style2">dari</span>
                <?php echo $hasil['nama'];
                ?>pada <?php echo $hasil['date'];?>
                </span>
               
            </td>
        </tr>
        <tr valign="top">
            <td bgcolor="#FFBFAA">
                <?php
                echo $hasil['komentar'];
                ?>
            </td>
        </tr>

    </table>
    <?php
     $no++;
     echo "<br>";
    
}
?>

<?php
$query = "SELECT COUNT(id) AS numrows FROM pengunjung";
$result = mysqli_query($conn, $query) or die('Error, query failed');
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$numrows = $row['numrows'];

$maxPage = ceil($numrows / $rowsPerPage);

$self = $_SERVER['PHP_SELF'];
$nav = '';
for (
    $page = 1; $page <= $maxPage; $page++
) {
    if ($page == $pageNum)
    {$nav .= "$page";}
    
    else {
    $nav .= "<a href=\"$self?page=$page\">$page</a>";
    }
}
if ($pageNum > 1)
{
    $page = $pageNum -1;
    $prev = " <a href=\"$self?page=$page\">[Next]</a>";
    
    $first = " <a href \"$self?page=1\">[First Page]</a>";

} else {
    $prev = '&nbsp;';
    $first = '&nbsp;';
}

if ($pageNum < $maxPage) { 
    $page = $pageNum + 1;
    $next = "<a href= \"$self?page=$page\"> Next</a>";
    $last = "<a href=\"$self?page=$maxPage\">Last Page </a>";

} else {
    $next = '&nbsp;';
    $last = '&nbsp;';
}
?>
<?php
echo "<center>$first " . " $prev " . " $nav " . " $next " . " $last</center>";
?>
</body>
</html>