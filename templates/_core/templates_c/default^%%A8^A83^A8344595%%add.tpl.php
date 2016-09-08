<?php /* Smarty version 2.6.26, created on 2014-10-16 15:10:18
         compiled from _controller/admin/user/add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlspecialchars', '_controller/admin/user/add.tpl', 35, false),)), $this); ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_add']; ?>
</h2>

<form action="" method="post" name="myform">
<input type="hidden" name="ftoken" value="<?php echo $_SESSION['userAddToken']; ?>
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
					<label><?php echo $this->_tpl_vars['lang']['controller']['formGroupLabel']; ?>
 <span class="star_require">*</span> : </label>
					<select id="fgroupid" name="fgroupid">
						<option value="">- - - -</option>
						<?php $_from = $this->_tpl_vars['userGroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['groupname']):
?>
							<?php if ($this->_tpl_vars['groupPriorityList'][$this->_tpl_vars['key']] > $this->_tpl_vars['me']->groupPriority): ?>
								<option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['formData']['fgroupid'] == $this->_tpl_vars['key']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['groupname']; ?>
</option>
							<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</p>
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['formEmailLabel']; ?>
 <span class="star_require">*</span> : </label>
					<input type="text" name="femail" id="femail" size="40" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['femail']); ?>
" class="text-input">
				</p>
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['formUserNameLabel']; ?>
 <span class="star_require">*</span> : </label>
					<input type="text" name="fusername" id="fusername" size="40" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fusername']); ?>
" class="text-input">
				</p>
				
				
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['formPasswordLabel']; ?>
 <span class="star_require">*</span> : </label>
					<input type="password" name="fpassword" id="fpassword" size="40" class="text-input">
				</p>
				
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['formPassword2Label']; ?>
 <span class="star_require">*</span>  : </label>
					<input type="password" name="fpassword2" id="fpassword2" size="40" class="text-input">
				</p>
				<hr />
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['firstname']; ?>
  : </label>
					<input type="text" name="ffirstname" id="ffirstname" size="40" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['ffirstname']); ?>
" class="text-input">
				</p>
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['lastname']; ?>
  : </label>
					<input type="text" name="flastname" id="flastname" size="40" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['flastname']); ?>
" class="text-input">
				</p>
				
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['honor']; ?>
  : </label>
					<input type="text" name="fhonor" id="fhonor" size="40" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fhonor']); ?>
" class="text-input">
				</p>
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['address']; ?>
  : </label>
					<input type="text" name="faddress" id="faddress" size="40" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['faddress']); ?>
" class="text-input">
				</p>
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['address2']; ?>
  : </label>
					<input type="text" name="faddress2" id="faddress2" size="40" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['faddress2']); ?>
" class="text-input">
				</p>
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['zipcode']; ?>
  : </label>
					<input type="text" name="fzipcode" id="fzipcode" size="10" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fzipcode']); ?>
" class="text-input">
				</p>
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['city']; ?>
  : </label>
					<input type="text" name="fcity" id="fcity" size="40" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fcity']); ?>
" class="text-input">
				</p>
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['region']; ?>
  : </label>
					<input type="text" name="fregion" id="fregion" size="40" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fregion']); ?>
" class="text-input">
				</p>
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['country']; ?>
  : </label>
					<select id="fcountry" name="fcountry">
						<option value="">- - - -</option>
						<?php $_from = $this->_tpl_vars['setting']['country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['country']):
?>
							<option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['formData']['fcountry'] == $this->_tpl_vars['key']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['country']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</p>
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['phone1']; ?>
  : </label>
					<input type="text" name="fphone1" id="fphone1" size="20" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fphone1']); ?>
" class="text-input">
				</p>
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['phone2']; ?>
  : </label>
					<input type="text" name="fphone2" id="fphone2" size="20" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fphone2']); ?>
" class="text-input">
				</p>
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['psamembership']; ?>
  : </label>
					<input type="text" name="fpsamembership" id="fpsamembership" size="40" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fpsamembership']); ?>
" class="text-input">
				</p>
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['photoclub']; ?>
  : </label>
					<input type="text" name="fphotoclub" id="fphotoclub" size="40" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fphotoclub']); ?>
" class="text-input">
				</p>
				
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
