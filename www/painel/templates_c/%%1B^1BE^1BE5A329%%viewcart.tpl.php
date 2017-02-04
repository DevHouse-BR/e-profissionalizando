<?php /* Smarty version 2.6.26, created on 2011-01-20 22:00:30
         compiled from /home/prof/public_html/painel/templates/orderforms/web20cart/viewcart.tpl */ ?>
<link rel="stylesheet" type="text/css" href="templates/orderforms/web20cart/style.css" />
<script type="text/javascript" src="includes/jscript/pwstrength.js"></script>
<h2><?php echo $this->_tpl_vars['LANG']['carttitle']; ?>
</h2>
<?php echo '
<script language="javascript">
function removeItem(type,num) {
	var response = confirm("'; ?>
<?php echo $this->_tpl_vars['LANG']['cartremoveitemconfirm']; ?>
<?php echo '");
	if (response) {
		window.location = \'cart.php?a=remove&r=\'+type+\'&i=\'+num;
	}
}
function emptyCart(type,num) {
	var response = confirm("'; ?>
<?php echo $this->_tpl_vars['LANG']['cartemptyconfirm']; ?>
<?php echo '");
	if (response) {
		window.location = \'cart.php?a=empty\';
	}
}
function showCCForm() {
    jQuery("#ccinputform").slideDown();
}
function hideCCForm() {
    jQuery("#ccinputform").slideUp();
}
function useExistingCC() {
    jQuery(".newccinfo").hide();
}
function enterNewCC() {
    jQuery(".newccinfo").show();
}
</script>
'; ?>


<?php if ($this->_tpl_vars['errormessage']): ?>
<div class="errorbox"><?php echo $this->_tpl_vars['errormessage']; ?>
</div>
<br />
<?php elseif ($this->_tpl_vars['promotioncode'] && $this->_tpl_vars['rawdiscount'] == "0.00"): ?>
<div class="errorbox"><?php echo $this->_tpl_vars['LANG']['promoappliedbutnodiscount']; ?>
</div>
<br />
<?php endif; ?>

<?php if (! $this->_tpl_vars['loggedin'] && $this->_tpl_vars['currencies']): ?>
<form method="post" action="cart.php?a=view">
<p align="right"><?php echo $this->_tpl_vars['LANG']['choosecurrency']; ?>
: <select name="currency" onchange="submit()"><?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
<option value="<?php echo $this->_tpl_vars['curr']['id']; ?>
"<?php if ($this->_tpl_vars['curr']['id'] == $this->_tpl_vars['currency']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['curr']['code']; ?>
</option>
<?php endforeach; endif; unset($_from); ?></select> <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['go']; ?>
" /></p>
</form>
<br />
<?php endif; ?>

<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" class="data">
  <tr>
    <th width="55%"><?php echo $this->_tpl_vars['LANG']['orderdesc']; ?>
</th>
    <th width="45%"><?php echo $this->_tpl_vars['LANG']['orderprice']; ?>
</th>
  </tr>
  <?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['product']):
?>
  <tr class="carttableproduct">
    <td><strong><em><?php echo $this->_tpl_vars['product']['productinfo']['groupname']; ?>
</em> - <?php echo $this->_tpl_vars['product']['productinfo']['name']; ?>
</strong><?php if ($this->_tpl_vars['product']['domain']): ?> (<?php echo $this->_tpl_vars['product']['domain']; ?>
)<?php endif; ?><br />
      <?php if ($this->_tpl_vars['product']['configoptions']): ?>
      <?php $_from = $this->_tpl_vars['product']['configoptions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['confnum'] => $this->_tpl_vars['configoption']):
?>&nbsp;&raquo; <?php echo $this->_tpl_vars['configoption']['name']; ?>
: <?php if ($this->_tpl_vars['configoption']['type'] == 1 || $this->_tpl_vars['configoption']['type'] == 2): ?><?php echo $this->_tpl_vars['configoption']['option']; ?>
<?php elseif ($this->_tpl_vars['configoption']['type'] == 3): ?><?php if ($this->_tpl_vars['configoption']['qty']): ?><?php echo $this->_tpl_vars['LANG']['yes']; ?>
<?php else: ?><?php echo $this->_tpl_vars['LANG']['no']; ?>
<?php endif; ?><?php elseif ($this->_tpl_vars['configoption']['type'] == 4): ?><?php echo $this->_tpl_vars['configoption']['qty']; ?>
 x <?php echo $this->_tpl_vars['configoption']['option']; ?>
<?php endif; ?><br />
      <?php endforeach; endif; unset($_from); ?>
      <?php endif; ?> </td>
    <td align="center"><strong><?php echo $this->_tpl_vars['product']['pricingtext']; ?>
<?php if ($this->_tpl_vars['product']['proratadate']): ?><br />
      (<?php echo $this->_tpl_vars['LANG']['orderprorata']; ?>
 <?php echo $this->_tpl_vars['product']['proratadate']; ?>
)<?php endif; ?></strong></td>
  </tr>
  <?php $_from = $this->_tpl_vars['product']['addons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['addonnum'] => $this->_tpl_vars['addon']):
?>
  <tr class="carttableproduct">
    <td><strong><?php echo $this->_tpl_vars['LANG']['orderaddon']; ?>
</strong> - <?php echo $this->_tpl_vars['addon']['name']; ?>
</td>
    <td align="center"><strong><?php echo $this->_tpl_vars['addon']['pricingtext']; ?>
</strong></td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
  <tr class="carttableconfig">
    <td><a href="<?php echo $_SERVER['PHP_SELF']; ?>
?a=confproduct&i=<?php echo $this->_tpl_vars['num']; ?>
" style="color:#009900;">[<?php echo $this->_tpl_vars['LANG']['carteditproductconfig']; ?>
]</a> <a href="#" onclick="removeItem('p','<?php echo $this->_tpl_vars['num']; ?>
');return false" style="color:#cc0000;">[<?php echo $this->_tpl_vars['LANG']['cartremove']; ?>
]</a></td>
    <td>&nbsp;</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
  
  <?php $_from = $this->_tpl_vars['addons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['addon']):
?>
  <tr class="carttableproduct">
    <td><strong><?php echo $this->_tpl_vars['addon']['name']; ?>
</strong><br />
      <?php echo $this->_tpl_vars['addon']['productname']; ?>
<?php if ($this->_tpl_vars['addon']['domainname']): ?> - <?php echo $this->_tpl_vars['addon']['domainname']; ?>
<?php endif; ?> </td>
    <td align="center"><strong><?php echo $this->_tpl_vars['addon']['pricingtext']; ?>
</td>
  </tr>
  <tr class="carttableconfig">
    <td><a href="#" onclick="removeItem('a','<?php echo $this->_tpl_vars['num']; ?>
');return false" style="color:#cc0000;">[<?php echo $this->_tpl_vars['LANG']['cartremove']; ?>
]</a></td>
    <td>&nbsp;</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
  
  <?php $_from = $this->_tpl_vars['domains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['domain']):
?>
  <tr class="carttableproduct">
    <td><strong><?php if ($this->_tpl_vars['domain']['type'] == 'register'): ?><?php echo $this->_tpl_vars['LANG']['orderdomainregistration']; ?>
<?php else: ?><?php echo $this->_tpl_vars['LANG']['orderdomaintransfer']; ?>
<?php endif; ?></strong> - <?php echo $this->_tpl_vars['domain']['domain']; ?>
 - <?php echo $this->_tpl_vars['domain']['regperiod']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderyears']; ?>
<br />
      <?php if ($this->_tpl_vars['domain']['dnsmanagement']): ?>&nbsp;&raquo; <?php echo $this->_tpl_vars['LANG']['domaindnsmanagement']; ?>
<br />
      <?php endif; ?>
      <?php if ($this->_tpl_vars['domain']['emailforwarding']): ?>&nbsp;&raquo; <?php echo $this->_tpl_vars['LANG']['domainemailforwarding']; ?>
<br />
      <?php endif; ?>
      <?php if ($this->_tpl_vars['domain']['idprotection']): ?>&nbsp;&raquo; <?php echo $this->_tpl_vars['LANG']['domainidprotection']; ?>
<br />
      <?php endif; ?> </td>
    <td align="center"><strong><?php echo $this->_tpl_vars['domain']['price']; ?>
</strong></td>
  </tr>
  <tr class="carttableconfig">
    <td><a href="<?php echo $_SERVER['PHP_SELF']; ?>
?a=confdomains" style="color:#009900;">[<?php echo $this->_tpl_vars['LANG']['cartconfigdomainextras']; ?>
]</a> <a href="#" onclick="removeItem('d','<?php echo $this->_tpl_vars['num']; ?>
');return false" style="color:#cc0000;">[<?php echo $this->_tpl_vars['LANG']['cartremove']; ?>
]</a></td>
    <td>&nbsp;</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>

  <?php $_from = $this->_tpl_vars['renewals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['domain']):
?>
  <tr class="carttableproduct">
    <td><strong><?php echo $this->_tpl_vars['LANG']['domainrenewal']; ?>
</strong> - <?php echo $this->_tpl_vars['domain']['domain']; ?>
 - <?php echo $this->_tpl_vars['domain']['regperiod']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderyears']; ?>
<br />
      <?php if ($this->_tpl_vars['domain']['dnsmanagement']): ?>&nbsp;&raquo; <?php echo $this->_tpl_vars['LANG']['domaindnsmanagement']; ?>
<br />
      <?php endif; ?>
      <?php if ($this->_tpl_vars['domain']['emailforwarding']): ?>&nbsp;&raquo; <?php echo $this->_tpl_vars['LANG']['domainemailforwarding']; ?>
<br />
      <?php endif; ?>
      <?php if ($this->_tpl_vars['domain']['idprotection']): ?>&nbsp;&raquo; <?php echo $this->_tpl_vars['LANG']['domainidprotection']; ?>
<br />
      <?php endif; ?> </td>
    <td align="center"><strong><?php echo $this->_tpl_vars['domain']['price']; ?>
</strong></td>
  </tr>
  <tr class="carttableconfig">
    <td><a href="#" onclick="removeItem('r','<?php echo $this->_tpl_vars['num']; ?>
');return false" style="color:#cc0000;">[<?php echo $this->_tpl_vars['LANG']['cartremove']; ?>
]</a></td>
    <td>&nbsp;</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
  
  <?php if ($this->_tpl_vars['cartitems'] == 0): ?>
  <tr class="clientareatableactive">
    <td colspan="2"><br />
      <?php echo $this->_tpl_vars['LANG']['cartempty']; ?>
 <br />
    <br /></td>
  </tr>
  <?php endif; ?>
  <tr class="carttablesummary">
    <td align="right"><?php echo $this->_tpl_vars['LANG']['ordersubtotal']; ?>
