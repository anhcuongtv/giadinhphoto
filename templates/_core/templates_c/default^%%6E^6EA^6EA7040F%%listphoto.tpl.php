<?php /* Smarty version 2.6.26, created on 2014-11-03 13:46:08
         compiled from _controller/admin/round/listphoto.tpl */ ?>

<div class="listphoto-inner">
		<ul class="photo-item">

			<?php $_from = $this->_tpl_vars['photos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['photo']):
?>
				<li class="item"><a href="<?php echo $this->_tpl_vars['photo']->filepath; ?>
"><img src="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
uploads/contestphoto/en/<?php echo $this->_tpl_vars['photo']->filethumb2; ?>
"/></a> </li>
			<?php endforeach; endif; unset($_from); ?>
		</li>
	</div>
<?php echo '
<script>
				$(document).ready(function(){
									$(".listphoto").colorbox({rel:\'group1\'});

});
</script>
'; ?>