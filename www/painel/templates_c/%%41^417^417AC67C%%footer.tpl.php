<?php /* Smarty version 2.6.26, created on 2011-01-20 20:33:17
         compiled from portal/footer.tpl */ ?>
<?php if ($this->_tpl_vars['langchange']): ?><div align="right"><?php echo $this->_tpl_vars['setlanguage']; ?>
</div><br /><?php endif; ?>
  </div>
  <div id="side_menu">
    <p class="header"><?php echo $this->_tpl_vars['LANG']['quicknav']; ?>
</p>
    <ul>
      <li><a href="index.php"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/support.gif" alt="<?php echo $this->_tpl_vars['LANG']['globalsystemname']; ?>
" width="16" height="16" border="0" class="absmiddle" /></a> <a href="index.php" title="<?php echo $this->_tpl_vars['LANG']['globalsystemname']; ?>
"><?php echo $this->_tpl_vars['LANG']['globalsystemname']; ?>
</a></li>
      <li><a href="clientarea.php"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/clientarea.gif" alt="<?php echo $this->_tpl_vars['LANG']['clientareatitle']; ?>
" width="16" height="16" border="0" class="absmiddle" /></a> <a href="clientarea.php" title="<?php echo $this->_tpl_vars['LANG']['clientareatitle']; ?>
"><?php echo $this->_tpl_vars['LANG']['clientareatitle']; ?>
</a></li>
      <li><a href="announcements.php" title="<?php echo $this->_tpl_vars['LANG']['announcementstitle']; ?>
"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/announcement.gif" alt="<?php echo $this->_tpl_vars['LANG']['announcementstitle']; ?>
" width="16" height="16" border="0" class="absmiddle" /></a> <a href="announcements.php" title="<?php echo $this->_tpl_vars['LANG']['announcementstitle']; ?>
"><?php echo $this->_tpl_vars['LANG']['announcementstitle']; ?>
</a></li>
      <li><a href="knowledgebase.php" title="<?php echo $this->_tpl_vars['LANG']['knowledgebasetitle']; ?>
"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/knowledgebase.gif" alt="<?php echo $this->_tpl_vars['LANG']['knowledgebasetitle']; ?>
" width="16" height="16" border="0" class="absmiddle" /></a> <a href="knowledgebase.php" title="<?php echo $this->_tpl_vars['LANG']['knowledgebasetitle']; ?>
"><?php echo $this->_tpl_vars['LANG']['knowledgebasetitle']; ?>
</a></li>
      <li><a href="submitticket.php" title="<?php echo $this->_tpl_vars['LANG']['supportticketssubmitticket']; ?>
"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/submit-ticket.gif" alt="<?php echo $this->_tpl_vars['LANG']['supportticketssubmitticket']; ?>
" width="16" height="16" border="0" class="absmiddle" /></a> <a href="submitticket.php" title="<?php echo $this->_tpl_vars['LANG']['supportticketspagetitle']; ?>
"><?php echo $this->_tpl_vars['LANG']['supportticketssubmitticket']; ?>
</a></li>
      <li><a href="downloads.php" title="<?php echo $this->_tpl_vars['LANG']['downloadstitle']; ?>
"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/downloads.gif" alt="<?php echo $this->_tpl_vars['LANG']['downloadstitle']; ?>
" width="16" height="16" border="0" class="absmiddle" /></a> <a href="downloads.php" title="<?php echo $this->_tpl_vars['LANG']['downloadstitle']; ?>
"><?php echo $this->_tpl_vars['LANG']['downloadstitle']; ?>
</a></li>
      <li><a href="cart.php" title="<?php echo $this->_tpl_vars['LANG']['ordertitle']; ?>
"><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/order.gif" alt="<?php echo $this->_tpl_vars['LANG']['ordertitle']; ?>
" width="16" height="16" border="0" class="absmiddle" /></a> <a href="cart.php" title="<?php echo $this->_tpl_vars['LANG']['ordertitle']; ?>
"><?php echo $this->_tpl_vars['LANG']['ordertitle']; ?>
</a></li>
    </ul>
<?php if ($this->_tpl_vars['livehelp']): ?>
<p class="header"><?php echo $this->_tpl_vars['LANG']['chatlivehelp']; ?>
</p>
<?php echo $this->_tpl_vars['livehelp']; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['loggedin']): ?>
    <p class="header"><?php echo $this->_tpl_vars['LANG']['accountinfo']; ?>
