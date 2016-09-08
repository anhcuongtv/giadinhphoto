<?php /* Smarty version 2.6.26, created on 2012-08-14 00:30:09
         compiled from _controller/site/profile/index.tpl */ ?>
<div id="panelright" style="width:1000px">
	<div id="page">
		<h1><?php echo $this->_tpl_vars['lang']['controller']['title']; ?>
 <br /><small><?php echo $this->_tpl_vars['lang']['controller']['username']; ?>
: <?php echo $this->_tpl_vars['me']->username; ?>
 &lt;<?php echo $this->_tpl_vars['me']->email; ?>
&gt;</small></h1>
		<div class="contents"><p class="info"><?php echo $this->_tpl_vars['lang']['controller']['help']; ?>
</p></div>
		
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'],'notifySuccess' => $this->_tpl_vars['success'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<form action="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
profile.html" method="post" enctype="multipart/form-data">
		<input type="hidden" name="ftoken" value="<?php echo $_SESSION['userProfileToken']; ?>
" />
		<div class="form">
		<table cellspacing="0" cellpadding="4" id="registerform" width="100%">
		<tbody>
		<tr>
		<th align="right"></th>
		<td><span class="required">*</span> <?php echo $this->_tpl_vars['lang']['controller']['required']; ?>
</td>
		</tr>
		<tr>
		<th><label for="flastname"><?php echo $this->_tpl_vars['lang']['controller']['lastname']; ?>
<span class="required">*</span> :</label></th>
		<td><input type="text" class="sizeB" size="40" value="<?php echo $this->_tpl_vars['me']->lastname; ?>
" id="flastname" name="flastname"></td>
		</tr>
		<tr>
		<th><label for="ffirstname"><?php echo $this->_tpl_vars['lang']['controller']['firstname']; ?>
<span class="required">*</span> :</label></th>
		<td><input type="text" class="sizeB" size="40" value="<?php echo $this->_tpl_vars['me']->firstname; ?>
" id="ffirstname" name="ffirstname"></td>
		</tr>
		<tr>
		<th><label for="fhonor"><?php echo $this->_tpl_vars['lang']['controller']['honor']; ?>
:</label></th>
		<td><input type="text" class="sizeB" size="40" value="<?php echo $this->_tpl_vars['me']->honor; ?>
" id="fhonor" name="fhonor"></td>
		</tr>
		<tr>
		<th><label for="faddress"><?php echo $this->_tpl_vars['lang']['controller']['address']; ?>
<span class="required">*</span> :</label></th>
		<td><input type="text" class="sizeB" size="40" value="<?php echo $this->_tpl_vars['me']->address; ?>
" id="faddress" name="faddress"></td>
		</tr>
		<tr>
		<th><label for="faddress2"><?php echo $this->_tpl_vars['lang']['controller']['address2']; ?>
 :</label></th>
		<td><input type="text" class="sizeB" size="40" value="<?php echo $this->_tpl_vars['me']->address2; ?>
" id="faddress2" name="faddress2"></td>
		</tr>
		<tr>
		<th><label for="fzipcode"><?php echo $this->_tpl_vars['lang']['controller']['zipcode']; ?>
<span class="required">*</span> :</label></th>
		<td><input type="text" class="sizeB" size="40" value="<?php echo $this->_tpl_vars['me']->zipcode; ?>
" id="fzipcode" name="fzipcode"></td>
		</tr>
		<tr>
		<th><label for="fcity"><?php echo $this->_tpl_vars['lang']['controller']['city']; ?>
<span class="required">*</span> :</label></th>
		<td><input type="text" class="sizeB" size="40" value="<?php echo $this->_tpl_vars['me']->city; ?>
" id="fcity" name="fcity"></td>
		</tr>
		<tr>
		<th><label for="fregion"><?php echo $this->_tpl_vars['lang']['controller']['region']; ?>
