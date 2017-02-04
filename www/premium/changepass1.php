	<?php
	$code = "";
$codeinput="abcdefghijklmnopqrstuvxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$aantal=32;
for ($i = 1; $i <= $aantal; $i++) {
$code .= $codeinput[rand(0,strlen($codeinput)-1)];
}
?>
	<center><form action="index.php?page=changepass2" method="post"><table width="200" border="1" class="join">
  <tr>
    <th scope="row">Old password</th>
    <td><label>
      <input type="password" id="fname" name="oldpass" size="60" />
    </label></td>
  </tr>
    <tr>
    <th scope="row">New Password</th>
    <td><label>
      <input type="password" id="fname" name="newpass" size="60" />
    </label></td>
  </tr>
      <tr>
    <th scope="row">New Password (again)</th>
    <td><label>
      <input type="password" id="fname" name="newpass2" size="60" />
    </label></td>
  </tr>
  <tr>
    <th colspan="2" scope="row"><label>
    <input type="hidden" name="changekey" value="<?php echo $code; ?>">
      <input type="submit" name="button" id="button" value="Change password" />
    </label></th>
    </tr>
</table></form></center>