<?php /* Smarty version 2.6.26, created on 2012-08-09 13:17:31
         compiled from _mail/site/contact/admin.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['smartyMailGroupContainer'])."header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <h2>Website has new contact at <?php echo $this->_tpl_vars['datecreated']; ?>
</h2>
  <p>Username: <b><?php echo $this->_tpl_vars['myContact']->username; ?>
</b></p>
  <p>User ID: <b><?php echo $this->_tpl_vars['myContact']->userId; ?>
</b></p>
  <p>Full name: <b><?php echo $this->_tpl_vars['myContact']->fullname; ?>
</b></p>
  <p>Email: <b><?php echo $this->_tpl_vars['myContact']->email; ?>
</b></p>
  <p>Phone: <b><?php echo $this->_tpl_vars['myContact']->phone; ?>
</b></p>
  <p>Message: <b><?php echo $this->_tpl_vars['myContact']->message; ?>
</b></p>
  <p>Reason: <b><?php echo $this->_tpl_vars['myContact']->reason; ?>
</b></p>
 
  
 
  

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['smartyMailGroupContainer'])."footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>