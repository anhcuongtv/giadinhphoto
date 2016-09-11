<?php /* Smarty version 2.6.26, created on 2016-09-10 15:42:31
         compiled from _controller/site/login/index.tpl */ ?>
<div id="panelright" style="width:1000px">
	<div id="page">
		<h1><?php echo $this->_tpl_vars['lang']['controller']['title']; ?>
</h1>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<form action="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
login.html?redirect=<?php echo $this->_tpl_vars['redirectUrl']; ?>
" method="post">
			<div id="form-entry-formtip">
				<?php echo $this->_tpl_vars['lang']['controller']['help']; ?>

			</div>
			
			<div class="form-entry" >
				<div class="form-entry-label"><label><?php echo $this->_tpl_vars['lang']['controller']['username']; ?>
 :</label></div>
				<div class="form-entry-big-textbox"><input type="text" name="fusername" value="" /></div>
			</div>
			
			<div class="form-entry">
				<div class="form-entry-label"><label><?php echo $this->_tpl_vars['lang']['controller']['password']; ?>
 :</label></div>
				<div class="form-entry-big-textbox"><input type="password" id="fpassword" name="fpassword" value="" /></div>
			</div>
			
			<div class="form-entry">
				<div class="form-entry-label"></div>
				<div>
					<label class=" myTip" title="<?php echo $this->_tpl_vars['lang']['controller']['remembermeTip']; ?>
"><input type="checkbox" id="frememberme" name="frememberme" value="1" /> <?php echo $this->_tpl_vars['lang']['controller']['rememberme']; ?>
</label>
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
						&nbsp; &nbsp; 
						<a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
forgotpass.html<?php if ($this->_tpl_vars['redirectUrl'] != ''): ?>?redirect=<?php echo $this->_tpl_vars['redirectUrl']; ?>
<?php endif; ?>" title="<?php echo $this->_tpl_vars['lang']['controller']['forgotpass']; ?>
"><?php echo $this->_tpl_vars['lang']['controller']['forgotpass']; ?>
</a>
				</div>
			</div>
			
			
			
			<div class="form-entry">
				<div class="form-entry-label">&nbsp;</div>
				<div class="form-entry-submit"><input class="btnSubmit" type="submit" name="fsubmit" value="<?php echo $this->_tpl_vars['lang']['controller']['submitLabel']; ?>
" />&nbsp;&nbsp;&nbsp;
				<?php if ($this->_tpl_vars['setting']['extra']['enableRegister']): ?><span class="form-entry-login-register"><a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
register.html<?php if ($this->_tpl_vars['redirectUrl'] != ''): ?>?redirect=<?php echo $this->_tpl_vars['redirectUrl']; ?>
<?php endif; ?>" title="<?php echo $this->_tpl_vars['lang']['global']['mRegister']; ?>
"><?php echo $this->_tpl_vars['lang']['global']['mRegister']; ?>
</a></span><?php endif; ?>&nbsp;&nbsp;&nbsp;
				
				</div>
				
		
			</div>
			<div class="clearboth"></div>
			
		</form>
	</div>
</div>