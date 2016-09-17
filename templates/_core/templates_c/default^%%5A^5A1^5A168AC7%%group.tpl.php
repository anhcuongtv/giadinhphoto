<?php /* Smarty version 2.6.26, created on 2016-09-17 16:10:59
         compiled from _controller/site/memberarea/group.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '_controller/site/memberarea/group.tpl', 5, false),array('modifier', 'truncate', '_controller/site/memberarea/group.tpl', 13, false),array('modifier', 'date_format', '_controller/site/memberarea/group.tpl', 15, false),)), $this); ?>

<div id="page">

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
site/memberarea/photogroupedit/id/<?php echo $this->_tpl_vars['photo']->id; ?>
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