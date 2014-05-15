<?  
  include "auth.php"; 
  	
  include "themes/header.php"; 
?>

<tr><td valign=top width=200>

<?
  $index=1;	
  if ($file>0) $index=0;
  include "themes/menu.php";

?>
</td>
<td valign=top>
<table cellSpacing=5 width=100% border=0 valign=top>


<? 
if ($file>0)
{
$res=mysql_query("SELECT * FROM Information where info_id=$file;");
while( $row = mysql_fetch_array( $res ) ) 
 {
	echo "<tr><td><font size=5 color=#cc9900><b>", $row['title'], "</font><br></td></tr>";
	echo "<tr><td><font size=2>",$row['body'],"</td></tr>";
 }
}
else
{
?>
<tr><td valign=top>
<?
	echo "<tr><td><font size=5 color=#cc9900><b>", $title, "</font><br></td></tr>";
	echo "<tr><td><font size=2>",$body,"</td></tr>";	

} ?>
</td><tr></table>

</td></tr>



<?  include "themes/footer.php"; ?>
