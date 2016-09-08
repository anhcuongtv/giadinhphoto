<?php /* Smarty version 2.6.26, created on 2013-01-19 12:25:31
         compiled from _controller/admin/round/exportcsv_output.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'codau2khongdau', '_controller/admin/round/exportcsv_output.tpl', 4, false),array('modifier', 'replace', '_controller/admin/round/exportcsv_output.tpl', 4, false),array('modifier', 'count', '_controller/admin/round/exportcsv_output.tpl', 4, false),)), $this); ?>
ID, Photo Name, Section, File Path, Username, Full Name, Address, City, ZipCode, Country, Round, Total Score, Finish, Score Detail
<?php $_from = $this->_tpl_vars['roundPhotos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['roundphoto']):
?>
<?php $this->assign('countrycode', $this->_tpl_vars['roundphoto']->poster->country); ?>
<?php echo $this->_tpl_vars['roundphoto']->photo->id; ?>
,<?php echo ((is_array($_tmp=$this->_tpl_vars['roundphoto']->photo->name)) ? $this->_run_mod_handler('codau2khongdau', true, $_tmp) : smarty_modifier_codau2khongdau($_tmp)); ?>
,<?php echo $this->_tpl_vars['roundphoto']->photo->section; ?>
,<?php echo $this->_tpl_vars['roundphoto']->photo->filepath; ?>
,<?php echo $this->_tpl_vars['roundphoto']->poster->username; ?>
,<?php echo ((is_array($_tmp=$this->_tpl_vars['roundphoto']->poster->fullname)) ? $this->_run_mod_handler('codau2khongdau', true, $_tmp) : smarty_modifier_codau2khongdau($_tmp)); ?>
, <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['roundphoto']->poster->address)) ? $this->_run_mod_handler('codau2khongdau', true, $_tmp) : smarty_modifier_codau2khongdau($_tmp)))) ? $this->_run_mod_handler('replace', true, $_tmp, ',', ' ') : smarty_modifier_replace($_tmp, ',', ' ')); ?>
, <?php echo $this->_tpl_vars['roundphoto']->poster->city; ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['roundphoto']->poster->zipcode)) ? $this->_run_mod_handler('codau2khongdau', true, $_tmp) : smarty_modifier_codau2khongdau($_tmp)); ?>
, <?php echo $this->_tpl_vars['setting']['country'][$this->_tpl_vars['countrycode']]; ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['myRound']->name)) ? $this->_run_mod_handler('codau2khongdau', true, $_tmp) : smarty_modifier_codau2khongdau($_tmp)); ?>
, <?php echo $this->_tpl_vars['roundphoto']->totalScore; ?>
, <?php if ($this->_tpl_vars['roundphoto']->isfinished == 1): ?>YES<?php else: ?>NO<?php endif; ?>, <?php $_from = $this->_tpl_vars['roundphoto']->photoPointList; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['photopointlist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['photopointlist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['photopoint']):
        $this->_foreach['photopointlist']['iteration']++;
?><?php echo $this->_tpl_vars['photopoint']->judger->user->username; ?>
(<?php echo $this->_tpl_vars['photopoint']->point; ?>
)<?php if (! ($this->_foreach['photopointlist']['iteration'] == $this->_foreach['photopointlist']['total']) && count($this->_tpl_vars['roundphoto']->photoPointList) > 1): ?> | <?php endif; ?><?php endforeach; endif; unset($_from); ?>

<?php endforeach; endif; unset($_from); ?>