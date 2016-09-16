<?php /* Smarty version 2.6.26, created on 2016-09-16 10:00:24
         compiled from _controller/admin/product/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlspecialchars', '_controller/admin/product/edit.tpl', 28, false),)), $this); ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_edit']; ?>
</h2>

<form action="" method="post" name="myform" enctype="multipart/form-data">
	<input type="hidden" name="ftoken" value="<?php echo $_SESSION['productEditToken']; ?>
" />
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3><?php echo $this->_tpl_vars['lang']['controller']['title_edit']; ?>
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
					<label><?php echo $this->_tpl_vars['lang']['controller']['formNameLabel']; ?>
 : </label>
					<input disabled="disabled" type="text" name="fname" id="fname" size="50" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fname']); ?>
" style="border:1px solid #eee;">
				</p>
				
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['formPriceLabel']; ?>
 : </label>
					<input type="text" name="fprice" id="fprice" size="10" value="<?php if ($this->_tpl_vars['formData']['fprice'] > 0): ?><?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['formData']['fprice'],false); ?>
<?php endif; ?>" class="text-input"><select name="fcurrency"><option value="usd" <?php if ($this->_tpl_vars['currency']->currencyCode == 'usd'): ?>selected="selected"<?php endif; ?>>USD</option><option value="vnd" <?php if ($this->_tpl_vars['currency']->currencyCode == 'vnd'): ?>selected="selected"<?php endif; ?>>VND</option></select>
				</p>
				
				
				
				
				</fieldset>
			
		</div>
		
		
		
		
		
	</div>
	
	<div class="content-box-content-alt">
		<fieldset>
		<p>
			<input type="submit" name="fsubmit" value="<?php echo $this->_tpl_vars['lang']['controllergroup']['formUpdateSubmit']; ?>
" class="button buttonbig">
			<br /><small><span class="star_require">*</span> : <?php echo $this->_tpl_vars['lang']['controllergroup']['formRequiredLabel']; ?>
</small>
		</p>
		</fieldset>
	</div>

    	
</div>
</form>