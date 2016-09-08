<?php /* Smarty version 2.6.26, created on 2012-11-15 16:24:09
         compiled from _mail/site/forgotpass/user.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['smartyMailGroupContainer'])."header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if ($this->_tpl_vars['myUser']->fullname != ''): ?><p>Hi <?php echo $this->_tpl_vars['myUser']->fullname; ?>
,</p><?php endif; ?>
<p>Your request to recovery password at <?php echo $this->_tpl_vars['datecreated']; ?>
</p>
<p>Account:</p>
<p>&nbsp;&nbsp;Username: <b><?php echo $this->_tpl_vars['myUser']->username; ?>
 &lt;<?php echo $this->_tpl_vars['myUser']->email; ?>
&gt;</b></p>

<?php if ($this->_tpl_vars['activatedCode'] != ''): ?>
	<p>Click this link <a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
forgotpass.html?sub=reset&amp;username=<?php echo $this->_tpl_vars['myUser']->username; ?>
&amp;code=<?php echo $this->_tpl_vars['activatedCode']; ?>
"><?php echo $this->_tpl_vars['conf']['rooturl']; ?>
forgotpass.html?sub=reset&amp;username=<?php echo $this->_tpl_vars['myUser']->username; ?>
&amp;code=<?php echo $this->_tpl_vars['activatedCode']; ?>
</a> and type your new password to reset your password.</p>
    
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['smartyMailGroupContainer'])."footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>