<link href="style.css" rel="stylesheet" type="text/css" />
<br /><br />
<form id="form1" name="form1" method="post" action="insertserver.php">
<table width="200" border="1">
  <tr>
    <th scope="row">URL</th>
    <td><label>
      <input type="text" name="serverlink" id="textfield" />
    </label></td>
  </tr>
    <tr>
    <th scope="row">Servername</th>
    <td><label>
      <input type="text" name="servername" id="textfield" />
    </label></td>
  </tr>
      <tr>
    <th scope="row">IP Adress</th>
    <td><label>
      <input type="text" name="ipserver" id="textfield" />
    </label></td>
  </tr>
  <tr>
    <th colspan="2" scope="row">Type</th></tr>
<tr><th>Free</th><td><input name="type" type="radio" value="free" checked="checked"></td></tr>
<tr><th>Premium</th><td><input type="radio" name="type" value="premium"></td></tr>
  <tr>
    <th colspan="2" scope="row"><label>
      <input type="submit" name="button" id="button" value="Submit" />
    </label></th>
    </tr>
</table>
</form>