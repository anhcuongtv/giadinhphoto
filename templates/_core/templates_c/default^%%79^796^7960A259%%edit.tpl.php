<?php /* Smarty version 2.6.26, created on 2012-07-31 08:57:02
         compiled from _controller/admin/page/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlspecialchars', '_controller/admin/page/edit.tpl', 25, false),)), $this); ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_edit']; ?>
</h2>

<form action="" method="post" name="myform">
<input type="hidden" name="ftoken" value="<?php echo $_SESSION['pageEditToken']; ?>
" />
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3><?php echo $this->_tpl_vars['lang']['controller']['title_edit']; ?>
</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab"><?php echo $this->_tpl_vars['lang']['controllergroup']['formFormLabel']; ?>
</a></li> <!-- href must be unique and match the id of target div -->
			<li><a href="#tab2"><?php echo $this->_tpl_vars['lang']['controllergroup']['formSeoLabel']; ?>
</a></li>
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
					<label><?php echo $this->_tpl_vars['lang']['controller']['formIdtextLabel']; ?>
 <span class="star_require">*</span> : </label>
					<input type="text" name="fidtext" id="fidtext" size="80" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fidtext']); ?>
" class="text-input">
				</p>
				
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['formShowLabel']; ?>
: </label>
					<select name="fenable" id="fenable">
						<option value="1"><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>
						<option value="0" <?php if ($this->_tpl_vars['formData']['fenable'] == '0'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
					</select>
				</p>
				
				<hr class="language_seperator_line" />
				<?php $_from = $this->_tpl_vars['langEditList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['langedit']):
?>
					<?php $this->assign('langeditcode', $this->_tpl_vars['langedit']->code); ?>
					<h3 class="language_heading"><img src="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/flag_<?php echo $this->_tpl_vars['langeditcode']; ?>
.png" alt="<?php echo $this->_tpl_vars['langeditcode']; ?>
" /> <?php echo $this->_tpl_vars['langedit']->name; ?>
</h3>
					<p>
						<label><?php echo $this->_tpl_vars['lang']['controller']['formTitleLabel']; ?>
 : </label>
						<input type="text" name="ftitle[<?php echo $this->_tpl_vars['langeditcode']; ?>
]" id="ftitle[<?php echo $this->_tpl_vars['langeditcode']; ?>
]" size="80" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['ftitle'][$this->_tpl_vars['langeditcode']]); ?>
" class="text-input">
					</p>
					
					<p>
						<label><?php echo $this->_tpl_vars['lang']['controller']['formContentLabel']; ?>
: </label>
						<textarea class="text-input"  rows="15" name="fcontents[<?php echo $this->_tpl_vars['langeditcode']; ?>
]" id="fcontents[<?php echo $this->_tpl_vars['langeditcode']; ?>
]"><?php echo $this->_tpl_vars['formData']['fcontents'][$this->_tpl_vars['langeditcode']]; ?>
</textarea>
					</p>

					<hr class="language_seperator_line" />	
				<?php endforeach; endif; unset($_from); ?>
						
				
				
				</fieldset>
			
		</div>
		
		<div class="tab-content" id="tab2">
			
			<h3 class="language_heading">
			<?php $_from = $this->_tpl_vars['langEditList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['langedit']):
?>
				<?php $this->assign('langeditcode', $this->_tpl_vars['langedit']->code); ?>
				<h3 class="language_heading"><img src="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/flag_<?php echo $this->_tpl_vars['langeditcode']; ?>
.png" alt="<?php echo $this->_tpl_vars['langeditcode']; ?>
" /> <?php echo $this->_tpl_vars['langedit']->name; ?>
</h3>
					
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controllergroup']['formSeoTitleLabel']; ?>
 : </label>
					<input type="text" name="fseotitle[<?php echo $this->_tpl_vars['langeditcode']; ?>
]" id="fseotitle[<?php echo $this->_tpl_vars['langeditcode']; ?>
]" size="80" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fseotitle'][$this->_tpl_vars['langeditcode']]); ?>
" class="text-input">
				</p>
				
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controllergroup']['formSeoKeywordLabel']; ?>
 : </label>
					<textarea class="text-input mceNoEditor"  rows="2" name="fseokeyword[<?php echo $this->_tpl_vars['langeditcode']; ?>
]" id="fseokeyword[<?php echo $this->_tpl_vars['langeditcode']; ?>
]"><?php echo $this->_tpl_vars['formData']['fseokeyword'][$this->_tpl_vars['langeditcode']]; ?>
</textarea>
				</p>
				
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controllergroup']['formSeoDescriptionLabel']; ?>
 : </label>
					<textarea class="text-input mceNoEditor"  rows="2" name="fseodescription[<?php echo $this->_tpl_vars['langeditcode']; ?>
]" id="fseodescription[<?php echo $this->_tpl_vars['langeditcode']; ?>
]"><?php echo $this->_tpl_vars['formData']['fseodescription'][$this->_tpl_vars['langeditcode']]; ?>
</textarea>
				</p>
				
				<hr class="language_seperator_line" />	
			<?php endforeach; endif; unset($_from); ?>
				
					
			
			
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

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tinymce.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
