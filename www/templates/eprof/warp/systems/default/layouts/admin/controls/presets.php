<?php
/**
* @package   Warp Theme Framework
* @file      presets.php
* @version   5.5.0
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2010 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/
	
	// init vars
	$presets = $this->warp->config->get('_presets', array());

?>

<select id="selectPreset" style="width:200px;">
    <option value="-1">Please choose a preset...</option>
    <?php foreach($presets as $key => $preset): ?>
        <option value="<?php echo $key;?>"><?php echo $preset['name'];?></option>
    <?php endforeach; ?>
</select>

<script type="text/javascript">
        
        window.YOOpresets = <?php echo json_encode($presets);?>;
        
        window.fnSelectPresetMootools = function(select){
        
            if (select.value == -1) return;

            var preset = YOOpresets[select.value];
            var elements = document.getElement("form[name=adminForm]").getElements('[name^=params]');
            
            for(var i=0;i<elements.length;i++){
                var node = elements[i];
                var $name = node.name.replace("params[",'').replace("]",'');

                if(preset.options[$name] || preset.options[$name]===0){
                    if(node.type=='radio') {
                        if(node.value==preset.options[$name]) node.setProperty('checked',true);
                    } else {
                        node.value = preset.options[$name];
                    }
                }

            }

            //select.selectedIndex = 0;
        };
        
        window.fnSelectPresetjQuery = function(select){
        
            if(select.value == -1) return;
            
            var preset = YOOpresets[select.value];
            var elements = jQuery("form[name=adminForm]:first").find('[name^=yoo_]');
            
            for(var i=0;i<elements.length;i++){
                var node = elements[i];
                var $name = node.name.replace('yoo_','');
                
                if(preset.options[$name] || preset.options[$name]===0){
                    if(node.type=='radio') {
                        if(node.value==preset.options[$name]) jQuery(node).attr('checked',true);
                    } else {
                        jQuery(node).val(preset.options[$name]);
                    }
                }
  
            }
            //select.selectedIndex = 0;
        };
        
        if (typeof MooTools !== 'undefined') {
            window.addEvent('domready', function(){
               document.getElement("#selectPreset").addEvent("change", function(){fnSelectPresetMootools(this);});
            });
        } else if (typeof jQuery !== 'undefined') {
            jQuery(function(){
                jQuery("#selectPreset").bind("change", function(){fnSelectPresetjQuery(this);});
            });
        }
       
</script>