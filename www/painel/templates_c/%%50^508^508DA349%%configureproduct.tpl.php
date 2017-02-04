<?php /* Smarty version 2.6.26, created on 2011-01-20 21:59:58
         compiled from /home/prof/public_html/painel/templates/orderforms/web20cart/configureproduct.tpl */ ?>
<link rel="stylesheet" type="text/css" href="templates/orderforms/web20cart/style.css" />
<h2><?php echo $this->_tpl_vars['LANG']['cartproductconfig']; ?>
</h2>
<p><?php echo $this->_tpl_vars['LANG']['cartproductdesc']; ?>
</p>
<?php if ($this->_tpl_vars['editconfig']): ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?a=confproduct&i=<?php echo $this->_tpl_vars['i']; ?>
">
<input type="hidden" name="configure" value="true">
<?php else: ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?a=add&pid=<?php echo $this->_tpl_vars['pid']; ?>
">
  <input type="hidden" name="configure" value="true">
  <?php endif; ?>

  <?php if ($this->_tpl_vars['errormessage']): ?>
  <div class="errorbox"><?php echo $this->_tpl_vars['errormessage']; ?>
</div>
  <br />
  <?php endif; ?>

  <?php if ($this->_tpl_vars['productinfo']): ?>
  <h3><?php echo $this->_tpl_vars['LANG']['orderproduct']; ?>
</h3>
  <div class="cartbox"><strong><?php echo $this->_tpl_vars['productinfo']['groupname']; ?>
 - <?php echo $this->_tpl_vars['productinfo']['name']; ?>
</strong><br />
    <?php echo $this->_tpl_vars['productinfo']['description']; ?>
</div>
  <input type="hidden" name="previousbillingcycle" value="<?php echo $this->_tpl_vars['billingcycle']; ?>
" />
  <h3><?php echo $this->_tpl_vars['LANG']['orderbillingcycle']; ?>
</h3>
  <div class="cartbox"><?php if ($this->_tpl_vars['pricing']['type'] == 'free'): ?>
    <input type="hidden" name="billingcycle" value="free" />
    <?php echo $this->_tpl_vars['LANG']['orderfree']; ?>

    <?php elseif ($this->_tpl_vars['pricing']['type'] == 'onetime'): ?>
    <input type="hidden" name="billingcycle" value="onetime" />
    <?php echo $this->_tpl_vars['pricing']['onetime']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderpaymenttermonetime']; ?>

    <?php else: ?>
<select name="billingcycle" onchange="submit()">
<?php if ($this->_tpl_vars['pricing']['monthly']): ?><option value="monthly"<?php if ($this->_tpl_vars['billingcycle'] == 'monthly'): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['pricing']['monthly']; ?>
</option><?php endif; ?>
<?php if ($this->_tpl_vars['pricing']['quarterly']): ?><option value="quarterly"<?php if ($this->_tpl_vars['billingcycle'] == 'quarterly'): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['pricing']['quarterly']; ?>
</option><?php endif; ?>
<?php if ($this->_tpl_vars['pricing']['semiannually']): ?><option value="semiannually"<?php if ($this->_tpl_vars['billingcycle'] == 'semiannually'): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['pricing']['semiannually']; ?>
</option><?php endif; ?>
<?php if ($this->_tpl_vars['pricing']['annually']): ?><option value="annually"<?php if ($this->_tpl_vars['billingcycle'] == 'annually'): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['pricing']['annually']; ?>
</option><?php endif; ?>
<?php if ($this->_tpl_vars['pricing']['biennially']): ?><option value="biennially"<?php if ($this->_tpl_vars['billingcycle'] == 'biennially'): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['pricing']['biennially']; ?>
</option><?php endif; ?>
<?php if ($this->_tpl_vars['pricing']['triennially']): ?><option value="triennially"<?php if ($this->_tpl_vars['billingcycle'] == 'triennially'): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['pricing']['triennially']; ?>
</option><?php endif; ?>
</select>
    <?php endif; ?></div>
  <?php endif; ?>

  <?php if ($this->_tpl_vars['productinfo']['type'] == 'server'): ?>
  <h3><?php echo $this->_tpl_vars['LANG']['cartconfigserver']; ?>
