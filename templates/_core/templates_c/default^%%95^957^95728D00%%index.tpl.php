<?php /* Smarty version 2.6.26, created on 2014-08-28 10:43:51
         compiled from _controller/site/register/index.tpl */ ?>
<div id="panelright" style="width:1000px">
	<div id="page">
		<h1><?php echo $this->_tpl_vars['lang']['controller']['heading']; ?>
</h1>
		<p class="info"><?php echo $this->_tpl_vars['lang']['controller']['help']; ?>
</p>
		
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'],'notifySuccess' => $this->_tpl_vars['success'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
		<div class="contents">
		
		
			<form action="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
register.html" method="post">
	
	
			<input type="hidden" name="ftoken" value="<?php echo $_SESSION['userRegisterToken']; ?>
" />
			<div class="form">
			<table cellspacing="0" cellpadding="4" id="registerform">
			<tbody><tr>
			<th align="right"></th>
			<td><span class="required">*</span> <?php echo $this->_tpl_vars['lang']['controller']['required']; ?>
</td>
			</tr>
			<tr>
			<th><label for="flastname"><?php echo $this->_tpl_vars['lang']['controller']['lastname']; ?>
<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="<?php echo $this->_tpl_vars['formData']['flastname']; ?>
" id="flastname" name="flastname"></td>
			</tr>
			<tr>
			<th><label for="ffirstname"><?php echo $this->_tpl_vars['lang']['controller']['firstname']; ?>
<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="<?php echo $this->_tpl_vars['formData']['ffirstname']; ?>
" id="ffirstname" name="ffirstname"></td>
			</tr>
			
			<tr>
			<th><label for="faddress"><?php echo $this->_tpl_vars['lang']['controller']['address']; ?>
<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="<?php echo $this->_tpl_vars['formData']['faddress']; ?>
" id="faddress" name="faddress"></td>
			</tr>
			
			<tr>
			<th><label for="fzipcode"><?php echo $this->_tpl_vars['lang']['controller']['zipcode']; ?>
<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="<?php echo $this->_tpl_vars['formData']['fzipcode']; ?>
" id="fzipcode" name="fzipcode"></td>
			</tr>
			<tr>
			<th><label for="fcity"><?php echo $this->_tpl_vars['lang']['controller']['city']; ?>
<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="<?php echo $this->_tpl_vars['formData']['fcity']; ?>
" id="fcity" name="fcity"></td>
			</tr>
			<tr>
			<th><label for="fregion"><?php echo $this->_tpl_vars['lang']['controller']['region']; ?>
<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="<?php echo $this->_tpl_vars['formData']['fregion']; ?>
" id="fregion" name="fregion"></td>
			</tr>
			<tr>
			<th><label for="fcountry"><?php echo $this->_tpl_vars['lang']['controller']['country']; ?>
<span class="required">*</span> :</label></th>
			<td><select id="fcountry" name="fcountry">
			<option value="">- - - -</option>
			<?php $_from = $this->_tpl_vars['setting']['country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['country']):
?>
				<option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['formData']['fcountry'] == $this->_tpl_vars['key']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['country']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
			</select></td>
			</tr>
			<tr>
			<th><label for="fphone1"><?php echo $this->_tpl_vars['lang']['controller']['phone1']; ?>
<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="<?php echo $this->_tpl_vars['formData']['fphone1']; ?>
" id="fphone1" name="fphone1"></td>
			</tr>
			<tr>
			<th>&nbsp;</th>
			<td class="code"><?php echo $this->_tpl_vars['lang']['controller']['phone1help']; ?>
</td>
			</tr>
			
			<tr>
			<th><label for="fusername"><?php echo $this->_tpl_vars['lang']['controller']['username']; ?>
<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="<?php echo $this->_tpl_vars['formData']['fusername']; ?>
" id="fusername" name="fusername"></td>
			</tr>
			<tr>
			<th><label for="fpassword1"><?php echo $this->_tpl_vars['lang']['controller']['password']; ?>
<span class="required">*</span> :</label></th>
			<td><input type="password" class="textbox" size="40" value="<?php echo $this->_tpl_vars['formData']['fpassword1']; ?>
" id="fpassword1" name="fpassword1"></td>
			</tr>
			<tr>
			<th><label for="fpassword2"><?php echo $this->_tpl_vars['lang']['controller']['passwordconfirm']; ?>
<span class="required">*</span> :</label></th>
			<td><input type="password" class="textbox" size="40" value="<?php echo $this->_tpl_vars['formData']['fpassword2']; ?>
" id="fpassword2" name="fpassword2"></td>
			</tr>
			<tr>
			<th><label for="femail"><?php echo $this->_tpl_vars['lang']['controller']['email']; ?>
<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="<?php echo $this->_tpl_vars['formData']['femail']; ?>
" id="femail" name="femail"></td>
			</tr>
			<tr>
			<th><label for="femail2"><?php echo $this->_tpl_vars['lang']['controller']['email2']; ?>
<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="<?php echo $this->_tpl_vars['formData']['femail2']; ?>
" id="femail2" name="femail2"></td>
			</tr>
			
			<tr>
			<th><label for="fcaptcha"><?php echo $this->_tpl_vars['lang']['controller']['securityCode']; ?>
<span class="required">*</span> :</label></th>
			<td><img alt="captcha" id="captchaImage" width="200" height="50" src='<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/captcha' /><a class="form-entry-register-captcharefresh" href="javascript:void(0);" onclick="javascript:reloadCaptchaImage();" title="<?php echo $this->_tpl_vars['lang']['controller']['refreshImage']; ?>
"><?php echo $this->_tpl_vars['lang']['controller']['refreshImage']; ?>
</a><br />
			<input type="text" class="textbox" size="40" value="" id="fcaptcha" name="fcaptcha" title="<?php echo $this->_tpl_vars['lang']['controller']['securityCodeTip']; ?>
" /></td>
			</tr>
			</tbody></table>
			
			<!-- / class form --></div>
			<?php echo $this->_tpl_vars['lang']['controller']['foottext1']; ?>

			<p class="btnSubmit"><input type="submit" class="btnSubmit" value="Submit" id="fsubmit" name="fsubmit"></p>
			<?php echo $this->_tpl_vars['lang']['controller']['foottext2']; ?>

			</form>
		</div>
	</div>
</div>


	