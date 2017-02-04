<?php /* Smarty version 2.6.26, created on 2011-01-20 21:59:07
         compiled from /home/prof/public_html/painel/templates/orderforms/web20cart/configureproductdomain.tpl */ ?>
<link rel="stylesheet" type="text/css" href="templates/orderforms/web20cart/style.css" />
<h2><?php echo $this->_tpl_vars['LANG']['cartproductconfig']; ?>
</h2>
<p><?php echo $this->_tpl_vars['LANG']['cartproductdomaindesc']; ?>
</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?a=add&pid=<?php echo $this->_tpl_vars['pid']; ?>
">
<?php $_from = $this->_tpl_vars['passedvariables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['value']):
?>
<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
" value="<?php echo $this->_tpl_vars['value']; ?>
" />
<?php endforeach; endif; unset($_from); ?>
  <?php if ($this->_tpl_vars['errormessage']): ?>
  <div class="errorbox"><?php echo $this->_tpl_vars['errormessage']; ?>
</div>
  <br />
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['incartdomains']): ?>
  <p><input type="radio" name="domainoption" value="incart" id="selincart" onclick="document.getElementById('register').style.display='none';document.getElementById('transfer').style.display='none';document.getElementById('owndomain').style.display='none';document.getElementById('subdomain').style.display='none';document.getElementById('incart').style.display=''" />
  <label for="selincart"><?php echo $this->_tpl_vars['LANG']['cartproductdomainuseincart']; ?>
</label></p>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['registerdomainenabled']): ?>
  <p><input type="radio" name="domainoption" value="register" id="selregister" onclick="document.getElementById('register').style.display='';document.getElementById('transfer').style.display='none';document.getElementById('owndomain').style.display='none';document.getElementById('subdomain').style.display='none';document.getElementById('incart').style.display='none'" />
  <label for="selregister"><?php echo $this->_tpl_vars['LANG']['orderdomainoption1part1']; ?>
 <?php echo $this->_tpl_vars['companyname']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderdomainoption1part2']; ?>
</label></p>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['transferdomainenabled']): ?>
  <p><input type="radio" name="domainoption" value="transfer" id="seltransfer" onclick="document.getElementById('register').style.display='none';document.getElementById('transfer').style.display='';document.getElementById('owndomain').style.display='none';document.getElementById('subdomain').style.display='none';document.getElementById('incart').style.display='none'" />
  <label for="seltransfer"><?php echo $this->_tpl_vars['LANG']['orderdomainoption3']; ?>
 <?php echo $this->_tpl_vars['companyname']; ?>
</label></p>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['owndomainenabled']): ?>
  <p><input type="radio" name="domainoption" value="owndomain" id="selowndomain" onclick="document.getElementById('register').style.display='none';document.getElementById('transfer').style.display='none';document.getElementById('owndomain').style.display='';document.getElementById('subdomain').style.display='none';document.getElementById('incart').style.display='none'" />
  <label for="selowndomain"><?php echo $this->_tpl_vars['LANG']['orderdomainoption2']; ?>
</label></p>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['subdomains']): ?>
  <p><input type="radio" name="domainoption" value="subdomain" id="selsubdomain" onclick="document.getElementById('register').style.display='none';document.getElementById('transfer').style.display='none';document.getElementById('owndomain').style.display='none';document.getElementById('subdomain').style.display='';document.getElementById('incart').style.display='none'" />
  <label for="selsubdomain"><?php echo $this->_tpl_vars['LANG']['orderdomainoption4']; ?>
</label></p>
  <?php endif; ?> <br />
  <div class="cartbox">
    <div id="incart" align="center"><?php echo $this->_tpl_vars['LANG']['cartproductdomainchoose']; ?>
:
      <select name="incartdomain">
        
<?php $_from = $this->_tpl_vars['incartdomains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['incartdomain']):
?>

        <option value="<?php echo $this->_tpl_vars['incartdomain']; ?>
"><?php echo $this->_tpl_vars['incartdomain']; ?>
</option>
        
<?php endforeach; endif; unset($_from); ?>

      </select>
    </div>
    <div id="register" align="center">www.
      <input type="text" name="sld[0]" size="40" value="<?php echo $this->_tpl_vars['sld']; ?>
" />
      <select name="tld[0]">
        
<?php $_from = $this->_tpl_vars['registertlds']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['listtld']):
?>

        <option value="<?php echo $this->_tpl_vars['listtld']; ?>
"<?php if ($this->_tpl_vars['listtld'] == $this->_tpl_vars['tld']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['listtld']; ?>
</option>
        
<?php endforeach; endif; unset($_from); ?>

      </select>
    </div>
    <div id="transfer" align="center">www.
      <input type="text" name="sld[1]" size="40" value="<?php echo $this->_tpl_vars['sld']; ?>