: &nbsp;</td>
    <td align="center"><?php echo $this->_tpl_vars['subtotal']; ?>
</td>
  </tr>
  <?php if ($this->_tpl_vars['promotioncode']): ?>
  <tr class="carttablepromotion">
    <td align="right"><?php echo $this->_tpl_vars['promotiondescription']; ?>
: &nbsp;</td>
    <td align="center"><?php echo $this->_tpl_vars['discount']; ?>
</td>
  </tr>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['taxrate']): ?>
  <tr class="carttablesummary">
    <td align="right"><?php echo $this->_tpl_vars['taxname']; ?>
 @ <?php echo $this->_tpl_vars['taxrate']; ?>
%: &nbsp;</td>
    <td align="center"><?php echo $this->_tpl_vars['taxtotal']; ?>
</td>
  </tr>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['taxrate2']): ?>
  <tr class="carttablesummary">
    <td align="right"><?php echo $this->_tpl_vars['taxname2']; ?>
 @ <?php echo $this->_tpl_vars['taxrate2']; ?>
%: &nbsp;</td>
    <td align="center"><?php echo $this->_tpl_vars['taxtotal2']; ?>
</td>
  </tr>
  <?php endif; ?>
  <tr class="carttabledue">
    <td align="right"><?php echo $this->_tpl_vars['LANG']['ordertotalduetoday']; ?>
