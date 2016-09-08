<?php /* Smarty version 2.6.26, created on 2012-07-31 07:25:01
         compiled from _mail/site/register/admin.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['smartyMailGroupContainer'])."header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if ($this->_tpl_vars['sec'] == 'activate'): ?>
	<p>Account <strong><?php echo $this->_tpl_vars['account']; ?>
</strong> had been activated at <?php echo $this->_tpl_vars['datecreated']; ?>
</p>
<?php else: ?>
  <h2>Website has new registered member at <?php echo $this->_tpl_vars['datecreated']; ?>
</h2>
  <p>Username: <b><?php echo $this->_tpl_vars['myUser']->username; ?>
</b></p>
  <p>Email: <b><?php echo $this->_tpl_vars['myUser']->email; ?>
</b></p>
  <p>Full name: <b><?php echo $this->_tpl_vars['myUser']->fullname; ?>
</b></p>
  
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['smartyMailGroupContainer'])."footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>