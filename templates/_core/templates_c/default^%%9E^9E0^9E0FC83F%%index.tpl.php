<?php /* Smarty version 2.6.26, created on 2012-11-15 14:07:32
         compiled from _controller/site/statuslist/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', '_controller/site/statuslist/index.tpl', 24, false),array('function', 'paginate', '_controller/site/statuslist/index.tpl', 39, false),array('modifier', 'date_format', '_controller/site/statuslist/index.tpl', 28, false),)), $this); ?>
<div id="panelright" style="width:1000px">

	<div id="page">
		<h1><?php echo $this->_tpl_vars['lang']['controller']['title']; ?>
 (<?php echo $this->_tpl_vars['total']; ?>
 <?php echo $this->_tpl_vars['lang']['controller']['userLabel']; ?>
)</h1>
		<div style="text-align:right;font-size:14px;margin-top:-50px; margin-left:780px; position:absolute">
			<img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/tick_circle.png" alt="Yes" /><?php echo $this->_tpl_vars['lang']['controller']['isPaid']; ?>
 &nbsp; 	
			<img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/cross_circle.png" alt="No" /> <?php echo $this->_tpl_vars['lang']['controller']['isNotPaid']; ?>

		</div>
		<table border="1" id="statuslisttable" bordercolor="#CCCCCC" style="border-collapse:collapse;">
        	<tr>
            	<th>#</th>
                <th><?php echo $this->_tpl_vars['lang']['controller']['fullname']; ?>
</th>
                <th><?php echo $this->_tpl_vars['lang']['controller']['region']; ?>
</th>
                <th><?php echo $this->_tpl_vars['lang']['controller']['country']; ?>
</th>
                <th><?php echo $this->_tpl_vars['lang']['controller']['datecreated']; ?>
</th>
                <th><?php echo $this->_tpl_vars['lang']['controller']['paidColor']; ?>
</th>
                <th><?php echo $this->_tpl_vars['lang']['controller']['paidMono']; ?>
</th>
                <th><?php echo $this->_tpl_vars['lang']['controller']['paidNature']; ?>
</th>
                <th><?php echo $this->_tpl_vars['lang']['controller']['paidTravel']; ?>
</th>
            </tr>
			<?php $_from = $this->_tpl_vars['userList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['userlist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['userlist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['user']):
        $this->_foreach['userlist']['iteration']++;
?>
				<tr>
                    <td><?php echo smarty_function_math(array('equation' => "a+b",'a' => $this->_tpl_vars['orderStartCount'],'b' => $this->_foreach['userlist']['iteration']), $this);?>
</td>
                    <td><?php echo $this->_tpl_vars['user']->fullname; ?>
</td>
                    <td><?php echo $this->_tpl_vars['user']->region; ?>
</td>
                    <td><?php echo $this->_tpl_vars['user']->country; ?>
</td>
                    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->datecreated)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                    <td class="center"><?php if ($this->_tpl_vars['user']->paidColor == 1): ?><img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/tick_circle.png" alt="Yes" /><?php else: ?><img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/cross_circle.png" alt="No" /><?php endif; ?></td>
                    <td class="center"><?php if ($this->_tpl_vars['user']->paidMono == 1): ?><img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/tick_circle.png" alt="Yes" /><?php else: ?><img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/cross_circle.png" alt="No" /><?php endif; ?></td>
                    <td class="center"><?php if ($this->_tpl_vars['user']->paidNature == 1): ?><img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/tick_circle.png" alt="Yes" /><?php else: ?><img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/cross_circle.png" alt="No" /><?php endif; ?></td>
                    <td class="center"><?php if ($this->_tpl_vars['user']->paidTravel == 1): ?><img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/tick_circle.png" alt="Yes" /><?php else: ?><img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/cross_circle.png" alt="No" /><?php endif; ?></td>
                </tr>
			<?php endforeach; endif; unset($_from); ?>

        </table>
        
        <?php $this->assign('pageurl', "page/::PAGE::"); ?>
			<?php echo smarty_function_paginate(array('count' => $this->_tpl_vars['totalPage'],'curr' => $this->_tpl_vars['curPage'],'lang' => $this->_tpl_vars['paginateLang'],'max' => 10,'url' => ($this->_tpl_vars['paginateurl']).($this->_tpl_vars['pageurl'])), $this);?>

		
		
	
	</div>

</div><!-- end #panelright -->