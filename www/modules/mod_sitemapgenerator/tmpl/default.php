<style>
.moduletable loc a
{
padding-left:30px!important;
}
.moduletable ul li loc a
{
padding-left:30px!important;
}
.moduletable ul
{
float:left;
width:24%;
margin:0px;
padding:5px 0px;
font-size:16px;
color:#999999;
}
.moduletable ul li
{
padding:0px;
list-style:square;
font-size:12px;
width:90%;
background:none;
}
div.ja-innerpad
{
padding-left:30px!important;
}
h2
{
background:none repeat scroll 0 0 transparent;
color:#454545;
display:block;
font-size:26px;
font-weight:normal;
margin:0;
padding:0;
text-transform:uppercase;
color:#FFFFFF;
display:block;
font-family:Cambria,"Times New Roman",Times,serif;
margin:0;
padding:1px 10px;
text-transform:uppercase;
margin:10px 0px;
}
</style>
<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$articleid = $params->get( 'articleid' );
$crawl = $params->get( 'crawl' );
$priority = $params->get( 'priority' );
$sef = $params->get( 'sef' );
$domain_name = $params->get( 'domain_name' );
$google = $params->get( 'google' );


ini_set( "display_errors", 0);
session_start();
$_SESSION['crawl']=$crawl;
$_SESSION['priority']=$priority;
$_SESSION['sef']=0;
$_SESSION['articleid']=$articleid;
$_SESSION['sef']=0;
$_SESSION['domain_name']=$domain_name;
#
// Indicate file type : XML document
#

#

#
// MySQL query to get articles of the blog
#

$requete = "SELECT DISTINCT title,id,modified,alias,catid FROM jos_content WHERE id NOT IN ($articleid) AND state='1' GROUP BY(title)";
#
$resultat = mysql_query($requete);
#

$requete2 = "SELECT link,id,checked_out_time,name FROM jos_menu WHERE published='1'";
$resultat2 = mysql_query($requete2);
#

$requete3 = "SELECT link,id,checked_out_time,name FROM jos_menu WHERE published='1'";
$resultat3 = mysql_query($requete3);
// Writing of the XML file
#
// Headers :
#
$sm1 = '';
$sm2 = '';
#
#
#

?>



<?php
$query="SELECT DISTINCT id,title FROM jos_categories WHERE published='1' GROUP BY(title)";

$query2 = mysql_query($query);

while($data= mysql_fetch_array($query2))
{
$id=$data['id'];
$cattitle=$data['title'];
$sm1 .='<ul>'.$cattitle.'';
$requete = "SELECT DISTINCT title,id,modified,alias,catid FROM jos_content WHERE state='1' AND catid='$id' GROUP BY(title)";
$query=mysql_query($requete);
while ($blog=mysql_fetch_array($query))
{
$sm1 .= '<li> <a href="'.$_SESSION['domain_name'].'index.php?option=com_content&amp;view=article&amp;id='.$blog['id'].'" >'.$blog['title'].'</a> </li>';
}
$sm1 .='</ul>';

}

#

#


$sm1 .='<ul>';
while ($blog=mysql_fetch_array($resultat2,MYSQL_ASSOC)) {
#



#
$sm1 .= '<li> <a href="'.$_SESSION['domain_name'].''.str_replace("&","&amp;",$blog['link']).'&amp;Itemid='.$blog['id'].'">'.$blog['name'].'</a></li>'; // you may adapt the URL syntax to your need, this is an example
#
}
#
#

$sm1 .='</ul>';
$sm1 .= '';
#
echo $sm1;
?>

<?php

#
$sm .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

#
// Articles of the blog
#
$sm .= '<url>';
#
$sm .= '<loc>'.$_SESSION['domain_name'].'</loc>'; // you may adapt the URL syntax to your need, this is an example
#
#
$sm .= '<changefreq>'.$_SESSION['crawl'].'</changefreq>';
#
$sm1 .= '<priority>'.$_SESSION['priority'].'</priority>';
#
$sm .= '</url>';
while ($blog=mysql_fetch_array($resultat3,MYSQL_ASSOC)) {
#
$sm .= '<url>';
#
$sm .= '<loc>'.$_SESSION['domain_name'].''.str_replace("&","&amp;",$blog['link']).'&amp;Itemid='.$blog['id'].'</loc>'; // you may adapt the URL syntax to your need, this is an example
#
$checked_out_time = (explode(" ",$blog['checked_out_time']));
if($checked_out_time[0] == "0000-00-00")
{
$sm .= '<changefreq>'.$_SESSION['crawl'].'</changefreq>';
#
$sm .= '<priority>'.$_SESSION['priority'].'</priority>';
#
$sm .= '</url>';
}
else
{
$sm .= '<lastmod>'.$checked_out_time[0].'</lastmod>';
#
$sm .= '<changefreq>'.$_SESSION['crawl'].'</changefreq>';
#
$sm .= '<priority>'.$_SESSION['priority'].'</priority>';
#
$sm .= '</url>';
}
#
}
$blog =0;
while ($blog=mysql_fetch_array($resultat)) {
#
if($_SESSION['sef']==0)
{

$sm .= '<url>';
#
$sm .= '<loc>'.$_SESSION['domain_name'].'index.php?option=com_content&amp;view=article&amp;id='.$blog['id'].'</loc>'; // you may adapt the URL syntax to your need, this is an example
#
#
$modified = (explode(" ",$blog['modified']));
if($modified[0] == "0000-00-00")
{
#
$sm .= '<changefreq>'.$_SESSION['crawl'].'</changefreq>';
#
$sm .= '<priority>'.$_SESSION['priority'].'</priority>';
#
$sm .= '</url>';

}
else
{
$sm .= '<lastmod>'.$modified[0].'</lastmod>';
#
$sm .= '<changefreq>'.$_SESSION['crawl'].'</changefreq>';
#
$sm .= '<priority>'.$_SESSION['priority'].'</priority>';
#
$sm .= '</url>';
}
}
else
{


$catid=$blog['catid'];

$query="SELECT alias,title FROM jos_categories WHERE id='$catid'";

$query2 = mysql_query($query);

while($data= mysql_fetch_array($query2))
{
$catalias=$data['alias'];
$cattitle=$data['title'];
}
$cattitle = str_replace(" ","-",$cattitle);
$cattitle = str_replace("&","&amp;",$cattitle);
$sm .= '<url>';
#
$sm .= '<loc>'.$_SESSION['domain_name'].''.$cattitle.'/'.$blog['alias'].'</loc>'; // you may adapt the URL syntax to your need, this is an example
#
$modified = (explode(" ",$blog['modified']));
if($modified[0] == "0000-00-00")
{
#
$sm .= '<changefreq>'.$_SESSION['crawl'].'</changefreq>';
#
$sm .= '<priority>'.$_SESSION['priority'].'</priority>';
#
$sm .= '</url>';

}
else
{
$sm .= '<lastmod>'.$modified[0].'</lastmod>';
#
$sm .= '<changefreq>'.$_SESSION['crawl'].'</changefreq>';
#
$sm .= '<priority>'.$_SESSION['priority'].'</priority>';
#
$sm .= '</url>';
}

}
#
}
#

#
$sm .= '';
#

#




#

#
$sm .= '';

#

#

//echo $sm;
$myFile = "sitemap.xml";
$fh = fopen($myFile, 'w') or die("can't open file");


fwrite($fh, $sm);
$stringData = "</urlset>";
fwrite($fh, $stringData);

fclose($fh);

?>
</urlset>