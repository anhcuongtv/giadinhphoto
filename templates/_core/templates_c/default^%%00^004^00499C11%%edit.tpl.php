<?php /* Smarty version 2.6.26, created on 2012-08-09 13:18:26
         compiled from _controller/admin/contact/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlspecialchars', '_controller/admin/contact/edit.tpl', 30, false),array('modifier', 'date_format', '_controller/admin/contact/edit.tpl', 67, false),)), $this); ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_edit']; ?>
</h2>


<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3><?php echo $this->_tpl_vars['lang']['controller']['title_edit']; ?>
</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" id="tab1_link" class="default-tab"><?php echo $this->_tpl_vars['lang']['controllergroup']['formFormLabel']; ?>
</a></li> <!-- href must be unique and match the id of target div -->
		</ul>
		<ul class="content-box-link">
			<li><a href="<?php echo $this->_tpl_vars['backUrl']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['formBackLabel']; ?>
</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'],'notifySuccess' => $this->_tpl_vars['success'],'notifyWarning' => $this->_tpl_vars['warning'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<div class="tab-content default-tab" id="tab1">
			<form action="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contact/edit/id/<?php echo $this->_tpl_vars['myContact']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
" method="post" name="myform">
			<input type="hidden" name="ftoken" value="<?php echo $_SESSION['contactEditToken']; ?>
" />
			<table class="form" cellpadding="5" cellspacing="5">
				<tr>
					<td width="150" class="label" valign="middle"><?php echo $this->_tpl_vars['lang']['controller']['formUsernameLabel']; ?>
 : </td>
					<td><?php echo $this->_tpl_vars['formData']['fusername']; ?>
 (USER ID: <?php echo $this->_tpl_vars['formData']['fuserid']; ?>
)</td>
				</tr>
				
				
				<tr>
					<td class="label" valign="middle"><?php echo $this->_tpl_vars['lang']['controller']['formFullnameLabel']; ?>
 : </td>
					<td><input type="text" name="ffullname" id="ffullname" size="60" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['ffullname']); ?>
" class="text-input"></td>
				</tr>
				<tr>
					<td class="label" valign="middle"><?php echo $this->_tpl_vars['lang']['controller']['formEmailLabel']; ?>
 : </td>
					<td><input type="text" name="femail" id="femail" size="60" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['femail']); ?>
" class="text-input"></td>
				</tr>
				<tr>
					<td class="label" valign="middle"><?php echo $this->_tpl_vars['lang']['controller']['formPhoneLabel']; ?>
 : </td>
					<td><input type="text" name="fphone" id="fphone" size="60" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fphone']); ?>
" class="text-input"></td>
				</tr>
				<tr>
					<td class="label" valign="middle"><?php echo $this->_tpl_vars['lang']['controller']['formReasonLabel']; ?>
 : </td>
					<td><select name="freason" id="freason">
						<option value="general" <?php if ($this->_tpl_vars['formData']['freason'] == 'general'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['reasonGeneral']; ?>
</option>
						<option value="ads" <?php if ($this->_tpl_vars['formData']['freason'] == 'ads'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['reasonAds']; ?>
</option>
						<option value="idea" <?php if ($this->_tpl_vars['formData']['freason'] == 'idea'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['reasonIdea']; ?>
</option>
						<option value="support" <?php if ($this->_tpl_vars['formData']['freason'] == 'support'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['reasonSupport']; ?>
</option>
					</select></td>
				</tr>
				<tr>
					<td class="label" valign="middle"><?php echo $this->_tpl_vars['lang']['controller']['formMessageLabel']; ?>
 :</td>
					<td><textarea class="text-input"  rows="6" name="fmessage" id="fmessage"><?php echo $this->_tpl_vars['formData']['fmessage']; ?>
</textarea></td>
				</tr>
				<tr>
					<td class="label" valign="middle"><?php echo $this->_tpl_vars['lang']['controller']['formStatusLabel']; ?>
 : </td>
					<td><select name="fstatus" id="fstatus">
						<option value="new" <?php if ($this->_tpl_vars['formData']['fstatus'] == 'new'): ?>selected="selected"<?php endif; ?>>New</option>
						<option value="pending" <?php if ($this->_tpl_vars['formData']['fstatus'] == 'pending'): ?>selected="selected"<?php endif; ?>>Pending</option>
						<option value="completed" <?php if ($this->_tpl_vars['formData']['fstatus'] == 'completed'): ?>selected="selected"<?php endif; ?>>Completed</option>
					</select></td>
				</tr>
				<tr>
					<td class="label" valign="middle"><?php echo $this->_tpl_vars['lang']['controller']['formNoteLabel']; ?>
 :</td>
					<td><textarea class="text-input"  rows="4" name="fnote" id="fnote"><?php echo $this->_tpl_vars['formData']['fnote']; ?>
</textarea></td>
				</tr>
				<tr>
					<td class="label" valign="middle"><?php echo $this->_tpl_vars['lang']['controller']['formDateCreatedLabel']; ?>
 :</td>
					<td><?php echo ((is_array($_tmp=$this->_tpl_vars['formData']['fdatecreated'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['lang']['controllergroup']['dateFormatTimeSmarty']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['lang']['controllergroup']['dateFormatTimeSmarty'])); ?>
 (<?php echo $this->_tpl_vars['lang']['controller']['formIpAddressLabel']; ?>
 : <?php echo $this->_tpl_vars['formData']['fipaddress']; ?>
)</td>
				</tr>
				
			</table>
			<fieldset>
			<p>
				<input type="submit" name="fsubmit" value="<?php echo $this->_tpl_vars['lang']['controllergroup']['formUpdateSubmit']; ?>
" class="button buttonbig">
				<br /><small><span class="star_require">*</span> : <?php echo $this->_tpl_vars['lang']['controllergroup']['formRequiredLabel']; ?>
</small>
			</p>
			</fieldset>
			
			</form>
		</div>
		
		
	</div>
	
	
</div>