</h3>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['serverhostname']; ?>
:</td>
            <td><input type="text" name="hostname" size="15" value="<?php echo $this->_tpl_vars['server']['hostname']; ?>
" />
              eg. server1(.yourdomain.com)</td>
          </tr>
          <tr>
            <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['serverns1prefix']; ?>
:</td>
            <td><input type="text" name="ns1prefix" size="10" value="<?php echo $this->_tpl_vars['server']['ns1prefix']; ?>
" />
              eg. ns1(.yourdomain.com)</td>
          </tr>
          <tr>
            <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['serverns2prefix']; ?>
:</td>
            <td><input type="text" name="ns2prefix" size="10" value="<?php echo $this->_tpl_vars['server']['ns2prefix']; ?>
" />
              eg. ns2(.yourdomain.com)</td>
          </tr>
          <tr>
            <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['LANG']['serverrootpw']; ?>
:</td>
            <td><input type="password" name="rootpw" size="20" value="<?php echo $this->_tpl_vars['server']['rootpw']; ?>
" /></td>
          </tr>
        </table></td>
    </tr>
  </table>
  <?php endif; ?>

  <?php if ($this->_tpl_vars['configurableoptions']): ?>
  <h3><?php echo $this->_tpl_vars['LANG']['orderconfigpackage']; ?>
</h3>
  <p><?php echo $this->_tpl_vars['LANG']['cartconfigoptionsdesc']; ?>
</p>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <?php $_from = $this->_tpl_vars['configurableoptions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['configoption']):
?>
          <tr>
            <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['configoption']['optionname']; ?>
:</td>
            <td><?php if ($this->_tpl_vars['configoption']['optiontype'] == 1): ?>
<select name="configoption[<?php echo $this->_tpl_vars['configoption']['id']; ?>
]">
<?php $_from = $this->_tpl_vars['configoption']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num2'] => $this->_tpl_vars['options']):
?>
<option value="<?php echo $this->_tpl_vars['options']['id']; ?>
"<?php if ($this->_tpl_vars['configoption']['selectedvalue'] == $this->_tpl_vars['options']['id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['options']['name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
              <?php elseif ($this->_tpl_vars['configoption']['optiontype'] == 2): ?>
              <?php $_from = $this->_tpl_vars['configoption']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num2'] => $this->_tpl_vars['options']):
?>
              <input type="radio" name="configoption[<?php echo $this->_tpl_vars['configoption']['id']; ?>
]" value="<?php echo $this->_tpl_vars['options']['id']; ?>
"<?php if ($this->_tpl_vars['configoption']['selectedvalue'] == $this->_tpl_vars['options']['id']): ?> checked="checked"<?php endif; ?>>
              <?php echo $this->_tpl_vars['options']['name']; ?>
<br />
              <?php endforeach; endif; unset($_from); ?>
              <?php elseif ($this->_tpl_vars['configoption']['optiontype'] == 3): ?>
              <input type="checkbox" name="configoption[<?php echo $this->_tpl_vars['configoption']['id']; ?>
]" value="1"<?php if ($this->_tpl_vars['configoption']['selectedqty']): ?> checked<?php endif; ?>>
              <?php echo $this->_tpl_vars['configoption']['options']['0']['name']; ?>

              <?php elseif ($this->_tpl_vars['configoption']['optiontype'] == 4): ?>
              <input type="text" name="configoption[<?php echo $this->_tpl_vars['configoption']['id']; ?>
]" value="<?php echo $this->_tpl_vars['configoption']['selectedqty']; ?>
" size="5">
              x <?php echo $this->_tpl_vars['configoption']['options']['0']['name']; ?>

              <?php endif; ?> </td>
          </tr>
          <?php endforeach; endif; unset($_from); ?>
        </table></td>
    </tr>
  </table>
  <?php endif; ?>

  <?php if ($this->_tpl_vars['addons']): ?>
  <h3><?php echo $this->_tpl_vars['LANG']['cartaddons']; ?>
