<?php /* Smarty version 2.6.26, created on 2012-08-10 20:46:18
         compiled from _controller/admin/contestphotoready/exportcsv_output.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'codau2khongdau', '_controller/admin/contestphotoready/exportcsv_output.tpl', 4, false),array('modifier', 'date_format', '_controller/admin/contestphotoready/exportcsv_output.tpl', 4, false),)), $this); ?>
ID, Photo Name, Section, Resolution, File Path, User ID, Username, Full Name, Email, Phone, Address, City, Zipcode, Country, Photo Club, Color, Monochrome, Nature, Date Register
<?php $_from = $this->_tpl_vars['photos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['photo']):
?>
<?php $this->assign('countrycode', $this->_tpl_vars['photo']->poster->country); ?>
<?php echo $this->_tpl_vars['photo']->id; ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['photo']->name)) ? $this->_run_mod_handler('codau2khongdau', true, $_tmp) : smarty_modifier_codau2khongdau($_tmp)); ?>
, <?php echo $this->_tpl_vars['photo']->section; ?>
, <?php echo $this->_tpl_vars['photo']->resolution; ?>
, <?php echo $this->_tpl_vars['photo']->filepath; ?>
, <?php echo $this->_tpl_vars['photo']->poster->id; ?>
, <?php echo $this->_tpl_vars['photo']->poster->username; ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['photo']->poster->fullname)) ? $this->_run_mod_handler('codau2khongdau', true, $_tmp) : smarty_modifier_codau2khongdau($_tmp)); ?>
, <?php echo $this->_tpl_vars['photo']->poster->email; ?>
, <?php echo $this->_tpl_vars['photo']->poster->phone1; ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['photo']->poster->address)) ? $this->_run_mod_handler('codau2khongdau', true, $_tmp) : smarty_modifier_codau2khongdau($_tmp)); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['photo']->poster->city)) ? $this->_run_mod_handler('codau2khongdau', true, $_tmp) : smarty_modifier_codau2khongdau($_tmp)); ?>
,<?php echo $this->_tpl_vars['photo']->poster->zipcode; ?>
,<?php echo $this->_tpl_vars['setting']['country'][$this->_tpl_vars['countrycode']]; ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['photo']->poster->photoclub)) ? $this->_run_mod_handler('codau2khongdau', true, $_tmp) : smarty_modifier_codau2khongdau($_tmp)); ?>
, <?php if ($this->_tpl_vars['photo']->poster->paidColor == 1): ?>YES<?php else: ?>NO<?php endif; ?>, <?php if ($this->_tpl_vars['photo']->poster->paidMono == 1): ?>YES<?php else: ?>NO<?php endif; ?>, <?php if ($this->_tpl_vars['photo']->poster->paidNature == 1): ?>YES<?php else: ?>NO<?php endif; ?>, <?php echo ((is_array($_tmp=$this->_tpl_vars['photo']->poster->datecreated)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>

<?php endforeach; endif; unset($_from); ?>