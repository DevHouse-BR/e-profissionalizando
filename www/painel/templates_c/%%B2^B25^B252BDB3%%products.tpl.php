<?php /* Smarty version 2.6.26, created on 2011-01-20 21:59:00
         compiled from /home/prof/public_html/painel/templates/orderforms/web20cart/products.tpl */ ?>
<link rel="stylesheet" type="text/css" href="templates/orderforms/web20cart/style.css" />
<h2><?php echo $this->_tpl_vars['LANG']['cartbrowse']; ?>
</h2>
<div class="cartmenu" align="center"> <?php $_from = $this->_tpl_vars['productgroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['productgroup']):
?>
  <?php if ($this->_tpl_vars['gid'] == $this->_tpl_vars['productgroup']['gid']): ?>
  <strong><?php echo $this->_tpl_vars['productgroup']['name']; ?>
</strong> | 
  <?php else: ?> <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?gid=<?php echo $this->_tpl_vars['productgroup']['gid']; ?>
"><?php echo $this->_tpl_vars['productgroup']['name']; ?>
</a> | 
  <?php endif; ?>
  <?php endforeach; endif; unset($_from); ?>
  <?php if ($this->_tpl_vars['loggedin']): ?>
  <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?gid=addons"><?php echo $this->_tpl_vars['LANG']['cartproductaddons']; ?>
</a> |
  <?php if ($this->_tpl_vars['renewalsenabled']): ?><a href="<?php echo $_SERVER['PHP_SELF']; ?>
?gid=renewals"><?php echo $this->_tpl_vars['LANG']['domainrenewals']; ?>
</a> | <?php endif; ?>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['registerdomainenabled']): ?><a href="<?php echo $_SERVER['PHP_SELF']; ?>
?a=add&domain=register"><?php echo $this->_tpl_vars['LANG']['registerdomain']; ?>
</a> |<?php endif; ?>
  <?php if ($this->_tpl_vars['transferdomainenabled']): ?><a href="<?php echo $_SERVER['PHP_SELF']; ?>
?a=add&domain=transfer"><?php echo $this->_tpl_vars['LANG']['transferdomain']; ?>
</a> |<?php endif; ?> <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?a=view"><?php echo $this->_tpl_vars['LANG']['viewcart']; ?>
</a> </div>

<?php if (! $this->_tpl_vars['loggedin'] && $this->_tpl_vars['currencies']): ?>
<form method="post" action="cart.php?gid=<?php echo $_GET['gid']; ?>
">
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

<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['product']):
?>
<div class="cartbox" align="center">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="40%" align="left" valign="top"><strong><?php echo $this->_tpl_vars['product']['name']; ?>
</strong> <?php if ($this->_tpl_vars['product']['qty'] != ""): ?><em>(<?php echo $this->_tpl_vars['product']['qty']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderavailable']; ?>
)</em><?php endif; ?><br />
<?php if ($this->_tpl_vars['product']['description']): ?><?php echo $this->_tpl_vars['product']['description']; ?>
<br />
<?php endif; ?></td>
    <td width="40%" align="center" valign="middle" class="pricing"><?php if ($this->_tpl_vars['product']['paytype'] == 'free'): ?>
      <?php echo $this->_tpl_vars['LANG']['orderfree']; ?>

      <?php elseif ($this->_tpl_vars['product']['paytype'] == 'onetime'): ?>
      <?php echo $this->_tpl_vars['product']['pricing']['onetime']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderpaymenttermonetime']; ?>

      <?php elseif ($this->_tpl_vars['product']['paytype'] == 'recurring'): ?>
      <?php if ($this->_tpl_vars['product']['pricing']['monthly']): ?><?php echo $this->_tpl_vars['product']['pricing']['monthly']; ?>
<br />
      <?php endif; ?>
      <?php if ($this->_tpl_vars['product']['pricing']['quarterly']): ?><?php echo $this->_tpl_vars['product']['pricing']['quarterly']; ?>
<br />
      <?php endif; ?>
      <?php if ($this->_tpl_vars['product']['pricing']['semiannually']): ?><?php echo $this->_tpl_vars['product']['pricing']['semiannually']; ?>
<br />
      <?php endif; ?>
      <?php if ($this->_tpl_vars['product']['pricing']['annually']): ?><?php echo $this->_tpl_vars['product']['pricing']['annually']; ?>
<br />
      <?php endif; ?>
      <?php if ($this->_tpl_vars['product']['pricing']['biennially']): ?><?php echo $this->_tpl_vars['product']['pricing']['biennially']; ?>
<br />
      <?php endif; ?>
      <?php if ($this->_tpl_vars['product']['pricing']['triennially']): ?><?php echo $this->_tpl_vars['product']['pricing']['triennially']; ?>
<br />
      <?php endif; ?>
    <?php endif; ?></td>
    <td width="20%" align="center" valign="middle"><input type="button" value="<?php echo $this->_tpl_vars['LANG']['ordernowbutton']; ?>
"<?php if ($this->_tpl_vars['product']['qty'] == '0'): ?> disabled<?php endif; ?> onclick="window.location='<?php echo $_SERVER['PHP_SELF']; ?>
?a=add&pid=<?php echo $this->_tpl_vars['product']['pid']; ?>
'" class="buttongo" /></td>
  </tr>
</table>
</div>
<br />
<?php endforeach; endif; unset($_from); ?>
<p align="center">
  <input type="button" value="<?php echo $this->_tpl_vars['LANG']['viewcart']; ?>
" onclick="window.location='cart.php?a=view'" class="button" />
</p>