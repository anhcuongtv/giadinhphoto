<?php /* Smarty version 2.6.26, created on 2014-10-30 10:21:11
         compiled from _controller/site/news/detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '_controller/site/news/detail.tpl', 9, false),)), $this); ?>
<div id="panelright" style="width:1000px">
	<div id="page">
		<h1><?php echo $this->_tpl_vars['myNews']->name[$this->_tpl_vars['langCode']]; ?>
</h1>
					<div class="addthis_native_toolbox"></div>

		<div class="news">
			<div class="news_date">
				<?php echo ((is_array($_tmp=$this->_tpl_vars['myNews']->datemodified)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>

			</div>
			
			<?php if ($this->_tpl_vars['myNews']->image != ''): ?>
				<div class="news_image" style="display:none;">
					<img style="border:1px solid #999999;" alt="<?php echo $this->_tpl_vars['myNews']->name[$this->_tpl_vars['langCode']]; ?>
" src="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['setting']['news']['imageDirectory']; ?>
<?php echo $this->_tpl_vars['myNews']->image; ?>
"/>
				</div>
			<?php endif; ?>
		
			<?php if ($this->_tpl_vars['myNews']->summary[$this->_tpl_vars['langCode']] != ''): ?>
				<div class="news_summary" style="display:none;">
					<?php echo $this->_tpl_vars['myNews']->summary[$this->_tpl_vars['langCode']]; ?>

				</div>
			<?php endif; ?>
		
			<div class="news_contents">
				<?php echo $this->_tpl_vars['myNews']->contents[$this->_tpl_vars['langCode']]; ?>

			</div>
		


		<?php if ($this->_tpl_vars['myNews']->tags[$this->_tpl_vars['langCode']] != ''): ?>
			<div class="news_tags">
				<span class="news_tags_title"><?php echo $this->_tpl_vars['lang']['controller']['tags']; ?>
</span>
				<span class="news_tags_list">
					<?php echo $this->_tpl_vars['myNews']->tags[$this->_tpl_vars['langCode']]; ?>

				</span>
			</div>
		<?php endif; ?>
		
		
			
			<div class="news_more">
				<div class="news_more_group">
					<div class="news_more_heading"><?php echo $this->_tpl_vars['lang']['controller']['moreCategory']; ?>
</div>
					<div class="news_more_list">
						<?php $_from = $this->_tpl_vars['moreNewsSameCategory']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['news']):
?>
						<?php $this->assign('seolink', $this->_tpl_vars['news']->getFullUrl()); ?>
							<a href="<?php echo $this->_tpl_vars['seolink']; ?>
" id="news<?php echo $this->_tpl_vars['news']->id; ?>
" title="<?php echo $this->_tpl_vars['news']->name[$this->_tpl_vars['langCode']]; ?>
">
									<span class="news_more_title">&raquo; <?php echo $this->_tpl_vars['news']->name[$this->_tpl_vars['langCode']]; ?>
</span>
									<span class="news_more_date">(<?php echo ((is_array($_tmp=$this->_tpl_vars['news']->datemodified)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d/%m/%Y') : smarty_modifier_date_format($_tmp, '%d/%m/%Y')); ?>
)</span>
								</a>
						<?php endforeach; endif; unset($_from); ?>
						
					 </div>
				</div>
		
		
				
			</div>
		</div>
	</div>
</div>
