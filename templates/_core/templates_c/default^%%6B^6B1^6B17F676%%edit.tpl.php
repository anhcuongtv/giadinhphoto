<?php /* Smarty version 2.6.26, created on 2012-07-31 08:39:56
         compiled from _controller/admin/contestphoto/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlspecialchars', '_controller/admin/contestphoto/edit.tpl', 38, false),)), $this); ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_edit']; ?>
</h2>

<form action="" method="post" name="myform">
<input type="hidden" name="ftoken" value="<?php echo $_SESSION['editPhotoToken']; ?>
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
		<img alt="<?php echo $this->_tpl_vars['myPhoto']->filethumb1; ?>
" title="<?php echo $this->_tpl_vars['myPhoto']->description; ?>
" src="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['setting']['contestphoto']['imageDirectory']; ?>
<?php echo $this->_tpl_vars['myPhoto']->filethumb2; ?>
" />
		
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'],'notifySuccess' => $this->_tpl_vars['success'],'notifyWarning' => $this->_tpl_vars['warning'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			
			<fieldset>
			
			
			
			<p>
				<label>Section  : </label>
				<select name="fsection">
						<option value=""><?php echo $this->_tpl_vars['lang']['global']['photoSectionSelectOne']; ?>
</option>
						<option value="color" <?php if ($this->_tpl_vars['formData']['fsection'] == 'color'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['photoSectionColor']; ?>
</option>
						<option value="mono" <?php if ($this->_tpl_vars['formData']['fsection'] == 'mono'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['photoSectionMono']; ?>
</option>
						<option value="nature" <?php if ($this->_tpl_vars['formData']['fsection'] == 'nature'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['photoSectionNature']; ?>
</option>
					</select>
			</p>
			<p>
				<label>Photo Name  : </label>
				<input type="text" name="fname" id="fname" size="40" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fname']); ?>
" class="text-input">
			</p>
			<p>
				<label>Keyword  : </label>
				<input type="text" name="fdescription" id="fdescription" size="40" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fdescription']); ?>
" class="text-input">
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
