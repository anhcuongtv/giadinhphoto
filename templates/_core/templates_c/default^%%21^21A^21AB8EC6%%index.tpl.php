<?php /* Smarty version 2.6.26, created on 2012-11-15 14:07:45
         compiled from _controller/site/contact/index.tpl */ ?>
<div id="panelright" style="width:1000px">
	<div id="page">
		<h1><?php echo $this->_tpl_vars['lang']['controller']['title']; ?>
</h1>
		<div class="contents">
			<h2 style="font-size:16px;"><strong><?php echo $this->_tpl_vars['lang']['controller']['titleInformation']; ?>
</strong></h2>
			<?php echo $this->_tpl_vars['page']->contents[$this->_tpl_vars['langCode']]; ?>

			
			<hr size="1" />
			<br />
			
			
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'],'notifySuccess' => $this->_tpl_vars['success'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			
			
			
			<form action="" method="post">
				<div id="form-entry-formtip">
					<span class="required">*</span> : <?php echo $this->_tpl_vars['lang']['controller']['required']; ?>

				</div>
				
				<div class="form-entry">
					<div class="form-entry-label"><label><?php echo $this->_tpl_vars['lang']['controller']['fullname']; ?>
 <span class="required">*</span>:</label></div>
					<div class="form-entry-big-textbox"><input type="text" id="ffullname" name="ffullname" value="<?php echo $this->_tpl_vars['formData']['ffullname']; ?>
" /></div>
				</div>
				<div class="form-entry">
					<div class="form-entry-label"><label><?php echo $this->_tpl_vars['lang']['controller']['email']; ?>
 <span class="required">*</span>:</label></div>
					<div class="form-entry-big-textbox"><input type="text" id="femail" name="femail" value="<?php echo $this->_tpl_vars['formData']['femail']; ?>
" /></div>
				</div>
				<div class="form-entry">
					<div class="form-entry-label form-entry-label-normalfont"><label><?php echo $this->_tpl_vars['lang']['controller']['phone']; ?>
:</label></div>
					<div class="form-entry-textbox"><input type="text" id="fphone" name="fphone" size="5" value="<?php echo $this->_tpl_vars['formData']['fphone']; ?>
" style="width:100px;" /></div>
				</div>
				
				
				<div class="form-entry">
					<div class="form-entry-label form-entry-label-normalfont"><label><?php echo $this->_tpl_vars['lang']['controller']['reason']; ?>
:</label></div>
					<div class="form-entry-big-textbox">
						<select class="entry-selectbox" name="freason" id="freason">
							<option <?php if ($this->_tpl_vars['formData']['freason'] == 'general'): ?>selected="selected" <?php endif; ?> value="general"><?php echo $this->_tpl_vars['lang']['controller']['reasonGeneral']; ?>
</option>
							<option <?php if ($this->_tpl_vars['formData']['freason'] == 'support'): ?>selected="selected" <?php endif; ?> value="support"><?php echo $this->_tpl_vars['lang']['controller']['reasonSupport']; ?>
</option>
						</select>
					</div>
				</div>
				<div class="form-entry">
					<div class="form-entry-label form-entry-label-normalfont"><label><?php echo $this->_tpl_vars['lang']['controller']['message']; ?>
 <span class="required">*</span>:</label></div>
					<div class="form-entry-textbox">
						<textarea name="fmessage" class="entry-textarea" rows="5" style="width:400px;"><?php echo $this->_tpl_vars['formData']['fmessage']; ?>
</textarea>
					</div>
				</div>
				
				<div class="form-entry">
						<div class="form-entry-label"><label><?php echo $this->_tpl_vars['lang']['controller']['securityCode']; ?>
 <span class="required">*</span>:</label></div>
						<div class="form-entry-textbox">
							<div class=""><img alt="captcha" id="captchaImage" width="200" height="50" src='<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/captcha' /><a class="" href="javascript:void(0);" onclick="javascript:reloadCaptchaImage();" title="<?php echo $this->_tpl_vars['lang']['controller']['refreshImage']; ?>
"><?php echo $this->_tpl_vars['lang']['controller']['refreshImage']; ?>
</a></div>
							<div class="">
								<input type="text" name="fcaptcha" onclick="this.value=''" class="myTip" title="<?php echo $this->_tpl_vars['lang']['controller']['securityCodeTip']; ?>
"/>
							</div>
							
						</div>
					</div>
				
				
						
				
				<div class="form-entry">
					<div class="form-entry-label">&nbsp;</div>
					<div class="form-entry-submit"><input class="btnSubmit" type="submit" name="fsubmit" value="<?php echo $this->_tpl_vars['lang']['controller']['submitLabel']; ?>
" /></div>
				</div>
				<div class="clearboth"></div>
				
			</form>
		</div>
	</div>
</div>
