<?php /* Smarty version 2.6.26, created on 2012-08-09 13:19:22
         compiled from _controller/admin/language/edit.tpl */ ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_edit']; ?>
</h2>
<div id="page-intro"><?php echo $this->_tpl_vars['lang']['controller']['intro_edit']; ?>
</div>



<form name="manage" action="" method="post">
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3><span style="font-family:'Courier New', Courier, monospace"><?php echo $this->_tpl_vars['langFolder']; ?>
<?php echo $this->_tpl_vars['folder']; ?>
/<?php if ($this->_tpl_vars['subfolder'] != ''): ?><?php echo $this->_tpl_vars['subfolder']; ?>
/<?php endif; ?><?php echo $this->_tpl_vars['file']; ?>
</span></h3>
		<ul class="content-box-link">
			<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
language"><?php echo $this->_tpl_vars['lang']['controllergroup']['formBackLabel']; ?>
</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<?php $_from = $this->_tpl_vars['fileData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['node']):
?>
			<fieldset>
				<p>
					<label style="font-family:'Courier New', Courier, monospace"><?php echo $this->_tpl_vars['node']['name']; ?>
 : </label>
					<textarea class="text-input"  rows="1"  name="fname[<?php echo $this->_tpl_vars['node']['name']; ?>
]"><?php echo $this->_tpl_vars['node']['values']; ?>
</textarea>
					<?php if ($this->_tpl_vars['node']['descr'] != ''): ?>
						<br /><small><?php echo $this->_tpl_vars['lang']['controller']['formDescriptionLabel']; ?>
:<?php echo $this->_tpl_vars['node']['descr']; ?>
</small>
					<?php endif; ?>
				</p>
			</fieldset>
		<?php endforeach; endif; unset($_from); ?>
		<br />
	
	</div>
	
	<div class="content-box-content">
		<fieldset>
			<p>
				<label><input type="checkbox" name="fsortbyalphabet" value="1"/> <?php echo $this->_tpl_vars['lang']['controller']['formReorderAlphabetLabel']; ?>
</label>
			</p>
			<p>
				<input type="submit" name="fsubmit" value="<?php echo $this->_tpl_vars['lang']['controllergroup']['formSaveSubmit']; ?>
" class="button buttonbig">
			</p>
		</fieldset>
	</div>
	
	
	
	

    	
</div>
</form>