: &nbsp;</td>
    <td align="center"><?php echo $this->_tpl_vars['total']; ?>
</td>
  </tr>
  <?php if ($this->_tpl_vars['totalrecurringmonthly'] || $this->_tpl_vars['totalrecurringquarterly'] || $this->_tpl_vars['totalrecurringsemiannually'] || $this->_tpl_vars['totalrecurringannually'] || $this->_tpl_vars['totalrecurringbiennially'] || $this->_tpl_vars['totalrecurringtriennially']): ?>
  <tr class="carttablerecurring">
    <td align="right"><?php echo $this->_tpl_vars['LANG']['ordertotalrecurring']; ?>
: &nbsp;</td>
    <td align="center"><?php if ($this->_tpl_vars['totalrecurringmonthly']): ?><?php echo $this->_tpl_vars['totalrecurringmonthly']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderpaymenttermmonthly']; ?>
<br />
      <?php endif; ?>
      <?php if ($this->_tpl_vars['totalrecurringquarterly']): ?><?php echo $this->_tpl_vars['totalrecurringquarterly']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderpaymenttermquarterly']; ?>
<br />
      <?php endif; ?>
      <?php if ($this->_tpl_vars['totalrecurringsemiannually']): ?><?php echo $this->_tpl_vars['totalrecurringsemiannually']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderpaymenttermsemiannually']; ?>
