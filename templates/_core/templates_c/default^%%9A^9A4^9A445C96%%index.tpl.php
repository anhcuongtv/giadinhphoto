<?php /* Smarty version 2.6.26, created on 2014-10-30 11:13:23
         compiled from _controller/site/photo/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', '_controller/site/photo/index.tpl', 117, false),array('function', 'paginate', '_controller/site/photo/index.tpl', 127, false),)), $this); ?>
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
							<option value=""><?php echo $this->_tpl_vars['lang']['global']['photoSectionSelectOne']; ?>
</option>
                                <optgroup label="<?php echo $this->_tpl_vars['lang']['global']['photoSectionColor']; ?>
">
                                <option value="color-c" <?php if ($this->_tpl_vars['formData']['fsection'] == 'color-c'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['subphotoSectionColor']; ?>
</option>
                                <option value="landscape-c" <?php if ($this->_tpl_vars['formData']['fsection'] == 'landscape-c'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['subphotoSectionColorLandscape']; ?>
</option>
                                <option value="sport-c" <?php if ($this->_tpl_vars['formData']['fsection'] == 'sport-c'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['subphotoSectionColorSport']; ?>
</option>
                                <option value="idea-c" <?php if ($this->_tpl_vars['formData']['fsection'] == 'idea-c'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['subphotoSectionColorIdea']; ?>
</option>
                                </optgroup>
                                <optgroup label="<?php echo $this->_tpl_vars['lang']['global']['photoSectionMono']; ?>
">
                                <option value="mono-m" <?php if ($this->_tpl_vars['formData']['fsection'] == 'mono-m'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['subphotoSectionMono']; ?>
</option>
                                <option value="landscape-m" <?php if ($this->_tpl_vars['formData']['fsection'] == 'landscape-m'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['subphotoSectionMonoLandscape']; ?>
</option>
                                <option value="sport-m" <?php if ($this->_tpl_vars['formData']['fsection'] == 'sport-m'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['subphotoSectionMonoSport']; ?>
</option>
                                <option value="idea-m" <?php if ($this->_tpl_vars['formData']['fsection'] == 'idea-m'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['subphotoSectionMonoIdea']; ?>
</option>
                                </optgroup>
                                <optgroup label="<?php echo $this->_tpl_vars['lang']['global']['photoSectionNature']; ?>
">
                                <option value="nature-n" <?php if ($this->_tpl_vars['formData']['fsection'] == 'nature-n'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['photoSectionNature']; ?>
</option>
                                <option value="bird-n" <?php if ($this->_tpl_vars['formData']['fsection'] == 'bird-n'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['subphotoSectionNatureBird']; ?>
</option>
                                <option value="snow-n" <?php if ($this->_tpl_vars['formData']['fsection'] == 'snow-n'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['subphotoSectionNatureSnow']; ?>
 </option>
                                <option value="flower-n" <?php if ($this->_tpl_vars['formData']['fsection'] == 'flower-n'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['subphotoSectionNatureFlower']; ?>
 </option>
                                </optgroup>
                                <optgroup label="<?php echo $this->_tpl_vars['lang']['global']['photoSectionTravel']; ?>
">
                                <option value="travel-t" <?php if ($this->_tpl_vars['formData']['fsection'] == 'travel-t'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['subphotoSectionTravel']; ?>
</option>
                                <option value="transportation-t" <?php if ($this->_tpl_vars['formData']['fsection'] == 'transportation-t'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['subphotoSectionTravelTransportation']; ?>
</option>
                                <option value="dress-t" <?php if ($this->_tpl_vars['formData']['fsection'] == 'dress-t'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['subphotoSectionTravelDress']; ?>
</option>
                                <option value="country-t" <?php if ($this->_tpl_vars['formData']['fsection'] == 'country-t'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['global']['subphotoSectionTravelCountry']; ?>
</option>
                                </optgroup>
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
    	<?php if ($this->_tpl_vars['formData']['fsection'] == 'color'): ?>
            <?php echo $this->_tpl_vars['lang']['global']['photoSectionColor']; ?>

        <?php elseif ($this->_tpl_vars['formData']['fsection'] == 'mono'): ?>
            <?php echo $this->_tpl_vars['lang']['global']['photoSectionMono']; ?>

        <?php elseif ($this->_tpl_vars['formData']['fsection'] == 'color-c'): ?>
            <?php echo $this->_tpl_vars['lang']['global']['photoSectionColorBest']; ?>
       
        <?php elseif ($this->_tpl_vars['formData']['fsection'] == 'travel-t'): ?>
            <?php echo $this->_tpl_vars['lang']['global']['photoSectionTravelBest']; ?>

        <?php elseif ($this->_tpl_vars['formData']['fsection'] == 'transportation-t'): ?>
            <?php echo $this->_tpl_vars['lang']['global']['subphotoSectionTravelTransportation']; ?>

        <?php elseif ($this->_tpl_vars['formData']['fsection'] == 'country-t'): ?>
            <?php echo $this->_tpl_vars['lang']['global']['subphotoSectionTravelCountry']; ?>

        <?php elseif ($this->_tpl_vars['formData']['fsection'] == 'snow-n'): ?>
            <?php echo $this->_tpl_vars['lang']['global']['subphotoSectionNatureSnow']; ?>

        <?php elseif ($this->_tpl_vars['formData']['fsection'] == 'dress-t'): ?>
            <?php echo $this->_tpl_vars['lang']['global']['subphotoSectionTravelDress']; ?>

        <?php elseif ($this->_tpl_vars['formData']['fsection'] == 'mono-m'): ?>
            <?php echo $this->_tpl_vars['lang']['global']['photoSectionMonoBest']; ?>

        <?php elseif ($this->_tpl_vars['formData']['fsection'] == 'sport-m'): ?>
            <?php echo $this->_tpl_vars['lang']['global']['subphotoSectionMonoSport']; ?>

        <?php elseif ($this->_tpl_vars['formData']['fsection'] == 'idea-m'): ?>
            <?php echo $this->_tpl_vars['lang']['global']['subphotoSectionMonoIdea']; ?>

        <?php elseif ($this->_tpl_vars['formData']['fsection'] == 'nature-n'): ?>
            <?php echo $this->_tpl_vars['lang']['global']['photoSectionNature']; ?>

        <?php elseif ($this->_tpl_vars['formData']['fsection'] == 'landscape-m'): ?>
            <?php echo $this->_tpl_vars['lang']['global']['subphotoSectionMonoLandscape']; ?>

        <?php elseif ($this->_tpl_vars['formData']['fsection'] == 'landscape-c'): ?>
            <?php echo $this->_tpl_vars['lang']['global']['subphotoSectionColorLandscape']; ?>

        <?php elseif ($this->_tpl_vars['formData']['fsection'] == 'bird-n'): ?>
            <?php echo $this->_tpl_vars['lang']['global']['subphotoSectionNatureBird']; ?>

        <?php elseif ($this->_tpl_vars['formData']['fsection'] == 'flower-n'): ?>
            <?php echo $this->_tpl_vars['lang']['global']['subphotoSectionNatureFlower']; ?>

        <?php else: ?>
            <?php echo $this->_tpl_vars['lang']['global']['photoSectionNature']; ?>

        <?php endif; ?>	
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

