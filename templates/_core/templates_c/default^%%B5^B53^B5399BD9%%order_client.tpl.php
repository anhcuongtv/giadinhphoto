<?php /* Smarty version 2.6.26, created on 2012-07-31 07:01:16
         compiled from _mail/site/checkout/order_client.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['smartyMailGroupContainer'])."header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h2>Ordering products at <?php echo $this->_tpl_vars['datecreated']; ?>
</h2>
<p><b>Order information: </b></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;Contact Email: <b><?php echo $this->_tpl_vars['account']; ?>
</b></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;Invoice ID: <b>#<?php echo $this->_tpl_vars['invoiceId']; ?>
</b></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;Total: <b><?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['totalpriceAfterTax']); ?>
</b></p>
<div style="border: 1px solid #cccccc;background:#f0f0f0;">
<?php echo $this->_tpl_vars['orderDetailContents']; ?>

</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['smartyMailGroupContainer'])."footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>