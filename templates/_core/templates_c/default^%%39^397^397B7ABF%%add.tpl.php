<?php /* Smarty version 2.6.26, created on 2016-09-16 11:10:47
         compiled from _controller/admin/judger/add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlspecialchars', '_controller/admin/judger/add.tpl', 26, false),)), $this); ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_add']; ?>
</h2>

<form action="" method="post" name="myform" enctype="multipart/form-data">
<input type="hidden" name="ftoken" value="<?php echo $_SESSION['judgerAddToken']; ?>
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
			
				<fieldset>

				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['judger']; ?>
 <span class="star_require">*</span> : </label>
					User ID: <input type="text" name="fuserid" id="fuserid" size="5" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fuserid']); ?>
" class="text-input">
					 <em>- OR -</em>
					Username: <input type="text" name="fusername" id="fusername" size="30" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fusername']); ?>
" class="text-input">
					<em>- OR -</em>
					Email<input type="text" name="femail" id="femail" size="30" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['femail']); ?>
" class="text-input">
				</p>

				<?php $_from = $this->_tpl_vars['group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sectionItem']):
?>
					<?php if ($this->_tpl_vars['sectionItem']->isSection): ?>
						<div class="sectionGroup">
							<span><?php echo $this->_tpl_vars['sectionItem']->name; ?>
</span>

					<?php if ($this->_tpl_vars['sectionItem']->child): ?>
						<?php $_from = $this->_tpl_vars['sectionItem']->child; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sectionItemDetail']):
?>
						<p>
							<label><?php echo $this->_tpl_vars['sectionItemDetail']->name; ?>
: </label>
							<select name="group[]" id="group">
								<option value="0"><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
								<option value="<?php echo $this->_tpl_vars['sectionItemDetail']->id; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>
							</select>
						</p>
						<?php endforeach; endif; unset($_from); ?>
					<?php endif; ?>
							</div>
					<?php endif; ?>
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


