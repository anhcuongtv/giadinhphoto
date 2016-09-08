<?php /* Smarty version 2.6.26, created on 2012-11-16 16:58:25
         compiled from _controller/site/news/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '_controller/site/news/index.tpl', 5, false),array('modifier', 'stripslashes', '_controller/site/news/index.tpl', 12, false),array('modifier', 'date_format', '_controller/site/news/index.tpl', 14, false),array('function', 'paginate', '_controller/site/news/index.tpl', 24, false),)), $this); ?>
<div id="panelright" style="width:1000px">
	<div id="page">
		<h1><?php echo $this->_tpl_vars['lang']['controller']['title']; ?>
</h1>
		<?php if (count($this->_tpl_vars['newsList']) == 0): ?>
			<div align="center" style="margin:30px; font-weight:bold; color:#FF3300;font-size:14px;"><?php echo $this->_tpl_vars['lang']['controller']['notFound']; ?>
</div>
		<?php else: ?>
			<div class="newsthumbs">
				<?php $_from = $this->_tpl_vars['newsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['sitenews'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sitenews']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['news']):
        $this->_foreach['sitenews']['iteration']++;
?>
				<?php $this->assign('seolink', $this->_tpl_vars['news']->getFullUrl()); ?>
				<div class="newsthumb">
					<div class="newsthumb_title"><a href="<?php echo $this->_tpl_vars['seolink']; ?>
">&raquo;  <?php echo ((is_array($_tmp=$this->_tpl_vars['news']->name[$this->_tpl_vars['langCode']])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</a></div>
					<?php if ($this->_tpl_vars['news']->image != ''): ?><div class="newsthumb_image"><a href="<?php echo $this->_tpl_vars['seolink']; ?>
" title="$news->name.$langCode"><img style="border:1px solid #999999;" alt="<?php echo $this->_tpl_vars['news']->name[$this->_tpl_vars['langCode']]; ?>
" src="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['setting']['news']['imageDirectory']; ?>
<?php echo $this->_tpl_vars['news']->smallImage; ?>
"/></a></div><?php endif; ?>
					<div class="newsthumb_date"><?php echo $this->_tpl_vars['lang']['controller']['datecreated']; ?>
 : <?php echo ((is_array($_tmp=$this->_tpl_vars['news']->datemodified)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d/%m/%Y') : smarty_modifier_date_format($_tmp, '%d/%m/%Y')); ?>
</div>
					<div class="newsthumb_summary"><?php echo $this->_tpl_vars['news']->summary[$this->_tpl_vars['langCode']]; ?>
</div>
					<div class="newsthumb_detail_link">
						<a href="<?php echo $this->_tpl_vars['seolink']; ?>
"><?php echo $this->_tpl_vars['lang']['controller']['detail']; ?>
</a>
					</div>
					<hr class="newsthumb_seperator" />
				</div>
				<?php endforeach; endif; unset($_from); ?>
				
				<?php $this->assign('pageurl', "page/::PAGE::"); ?>
				<?php echo smarty_function_paginate(array('count' => $this->_tpl_vars['totalPage'],'curr' => $this->_tpl_vars['curPage'],'lang' => $this->_tpl_vars['paginateLang'],'max' => 10,'url' => ($this->_tpl_vars['paginateurl']).($this->_tpl_vars['pageurl'])), $this);?>

			
			</div>
			
			
		<?php endif; ?>
	</div>
</div>





