<?php /* Smarty version 2.6.26, created on 2014-10-21 10:32:54
         compiled from _mail/admin/user/resetpass.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['smartyMailContainerRoot'])."site/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
RESET PASSWORD FOR ACCOUNT <b><?php echo $this->_tpl_vars['myUser']->username; ?>
</b>:

This email was sent from out website to notify you that administrator had been reset your password for your account. Your new account information:<br />
<br />
Username: <?php echo $this->_tpl_vars['myUser']->username; ?>
<br />
Password: <?php echo $this->_tpl_vars['newpass']; ?>
<br />
<br />
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['smartyMailContainerRoot'])."site/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>