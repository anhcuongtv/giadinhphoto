<?php /* Smarty version 2.6.26, created on 2016-09-16 10:00:06
         compiled from _controller/admin/product/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '_controller/admin/product/index.tpl', 20, false),)), $this); ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_list']; ?>
</h2>
<div id="page-intro"><?php echo $this->_tpl_vars['lang']['controller']['intro_list']; ?>
</div>

<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3><?php echo $this->_tpl_vars['lang']['controller']['title_list']; ?>
(<?php echo $this->_tpl_vars['total']; ?>
)</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab"><?php echo $this->_tpl_vars['lang']['controllergroup']['tableTabLabel']; ?>
</a></li> <!-- href must be unique and match the id of target div -->
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
			<form action="" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<input type="hidden" name="ftoken" value="<?php echo $_SESSION['productBulkToken']; ?>
" />
				<table class="grid">
					
				<?php if (count($this->_tpl_vars['products']) > 0): ?>
					<thead>
						<tr>
							<th width="30" align="right"><?php echo $this->_tpl_vars['lang']['controllergroup']['formIdLabel']; ?>
</th>
							<th align="left"><?php echo $this->_tpl_vars['lang']['controller']['formNameLabel']; ?>
</th>		
							<th width="80" class="td_right"><?php echo $this->_tpl_vars['lang']['controller']['formPriceLabel']; ?>
</th>				
							<th width="70"></th>
						</tr>
					</thead>
					
					
					<tbody>
					<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['myProduct']):
?>
					
						<tr>
							<td style="font-weight:bold;" align="right"><?php echo $this->_tpl_vars['myProduct']->id; ?>
</td>
							<td align="left"><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
product/edit/id/<?php echo $this->_tpl_vars['myProduct']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><?php echo $this->_tpl_vars['myProduct']->name; ?>
</a>
							</td>
							<td class="td_right"><?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['myProduct']->price); ?>
</td>
							
							<td><a title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formActionEditTooltip']; ?>
" href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
product/edit/id/<?php echo $this->_tpl_vars['myProduct']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/pencil.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formEditLabel']; ?>
" width="16"/></a> &nbsp;
								<a style="display:none" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formActionDeleteTooltip']; ?>
" href="javascript:delm('<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
product/delete/id/<?php echo $this->_tpl_vars['myProduct']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
?token=<?php echo $_SESSION['securityToken']; ?>
');"><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/cross.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formDeleteLabel']; ?>
" width="16"/></a>
							</td>
						</tr>
						
					
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
	

    	
</div>


