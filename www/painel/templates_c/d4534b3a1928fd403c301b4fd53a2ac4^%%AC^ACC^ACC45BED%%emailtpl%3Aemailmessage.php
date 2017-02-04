<?php /* Smarty version 2.6.26, created on 2012-01-13 00:02:07
         compiled from emailtpl:emailmessage */ ?>
<p>
Dear <?php echo $this->_tpl_vars['client_name']; ?>
,
</p>
<p>
This is a billing reminder that your invoice no. <?php echo $this->_tpl_vars['invoice_num']; ?>
 which was generated on <?php echo $this->_tpl_vars['invoice_date_created']; ?>
 is due on <?php echo $this->_tpl_vars['invoice_date_due']; ?>
.
</p>
<p>
Your payment method is: <?php echo $this->_tpl_vars['invoice_payment_method']; ?>

</p>
<p>
Invoice: <?php echo $this->_tpl_vars['invoice_num']; ?>
<br />
Balance Due: <?php echo $this->_tpl_vars['invoice_balance']; ?>
<br />
Due Date: <?php echo $this->_tpl_vars['invoice_date_due']; ?>

</p>
<p>
You can login to your client area to view and pay the invoice at <?php echo $this->_tpl_vars['invoice_link']; ?>

</p>
<p>
<?php echo $this->_tpl_vars['signature']; ?>

</p>