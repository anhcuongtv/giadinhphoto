<?php /* Smarty version 2.6.26, created on 2016-09-17 21:54:37
         compiled from _controller/site/memberarea/editphoto.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '_controller/site/memberarea/editphoto.tpl', 5, false),)), $this); ?>
<div id="photodetail">
	<h1>Edit: <?php echo $this->_tpl_vars['myPhoto']->name; ?>
 - [<?php echo $this->_tpl_vars['myPhoto']->getSection(); ?>
]</h1>
	<div class="poster">
		<div class="avatar"><img alt="<?php echo $this->_tpl_vars['myPhoto']->name; ?>
" title="<?php echo $this->_tpl_vars['myPhoto']->description; ?>
" src="<?php echo $this->_tpl_vars['myPhoto']->getImage('thumb2'); ?>
" /></div>
		<div class="box2"><?php echo $this->_tpl_vars['myPhoto']->resolution; ?>
 pixel<br /><?php echo ((is_array($_tmp=$this->_tpl_vars['myPhoto']->datecreated)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</div>
			</div>
</div>

<div id="page">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'],'notifySuccess' => $this->_tpl_vars['success'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<form method="post" action="">
	<input type="hidden" name="ftoken" value="<?php echo $_SESSION['editPhotoToken']; ?>
" />
		<table>
				<tr>
					<td align="right" width="150" style="padding:5px;"><?php echo $this->_tpl_vars['lang']['controller']['section']; ?>
:</td>
					<td style="padding:5px;"><select name="fsection" disabled>
							<?php echo $this->_tpl_vars['data']; ?>

						</select>
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
					<td style="padding:5px;"><input class="btnSubmit" type="submit" name="fsubmit" value="<?php echo $this->_tpl_vars['lang']['controller']['updateBtn']; ?>
" />
					</td>
				</tr>
			</table>
	
	</form>
</div>