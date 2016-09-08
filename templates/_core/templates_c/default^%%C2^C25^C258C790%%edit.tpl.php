<?php /* Smarty version 2.6.26, created on 2014-11-01 04:30:00
         compiled from _controller/admin/judger/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '_controller/admin/judger/edit.tpl', 174, false),)), $this); ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_edit']; ?>
</h2>

<form action="" method="post" name="myform">
<input type="hidden" name="ftoken" value="<?php echo $_SESSION['judgerEditToken']; ?>
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
					<label><?php echo $this->_tpl_vars['lang']['controller']['judger']; ?>
 <span class="star_require">*</span> : </label>
					User ID: <input type="text" disabled="disabled" size="5" value="<?php echo $this->_tpl_vars['myJudger']->uid; ?>
" class="text-input">
					 <em>- OR -</em>
					Username: <input type="text" disabled="disabled" size="30" value="<?php echo $this->_tpl_vars['myJudger']->user->username; ?>
" class="text-input">
					<em>- OR -</em>
					Email<input type="text" disabled="disabled" size="30" value="<?php echo $this->_tpl_vars['myJudger']->user->email; ?>
" class="text-input">
				</p>
				
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['iscolor']; ?>
: </label>
					<select name="fiscolor" id="fiscolor">
                        <option value="0"><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
						<option value="1" <?php if ($this->_tpl_vars['formData']['fiscolor'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>						
					</select>
				</p>
                
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['isColorBestPortrait']; ?>
 Best: </label>
                    <select name="isColorBestPortrait" id="fiscolorbest">
                        <option value="0"><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
                        <option value="1" <?php if ($this->_tpl_vars['formData']['isColorBestPortrait'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>                        
                    </select>
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['isColorBestIdea']; ?>
 Best: </label>
                    <select name="isColorBestIdea" id="fiscolorbest">
                        <option value="0"><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
                        <option value="1" <?php if ($this->_tpl_vars['formData']['isColorBestIdea'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>                        
                    </select>
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['isColorBestAction']; ?>
 Best: </label>
                    <select name="isColorBestAction" id="fiscolorbest">
                        <option value="0"><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
                        <option value="1" <?php if ($this->_tpl_vars['formData']['isColorBestAction'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>                        
                    </select>
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['ismono']; ?>
 </label>
                    <select name="fismono" id="fiscolorbest">
                        <option value="0"><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
                        <option value="1" <?php if ($this->_tpl_vars['formData']['fismono'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>                        
                    </select>
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['isMonoBestPortrait']; ?>
 Best: </label>
                    <select name="isMonoBestPortrait" id="fiscolorbest">
                        <option value="0"><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
                        <option value="1" <?php if ($this->_tpl_vars['formData']['isMonoBestPortrait'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>                        
                    </select>
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['isMonoBestAction']; ?>
 Best: </label>
                    <select name="isMonoBestAction" id="isMonoBestAction">
                        <option value="0"><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
                        <option value="1" <?php if ($this->_tpl_vars['formData']['isMonoBestAction'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>                        
                    </select>
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['isMonoCreative']; ?>
 Best: </label>
                    <select name="isMonoCreative" id="fiscolorbest">
                        <option value="0"><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
                        <option value="1" <?php if ($this->_tpl_vars['formData']['isMonoCreative'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>                        
                    </select>
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['isnature']; ?>
  </label>
                    <select name="fisnature" id="fisnature">
                        <option value="0"><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
                        <option value="1" <?php if ($this->_tpl_vars['formData']['fisnature'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>                        
                    </select>
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['isNatureBestBird']; ?>
 Best: </label>
                    <select name="isNatureBestBird" id="isNatureBestBird">
                        <option value="0"><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
                        <option value="1" <?php if ($this->_tpl_vars['formData']['isNatureBestBird'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>                        
                    </select>
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['isNatureBestSnow']; ?>
 Best: </label>
                    <select name="isNatureBestSnow" id="isNatureBestSnow">
                        <option value="0"><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
                        <option value="1" <?php if ($this->_tpl_vars['formData']['isNatureBestSnow'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>                        
                    </select>
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['isNatureBestFlower']; ?>
 Best: </label>
                    <select name="isNatureBestFlower" id="isNatureBestFlower">
                        <option value="0"><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
                        <option value="1" <?php if ($this->_tpl_vars['formData']['isNatureBestFlower'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>                        
                    </select>
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['istravel']; ?>
 </label>
                    <select name="fistravel" id="fistravel">
                        <option value="0"><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
                        <option value="1" <?php if ($this->_tpl_vars['formData']['fistravel'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>                        
                    </select>
                </p>
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['isTravelTransportation']; ?>
 Best: </label>
                    <select name="isTravelTransportation" id="isTravelTransportation">
                        <option value="0"><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
                        <option value="1" <?php if ($this->_tpl_vars['formData']['isTravelTransportation'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>                        
                    </select>
                </p>
				
				<p>
					<label><?php echo $this->_tpl_vars['lang']['controller']['isTravelTraditional']; ?>
 Best :</label>
					<select name="isTravelTraditional" id="isTravelTraditional">
                        <option value="0" ><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
						<option value="1" <?php if ($this->_tpl_vars['formData']['isTravelTraditional'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>
					</select>
				</p>
                
                <p>
                    <label><?php echo $this->_tpl_vars['lang']['controller']['isTravelCountry']; ?>
 Best </label>
                    <select name="isTravelCountry" id="isTravelCountry">
                        <option value="0" ><?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
</option>
                        <option value="1" <?php if ($this->_tpl_vars['formData']['isTravelCountry'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
</option>
                    </select>
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


<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>Round Score Statistic (<?php echo count($this->_tpl_vars['rounds']); ?>
)</h3>
		<ul class="content-box-link">
			<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
round"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuRoundList']; ?>
</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
			
				<table class="grid">
					
				<?php if (count($this->_tpl_vars['rounds']) > 0): ?>
					<thead>
						<tr>
						   <th width="30" class="td_left">ID</th>
							<th class="td_left" width="200">Name</th>		
							<th class="td_left">Photo</th>
                            <th class="td_left">Score Stats</th>	
									
							<th width="100" class="td_center">Is Active</th>
							
						</tr>
					</thead>
					
					
					<tbody>
					<?php $_from = $this->_tpl_vars['rounds']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['roundlist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['roundlist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['round']):
        $this->_foreach['roundlist']['iteration']++;
?>
					
						<tr>
							<td style="font-weight:bold;"><?php echo $this->_tpl_vars['round']->id; ?>
</td>
							<td><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
round/edit/id/<?php echo $this->_tpl_vars['round']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><?php echo $this->_tpl_vars['round']->name; ?>
</a></td>
							<td>
                            	<?php echo $this->_tpl_vars['round']->numberphoto; ?>

                                
                            </td>
                            <td><small>
                            	<?php if ($this->_tpl_vars['round']->numberphoto > 0): ?>
                                	Finished: <?php echo $this->_tpl_vars['round']->numberphotofinished; ?>
, <br />
                                    Un-scored: <?php echo $this->_tpl_vars['round']->numberphotounscored; ?>
<br />
                                    
                                <?php else: ?>
                                	<em>Photo empty</em>
                                <?php endif; ?>
                            	</small>
                            </td>
                            
							<td class="td_center"><?php if ($this->_tpl_vars['round']->isactive == 1): ?><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/tick_circle.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
" width="16"/><?php else: ?><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/cross_circle.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
" width="16"/><?php endif; ?></td>
							
						</tr>
						
						<?php $this->assign('prevRound', $this->_tpl_vars['round']); ?>
					<?php endforeach; endif; unset($_from); ?>
					</tbody>
					
				  
				<?php else: ?>
					<tr>
						<td colspan="10"> <?php echo $this->_tpl_vars['lang']['controllergroup']['notfound']; ?>
</td>
					</tr>
				<?php endif; ?>
				
				</table>
			</form>
	
	</div>

    	
</div>
