<?php /* Smarty version 2.6.26, created on 2016-09-16 15:46:46
         compiled from _controller/admin/user/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlspecialchars', '_controller/admin/user/edit.tpl', 43, false),)), $this); ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_edit']; ?>
</h2>

<form action="" method="post" name="myform">
<input type="hidden" name="ftoken" value="<?php echo $_SESSION['userEditToken']; ?>
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
				<label><?php echo $this->_tpl_vars['lang']['controller']['formGroupLabel']; ?>
 <span class="star_require">*</span> : </label>
				
				<?php if ($this->_tpl_vars['me']->id == $this->_tpl_vars['myUser']->id): ?>
					<input type="text" name="fgroupid" id="fgroupid" size="40" disabled="disabled" style="color:#aaa;" value="<?php echo $this->_tpl_vars['myUser']->groupname($this->_tpl_vars['myUser']->groupid,$this->_tpl_vars['lang']); ?>
" class="text-input">
				<?php else: ?>	
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
				<?php endif; ?>
					
				
			</p>
			<p>
				<label><?php echo $this->_tpl_vars['lang']['controller']['formEmailLabel']; ?>
 <span class="star_require">*</span> : </label>
				<input type="text" name="femail" id="femail" size="40" disabled="disabled" style="color:#aaa;" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['femail']); ?>
" class="text-input">
			</p>
			<p>
				<label><?php echo $this->_tpl_vars['lang']['controller']['formUserNameLabel']; ?>
 : </label>
				<input type="text" name="fusername" id="fusername" size="40" disabled="disabled" style="color:#aaa;" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fusername']); ?>
" class="text-input">
			</p>
			
			
			<p>
				<label><?php echo $this->_tpl_vars['lang']['controller']['formPasswordLabel']; ?>
 <span class="star_require">*</span> : </label>
				<a href="javascript:delm('<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
user/resetpass/id/<?php echo $this->_tpl_vars['myUser']->id; ?>
')"><?php echo $this->_tpl_vars['lang']['controller']['resetpass']; ?>
</a>
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
            
            <p><input type="checkbox" name="fpaidcolor" value="1" <?php if ($this->_tpl_vars['formData']['fpaidcolor'] == 1): ?>checked="checked"<?php endif; ?> /> Paid Color Section</p>
            <p><input type="checkbox" name="fpaidmono" value="1" <?php if ($this->_tpl_vars['formData']['fpaidmono'] == 1): ?>checked="checked"<?php endif; ?> /> Paid Monochrome Section</p>
            <p><input type="checkbox" name="fpaidnature" value="1" <?php if ($this->_tpl_vars['formData']['fpaidnature'] == 1): ?>checked="checked"<?php endif; ?> /> Paid Nature Section</p>
		<p><input type="checkbox" name="fpaidtravel" value="1" <?php if ($this->_tpl_vars['formData']['fpaidtravel'] == 1): ?>checked="checked"<?php endif; ?> /> Paid Travel Section</p>		
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
