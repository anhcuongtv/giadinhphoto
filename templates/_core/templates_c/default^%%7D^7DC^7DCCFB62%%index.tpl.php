<?php /* Smarty version 2.6.26, created on 2012-11-15 13:07:21
         compiled from _controller/admin/index/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '_controller/admin/index/index.tpl', 31, false),)), $this); ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head']; ?>
</h2>
<div id="page-intro"><?php echo $this->_tpl_vars['lang']['controller']['intro']; ?>
</div>

<div class="content-box column-left"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3><?php echo $this->_tpl_vars['lang']['controller']['title_system']; ?>
</h3>
		
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<table class="grid" cellpadding="10">
			<tr>
				<td width="200" class="td_right">Server IP :</td>
				<td><?php echo $this->_tpl_vars['formData']['fserverip']; ?>
</td>
			</tr>
			<tr>
				<td class="td_right">Server Name :</td>
				<td><?php echo $this->_tpl_vars['formData']['fserver']; ?>
</td>
			</tr>
			<tr>
				<td class="td_right">PHP Version :</td>
				<td><?php echo $this->_tpl_vars['formData']['fphp']; ?>
</td>
			</tr>
			<tr>
				<td class="td_right">MySQL Version :</td>
				<td></td>
			</tr>
			<tr>
				<td class="td_right">Server Time :</td>
				<td><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['lang']['controllergroup']['dateFormatTimeSmarty']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['lang']['controllergroup']['dateFormatTimeSmarty'])); ?>
</td>
			</tr>
		</table>
	</div>	
</div>


<div class="content-box column-right"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3><?php echo $this->_tpl_vars['lang']['controller']['title_website']; ?>
</h3>
		
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<table cellpadding="10" cellspacing="20">
			<tbody>
			<tr>
				<td width="50">&nbsp;</td>
				<td><a title="<?php echo $this->_tpl_vars['lang']['controller']['viewAllTooltip']; ?>
" href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
user"><img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/detail.png" alt="list" /></a>  <span class="statnumber"><?php echo $this->_tpl_vars['stat']['user']; ?>
</span> <strong><?php echo $this->_tpl_vars['lang']['controller']['statUser']; ?>
<?php if ($this->_tpl_vars['stat']['user'] > 1): ?><?php echo $this->_tpl_vars['lang']['controller']['statPluralSuffix']; ?>
<?php endif; ?></strong> </td>
			</tr>
			<tr>
				<td width="50">&nbsp;</td>
				<td><a title="<?php echo $this->_tpl_vars['lang']['controller']['viewAllTooltip']; ?>
" href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contact"><img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/detail.png" alt="list" /></a>  <span class="statnumber"><?php echo $this->_tpl_vars['stat']['contact']; ?>
</span> <strong><?php echo $this->_tpl_vars['lang']['controller']['statContact']; ?>
<?php if ($this->_tpl_vars['stat']['contact'] > 1): ?><?php echo $this->_tpl_vars['lang']['controller']['statPluralSuffix']; ?>
<?php endif; ?></strong> </td>
			</tr>
			
			
			<tr>
				<td colspan="2"><hr size="1" /><br /><a href="http://www.google.com/analytics/" target="_blank">&raquo; Go to Google Analytics</a></td>
			</tr>
		</tbody
		></table>
	</div>	
</div>

<div class="clear"></div>