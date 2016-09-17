<?php /* Smarty version 2.6.26, created on 2016-09-17 16:04:10
         compiled from _controller/site/memberarea/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '_controller/site/memberarea/index.tpl', 116, false),array('modifier', 'truncate', '_controller/site/memberarea/index.tpl', 163, false),array('modifier', 'date_format', '_controller/site/memberarea/index.tpl', 165, false),)), $this); ?>

<div id="page">
	
	<div id="memberarealeft">
		<ul id="membertab">
			<li id="info"><a <?php if ($this->_tpl_vars['tab'] == 'info'): ?>class="selected"<?php endif; ?> href="#tabinfo"><?php echo $this->_tpl_vars['lang']['controller']['tabInfo']; ?>
</a></li>
			<li id="upload"><a <?php if ($this->_tpl_vars['tab'] == 'upload'): ?>class="selected"<?php endif; ?> href="#tabupload"><?php echo $this->_tpl_vars['lang']['controller']['tabWork']; ?>
</a></li>
			<li id="payment"><a <?php if ($this->_tpl_vars['tab'] == 'payment'): ?>class="selected"<?php endif; ?> href="#tabpayment"><?php echo $this->_tpl_vars['lang']['controller']['tabPayment']; ?>
</a></li>
            <li id="logout" style="float:right;"><a style="color:red" href="logout.html"><?php echo $this->_tpl_vars['lang']['controller']['tabLogout']; ?>
</a></li>
            
		</ul>
		<div class="clear"></div><br />
		
		<div id="tabinfo">
			<div class="detail">
				<div class="head">
					<div class="left"><?php echo $this->_tpl_vars['lang']['controller']['personalDetail']; ?>
</div>
					<div class="right"><a class="btnSubmit" style="display:block; text-decoration:none" href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
profile.html"><?php echo $this->_tpl_vars['lang']['controller']['updateBtn']; ?>
</a></div>
				</div>
				<div class="name"><?php echo $this->_tpl_vars['me']->firstname; ?>
 <?php echo $this->_tpl_vars['me']->lastname; ?>
</div>
				<ul>
					<li><strong><?php echo $this->_tpl_vars['lang']['controller']['honor']; ?>
:</strong><span><?php echo $this->_tpl_vars['me']->honor; ?>
&nbsp;</span></li>
					<li><strong><?php echo $this->_tpl_vars['lang']['controller']['address']; ?>
:</strong><span><?php echo $this->_tpl_vars['me']->address; ?>
&nbsp;</span></li>
					<li><strong><?php echo $this->_tpl_vars['lang']['controller']['address2']; ?>
:</strong><span><?php echo $this->_tpl_vars['me']->address2; ?>
&nbsp;</span></li>
					<li><strong><?php echo $this->_tpl_vars['lang']['controller']['zipcode']; ?>
:</strong><span><?php echo $this->_tpl_vars['me']->zipcode; ?>
&nbsp;</span></li>
					<li><strong><?php echo $this->_tpl_vars['lang']['controller']['city']; ?>
:</strong><span><?php echo $this->_tpl_vars['me']->city; ?>
&nbsp;</span></li>
					<li><strong><?php echo $this->_tpl_vars['lang']['controller']['region']; ?>
:</strong><span><?php echo $this->_tpl_vars['me']->region; ?>
&nbsp;</span></li>
					<li><strong><?php echo $this->_tpl_vars['lang']['controller']['country']; ?>
:</strong><span><?php echo $this->_tpl_vars['me']->getCountryName(); ?>
&nbsp;</span></li>
					<li><strong><?php echo $this->_tpl_vars['lang']['controller']['phone1']; ?>
:</strong><span><?php echo $this->_tpl_vars['me']->phone1; ?>
&nbsp;</span></li>
					<li><strong><?php echo $this->_tpl_vars['lang']['controller']['phone2']; ?>
:</strong><span><?php echo $this->_tpl_vars['me']->phone2; ?>
&nbsp;</span></li>
					<li><strong><?php echo $this->_tpl_vars['lang']['controller']['psamembership']; ?>
:</strong><span><?php echo $this->_tpl_vars['me']->psamembership; ?>
&nbsp;</span></li>
					<li><strong><?php echo $this->_tpl_vars['lang']['controller']['photoclub']; ?>
:</strong><span><?php echo $this->_tpl_vars['me']->photoclub; ?>
&nbsp;</span></li>
				</ul>
			</div>
			
		</div><!-- end #tabinfo -->
		
		<div id="tabupload">
			<h2><?php echo $this->_tpl_vars['lang']['controller']['photoSubmit']; ?>
</h2>
			<p class="text"><?php echo $this->_tpl_vars['lang']['controller']['photoSubmitHelp']; ?>
</p>
			
			<form method="post" action="<?php if ($this->_tpl_vars['formData']['fremoteupload'] != ''): ?><?php echo $this->_tpl_vars['formData']['fremoteactionurl']; ?>
<?php else: ?><?php echo $this->_tpl_vars['conf']['rooturl']; ?>
memberarea.html?tab=upload<?php endif; ?>" enctype="multipart/form-data">
			
			<?php if ($this->_tpl_vars['formData']['fremoteupload'] != ''): ?>
				<input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['formData']['fremoteuid']; ?>
" />
				<input type="hidden" name="sid" value="<?php echo $this->_tpl_vars['formData']['fremotesessionid']; ?>
" />
				<input type="hidden" name="token" value="<?php echo $this->_tpl_vars['formData']['fremotetoken']; ?>
" />
			<?php else: ?>
				<input type="hidden" name="ftoken" value="<?php echo $_SESSION['addPhotoToken']; ?>
" />
			<?php endif; ?>
			<p class="computer"><?php echo $this->_tpl_vars['lang']['controller']['photoSubmitHelp2']; ?>
</p>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'],'notifySuccess' => $this->_tpl_vars['success'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<div>
				<table>
					<tr>
						<td align="right" width="150" style="padding:5px;"><?php echo $this->_tpl_vars['lang']['controller']['section']; ?>
:</td>
						<td style="padding:5px;">
							<select name="fsection" style="padding:3px;">
								<?php echo $this->_tpl_vars['data']; ?>

							</select>
						</td>
					</tr>
					<tr>
						<td align="right" style="padding:5px;"><?php echo $this->_tpl_vars['lang']['controller']['photoupload']; ?>
:</td>
						<td style="padding:5px;"><input type="file" name="fimage" size="40" />
						</td>
					</tr>
					<tr>
						<td align="right" style="padding:5px;"><?php echo $this->_tpl_vars['lang']['controller']['photoname']; ?>
:</td>
						<td style="padding:5px;"><input type="text" name="fname" value="<?php echo $this->_tpl_vars['formData']['fname']; ?>
" size="40" />
						</td>
					</tr>
					
					
					<tr>
						<td align="right" style="padding:5px;"><?php echo $this->_tpl_vars['lang']['controller']['photodescription']; ?>
:</td>
						<td style="padding:5px;"><input type="text" name="fdescription" value="<?php echo $this->_tpl_vars['formData']['fdescription']; ?>
" size="40" />
						</td>
					</tr>
					<tr>
						<td align="right" style="padding:5px;"></td>
						<td style="padding:5px;"><input type="submit" class="btnSubmit" name="fsubmitphoto" value="<?php echo $this->_tpl_vars['lang']['controller']['photoSubmitBtn']; ?>
" />
						</td>
					</tr>
				</table>
				
			</div>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyInformation' => $this->_tpl_vars['information'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			
			
			
			</form>
			
		</div><!-- end #tabupload -->
		
		<div id="tabpayment">
			<div style="text-align:right;padding:10px;">
				<form name="currencyForm" method="post" action="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
memberarea.html?tab=payment">
		
						Currency: <select style="border: 1px solid rgb(221, 221, 221); font-size: 10px; padding:0;" onchange="javascript:document.currencyForm.submit();" name="fcurrency"><option value="usd" <?php if ($this->_tpl_vars['currency']->currencyCode == 'usd'): ?>selected="selected"<?php endif; ?> >USD</option><option value="vnd" <?php if ($this->_tpl_vars['currency']->currencyCode == 'vnd'): ?>selected="selected"<?php endif; ?>>VND</option></select>
				</form>
				</div>
				
				
		<form action="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
memberarea.html?tab=payment" method="post">
			<?php if (empty ( $this->_tpl_vars['me']->paidSection )): ?>
				<div class="infoEmpty"><?php echo $this->_tpl_vars['lang']['controller']['paymentEmpty']; ?>
</div>
			<?php else: ?>
				<div style="background:#E2F7FE; border:1px solid #09F; padding:10px;">
					<div class="infoEmpty"><strong><?php echo $this->_tpl_vars['lang']['controller']['yourPaidSectionTitle']; ?>
</strong></div>
					<div class="paymentOptionList">
						<?php echo $this->_tpl_vars['paymentPaidList']; ?>

					</div>
				</div>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['totalOptionList'] == ((is_array($_tmp=$this->_tpl_vars['me']->paidSection)) ? $this->_run_mod_handler('count', true, $_tmp) : count($_tmp))): ?>
				<br />
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyInformation' => $this->_tpl_vars['lang']['controller']['paymentFullAlready'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>
				<div class="infoSelectPayment"><?php echo $this->_tpl_vars['lang']['controller']['paymentSelect']; ?>
</div>
				<div class="paymentOptionList">
					<?php echo $this->_tpl_vars['paymentOptionList']; ?>

				</div>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['errorPayment'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			  
				<div class="paymentOptionCart">
					<input type="submit" name="fsubmitsection" value="<?php echo $this->_tpl_vars['lang']['controller']['paymentSectionCart']; ?>
" />
				</div>
				<div class="paymentMethod">
					<h2><?php echo $this->_tpl_vars['myPaymentPage']->title[$this->_tpl_vars['langCode']]; ?>
</h2>
					<div><?php echo $this->_tpl_vars['myPaymentPage']->contents[$this->_tpl_vars['langCode']]; ?>
</div>
				</div>
			<?php endif; ?>
		</form>
		</div><!-- end #tabpayment -->
	</div><!-- end #memberarealeft -->
		
	
	<div id="myphoto">
		<h2><?php echo $this->_tpl_vars['lang']['controller']['myphoto']; ?>
 (<?php echo count($this->_tpl_vars['myPhotoList']); ?>
)</h2>
		<div class="photos">
			<ul>

				<?php $_from = $this->_tpl_vars['myPhotoList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['photo']):
?>
					<li>
						<p><img alt="<?php echo $this->_tpl_vars['photo']->name; ?>
" src="<?php echo $this->_tpl_vars['photo']->getImage('thumb2'); ?>
" width="180"></p>
						<p class="name">
							<a target="_self" href="#" title="<?php echo $this->_tpl_vars['photo']->name; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['photo']->name)) ? $this->_run_mod_handler('truncate', true, $_tmp, 32) : smarty_modifier_truncate($_tmp, 32)); ?>
<br/><label><?php echo $this->_tpl_vars['lang']['global']['labelSection']; ?>
<?php echo $this->_tpl_vars['photo']->getSection(); ?>
</label></a>
						</p>
						<p class="date"><?php echo $this->_tpl_vars['lang']['controller']['datecreated']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['photo']->datecreated)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>
</p>
						<p class="action"><a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/memberarea/photoedit/id/<?php echo $this->_tpl_vars['photo']->id; ?>
"><?php echo $this->_tpl_vars['lang']['controller']['editLabel']; ?>
</a> &nbsp;| &nbsp;<a href="javascript:delm('<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/memberarea/photodelete/id/<?php echo $this->_tpl_vars['photo']->id; ?>
');"><?php echo $this->_tpl_vars['lang']['controller']['deleteLabel']; ?>
</a> &nbsp;|&nbsp; <a href="<?php echo $this->_tpl_vars['photo']->getPhotoPath(); ?>
#comment"><?php echo $this->_tpl_vars['photo']->comment; ?>
 <?php echo $this->_tpl_vars['lang']['controller']['comment']; ?>
</a></p>
					</li>
				<?php endforeach; endif; unset($_from); ?>

			</ul>
			<div class="clear"></div>
		</div>
	</div><!-- end #myphoto -->

	<div id="myphoto">
		<h2><?php echo $this->_tpl_vars['lang']['controller']['mygroupphoto']; ?>
 (<?php echo count($this->_tpl_vars['myPhotoGroupList']); ?>
)</h2>
		<div class="photos">
			<ul>

				<?php $_from = $this->_tpl_vars['myPhotoGroupList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['photo']):
?>
					<li>
						<p><img alt="<?php echo $this->_tpl_vars['photo']->name; ?>
" src="<?php echo $this->_tpl_vars['photo']->getImage('thumb2'); ?>
" width="180"></p>
						<p class="name">
							<a target="_self" href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/memberarea/photogroup/id/<?php echo $this->_tpl_vars['photo']->id; ?>
" title="<?php echo $this->_tpl_vars['photo']->name; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['photo']->name)) ? $this->_run_mod_handler('truncate', true, $_tmp, 32) : smarty_modifier_truncate($_tmp, 32)); ?>
<br/><label><?php echo $this->_tpl_vars['lang']['global']['labelSection']; ?>
<?php echo $this->_tpl_vars['photo']->getSection(); ?>
</label><br/><?php echo $this->_tpl_vars['lang']['controller']['viewDetail']; ?>
</a>
						</p>
						<p class="date"><?php echo $this->_tpl_vars['lang']['controller']['datecreated']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['photo']->datecreated)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>
</p>
						<p class="action"><a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/memberarea/photoedit/id/<?php echo $this->_tpl_vars['photo']->id; ?>
"><?php echo $this->_tpl_vars['lang']['controller']['editLabel']; ?>
</a> &nbsp;| &nbsp;<a href="javascript:delm('<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/memberarea/photodelete/id/<?php echo $this->_tpl_vars['photo']->id; ?>
');"><?php echo $this->_tpl_vars['lang']['controller']['deleteLabel']; ?>
</a> &nbsp;|&nbsp; <a href="<?php echo $this->_tpl_vars['photo']->getPhotoPath(); ?>
#comment"><?php echo $this->_tpl_vars['photo']->comment; ?>
 <?php echo $this->_tpl_vars['lang']['controller']['comment']; ?>
</a></p>
					</li>
				<?php endforeach; endif; unset($_from); ?>

			</ul>
			<div class="clear"></div>
		</div>
	</div><!-- end #myphoto -->
</div><!-- end #page -->



<script type="text/javascript">
	<?php echo '
	$(document).ready(function () {
      $(\'#membertab\').idTabs();
    });
	'; ?>

	
	
	var packTotalList = new Array();
	packTotalList[0] = '...';
	
	
		<?php $_from = $this->_tpl_vars['productPackList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
			packTotalList[<?php echo $this->_tpl_vars['product']->bincode; ?>
] = '<?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['product']->price); ?>
';
		<?php endforeach; endif; unset($_from); ?>
	
	
	function calculateOptionTotal()
	<?php echo '{'; ?>

	
		var packId = 0;
		
		<?php if ($this->_tpl_vars['formData']['fpaylocation'] == 'vn'): ?>
			if($('#fpaymentsection_color').attr('checked'))
				packId += 1;
				
			if($('#fpaymentsection_mono').attr('checked'))
				packId += 2;
				
			if($('#fpaymentsection_nature').attr('checked'))
				packId += 4;
		<?php else: ?>
			if($('#fpaymentsection_color').attr('checked'))
				packId += 8;
				
			if($('#fpaymentsection_mono').attr('checked'))
				packId += 16;
				
			if($('#fpaymentsection_nature').attr('checked'))
				packId += 32;
		<?php endif; ?>
		
		$('#paymentOptionPrice').html(packTotalList[packId]);
	<?php echo '}'; ?>

	</script>