<?php /* Smarty version 2.6.26, created on 2016-09-13 21:51:47
         compiled from _controller/site/photo/detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '_controller/site/photo/detail.tpl', 6, false),array('modifier', 'truncate', '_controller/site/photo/detail.tpl', 36, false),)), $this); ?>
<div id="photodetail">
	<h1><?php echo $this->_tpl_vars['myPhoto']->name; ?>
 - [<a href="http://giadinhphotocontest.com/site/photo/index/section/<?php echo $this->_tpl_vars['myPhoto']->section; ?>
"><?php echo $this->_tpl_vars['myPhoto']->getSection(); ?>
</a>]</h1>
	<div class="poster">
		<div class="avatar"><img alt="<?php echo $this->_tpl_vars['poster']->username; ?>
" src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/photoinfo-icon.png"></div>
		<div class="box1"><strong><?php echo $this->_tpl_vars['lang']['controller']['size']; ?>
:</strong><br /><strong><?php echo $this->_tpl_vars['lang']['controller']['posted']; ?>
:</strong></div>
		<div class="box2"><?php echo $this->_tpl_vars['myPhoto']->resolution; ?>
 pixel<br /><?php echo ((is_array($_tmp=$this->_tpl_vars['myPhoto']->datecreated)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</div>
		<div class="box3"><strong><?php echo $this->_tpl_vars['lang']['controller']['view']; ?>
:</strong> <?php echo $this->_tpl_vars['myPhoto']->view; ?>
</div>
<br/>	<div class="addthis_native_toolbox"></div>

	</div>
	
	<div id="mainphoto">
		<img alt="<?php echo $this->_tpl_vars['myPhoto']->filethumb1; ?>
" title="<?php echo $this->_tpl_vars['myPhoto']->description; ?>
" src="<?php echo $this->_tpl_vars['myPhoto']->getImage(); ?>
">
		<div class="tag"><?php if ($this->_tpl_vars['myPhoto']->description != ''): ?><?php echo $this->_tpl_vars['lang']['controller']['tag']; ?>
: <?php echo $this->_tpl_vars['myPhoto']->description; ?>
<?php endif; ?></div>
		<ul class="slideShow clearfix">
			
			<li class="prev"><a href="<?php echo $this->_tpl_vars['prevPhoto']->getPhotoPath(); ?>
#photobox"  class="previousPhoto"  title="<?php echo $this->_tpl_vars['lang']['controller']['detailPrevTitle']; ?>
"><?php echo $this->_tpl_vars['lang']['controller']['detailPrev']; ?>
</a></li>
			<li class="next"><a href="<?php echo $this->_tpl_vars['nextPhoto']->getPhotoPath(); ?>
#photobox"  class="nextPhoto" title="<?php echo $this->_tpl_vars['lang']['controller']['detailNextTitle']; ?>
"><?php echo $this->_tpl_vars['lang']['controller']['detailNext']; ?>
</a></li>
			<li class="btnSlide"><a href="<?php echo $this->_tpl_vars['myPhoto']->getImage(); ?>
" title="<?php echo $this->_tpl_vars['myPhoto']->name; ?>
" rel="shadowbox[process]"><?php echo $this->_tpl_vars['lang']['controller']['detailSlideshow']; ?>
</a></li>
		</ul>
		<div class="clear"></div>
	</div>
	
	<?php $_from = $this->_tpl_vars['posterPhotoList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['photo']):
?>
		<?php if ($this->_tpl_vars['photo']->id != $this->_tpl_vars['myPhoto']->id): ?>
		<a style="display:none" href="<?php echo $this->_tpl_vars['photo']->getImage(); ?>
" title="<?php echo $this->_tpl_vars['photo']->name; ?>
" rel="shadowbox[process]"><?php echo $this->_tpl_vars['photo']->name; ?>
</a>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	
	<div id="more">
		<div class="photobox" style="padding:0;">
			<div class="photos">
				<?php $_from = $this->_tpl_vars['newerPhotoList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['photo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['photo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['photo']):
        $this->_foreach['photo']['iteration']++;
?>
				<div class="photo">
					<div class="image"><a href="<?php echo $this->_tpl_vars['photo']->getPhotoPath(); ?>
"title="<?php echo $this->_tpl_vars['photo']->name; ?>
"><img width="216" alt="<?php echo $this->_tpl_vars['photo']->filethumb2; ?>
" src="<?php echo $this->_tpl_vars['photo']->getImage('thumb2'); ?>
"></a></div>
					<a class="name" href="<?php echo $this->_tpl_vars['photo']->getPhotoPath(); ?>
" title="<?php echo $this->_tpl_vars['photo']->name; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['photo']->name)) ? $this->_run_mod_handler('truncate', true, $_tmp, 15) : smarty_modifier_truncate($_tmp, 15)); ?>
</a>
					<a class="view" href="<?php echo $this->_tpl_vars['photo']->getPhotoPath(); ?>
" title="<?php echo $this->_tpl_vars['photo']->name; ?>
"><?php echo $this->_tpl_vars['photo']->view; ?>
 <?php if ($this->_tpl_vars['photo']->view > 1): ?><?php echo $this->_tpl_vars['lang']['controller']['view']; ?>
<?php else: ?><?php echo $this->_tpl_vars['lang']['controller']['view']; ?>
<?php endif; ?></a>
				</div>
				<?php endforeach; endif; unset($_from); ?>
			</div>
		</div><!-- end .photobox -->
		<div class="clear"></div>
	</div>
	<?php echo '
	<script>
	var previousPhoto = $(\'.previousPhoto\').attr(\'href\');
	var nextPhoto = $(\'.nextPhoto\').attr(\'href\');
		document.onkeydown = function(e) {
    switch (e.keyCode) {
        case 37:
        window.location = previousPhoto;
            break;
        case 39:
        window.location= nextPhoto;
            break;
    }
};
	</script>
	'; ?>

</div>