<br />
      <?php endif; ?>
      <?php if ($this->_tpl_vars['totalrecurringannually']): ?><?php echo $this->_tpl_vars['totalrecurringannually']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderpaymenttermannually']; ?>
<br />
      <?php endif; ?>
      <?php if ($this->_tpl_vars['totalrecurringbiennially']): ?><?php echo $this->_tpl_vars['totalrecurringbiennially']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderpaymenttermbiennially']; ?>
<br />
      <?php endif; ?>
      <?php if ($this->_tpl_vars['totalrecurringtriennially']): ?><?php echo $this->_tpl_vars['totalrecurringtriennially']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderpaymenttermtriennially']; ?>
<br />
      <?php endif; ?></td>
  </tr>
  <?php endif; ?>
</table>
<br />
<?php if (! $this->_tpl_vars['checkout']): ?>
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td width="55%" align="center"><form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?a=view">
        <input type="hidden" name="validatepromo" value="true" />
        <strong><?php echo $this->_tpl_vars['LANG']['orderpromotioncode']; ?>
</strong> <?php if ($this->_tpl_vars['promotioncode']): ?><?php echo $this->_tpl_vars['promotioncode']; ?>
 - <?php echo $this->_tpl_vars['promotiondescription']; ?>
<br /><a href="<?php echo $_SERVER['PHP_SELF']; ?>
?a=removepromo"><?php echo $this->_tpl_vars['LANG']['orderdontusepromo']; ?>
</a><?php else: ?>
        <input type="text" name="promocode" size="20" /> 
        <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['orderpromovalidatebutton']; ?>
" class="button" />
        <?php endif; ?>
      </form></td>
    <td width="45%" align="center"><input type="button" value="<?php echo $this->_tpl_vars['LANG']['emptycart']; ?>
" onclick="emptyCart();return false" class="buttonwarn" />
      <input type="button" value="<?php echo $this->_tpl_vars['LANG']['continueshopping']; ?>
" onclick="window.location='cart.php'" class="button" />
    <input type="button" value="<?php echo $this->_tpl_vars['LANG']['checkout']; ?>
" onclick="window.location='cart.php?a=checkout'"<?php if ($this->_tpl_vars['cartitems'] == 0): ?> disabled<?php endif; ?> class="buttongo" /></td>
  </tr>
</table>
<?php else: ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?a=checkout">
  <input type="hidden" name="submit" value="true" />
  <h3><?php echo $this->_tpl_vars['LANG']['yourdetails']; ?>
</h3>
  <p><?php if (! $this->_tpl_vars['loggedin']): ?><strong><?php echo $this->_tpl_vars['LANG']['alreadyregistered']; ?>
</strong> <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?a=login"><?php echo $this->_tpl_vars['LANG']['clickheretologin']; ?>
</a><?php endif; ?></p>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="frame">
    <tr>
      <td width="50%" valign="top"><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="100" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareafirstname']; ?>
</td>
            <td><?php if ($this->_tpl_vars['loggedin']): ?><?php echo $this->_tpl_vars['clientsdetails']['firstname']; ?>
<?php else: ?>
              <input type="text" name="firstname" style="width:80%;" value="<?php echo $this->_tpl_vars['clientsdetails']['firstname']; ?>
" />
              <?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientarealastname']; ?>
</td>
            <td><?php if ($this->_tpl_vars['loggedin']): ?><?php echo $this->_tpl_vars['clientsdetails']['lastname']; ?>
<?php else: ?>
              <input type="text" name="lastname" style="width:80%;" value="<?php echo $this->_tpl_vars['clientsdetails']['lastname']; ?>
