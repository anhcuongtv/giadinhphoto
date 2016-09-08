<?php /* Smarty version 2.6.26, created on 2012-11-15 14:08:15
         compiled from _controller/site/forgotpass/index.tpl */ ?>
<div id="panelright" style="width:1000px">
	<div id="page">
		<h1><?php echo $this->_tpl_vars['lang']['controller']['title']; ?>
</h1>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
		<form action="" method="post">
			
			<div class="form-entry" >
				<div class="form-entry-label"><label><?php echo $this->_tpl_vars['lang']['controller']['email']; ?>
 :</label></div>
				<div class="form-entry-big-textbox"><input type="text" name="femail" value="<?php echo $this->_tpl_vars['formData']['femail']; ?>
" /></div>
			</div>
			
				
				
			<div class="form-entry">
				<div class="form-entry-label">&nbsp;</div>
				<div class="form-entry-submit"><input class="btnSubmit" type="submit" name="fsubmit" value="<?php echo $this->_tpl_vars['lang']['controller']['submitLabel']; ?>
" />
				<span class="form-entry-login-register"><a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
login.html<?php if ($this->_tpl_vars['redirectUrl'] != ''): ?>?redirect=<?php echo $this->_tpl_vars['redirectUrl']; ?>
<?php endif; ?>" title="<?php echo $this->_tpl_vars['lang']['global']['mLogin']; ?>
"><?php echo $this->_tpl_vars['lang']['global']['mLogin']; ?>
</a></span>
				</div>
				
		
			</div>
			<div class="clearboth"></div>
			
		</form>
	</div>
</div>

