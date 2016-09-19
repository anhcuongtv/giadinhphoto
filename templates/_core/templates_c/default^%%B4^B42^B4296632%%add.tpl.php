<?php /* Smarty version 2.6.26, created on 2016-09-19 22:02:43
         compiled from _controller/admin/product/add.tpl */ ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_add']; ?>
</h2>

<form action="" method="post" name="myform" enctype="multipart/form-data">
	<input type="hidden" name="ftoken" value="<?php echo $_SESSION['productAddToken']; ?>
" />
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3><?php echo $this->_tpl_vars['lang']['controller']['title_add']; ?>
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

			<p>
				<label><?php echo $this->_tpl_vars['lang']['controller']['status']; ?>
: </label>
				<select name="status" id="status">
					<option value="1"><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>
					<option value="0" <?php if ($this->_tpl_vars['formData']['status'] == '0'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
				</select>
			</p>

			<fieldset>
				<hr class="language_seperator_line" />
				<?php $_from = $this->_tpl_vars['langEditList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['langedit']):
?>
					<?php $this->assign('langeditcode', $this->_tpl_vars['langedit']->code); ?>
					<?php $this->assign('name', "name_".($this->_tpl_vars['langeditcode'])); ?>
					<?php $this->assign('price', "price_".($this->_tpl_vars['langeditcode'])); ?>
					<?php $this->assign('description', "description_".($this->_tpl_vars['langeditcode'])); ?>
					<h3 class="language_heading"><img src="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/flag_<?php echo $this->_tpl_vars['langeditcode']; ?>
.png" alt="<?php echo $this->_tpl_vars['langeditcode']; ?>
" /> <?php echo $this->_tpl_vars['langedit']->name; ?>
</h3>
					<p>
						<label><?php echo $this->_tpl_vars['lang']['controller']['formNameLabel']; ?>
 : </label>
						<input type="text" name="name_<?php echo $this->_tpl_vars['langeditcode']; ?>
" id="name_<?php echo $this->_tpl_vars['langeditcode']; ?>
" size="80" value="<?php echo $this->_tpl_vars['formData'][$this->_tpl_vars['name']]; ?>
" class="text-input">
					</p>
					<p>
						<label><?php echo $this->_tpl_vars['lang']['controller']['formPriceLabel']; ?>
 : </label>
						<input type="text" name="price_<?php echo $this->_tpl_vars['langeditcode']; ?>
" id="price_<?php echo $this->_tpl_vars['langeditcode']; ?>
" size="80" value="<?php echo $this->_tpl_vars['formData'][$this->_tpl_vars['price']]; ?>
" class="text-input">
					</p>
					<p>
						<label><?php echo $this->_tpl_vars['lang']['controller']['title_add']; ?>
: </label>
						<textarea class="text-input"  rows="15" name="description_<?php echo $this->_tpl_vars['langeditcode']; ?>
" id="description_<?php echo $this->_tpl_vars['langeditcode']; ?>
"><?php echo $this->_tpl_vars['formData'][$this->_tpl_vars['description']]; ?>
</textarea>
					</p>

					<hr class="language_seperator_line" />
				<?php endforeach; endif; unset($_from); ?>
			</fieldset>
			
		</div>

		
	</div>
	
	<div class="content-box-content-alt">
		<fieldset>
		<p>
			<input type="submit" name="fsubmit" value="<?php echo $this->_tpl_vars['lang']['controllergroup']['formAddSubmit']; ?>
" class="button buttonbig">
			<br /><small><span class="star_require">*</span> : <?php echo $this->_tpl_vars['lang']['controllergroup']['formRequiredLabel']; ?>
</small>
		</p>
		</fieldset>
	</div>

    	
</div>
</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tinymce.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>