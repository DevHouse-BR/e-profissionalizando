<?php /* Smarty version 2.6.26, created on 2011-01-20 20:33:17
         compiled from portal/header.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?php echo $this->_tpl_vars['charset']; ?>
" />
<title><?php echo $this->_tpl_vars['companyname']; ?>
 - <?php echo $this->_tpl_vars['pagetitle']; ?>
<?php if ($this->_tpl_vars['kbarticle']['title']): ?> - <?php echo $this->_tpl_vars['kbarticle']['title']; ?>
<?php endif; ?></title>
<?php if ($this->_tpl_vars['systemurl']): ?><base href="<?php echo $this->_tpl_vars['systemurl']; ?>
" />
<?php endif; ?><link rel="stylesheet" type="text/css" href="templates/<?php echo $this->_tpl_vars['template']; ?>
/style.css" />
<script type="text/javascript" src="includes/jscript/jquery.js"></script>
<?php if ($this->_tpl_vars['livehelpjs']): ?><?php echo $this->_tpl_vars['livehelpjs']; ?>

<?php endif; ?></head>
<body>
<div id="top_container">
  <div id="top">
    <div id="company_title"><?php echo $this->_tpl_vars['companyname']; ?>
</div>
    <div id="welcome_box"><?php if ($this->_tpl_vars['loggedin']): ?><?php echo $this->_tpl_vars['LANG']['welcomeback']; ?>
, <strong><?php echo $this->_tpl_vars['loggedinuser']['firstname']; ?>
</strong>&nbsp;&nbsp;&nbsp;<img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/details.gif" alt="<?php echo $this->_tpl_vars['LANG']['clientareanavdetails']; ?>
" width="16" height="16" border="0" class="absmiddle" /> <a href="clientarea.php?action=details" title="<?php echo $this->_tpl_vars['LANG']['clientareanavdetails']; ?>
"><strong><?php echo $this->_tpl_vars['LANG']['clientareanavdetails']; ?>
</strong></a>&nbsp;&nbsp;&nbsp;<img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/logout.gif" alt="<?php echo $this->_tpl_vars['LANG']['logouttitle']; ?>
" width="16" height="16" border="0" class="absmiddle" /> <a href="logout.php" title="Logout"><strong><?php echo $this->_tpl_vars['LANG']['logouttitle']; ?>
</strong></a><?php else: ?><?php echo $this->_tpl_vars['LANG']['please']; ?>
 <a href="clientarea.php" title="<?php echo $this->_tpl_vars['LANG']['loginbutton']; ?>
"><strong><?php echo $this->_tpl_vars['LANG']['loginbutton']; ?>
</strong></a> <?php echo $this->_tpl_vars['LANG']['or']; ?>
 <a href="register.php" title="<?php echo $this->_tpl_vars['LANG']['clientregistertitle']; ?>
"><strong><?php echo $this->_tpl_vars['LANG']['clientregistertitle']; ?>
</strong></a><?php endif; ?></div>
  </div>
</div>
<div id="content_container">
<?php if ($this->_tpl_vars['loggedin']): ?>
  <div id="top_menu">
    <ul>
      <li><a href="clientarea.php" title="<?php echo $this->_tpl_vars['LANG']['clientareanavhome']; ?>
"><?php echo $this->_tpl_vars['LANG']['clientareanavhome']; ?>
</a></li>
      <li><a href="clientarea.php?action=details" title="<?php echo $this->_tpl_vars['LANG']['clientareanavdetails']; ?>
"><?php echo $this->_tpl_vars['LANG']['clientareanavdetails']; ?>
</a></li>
      <li><a href="clientarea.php?action=products" title="<?php echo $this->_tpl_vars['LANG']['clientareanavservices']; ?>
"><?php echo $this->_tpl_vars['LANG']['clientareanavservices']; ?>
</a></li>
      <li><a href="clientarea.php?action=domains" title="<?php echo $this->_tpl_vars['LANG']['clientareanavdomains']; ?>
"><?php echo $this->_tpl_vars['LANG']['clientareanavdomains']; ?>
</a></li>
      <li><a href="clientarea.php?action=invoices" title="<?php echo $this->_tpl_vars['LANG']['invoices']; ?>
"><?php echo $this->_tpl_vars['LANG']['invoices']; ?>
</a></li>
      <li><a href="supporttickets.php" title="<?php echo $this->_tpl_vars['LANG']['clientareanavsupporttickets']; ?>
"><?php echo $this->_tpl_vars['LANG']['clientareanavsupporttickets']; ?>
</a></li>
      <li><a href="affiliates.php" title="<?php echo $this->_tpl_vars['LANG']['affiliatestitle']; ?>
"><?php echo $this->_tpl_vars['LANG']['affiliatestitle']; ?>
</a></li>
      <li><a href="clientarea.php?action=emails" title="<?php echo $this->_tpl_vars['LANG']['clientareaemails']; ?>
"><?php echo $this->_tpl_vars['LANG']['clientareaemails']; ?>
</a></li>
    </ul>
    <div class="clear"></div>
  </div>
<?php endif; ?>
  <div id="content_left">
    <h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
	<p class="breadcrumb"><?php echo $this->_tpl_vars['breadcrumbnav']; ?>
</p>