" />
      <select name="tld[1]">
        
<?php $_from = $this->_tpl_vars['transfertlds']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['listtld']):
?>

        <option value="<?php echo $this->_tpl_vars['listtld']; ?>
"<?php if ($this->_tpl_vars['listtld'] == $this->_tpl_vars['tld']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['listtld']; ?>
</option>
        
<?php endforeach; endif; unset($_from); ?>

      </select>
    </div>
    <div id="owndomain" align="center">www.
      <input type="text" name="sld[2]" size="40" value="<?php echo $this->_tpl_vars['sld']; ?>
" />
      .
      <input type="text" name="tld[2]" size="7" value="<?php echo $this->_tpl_vars['tld']; ?>
" />
    </div>
    <div id="subdomain" align="center">http://
      <input type="text" name="sld[3]" size="40" value="<?php echo $this->_tpl_vars['sld']; ?>
" />
      <select name="tld[3]">
      <?php $_from = $this->_tpl_vars['subdomains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subid'] => $this->_tpl_vars['subdomain']):
?>
        <option value="<?php echo $this->_tpl_vars['subid']; ?>
"><?php echo $this->_tpl_vars['subdomain']; ?>
</option>
      <?php endforeach; endif; unset($_from); ?>
      </select></div>
  </div>
  <p align="center">
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['ordercontinuebutton']; ?>
" class="buttongo" />
  </p>
  <script language="javascript" type="text/javascript">
document.getElementById('incart').style.display='none';
document.getElementById('register').style.display='none';
document.getElementById('transfer').style.display='none';
document.getElementById('owndomain').style.display='none';
document.getElementById('subdomain').style.display='none';
document.getElementById('sel<?php echo $this->_tpl_vars['domainoption']; ?>
').checked='true';
document.getElementById('<?php echo $this->_tpl_vars['domainoption']; ?>
').style.display='';
</script>
  <?php if ($this->_tpl_vars['availabilityresults']): ?>
  <h3 class="cartsubheading"><?php echo $this->_tpl_vars['LANG']['choosedomains']; ?>
</h3>
  <table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" class="data">
    <tr>
      <th><?php echo $this->_tpl_vars['LANG']['domainname']; ?>
</th>
      <th><?php echo $this->_tpl_vars['LANG']['domainstatus']; ?>
</th>
      <th><?php echo $this->_tpl_vars['LANG']['domainmoreinfo']; ?>
</th>
    </tr>
    <?php $_from = $this->_tpl_vars['availabilityresults']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['result']):
?>
    <tr>
      <td><?php echo $this->_tpl_vars['result']['domain']; ?>
</td>
      <td class="<?php if ($this->_tpl_vars['result']['status'] == $this->_tpl_vars['searchvar']): ?>domaincheckeravailable<?php else: ?>domaincheckerunavailable<?php endif; ?>"><?php if ($this->_tpl_vars['result']['status'] == $this->_tpl_vars['searchvar']): ?>
        <input type="checkbox" name="domains[]" value="<?php echo $this->_tpl_vars['result']['domain']; ?>
"<?php if ($this->_tpl_vars['num'] == 0): ?> checked<?php endif; ?> />
        <?php echo $this->_tpl_vars['LANG']['domainavailable']; ?>
<?php else: ?><?php echo $this->_tpl_vars['LANG']['domainunavailable']; ?>
<?php endif; ?></td>
      <td><?php if ($this->_tpl_vars['result']['regoptions']): ?>
        <select name="domainsregperiod[<?php echo $this->_tpl_vars['result']['domain']; ?>
]">
          <?php $_from = $this->_tpl_vars['result']['regoptions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['period'] => $this->_tpl_vars['regoption']):
?>
          <?php if ($this->_tpl_vars['regoption'][$this->_tpl_vars['domainoption']]): ?><option value="<?php echo $this->_tpl_vars['period']; ?>
">
            <?php echo $this->_tpl_vars['period']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderyears']; ?>
 @ <?php echo $this->_tpl_vars['regoption'][$this->_tpl_vars['domainoption']]; ?>

          </option><?php endif; ?>
          <?php endforeach; endif; unset($_from); ?>
        </select>
      <?php endif; ?></td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
  </table>
  <p align="center">
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['ordercontinuebutton']; ?>
" class="buttongo" />
  </p>
  <?php endif; ?>

  <?php if ($this->_tpl_vars['freedomaintlds']): ?>* <em><?php echo $this->_tpl_vars['LANG']['orderfreedomainregistration']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderfreedomainappliesto']; ?>
: <?php echo $this->_tpl_vars['freedomaintlds']; ?>
</em><?php endif; ?>
</form><br />