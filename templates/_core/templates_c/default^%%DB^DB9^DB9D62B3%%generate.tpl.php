<?php /* Smarty version 2.6.26, created on 2016-09-16 11:54:51
         compiled from _controller/admin/contestphotoready/generate.tpl */ ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_generate']; ?>
</h2>

<form action="" method="post" name="myform" onsubmit="return confirm('Are You Sure ?');">
<input type="hidden" name="ftoken" value="<?php echo $_SESSION['contestphotoreadyGenerateToken']; ?>
" />
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3><?php echo $this->_tpl_vars['lang']['controller']['title_generate']; ?>
</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab"><?php echo $this->_tpl_vars['lang']['controllergroup']['formFormLabel']; ?>
</a></li> <!-- href must be unique and match the id of target div -->
			
		</ul>
		<ul class="content-box-link">
			<li><a href="<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['formBackLabel']; ?>
</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'],'notifySuccess' => $this->_tpl_vars['success'],'notifyWarning' => $this->_tpl_vars['warning'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			
				<fieldset>
								
				<p>
					<label><span class="star_require"><?php echo $this->_tpl_vars['lang']['controller']['warning']; ?>
</span></label>
					
				</p>
				
				
				</fieldset>
			
		</div>

	
		
	</div>
	
	<div class="content-box-content-alt">
		<fieldset>
		<p>
			<input type="submit" name="fsubmit" value="GENERATE NOW" class="button buttonbig button-delete">
			
		</p>
		</fieldset>
	</div>
	<br />

    	
</div>
</form>