" />
              <?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareacompanyname']; ?>
</td>
            <td><?php if ($this->_tpl_vars['loggedin']): ?><?php echo $this->_tpl_vars['clientsdetails']['companyname']; ?>
<?php else: ?>
              <input type="text" name="companyname" style="width:80%;" value="<?php echo $this->_tpl_vars['clientsdetails']['companyname']; ?>
" />
              <?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"<?php if (! $this->_tpl_vars['loggedin']): ?> style="height:21px;"<?php endif; ?>>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaemail']; ?>
</td>
            <td><?php if ($this->_tpl_vars['loggedin']): ?><?php echo $this->_tpl_vars['clientsdetails']['email']; ?>
<?php else: ?>
              <input type="text" name="email" style="width:90%;" value="<?php echo $this->_tpl_vars['clientsdetails']['email']; ?>
" />
              <?php endif; ?></td>
          </tr>
          <?php if ($this->_tpl_vars['loggedin']): ?>
          <tr>
            <td class="fieldarea">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="fieldarea">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <?php else: ?>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareapassword']; ?>
</td>
            <td><input type="password" name="password" size="20" id="newpw" value="<?php echo $this->_tpl_vars['password']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaconfirmpassword']; ?>
</td>
            <td><input type="password" name="password2" size="20" value="<?php echo $this->_tpl_vars['password2']; ?>
" /></td>
          </tr>
          <?php endif; ?>
      </table></td>
      <td width="50%" valign="top"><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="100" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaaddress1']; ?>
</td>
            <td><?php if ($this->_tpl_vars['loggedin']): ?><?php echo $this->_tpl_vars['clientsdetails']['address1']; ?>
<?php else: ?>
              <input type="text" name="address1" style="width:80%;" value="<?php echo $this->_tpl_vars['clientsdetails']['address1']; ?>
" />
              <?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaaddress2']; ?>
</td>
            <td><?php if ($this->_tpl_vars['loggedin']): ?><?php echo $this->_tpl_vars['clientsdetails']['address2']; ?>
<?php else: ?>
              <input type="text" name="address2" style="width:80%;" value="<?php echo $this->_tpl_vars['clientsdetails']['address2']; ?>
" />
              <?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareacity']; ?>
</td>
            <td><?php if ($this->_tpl_vars['loggedin']): ?><?php echo $this->_tpl_vars['clientsdetails']['city']; ?>
<?php else: ?>
              <input type="text" name="city" style="width:80%;" value="<?php echo $this->_tpl_vars['clientsdetails']['city']; ?>
" />
              <?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareastate']; ?>
</td>
            <td><?php if ($this->_tpl_vars['loggedin']): ?><?php echo $this->_tpl_vars['clientsdetails']['state']; ?>
<?php else: ?>
              <input type="text" name="state" style="width:80%;" value="<?php echo $this->_tpl_vars['clientsdetails']['state']; ?>
" />
              <?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareapostcode']; ?>
</td>
            <td><?php if ($this->_tpl_vars['loggedin']): ?><?php echo $this->_tpl_vars['clientsdetails']['postcode']; ?>
<?php else: ?>
              <input type="text" name="postcode" size="15" value="<?php echo $this->_tpl_vars['clientsdetails']['postcode']; ?>
" />
              <?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareacountry']; ?>
</td>
            <td><?php if ($this->_tpl_vars['loggedin']): ?><?php echo $this->_tpl_vars['clientsdetails']['country']; ?>
<?php else: ?><?php echo $this->_tpl_vars['clientcountrydropdown']; ?>
<?php endif; ?></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaphonenumber']; ?>
</td>
            <td><?php if ($this->_tpl_vars['loggedin']): ?><?php echo $this->_tpl_vars['clientsdetails']['phonenumber']; ?>
<?php else: ?>
              <input type="text" name="phonenumber" size="20" value="<?php echo $this->_tpl_vars['clientsdetails']['phonenumber']; ?>
" />
              <?php endif; ?></td>
          </tr>
      </table></td>
    </tr>
  </table>
  <?php if (! $this->_tpl_vars['loggedin']): ?><script language="javascript">showStrengthBar();</script><?php endif; ?>
  <?php if ($this->_tpl_vars['customfields'] || $this->_tpl_vars['securityquestions']): ?> <br />
  <table width="100%" cellspacing="1" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" cellpadding="2">
      <?php if ($this->_tpl_vars['securityquestions'] && ! $this->_tpl_vars['loggedin']): ?>
        <tr><td width="200" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareasecurityquestion']; ?>
