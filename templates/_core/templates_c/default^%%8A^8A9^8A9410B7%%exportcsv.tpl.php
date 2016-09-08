<?php /* Smarty version 2.6.26, created on 2014-11-04 17:12:26
         compiled from _controller/admin/round/exportcsv.tpl */ ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_exportcsv']; ?>
 : <?php echo $this->_tpl_vars['myRound']->name; ?>
</h2>

<form action="" method="post" name="myform">
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3><?php echo $this->_tpl_vars['lang']['controller']['title_exportcsv']; ?>
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
					<label>Section <span class="star_require">*</span> : </label>
					<select id="fsection" name="fsection[]" multiple="multiple" size="4">
						<option value="">- - - -</option>
                        <option value="color-c">Color</option>
						<option value="landscape-c">Color Best Portrait</option>
                        <option value="idea-c">Color Best Idead</option>
                        <option value="sport-c">Color Best Action </option>
                        <option value="mono-m">Mono</option>
                        <option value="idea-m">Mono Best Creative</option>
                        <option value="landscape-m">Mono Best Portrait</option>
						<option value="sport-m">Mono Best Action </option>
                        <option value="nature-n">Nature</option>
                        <option value="flower-n">Nature Best Flower</option>
                        <option value="bird-n">Nature Best Bird</option>
                        <option value="snow-n">Nature Best Snow</option>
                        <option value="travel-t">Travel</option>
						<option value="transportation-t">Travel Best Transportation </option>
                        <option value="dress-t">Travel Best Traditional</option>
                        <option value="country-t">Travel Best Country</option>

				  </select>
				</p>
				
				
				</fieldset>
			
		</div>
		
	</div>
	
	<div class="content-box-content-alt">
		<fieldset>
		<p>
			<input type="submit" name="fsubmit" value="EXPORT" class="button buttonbig">
			<br /><small><span class="star_require">*</span> : <?php echo $this->_tpl_vars['lang']['controllergroup']['formRequiredLabel']; ?>
</small>
		</p>
		</fieldset>
	</div>

    	
</div>
</form>
