<?php /* Smarty version 2.6.26, created on 2016-09-16 09:59:25
         compiled from _controller/admin/contestaward/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '_controller/admin/contestaward/index.tpl', 7, false),)), $this); ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_list']; ?>
</h2>
<div id="page-intro"><?php echo $this->_tpl_vars['lang']['controller']['intro_list']; ?>
</div>


<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3><?php echo $this->_tpl_vars['lang']['controller']['title_list']; ?>
 (<?php echo count($this->_tpl_vars['awards']); ?>
)</h3>
		<ul class="content-box-link">
			<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contestaward/add"><?php echo $this->_tpl_vars['lang']['controller']['head_add']; ?>
</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'],'notifySuccess' => $this->_tpl_vars['success'],'notifyWarning' => $this->_tpl_vars['warning'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<form action="" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<input type="hidden" name="ftoken" value="<?php echo $_SESSION['awardDeleteToken']; ?>
" />
				<table class="grid">
					
				<?php if (count($this->_tpl_vars['awards']) > 0): ?>
					<thead>
						<tr>
						   <th width="30" class="td_left"><?php echo $this->_tpl_vars['lang']['controllergroup']['formIdLabel']; ?>
</th>
							<th class="td_left" width="200"><?php echo $this->_tpl_vars['lang']['controller']['name']; ?>
</th>
                            <th class="td_left" width="200"><?php echo $this->_tpl_vars['lang']['controller']['section']; ?>
</th>	
							<th width="100" class="td_center"><?php echo $this->_tpl_vars['lang']['controller']['isactive']; ?>
</th>
							<th width="70"></th>
						</tr>
					</thead>
					
					
					<tbody>
					<?php $_from = $this->_tpl_vars['awards']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['awardlist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['awardlist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['award']):
        $this->_foreach['awardlist']['iteration']++;
?>
					
						<tr>
							<td style="font-weight:bold;"><?php echo $this->_tpl_vars['award']->id; ?>
</td>
							<td><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contestaward/edit/id/<?php echo $this->_tpl_vars['award']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><?php echo $this->_tpl_vars['award']->name; ?>
</a></td>
							<td>
                            	<?php if ($this->_tpl_vars['award']->section == 'color'): ?><?php echo $this->_tpl_vars['lang']['global']['photoSectionColor']; ?>
<?php elseif ($this->_tpl_vars['award']->section == 'mono'): ?><?php echo $this->_tpl_vars['lang']['global']['photoSectionMono']; ?>
<?php elseif ($this->_tpl_vars['award']->section == 'nature'): ?><?php echo $this->_tpl_vars['lang']['global']['photoSectionNature']; ?>
<?php elseif ($this->_tpl_vars['award']->section == 'travel'): ?><?php echo $this->_tpl_vars['lang']['global']['photoSectionTravel']; ?>
<?php else: ?><small style="color:#bbb;"><i><?php echo $this->_tpl_vars['lang']['controller']['applytoallsection']; ?>
</i></small><?php endif; ?>
                            </td>
                            
							<td class="td_center"><?php if ($this->_tpl_vars['award']->isactive == 1): ?><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/tick_circle.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formYesLabel']; ?>
" width="16"/><?php else: ?><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/cross_circle.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formNoLabel']; ?>
" width="16"/><?php endif; ?></td>
							
							<td><a title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formActionEditTooltip']; ?>
" href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contestaward/edit/id/<?php echo $this->_tpl_vars['award']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><img border="0" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/icons/pencil.png" alt="<?php echo $this->_tpl_vars['lang']['controllergroup']['formEditLabel']; ?>
" width="16"/></a> &nbsp;
								<a title="<?php echo $this->_tpl_vars['lang']['controllergroup']['formActionDeleteTooltip']; ?>
" href="javascript:delm('<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contestaward/delete/id/<?php echo $this->_tpl_vars['award']->id; ?>
/redirect/<?php echo $this->_tpl_vars['redirectUrl']; ?>
?token=<?php echo $_SESSION['awardDeleteToken']; ?>
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


