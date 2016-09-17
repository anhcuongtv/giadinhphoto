<?php /* Smarty version 2.6.26, created on 2016-09-17 21:49:05
         compiled from _controller/site/photo/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', '_controller/site/photo/index.tpl', 61, false),array('function', 'paginate', '_controller/site/photo/index.tpl', 71, false),)), $this); ?>
<div id="page">
	
	<div id="photolist_filter">
		<form onsubmit="return gofilter();">
			<?php echo $this->_tpl_vars['lang']['controller']['photoname']; ?>
: 
				<input type="text" name="fkeywordfilter" id="fkeywordfilter" size="32" value="<?php echo $this->_tpl_vars['formData']['fkeyword']; ?>
" class="textbox" /> -
			<?php echo $this->_tpl_vars['lang']['controller']['section']; ?>
 :
			<select name="fsectionfilter" id="fsectionfilter" class="selectbox">
				<?php echo $this->_tpl_vars['data']; ?>

			</select>
					
			<input type="submit" value="<?php echo $this->_tpl_vars['lang']['controller']['filterSubmit']; ?>
" class="button" />
		</form>
		<?php echo '
        <script type="text/javascript">
            function gofilter()
            {
        '; ?>

            <?php if ($this->_tpl_vars['round'] > 0 && $this->_tpl_vars['round'] != ''): ?>
                <?php echo 'var path = rooturl + "site/photo/index/round/'; ?>
<?php echo $this->_tpl_vars['round']; ?>
<?php echo '";'; ?>
    
            <?php else: ?>
                <?php echo 'var path = rooturl + "site/photo/index";'; ?>

            <?php endif; ?>
        <?php echo '
                var keyword = $("#fkeywordfilter").val();
                if(keyword.length > 0)
                {
                    path += "/keyword/" + keyword;
                }
                
                var section = $("#fsectionfilter").val();
                if(section.length > 0)
                {
                    path += "/section/" + section;
                }
                
                        
                document.location.href= path;
                
                return false;
            }
        </script>
        '; ?>

	</div>
	
	<h1>
    <?php if ($this->_tpl_vars['formData']['fsection'] != ''): ?>
		<?php $this->assign('section', $this->_tpl_vars['formData']['fsection']); ?>
	    <?php echo $this->_tpl_vars['groups'][$this->_tpl_vars['section']]; ?>


    <?php else: ?>
        <?php echo $this->_tpl_vars['lang']['controller']['viewAll']; ?>

    <?php endif; ?> (<?php echo $this->_tpl_vars['total']; ?>
 photos)</h1>
	<div class="contents"><?php if ($this->_tpl_vars['round'] == null): ?><?php echo $this->_tpl_vars['lang']['controller']['allimage']; ?>
 <?php echo $this->_tpl_vars['total']; ?>
 <?php echo $this->_tpl_vars['lang']['controller']['allimageafter']; ?>
 <?php echo $this->_tpl_vars['totalUser']; ?>
 <?php echo $this->_tpl_vars['lang']['controller']['allimageauthor']; ?>
<?php elseif ($this->_tpl_vars['round'] == 1): ?><?php echo $this->_tpl_vars['lang']['controller']['subtitle1']; ?>
<?php elseif ($this->_tpl_vars['round'] == 2): ?><?php echo $this->_tpl_vars['lang']['controller']['subtitle2']; ?>
<?php elseif ($this->_tpl_vars['round'] == 3): ?><?php echo $this->_tpl_vars['lang']['controller']['subtitle3']; ?>
<?php else: ?><?php echo $this->_tpl_vars['lang']['controller']['subtitle4']; ?>
<?php endif; ?></div>
	
	<div class="photobox" style="padding:0;">
		<div class="photos">
			<?php $_from = $this->_tpl_vars['newPhotoList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['photo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['photo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['photo']):
        $this->_foreach['photo']['iteration']++;
?>
			<div class="photo">
				<div class="image"><a href="<?php echo $this->_tpl_vars['photo']->getPhotoPath(); ?>
" title="<?php echo $this->_tpl_vars['photo']->name; ?>
"><img width="216" alt="<?php echo $this->_tpl_vars['photo']->name; ?>
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
	
	
	
	<?php $this->assign('pageurl', "page/::PAGE::"); ?>
	<?php echo smarty_function_paginate(array('count' => $this->_tpl_vars['totalPage'],'curr' => $this->_tpl_vars['curPage'],'lang' => $this->_tpl_vars['paginateLang'],'max' => 10,'url' => ($this->_tpl_vars['paginateurl']).($this->_tpl_vars['pageurl'])), $this);?>

</div>