</td><td><select name="securityqid">
          <?php $_from = $this->_tpl_vars['securityquestions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['question']):
?>
	        <option value=<?php echo $this->_tpl_vars['question']['id']; ?>
><?php echo $this->_tpl_vars['question']['question']; ?>
</option>
          <?php endforeach; endif; unset($_from); ?>
        </select></td></tr>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareasecurityanswer']; ?>
</td><td><input type="password" name="securityqans" size="30"></td>
        </tr>
      <?php endif; ?>
      <?php $_from = $this->_tpl_vars['customfields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['customfield']):
?>
        <tr><td width="200" class="fieldarea"><?php echo $this->_tpl_vars['customfield']['name']; ?>
</td><td><?php echo $this->_tpl_vars['customfield']['input']; ?>
 <?php echo $this->_tpl_vars['customfield']['description']; ?>
</td></tr>
      <?php endforeach; endif; unset($_from); ?>
      </table></td>
    </tr>
  </table>
  <?php endif; ?>

  <?php if ($this->_tpl_vars['taxenabled'] && ! $this->_tpl_vars['loggedin']): ?>
  <p align="center"><?php echo $this->_tpl_vars['LANG']['carttaxupdateselections']; ?>

    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['carttaxupdateselectionsupdate']; ?>
" name="updateonly" />
  </p>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['domainsinorder']): ?>
  <h3><?php echo $this->_tpl_vars['LANG']['domainregistrantinfo']; ?>
</h3>
  <?php if ($this->_tpl_vars['addcontact']): ?>
  <input type="hidden" name="contact" value="addingnew" />
  <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td width="50%" valign="top"><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="100" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareafirstname']; ?>
</td>
            <td><input type="text" name="domaincontactfirstname" style="width:80%;" value="<?php echo $this->_tpl_vars['domaincontact']['firstname']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientarealastname']; ?>
</td>
            <td><input type="text" name="domaincontactlastname" style="width:80%;" value="<?php echo $this->_tpl_vars['domaincontact']['lastname']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareacompanyname']; ?>
</td>
            <td><input type="text" name="domaincontactcompanyname" style="width:80%;" value="<?php echo $this->_tpl_vars['domaincontact']['companyname']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea" style="height:21px;"><br /></td>
            <td></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaemail']; ?>
</td>
            <td><input type="text" name="domaincontactemail" style="width:90%;" value="<?php echo $this->_tpl_vars['domaincontact']['email']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaphonenumber']; ?>
</td>
            <td><input type="text" name="domaincontactphonenumber" size="20" value="<?php echo $this->_tpl_vars['domaincontact']['phonenumber']; ?>
" /></td>
          </tr>
      </table></td>
      <td width="50%" valign="top"><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="100" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaaddress1']; ?>
</td>
            <td><input type="text" name="domaincontactaddress1" style="width:80%;" value="<?php echo $this->_tpl_vars['domaincontact']['address1']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareaaddress2']; ?>
</td>
            <td><input type="text" name="domaincontactaddress2" style="width:80%;" value="<?php echo $this->_tpl_vars['domaincontact']['address2']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareacity']; ?>
</td>
            <td><input type="text" name="domaincontactcity" style="width:80%;" value="<?php echo $this->_tpl_vars['domaincontact']['city']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareastate']; ?>
</td>
            <td><input type="text" name="domaincontactstate" style="width:80%;" value="<?php echo $this->_tpl_vars['domaincontact']['state']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareapostcode']; ?>
</td>
            <td><input type="text" name="domaincontactpostcode" size="15" value="<?php echo $this->_tpl_vars['domaincontact']['postcode']; ?>
" /></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareacountry']; ?>
</td>
            <td><?php echo $this->_tpl_vars['domaincontactcountrydropdown']; ?>
</td>
          </tr>
      </table></td>
    </tr>
  </table>
  <?php else: ?>
  <p><?php echo $this->_tpl_vars['LANG']['domainregistrantchoose']; ?>
:
    <select name="contact">
      <option value=""><?php echo $this->_tpl_vars['LANG']['usedefaultcontact']; ?>
</option>
      
<?php $_from = $this->_tpl_vars['domaincontacts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['domaincontact']):
?>

      <option value="<?php echo $this->_tpl_vars['domaincontact']['id']; ?>
"><?php echo $this->_tpl_vars['domaincontact']['name']; ?>
</option>
      
<?php endforeach; endif; unset($_from); ?>

      <option value="new"><?php echo $this->_tpl_vars['LANG']['clientareanavaddcontact']; ?>
...</option>
    </select>
    <br />
  </p>
  <?php endif; ?>
  <?php endif; ?>
  <h3><?php echo $this->_tpl_vars['LANG']['orderpaymentmethod']; ?>
</h3>
  <p align="center"><?php $_from = $this->_tpl_vars['gateways']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['gateway']):
?>
    <input type="radio" name="paymentmethod" value="<?php echo $this->_tpl_vars['gateway']['sysname']; ?>
" id="pgbtn<?php echo $this->_tpl_vars['num']; ?>
" onclick="<?php if ($this->_tpl_vars['gateway']['type'] == 'CC'): ?>showCCForm()<?php else: ?>hideCCForm()<?php endif; ?>"<?php if ($this->_tpl_vars['selectedgateway'] == $this->_tpl_vars['gateway']['sysname']): ?> checked<?php endif; ?> />
    <label for="pgbtn<?php echo $this->_tpl_vars['num']; ?>
"><?php echo $this->_tpl_vars['gateway']['name']; ?>
</label>
    <?php endforeach; endif; unset($_from); ?></p>

<div id="ccinputform"<?php if ($this->_tpl_vars['selectedgatewaytype'] != 'CC'): ?> style="display:none;"<?php endif; ?>>
<table width="100%" cellspacing="1" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" cellpadding="2">
        <?php if ($this->_tpl_vars['clientsdetails']['cclastfour']): ?>
        <tr>
          <td width="200" class="fieldarea"></td>
          <td><input type="radio" name="ccinfo" value="useexisting" id="useexisting" onclick="useExistingCC()"<?php if ($this->_tpl_vars['clientsdetails']['cclastfour']): ?> checked<?php else: ?> disabled<?php endif; ?> /> <label for="useexisting"><?php echo $this->_tpl_vars['LANG']['creditcarduseexisting']; ?>
<?php if ($this->_tpl_vars['clientsdetails']['cclastfour']): ?> (<?php echo $this->_tpl_vars['clientsdetails']['cclastfour']; ?>
)<?php endif; ?></label><br />
              <input type="radio" name="ccinfo" value="new" id="new" onclick="enterNewCC()"<?php if (! $this->_tpl_vars['clientsdetails']['cclastfour'] || $this->_tpl_vars['ccinfo'] == 'new'): ?> checked<?php endif; ?> /> <label for="new"><?php echo $this->_tpl_vars['LANG']['creditcardenternewcard']; ?>
</label>
          </td>
        </tr>
        <?php else: ?>
        <input type="hidden" name="ccinfo" value="new" />
        <?php endif; ?>
        <tr class="newccinfo"<?php if ($this->_tpl_vars['clientsdetails']['cclastfour'] && $this->_tpl_vars['ccinfo'] != 'new'): ?> style="display:none;"<?php endif; ?>>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['creditcardcardtype']; ?>
</td>
          <td><select name="cctype">
            <?php $_from = $this->_tpl_vars['acceptedcctypes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['cardtype']):
?>
            <option<?php if ($this->_tpl_vars['cctype'] == $this->_tpl_vars['cardtype']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['cardtype']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
          </select></td>
        </tr>
        <tr class="newccinfo"<?php if ($this->_tpl_vars['clientsdetails']['cclastfour'] && $this->_tpl_vars['ccinfo'] != 'new'): ?> style="display:none;"<?php endif; ?>>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['creditcardcardnumber']; ?>
</td>
          <td><input type="text" name="ccnumber" size="30" value="<?php echo $this->_tpl_vars['ccnumber']; ?>
" autocomplete="off" /></td>
        </tr>
        <tr class="newccinfo"<?php if ($this->_tpl_vars['clientsdetails']['cclastfour'] && $this->_tpl_vars['ccinfo'] != 'new'): ?> style="display:none;"<?php endif; ?>>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['creditcardcardexpires']; ?>
</td>
          <td><input type="text" name="ccexpirymonth" size="2" maxlength="2" value="<?php echo $this->_tpl_vars['ccexpirymonth']; ?>
" />/<input type="text" name="ccexpiryyear" size="2" maxlength="2" value="<?php echo $this->_tpl_vars['ccexpiryyear']; ?>
" /> (MM/YY)</td>
        </tr>
        <?php if ($this->_tpl_vars['showccissuestart']): ?>
        <tr class="newccinfo"<?php if ($this->_tpl_vars['clientsdetails']['cclastfour'] && $this->_tpl_vars['ccinfo'] != 'new'): ?> style="display:none;"<?php endif; ?>>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['creditcardcardstart']; ?>
</td>
          <td><input type="text" name="ccstartmonth" size="2" maxlength="2" value="<?php echo $this->_tpl_vars['ccstartmonth']; ?>
">/<input type="text" name="ccstartyear" size="2" maxlength="2" value="<?php echo $this->_tpl_vars['ccstartyear']; ?>
" /> (MM/YY)</td>
        </tr>
        <tr class="newccinfo"<?php if ($this->_tpl_vars['clientsdetails']['cclastfour'] && $this->_tpl_vars['ccinfo'] != 'new'): ?> style="display:none;"<?php endif; ?>>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['creditcardcardissuenum']; ?>
</td>
          <td><input type="text" name="ccissuenum" value="<?php echo $this->_tpl_vars['ccissuenum']; ?>
" size="5" maxlength="3" /></td>
        </tr>
        <?php endif; ?>
        <tr>
          <td width="200" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['creditcardcvvnumber']; ?>
</td>
          <td><input type="text" name="cccvv" value="<?php echo $this->_tpl_vars['cccvv']; ?>
" size="5" autocomplete="off" /> <a href="#" onclick="window.open('images/ccv.gif','','width=280,height=200,scrollbars=no,top=100,left=100');return false"><?php echo $this->_tpl_vars['LANG']['creditcardcvvwhere']; ?>
</a></td>
        </tr>
        <?php if ($this->_tpl_vars['shownostore']): ?>
        <tr>
          <td class="fieldarea"><input type="checkbox" name="nostore" id="nostore" /></td>
          <td><label for="nostore"><?php echo $this->_tpl_vars['LANG']['creditcardnostore']; ?>
</label></td>
        </tr>
        <?php endif; ?>
      </table></td>
    </tr>
</table>
</div>

  <?php if ($this->_tpl_vars['shownotesfield']): ?>
  <h3><?php echo $this->_tpl_vars['LANG']['ordernotes']; ?>
</h3>
  <p align="center">
    <textarea name="notes" rows="4" style="width:75%" onFocus="if(this.value=='<?php echo $this->_tpl_vars['LANG']['ordernotesdescription']; ?>
'){this.value='';}" onBlur="if (this.value==''){this.value='<?php echo $this->_tpl_vars['LANG']['ordernotesdescription']; ?>
';}"><?php echo $this->_tpl_vars['notes']; ?>
</textarea>
  </p>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['accepttos']): ?>
  <p align="center">
    <input type="checkbox" name="accepttos" id="accepttos" />
    <label for="accepttos"><?php echo $this->_tpl_vars['LANG']['ordertosagreement']; ?>
 <a href="<?php echo $this->_tpl_vars['tosurl']; ?>
" target="_blank"><?php echo $this->_tpl_vars['LANG']['ordertos']; ?>
</a></label>
  <p> <?php endif; ?>
  <p align="center">
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['completeorder']; ?>
"<?php if ($this->_tpl_vars['cartitems'] == 0): ?> disabled<?php endif; ?> onclick="this.value='<?php echo $this->_tpl_vars['LANG']['pleasewait']; ?>
'" class="buttongo" />
  </p>
  <p><img src="images/padlock.gif" border="0" class="imgfloat" alt="Secure Transaction" /> <?php echo $this->_tpl_vars['LANG']['ordersecure']; ?>
 (<strong><?php echo $this->_tpl_vars['ipaddress']; ?>
</strong>) <?php echo $this->_tpl_vars['LANG']['ordersecure2']; ?>
</p>
</form>
<?php endif; ?><br />