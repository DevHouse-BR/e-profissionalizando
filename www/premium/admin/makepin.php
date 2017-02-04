<link href="style.css" rel="stylesheet" type="text/css" />
<?php
$code = "";
$codeinput="abcdefghijklmnopqrstuvxyz0123456789";
$aantal=32;
for ($i = 1; $i <= $aantal; $i++) {
$code .= $codeinput[rand(0,strlen($codeinput)-1)];
}
echo $code;
?>
<br /><br />
<form id="form1" name="form1" method="post" action="insertpin.php?pin=<?php echo $code; ?>">
<table width="200" border="1">
  <tr>
    <th scope="row">Credits</th>
    <td><label>
      <input type="text" name="credits" id="textfield" />
    </label></td>
  </tr>
  <tr>
    <th scope="row">name</th>
    <td><label>
      <input type="text" name="email" id="textfield" />
    </label></td>
  </tr>
  <tr>
    <th colspan="2" scope="row"><label>
      <input type="submit" name="button" id="button" value="Submit" />
    </label></th>
    </tr>
</table>
</form>