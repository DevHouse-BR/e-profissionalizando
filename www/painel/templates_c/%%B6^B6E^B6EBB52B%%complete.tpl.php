<?php /* Smarty version 2.6.26, created on 2011-01-20 22:00:49
         compiled from /home/prof/public_html/painel/templates/orderforms/web20cart/complete.tpl */ ?>
<link rel="stylesheet" type="text/css" href="templates/orderforms/web20cart/style.css" />
<h2><?php echo $this->_tpl_vars['LANG']['orderconfirmation']; ?>
</h2>
<p><?php echo $this->_tpl_vars['LANG']['orderreceived']; ?>
</p>
<div class="cartbox">
  <p align="center"><strong><?php echo $this->_tpl_vars['LANG']['ordernumberis']; ?>
 <?php echo $this->_tpl_vars['ordernumber']; ?>
</strong></p>
</div>
<p><?php echo $this->_tpl_vars['LANG']['orderfinalinstructions']; ?>
</p>
<?php if ($this->_tpl_vars['invoiceid'] && ! $this->_tpl_vars['ispaid']): ?>
<div class="errorbox"><?php echo $this->_tpl_vars['LANG']['ordercompletebutnotpaid']; ?>
</div>
<p align="center"><a href="viewinvoice.php?id=<?php echo $this->_tpl_vars['invoiceid']; ?>
" target="_blank"><?php echo $this->_tpl_vars['LANG']['invoicenumber']; ?>
<?php echo $this->_tpl_vars['invoiceid']; ?>
</a></p>
<?php endif; ?>

<?php if ($this->_tpl_vars['ispaid']): ?>
<!-- Enter any HTML code which needs to be displayed once a user has completed the checkout of their order here - for example conversion tracking and affiliate tracking scripts -->
<?php endif; ?>
<p align="center"><a href="clientarea.php"><?php echo $this->_tpl_vars['LANG']['ordergotoclientarea']; ?>
</a></p>