</h3>
  <p><?php echo $this->_tpl_vars['LANG']['orderaddondescription']; ?>
</p>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <?php $_from = $this->_tpl_vars['addons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['addon']):
?>
          <tr>
            <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['addon']['checkbox']; ?>
</td>
            <td><label for="a<?php echo $this->_tpl_vars['addon']['id']; ?>
"><strong><?php echo $this->_tpl_vars['addon']['name']; ?>
</strong> - <?php echo $this->_tpl_vars['addon']['description']; ?>
 (<?php echo $this->_tpl_vars['addon']['pricing']; ?>
)</label></td>
          </tr>
          <?php endforeach; endif; unset($_from); ?>
        </table></td>
    </tr>
  </table>
  <?php endif; ?>

  <?php if ($this->_tpl_vars['customfields']): ?>
  <h3><?php echo $this->_tpl_vars['LANG']['orderadditionalrequiredinfo']; ?>
</h3>
  <p><?php echo $this->_tpl_vars['LANG']['cartcustomfieldsdesc']; ?>
</p>
  <div class="cartbox"> <?php $_from = $this->_tpl_vars['customfields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['customfield']):
?>
    <?php echo $this->_tpl_vars['customfield']['name']; ?>
: <?php echo $this->_tpl_vars['customfield']['input']; ?>
 <?php echo $this->_tpl_vars['customfield']['description']; ?>
<br />
    <?php endforeach; endif; unset($_from); ?> </div>
  <?php endif; ?>

  <?php if ($this->_tpl_vars['domainoption']): ?>
  <h3><?php echo $this->_tpl_vars['LANG']['cartproductdomain']; ?>
</h3>
  <?php if ($this->_tpl_vars['domains']): ?>
  <input type="hidden" name="domainoption" value="<?php echo $this->_tpl_vars['domainoption']; ?>
" />
  <p> <?php $_from = $this->_tpl_vars['domains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['domain']):
?>
    <input type="hidden" name="domains[]" value="<?php echo $this->_tpl_vars['domain']['domain']; ?>
" />
    <input type="hidden" name="domainsregperiod[<?php echo $this->_tpl_vars['domain']['domain']; ?>
]" value="<?php echo $this->_tpl_vars['domain']['regperiod']; ?>
" />
    <?php echo $this->_tpl_vars['LANG']['orderdomain']; ?>
 <?php echo $this->_tpl_vars['num']+1; ?>
 - <?php echo $this->_tpl_vars['domain']['domain']; ?>
<?php if ($this->_tpl_vars['domain']['regperiod']): ?> (<?php echo $this->_tpl_vars['domain']['regperiod']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderyears']; ?>
)<?php endif; ?><br />
    <?php endforeach; endif; unset($_from); ?> </p>
  <?php endif; ?>

  <?php if ($this->_tpl_vars['additionaldomainfields']): ?>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <?php $_from = $this->_tpl_vars['additionaldomainfields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['domainfieldname'] => $this->_tpl_vars['domainfield']):
?>
          <tr>
            <td width="150" class="fieldarea"><?php echo $this->_tpl_vars['domainfieldname']; ?>
</td>
            <td><?php echo $this->_tpl_vars['domainfield']; ?>
</td>
          </tr>
          <?php endforeach; endif; unset($_from); ?>
      </table></td>
    </tr>
  </table>
  <?php endif; ?>

  <?php endif; ?>
  <p align="center"><?php if ($this->_tpl_vars['editconfig']): ?>
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['updatecart']; ?>
" class="buttongo" />
    <?php else: ?>
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['addtocart']; ?>
" class="buttongo" />
    <?php endif; ?></p>
</form><br />