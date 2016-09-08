<?php /* Smarty version 2.6.26, created on 2014-11-04 10:46:23
         compiled from _controller/admin/round/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlspecialchars', '_controller/admin/round/edit.tpl', 25, false),)), $this); ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_edit']; ?>
</h2>

<form action="" method="post" name="myform">
<input type="hidden" name="ftoken" value="<?php echo $_SESSION['roundEditToken']; ?>
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
					<label><?php echo $this->_tpl_vars['lang']['controller']['name']; ?>
 <span class="star_require">*</span> : </label>
					<input type="text" name="fname" id="fname" size="80" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fname']); ?>
" class="text-input">
				</p>
				
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['isactive']; ?>
: </label>
					<select name="fisactive" id="fisactive">
						<option value="1"><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>
						<option value="0" <?php if ($this->_tpl_vars['formData']['fisactive'] == '0'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
					</select>
				</p>

                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['isEnableView']; ?>
: </label>
                    <select name="fisEnableView" id="fisactive">
                        <option value="1"><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>
                        <option value="0" <?php if ($this->_tpl_vars['formData']['fisEnableView'] == '0'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
                    </select>
                </p>
                
                <p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['isgiveaward']; ?>
: </label>
					<select name="fisgiveaward" id="fisgiveaward">
						<option value="1"><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>
						<option value="0" <?php if ($this->_tpl_vars['formData']['fisgiveaward'] == '0'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
					</select>
				</p>
				
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['passpoint']; ?>
 Color <span class="star_require">*</span> : </label>
					<input type="text" name="fpasspointcolor" id="fpasspoint" size="5" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fpasspoint']['sectionColor']); ?>
" class="text-input">
				</p>
                
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['passpoint']; ?>
 Color Best Portrait <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionColorBestPortrait" id="sectionColorBestPortrait" size="5" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fpasspoint']['sectionColorBestPortrait']); ?>
" class="text-input">
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['passpoint']; ?>
 Color Best Sport <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionColorBestAction" id="sectionColorBestAction" size="5" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fpasspoint']['sectionColorBestAction']); ?>
" class="text-input">
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['passpoint']; ?>
 Color Best Idea <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionColorBestIdea" id="sectionColorBestIdea" size="5" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fpasspoint']['sectionColorBestIdea']); ?>
" class="text-input">
                </p>
                 <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['passpoint']; ?>
 Mono <span class="star_require">*</span> : </label>
                    <input type="text" name="fpasspointmono" id="fpasspoint" size="5" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fpasspoint']['sectionMono']); ?>
" class="text-input">
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['passpoint']; ?>
 Mono Best Portrait <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionMonoBestPortrait" id="sectionMonoBestPortrait" size="5" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fpasspoint']['sectionMonoBestPortrait']); ?>
" class="text-input">
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['passpoint']; ?>
 Mono Best Action <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionMonoBestAction" id="sectionMonoBestAction" size="5" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fpasspoint']['sectionMonoBestAction']); ?>
" class="text-input">
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['passpoint']; ?>
 Mono Best Creative <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionMonoBestCreative" id="sectionMonoBestCreative" size="5" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fpasspoint']['sectionMonoBestCreative']); ?>
" class="text-input">
                </p>
                 <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['passpoint']; ?>
 Nature <span class="star_require">*</span> : </label>
                    <input type="text" name="fpasspointnature" id="fpasspoint" size="5" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fpasspoint']['sectionNature']); ?>
" class="text-input">
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['passpoint']; ?>
 Nature Best Snow <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionNatureBestSnow" id="sectionNatureBestSnow" size="5" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fpasspoint']['sectionNatureBestSnow']); ?>
" class="text-input">
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['passpoint']; ?>
 Nature Best Bird <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionNatureBestBird" id="sectionNatureBestBird" size="5" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fpasspoint']['sectionNatureBestBird']); ?>
" class="text-input">
                </p>

                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['passpoint']; ?>
 Nature Best Flower <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionNatureBestFlower" id="sectionNatureBestFlower" size="5" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fpasspoint']['sectionNatureBestFlower']); ?>
" class="text-input">
                </p>

                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['passpoint']; ?>
 Travel <span class="star_require">*</span> : </label>
                    <input type="text" name="fpasspointtravel" id="fpasspoint" size="5" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fpasspoint']['sectionTravel']); ?>
" class="text-input">
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['passpoint']; ?>
 Travel Best Transportation <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionTravelBestTransportation" id="sectionTravelBestTransportation" size="5" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fpasspoint']['sectionTravelBestTransportation']); ?>
" class="text-input">
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['passpoint']; ?>
 Travel Best Country  <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionTravelBestCountry" id="sectionTravelBestCountry" size="5" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fpasspoint']['sectionTravelBestCountry']); ?>
" class="text-input">
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['passpoint']; ?>
 Travel Best Traditional  <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionTravelBestTraditional" id="sectionTravelBestTraditional" size="5" value="<?php echo htmlspecialchars($this->_tpl_vars['formData']['fpasspoint']['sectionTravelBestTraditional']); ?>
" class="text-input">
                </p>
                
               
                
               
                
				
				
				
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

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tinymce.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
