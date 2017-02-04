<?php
defined('_JEXEC') or die('Restricted access');
echo nl2br($params->get('before_string')).$html.nl2br($params->get('after_string'));
?>