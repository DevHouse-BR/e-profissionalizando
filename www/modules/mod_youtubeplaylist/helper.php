<?php
/**
 * Youtubeplaylist Module
 *
 * @version 1.0.0
 * @package Youtubeplaylist
 * @author Nguyen Hoang Viet
 * @copyright Copyright (C) 2008 Luyenkim.net. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');

class modYoutubeplaylistHelper {
   function getContent(&$params, $mid = '') {
      global $mainframe;

      $vid = trim($params->get('vid',''));
      $vpid = trim($params->get('vpid',''));
      
      $width = $params->get('width','425');
      $height = $params->get('height','355');
      $width3 = $params->get('imagewidth','50');
      $numimage3 = $params->get('numimage','4');
      $height3 = floor($width3*3/4);      
      $allowfullscreen = $params->get('allowfullscreen','0');
      $randomplay = intval($params->get('randomplay','0'));
      $otherparams = $params->get('otherparams','');
      $autoplay = $params->get('autoplay',0);
      $color1 = ltrim($params->get('color1'),'#');
      $color2 = ltrim($params->get('color2'),'#');
      $related = $params->get('related',1);
      $border = $params->get('border',0);
      $class = $params->get('class',false);
      $id = $params->get('id',false);
          
      $playlist = intval(trim($params->get('playlist','0'))); //0:video 1:Playlist
      
      if($playlist) {if(!$vpid) return JText::_('Video playlist ID missing!');}
      else {if(!$vid) return JText::_('Video ID missing!');}
      
      
      if($playlist) $videolist =  $vpid; else $videolist =  $vid; 
      $videolist = preg_split('/[\n,]|<br \/>/', $videolist);
      //Get video list
      $videos = $titles = array();
      for ($i = 0; $i < count($videolist); $i ++) {
        $temp = explode(':',$videolist[$i],2);
        if(isset($temp[0])){
         $videos[]=$temp[0];
         $titles[]= $temp[1]? $temp[1]:'Click to play';
         }
      }
      $playnow_id = $videos[0];
      if($randomplay) $playnow_id = $videos[rand(0,count($videos)-1)];
      

      if($playlist) $url = 'http://www.youtube.com/p/'; 
      else $url = 'http://www.youtube.com/v/';
      
      $params_suffix = '?feature=player_embedded';
      if($allowfullscreen) {$params_suffix .= '&fs=1'; $allowfullscreen = 'true';} 
         else $allowfullscreen = 'false';
      if($autoplay) $params_suffix .= '&autoplay=1';
      if($color1) $params_suffix .= '&color1=0x' . $color1;
      if($color1) $params_suffix .= '&color2=0x' . $color2;
      if($border) $params_suffix .= '&border=1';
      if($related)$params_suffix .= '&rel='.$related;
      if($otherparams) $params_suffix .= '&'.$otherparams;
      
      $count = count($videos)-1;
      $playid_list ='<strong>'.JText::_('PLAYLIST').'</strong> ';
      if($count>0)  {
      for ($i = 0; $i <= $count; $i ++) {
         $playid_list .='<a href="javascript:void(0)" onclick="loadSWF(\''.$url.$videos[$i].'?feature=player_embedded&autoplay=1&fs=1\',\''.$mid.'\'); return false;" title="'.$titles[$i].'">'.$i.'</a> ';
         if($i < $count) $playid_list .='| ';
      }
      

	$playid_list2 ='<form name="theForm"> 
	<select name="selectedURL" onchange="loadSWF(this.value,\''.$mid.'\');">
	<option value="">'.JText::_('PLAYLIST_SELECTION').'</option>'; 
      for ($i = 0; $i <= $count; $i ++) {
         $playid_list2 .="\n".
	 '<option value="'.$url.$videos[$i].'?feature=player_embedded&autoplay=1&fs=1\'.">'.$titles[$i].'</option> ';
      }
         $playid_list2 .="\n".'</select>';
         $playid_list2 .="\n".'</form>'."\n";      
      }

      $count = count($videos)-1;
      if($numimage3==0) $numimage3 =  $count + 1;
      $playid_list3 ='<div class="mod_youtubeplaylist">';
      $url3 = 'http://img.youtube.com/vi/';
      for ($i = 0; $i <= $count; $i ++) {
         $playid_list3 .='<a href="javascript:void(0)" onclick="loadSWF(\''.$url.$videos[$i].'?feature=player_embedded&autoplay=1&fs=1\',\''.$mid.'\'); return false;" title="'.$titles[$i].'"><img width="'.$width3.'" height="'.$height3.'" src="'.$url3.$videos[$i].'/default.jpg" /></a>';
	 $k = $i + 1;
	if(($k % $numimage3) == 0) $playid_list3 .='<br />'; 
	}
	$playid_list3 .='</div>';
	 
      $html = "\n".'<div id="'.$mid.'-youtubevideo">
      You need Flash player 6+ and JavaScript enabled to view this video.
      </div>';
      $html .= "\n".
      '<script type="text/javascript">
      loadSWF(\''.$url.$playnow_id.$params_suffix.'\',\''.$mid.'\');'."\n".'</script>'."\n";
   
/*****************************************************/
      $spec_params = $spec_attr = array();
      if($class) $spec_attr[] = 'class:"'.$class.'"';
      if($id) $spec_attr []= 'id:"'.$id.'"';
      if($allowfullscreen) $spec_params []= 'allowfullscreen:"true"';
      $spec_params []='wmode:"transparent"';
      $spec_params = implode(',',$spec_params);
      $spec_attr = implode(',',$spec_attr);
/***************Load swfObject************************/
//ref: http://code.google.com/p/swfobject/wiki/documentation
      
      if(!$mainframe->get('loadswfobject')) { //Load only one time
         $d = &JFactory::getDocument();
             $d->addScript(JURI::root(true).'/modules/mod_youtubeplaylist/js/swfobject.js'); //Ok done
             $d->addStyleSheet( JURI::root(true).'/modules/mod_youtubeplaylist/css/style.css' );
         $myscript = "\n".'function loadSWF(url, id){
         if (url !="") {
		 var flashvars = {};
	         var params = {'.$spec_params.'};
	         var attributes = {'.$spec_attr.'};  
	           swfobject.embedSWF(url, id+"-youtubevideo", "'.$width.'", "'.$height.'", "6", false, flashvars, params, attributes);
	         }
	 }';
         $d->addScriptDeclaration($myscript);
         $mainframe->set( 'loadswfobject', true ); 
         }
/***************Load swfObject************************/
      if($params->get('style')=='1') { $playid_list =  $playid_list2;}
      if($params->get('style')=='2') { $playid_list =  $playid_list3;}
      
	if($params->get('position')=='1') $html = $html .'<br />'. $playid_list;
	else $html = $playid_list .'<br />'. $html;

      
      return $html;
   }
}
?>