<span class="required">*</span> :</label></th>
		<td><input type="text" class="sizeB" size="40" value="<?php echo $this->_tpl_vars['me']->region; ?>
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
" <?php if ($this->_tpl_vars['me']->country == $this->_tpl_vars['key']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['country']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
		</select></td>
		</tr>
		<tr>
		<th><label for="fphone1"><?php echo $this->_tpl_vars['lang']['controller']['phone1']; ?>
<span class="required">*</span> :</label></th>
		<td><input type="text" class="sizeB" size="40" value="<?php echo $this->_tpl_vars['me']->phone1; ?>
" id="fphone1" name="fphone1"></td>
		</tr>
		<tr>
		<th>&nbsp;</th>
		<td class="code"><?php echo $this->_tpl_vars['lang']['controller']['phone1help']; ?>
</td>
		</tr>
		<tr>
		<th><label for="fphone2"><?php echo $this->_tpl_vars['lang']['controller']['phone2']; ?>
 :</label></th>
		<td><input type="text" class="sizeB" size="40" value="<?php echo $this->_tpl_vars['me']->phone2; ?>
" id="fphone2" name="fphone2"></td>
		</tr>
		
		<tr>
		<th><label for="fpsamembership"><?php echo $this->_tpl_vars['lang']['controller']['psamembership']; ?>
 :</label></th>
		<td><input type="text" class="sizeB" size="40" value="<?php echo $this->_tpl_vars['me']->psamembership; ?>
" id="fpsamembership" name="fpsamembership"></td>
		</tr>
		<tr>
		<th><label for="fcaptcha"><?php echo $this->_tpl_vars['lang']['controller']['photoclub']; ?>
 :</label></th>
		<td><input type="text" class="sizeB" size="40" value="<?php echo $this->_tpl_vars['me']->photoclub; ?>
" id="fphotoclub" name="fphotoclub"></td>
		</tr>
		
		<!--
		<tr>
			<td colspan="2"><a name="avatarbox"></a><hr color="#fff" /></td>
		</tr>
		<tr>
		<th><?php echo $this->_tpl_vars['lang']['controller']['avatar']; ?>
</th>
		<td><?php if ($this->_tpl_vars['formData']['fimage'] != ''): ?><div>
								<a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['me']->username; ?>
" title="<?php echo $this->_tpl_vars['me']->username; ?>
"><img src="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['setting']['avatar']['imageDirectory']; ?>
<?php echo $this->_tpl_vars['formData']['fimage']; ?>
" border="0" alt="avatar" /></a>
								
								
								</div>
								
			<div>
			<label><input style="width:30px;" type="checkbox" name="fdeleteimage" value="1" /><?php echo $this->_tpl_vars['lang']['controller']['formImageDeleteLabel']; ?>
</label></div>
			<?php endif; ?>
					<input type="file" id="fimage" name="fimage" />				
									</td>
		</tr>
		-->
		<tr>
			<td colspan="2"><hr color="#fff" /></td>
		</tr>
		<tr>
		<th><?php echo $this->_tpl_vars['lang']['controller']['oldpass']; ?>
 <span class="required">**</span>:</th>
		<td><input type="password" id="foldpass" name="foldpass" value="" /></td>
		</tr>
		
		<tr>
		<th><?php echo $this->_tpl_vars['lang']['controller']['newpass1']; ?>
 <span class="required">**</span>:</th>
		<td><input type="password" id="fnewpass1" name="fnewpass1" value="" /></td>
		</tr>
		<tr>
		<th><?php echo $this->_tpl_vars['lang']['controller']['newpass2']; ?>
 <span class="required">**</span>:</th>
		<td><input type="password" id="fnewpass2" name="fnewpass2" value="" /></td>
		</tr>
		<tr>
		<th></th>
		<td><span class="required">**</span> <?php echo $this->_tpl_vars['lang']['controller']['changepassNote']; ?>
</td>
		</tr>
		
		</tbody></table>
		
		<!-- / class form --></div>
		
		<p class="btnSubmit"><input type="submit" class="btnSubmit" value="<?php echo $this->_tpl_vars['lang']['controller']['submitLabel']; ?>
" id="fsubmit" name="fsubmit"></p>
		
		</form>
	</div>
</div>