</p>
<p><strong><?php echo $this->_tpl_vars['clientsdetails']['firstname']; ?>
 <?php echo $this->_tpl_vars['clientsdetails']['lastname']; ?>
 <?php if ($this->_tpl_vars['clientsdetails']['companyname']): ?>(<?php echo $this->_tpl_vars['clientsdetails']['companyname']; ?>
)<?php endif; ?></strong><br />
<?php echo $this->_tpl_vars['clientsdetails']['address1']; ?>
, <?php echo $this->_tpl_vars['clientsdetails']['address2']; ?>
<br />
<?php echo $this->_tpl_vars['clientsdetails']['city']; ?>
, <?php echo $this->_tpl_vars['clientsdetails']['state']; ?>
, <?php echo $this->_tpl_vars['clientsdetails']['postcode']; ?>
<br />
<?php echo $this->_tpl_vars['clientsdetails']['countryname']; ?>
<br />
<?php echo $this->_tpl_vars['clientsdetails']['email']; ?>
<br /><br />
<?php if ($this->_tpl_vars['addfundsenabled']): ?><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/money.gif" alt="Add Funds" width="22" height="22" border="0" class="absmiddle" /> <a href="clientarea.php?action=addfunds"><?php echo $this->_tpl_vars['LANG']['addfunds']; ?>
</a><?php endif; ?></p>
    <p class="header"><?php echo $this->_tpl_vars['LANG']['accountstats']; ?>
</p>
    <p><?php echo $this->_tpl_vars['LANG']['statsnumproducts']; ?>
: <strong><?php echo $this->_tpl_vars['clientsstats']['productsnumactive']; ?>
</strong> (<?php echo $this->_tpl_vars['clientsstats']['productsnumtotal']; ?>
)<br />
<?php echo $this->_tpl_vars['LANG']['statsnumdomains']; ?>
: <strong><?php echo $this->_tpl_vars['clientsstats']['numactivedomains']; ?>
</strong> (<?php echo $this->_tpl_vars['clientsstats']['numdomains']; ?>
)<br />
<?php echo $this->_tpl_vars['LANG']['statsnumtickets']; ?>
: <strong><?php echo $this->_tpl_vars['clientsstats']['numtickets']; ?>
</strong><br />
<?php echo $this->_tpl_vars['LANG']['statsnumreferredsignups']; ?>
: <strong><?php echo $this->_tpl_vars['clientsstats']['numaffiliatesignups']; ?>
</strong><br />
<?php echo $this->_tpl_vars['LANG']['statscreditbalance']; ?>
: <strong><?php echo $this->_tpl_vars['clientsstats']['creditbalance']; ?>
</strong><br />
<?php echo $this->_tpl_vars['LANG']['statsdueinvoicesbalance']; ?>
: <strong><?php if ($this->_tpl_vars['clientsstats']['numdueinvoices'] > 0): ?><span class="red"><?php endif; ?><?php echo $this->_tpl_vars['clientsstats']['dueinvoicesbalance']; ?>
<?php if ($this->_tpl_vars['clientsstats']['numdueinvoices'] > 0): ?></span><?php endif; ?></strong></p>
<?php else: ?>
<form method="post" action="<?php echo $this->_tpl_vars['systemsslurl']; ?>
dologin.php">
  <p class="header"><?php echo $this->_tpl_vars['LANG']['clientlogin']; ?>
</p>
  <p><strong><?php echo $this->_tpl_vars['LANG']['email']; ?>
</strong><br />
    <input name="username" type="text" size="25" />
  </p>
  <p><strong><?php echo $this->_tpl_vars['LANG']['loginpassword']; ?>
</strong><br />
    <input name="password" type="password" size="25" />
  </p>
  <p>
    <input type="checkbox" name="rememberme" />
    <?php echo $this->_tpl_vars['LANG']['loginrememberme']; ?>
</p>
  <p>
    <input type="submit" class="submitbutton" value="<?php echo $this->_tpl_vars['LANG']['loginbutton']; ?>
" />
  </p>
</form>
  <p class="header"><?php echo $this->_tpl_vars['LANG']['knowledgebasesearch']; ?>
</p>
<form method="post" action="knowledgebase.php?action=search">
  <p>
    <input name="search" type="text" size="25" /><br />
    <select name="searchin">
      <option value="Knowledgebase"><?php echo $this->_tpl_vars['LANG']['knowledgebasetitle']; ?>
</option>
      <option value="Downloads"><?php echo $this->_tpl_vars['LANG']['downloadstitle']; ?>
</option>
    </select>
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['go']; ?>
" />
  </p>
</form>
<?php endif; ?>
<?php if ($this->_tpl_vars['twitterusername']): ?><br />
<p align="center"><a href="http://twitter.com/<?php echo $this->_tpl_vars['twitterusername']; ?>
" target="_blank"><img src="images/twitterfollow.png" width="150" border="0" alt="<?php echo $this->_tpl_vars['LANG']['twitterfollow']; ?>
" /></a></p>
<?php endif; ?>
  </div>
  <div class="clear"></div>
</div>
</body>
</html>