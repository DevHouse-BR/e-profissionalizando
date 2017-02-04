<?php
/**
* @package   Warp Theme Framework
* @file      xml.php
* @version   5.5.0
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright  2007 - 2010 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

/*
	Class: WarpHelperXml
		Xml helper class, handle xml files
*/
class WarpHelperXml extends WarpHelper {
    
    /*
		Function: load
			Get Xml object from file/string.

		Returns:
			Xml Object
	*/
	function &load($input, $mode='xml'){
		
        switch(strtolower($mode)){
            
            case 'xhtml':
            
            $xmlobj =&  new WarpXHTML($input);
            return $xmlobj;
            
            default:
            $xmlobj =&  new WarpXML($input);
            return $xmlobj;
        
        }
	}	

}

/*
	Class: WarpXML
		XML Parser Class
*/
class WarpXML{
    /*
		Variable: document
			XML root node.
    */
    var $document;
    
    /*
       Function: WarpXML
            Constructor.
       
       Parameters:
            $xmlstring  - xml string
            
       Returns:
            WarpXML
    */
    function WarpXML($xmlstring){
        $classname = get_class( $this ) . 'Element';
        $this->document =& new $classname('document');

        $this->document->parse($xmlstring);
    }

}

/*
	Class: WarpXMLElement
		XML Node Container
*/
class WarpXMLElement{

    /*
		Variable: id
			unique id of this XML element.
    */
	var $id = null;
    
    /*
		Variable: _attributes
			Array with the attributes of this XML element.
    */
	var $_attributes = array();

    /*
		Variable: _name
			The name of the element.
    */
	var $_name = '';

    /*
		Variable: _data
			The data the element contains.
    */
	var $_data = '';

    /*
		Variable: _children
			Array of references to the objects of all direct children of this XML object.
    */
	var $_children = array();

    /*
		Variable: _parent
			Reference to the parent element.
    */
    var $_parent = null;

    /*
       Function: WarpXMLElement
            Constructor, sets up all the default values.
       
       Parameters:
            $name  - node name
            
       Returns:
            WarpXMLElement
    */
	function WarpXMLElement($name, $attrs = array()){
		//Make the keys of the attr array lower case, and store the value
		//$this->_attributes = array_change_key_case($attrs, CASE_LOWER);
		$this->_attributes = is_array($attrs) ? $attrs:array();

		//Make the name lower case and store the value
		$this->_name = strtolower($name);
		$this->id = uniqid(mt_rand());
	}
    
    /*
       Function: parse
            Constructor, sets up all the default values.
       
       Parameters:
            $xmlstring  - xml string
            
       Returns:
            void
    */
    function parse($xmlstring){

            $classname = get_class( $this );
            
            if(!function_exists('xml_parser_create')) { 
                //print "'xml_parser_create()' function not found!"; 
            } 
            //Get the XML parser of PHP - PHP must have this module for the parser to work 
            $parser = xml_parser_create(''); 
            xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8"); # http://minutillo.com/steve/weblog/2004/6/17/php-xml-and-character-encodings-a-tale-of-sadness-rage-and-data-loss 
            xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0); 
            xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1); 
            xml_parse_into_struct($parser, trim($xmlstring), $xml); 
            xml_parser_free($parser); 

            if(!$xml) return;//Hmm...

            $current =& $this;
            $currentLevel = 1;
            
            foreach($xml as $i => $node){
                
                if($node['type']=='close') continue;

                $element =& new $classname($node['tag'], (isset($node['attributes']) ? $node['attributes']:array()));
                
                if(isset($node['value'])){
                    $element->_data = $node['value'];
                }
                
                if($node['level'] > $currentLevel){
                    $current =& $current->_children[count($current->_children)-1];
                }
                
                if($node['level'] < $currentLevel){
                    while($node['level'] < $currentLevel){
                        $current =& $current->_parent;
                        $currentLevel = $currentLevel-1;
                    }
                }
                
                $element->_parent =& $current;
                $current->_children[] =& $element;
                
                $currentLevel = $node['level'];
            }
    }

    /*
		Function: name
			Get the name of the element.

		Returns:
			String
	*/
	function name() {
		return $this->_name;
	}


    /*
       Function: attributes
            Get the an attribute of the element.
       
       Parameters:
            $attribute  - attribute name
            
       Returns:
            Mixed
    */
	function attributes($attribute = null)
	{
		if(!isset($attribute)) {
			return $this->_attributes;
		}
		return isset($this->_attributes[$attribute]) ? $this->_attributes[$attribute] : null;
	}

    /*
		Function: data
			Get the data of the element.

		Returns:
			String
	*/
	function data() {
		return $this->_data;
	}

    /*
       Function: setData	
            Set the data of the element.
       
       Parameters:
            $data - data content
       
       Returns:
            void
    */
	function setData($data) {
		$this->_data = $data;
        return $this;
	}
    
    /*
		Function: createElement
			Create a child element.

		Returns:
			Element node
	*/
    function &createElement($name = null, $value = null, $attributes = array()) {
		
        $classname = get_class($this);
        
        $element =& new $classname($name, $attributes);
		$element->_parent =& $this;
        $element->_data   = $value;
        $this->_children[] =& $element;
		return $element;
	}
    
    /*
		Function: setParent
			Set the parent node of a node.
	*/
    function setParent(&$parent){
        
        if($this->_parent){
            foreach($this->_parent->_children as $index=>$c){
                if($c->id==$this->id){
                    array_splice($this->_parent->_children, $index, 1);
                    //unset($this->_parent->_children[$index]);
                }
            }
        }
        $this->_parent =& $parent;
        $parent->_children[] =& $this;
        
        return $this;
    }
    
    /*
		Function: parent
			Get the parent of a node.

		Returns:
			Element node
	*/
    function &parent(){
        return $this->_parent;
    }
    
    /*
		Function: children
			Get the children of the element.

		Returns:
			Array
	*/
	function children($name=false) {
		
        if($name===false) return $this->_children;
        
        $elements = array();
        
        for($i=0;$i<count($this->_children);$i++){
            if($name==$this->_children[$i]->name()){
                $elements[] =& $this->_children[$i];
            }
        }
        
        return $elements;
	}

    /*
		Function: children
			Get the first child by tag name.
        
        Parameters:
			$name - tag name
        
		Returns:
			Element node
	*/
	function &child($name) {
		
        $null = null;
        
        for($i=0;$i<count($this->_children);$i++){
            if($name==$this->_children[$i]->name()) return $this->_children[$i];
        }
        
        return $null;
	}


    /*
       Function: addAttribute
            Adds an attribute to the element.
       
       Parameters:
            $name  - attribute name
            $value - attribute value            
       
       Returns:
            void
    */
	function addAttribute($name, $value) {
		//add the attribute to the element, override if it already exists
		$this->_attributes[$name] = $value;
        
        return $this;
	}


    /*
       Function: removeAttribute
            Removes an attribute from the element.
       
       Parameters:
            $name  - attribute name          
       
       Returns:
            void
    */
	function removeAttribute($name)
	{
		unset($this->_attributes[$name]);
        
        return $this;
	}

    /*
       Function: removeChild
            Removes a direct child from the element.
       
       Parameters:
            $child  - xml node          
            
       Returns:
            Boolean
    */
	function removeChild(&$child){
        foreach($this->_children as $index => $c){
            if($c->id==$child->id){
                //unset($this->_children[$index]);
				array_splice($this->_children, $index, 1);
                return true;
            }
        }
        return false;
	}
    
    /*
       Function: findIndexOfChild
            Finds the the index of a child node.
       
       Parameters:
            $child  - xml node          
            
       Returns:
            Integer
    */
    function findIndexOfChild(&$child){
        foreach($this->_children as $index => $c){
            if($c->id==$child->id){
                return $index;
            }
        }
        return -1;
    }

    /*
       Function: findIndexOfChild
            Traverses the tree calling the $callback.
       
       Parameters:
            $callback  - callback function         
            $args   - arguments array          
            
       Returns:
            void
    */
	function map($callback, $args=array()){
		$callback($this, $args);
		// Map to all children
		if ($n = count($this->_children)) {
			for($i=0;$i<$n;$i++)
			{
				$this->_children[$i]->map($callback, $args);
			}
		}
	}

    /*
       Function: findIndexOfChild
            Return a well-formed XML string based on SimpleXML element.
       
       Parameters:
            $whitespace  - output with whitespaces     
            
       Returns:
            String
    */
	function toString($whitespace=true,$level=0){
		//Start a new line, indent by the number indicated in $this->level, add a <, and add the name of the tag
		if ($whitespace) {
			$out = "\n".str_repeat("\t", $level).'<'.$this->_name;
		} else {
			$out = '<'.$this->_name;
		}

		//For each attribute, add attr="value"
		foreach($this->_attributes as $attr => $value) {
			$out .= ' '.$attr.'="'.htmlspecialchars($value).'"';
		}

		//If there are no children and it contains no data, end it off with a />
		if (empty($this->_children) && empty($this->_data)) {
			$out .= " />";
		}
		else //Otherwise...
		{
			//If there are children
			if(!empty($this->_children))
			{
				//Close off the start tag
				$out .= '>';

				//For each child, call the asXML function (this will ensure that all children are added recursively)
				foreach($this->_children as $child)
					$out .= $child->toString($whitespace,$level+1);

				//Add the newline and indentation to go along with the close tag
				if ($whitespace) {
					$out .= "\n".str_repeat("\t", $level);
				}
			}

			//If there is data, close off the start tag and add the data
			elseif(!empty($this->_data))
				$out .= '>'.htmlspecialchars($this->_data);

			//Add the end tag
			$out .= '</'.$this->_name.'>';
		}

		//Return the final output
		return $out;
	}
}

/*
	Class: WarpXHTML
		HTML Parser Class
*/
class WarpXHTML extends WarpXML{


}

/*
	Class: WarpXHTMLElement
		XML Node Container with special methods for better handling (like Mootools)
*/
class WarpXHTMLElement extends WarpXMLElement{
    
    /*
       Function: get
            Shortcut to attributes($name).
       
    */
    function get($name){
        return isset($this->_attributes[$name]) ? $this->_attributes[$name] : null;
    }
    
    /*
       Function: set
            Shortcut to addAttribute($name, $value).
       
    */
    function set($name, $value) {
        
        if($name=='html'){
            $this->_data = null;
            $this->parse($value);
        }elseif($name=='text'){
            $this->_data = $value;
        }else{
            $this->_attributes[$name] = $value;
        }
        return $this;
    }
    
    /*
       Function: getElements
            Return elements by query.
       
       Parameters:
            $query  - query string  
            
       Returns:
            Xml nodes
    */
    function &getElements($query){

        //return $this->children($query);

        $parts = explode(",", $query);
        
        $elements = array();
        
        for($i=0;$i<count($this->_children);$i++){
            foreach($parts as $p){
                $p = trim($p);
                if($p==$this->_children[$i]->name()){
                    $elements[] =& $this->_children[$i];
                }
                
                if(count($this->_children[$i]->_children)){
                    $tmp = $this->_children[$i]->getElements($query);
                    for($e=0;$e<count($tmp);$e++){
                        array_push($elements, $tmp[$e]);
                    }
                }
            }
        }
        
        return $elements;
    }
    
    /*
       Function: getElement
            Return first element by query.
       
       Parameters:
            $query  - query string  
            
       Returns:
            Xml node
    */
    function &getElement($query){
        
        return $this->child($query);
    }
    
    /*
       Function: inject
            Injects a node into another.
       
       Parameters:
            $element  - xml node
            
       Returns:
            void
    */
    function inject(&$element){
        $this->setParent($element);
        
        return $this;
    }
    
    /*
       Function: adopt
            Inserts the passed element(s) inside the Element (which will then become the parent element).
       
       Parameters:
            $elements  - xml nodes
            
       Returns:
            void
    */
    function adopt(){
        $args = func_get_args();
		foreach ($args as $a) {
            $a->setParent($this);
        }
        
        return $this;
    }
    
    /*
       Function: wraps
            The Element is moved to the position of the passed element and becomes the parent.
       
       Parameters:
            $element  - xml node
            
       Returns:
            void
    */
    function wraps(&$element){

        $parent =& $this->_parent;
        
        if($parent){
            $element->setParent($parent);
        }
        
        $this->setParent($element);
        
        return $this;
    }
    
    /*
       Function: dispose
            Removes the Element from the tree.
            
       Returns:
            void
    */
    function dispose(){
        
        if($this->_parent){
            $this->_parent->removeChild($this);
        }
    }
    
    /*
       Function: replaces
            Replaces the Element with an Element passed.
       
       Parameters:
            $element  - xml node
            
       Returns:
            Xml node
    */
    function &replaces(&$element){
        
        if($this->_parent){
            $element->setParent($this->_parent);
            $this->_parent->_children[$this->_parent->findIndexOfChild($this)] =& $element;
            
            return $element;
        }
    }
    
    /*
       Function: add2attribute
            Adds a part string to an attribute.
       
       Parameters:
            $attribute  - attribute name
            $item2add  -  part string
            $seperator  - concat seperator
            
       Returns:
            void
    */
    function add2attribute($attribute, $item2add, $seperator=' ') {
	    
	    $attrContent = isset($this->_attributes[$attribute]) ? $this->_attributes[$attribute] : '';
	    
	    $parts   = explode($seperator,$attrContent);
	    $parts[] = $item2add;
	    
	    $this->_attributes[$attribute] = trim(implode($seperator,$parts));
        
        return $this;
	}
    
    /*
       Function: hasClass
            Tests the Element to see if it has the passed in className.
       
       Parameters:
            $classname  - class name
            
       Returns:
            Boolean
    */
    function hasClass($classname){
        $name = strtolower($classname);
        
	    $classes = isset($this->_attributes['class']) ? $this->_attributes['class'] : '';
	    $classes = explode(" ", $classes);
	    
	    foreach($classes as $class){
	        if($name===strtolower($class)) return true;
	    }	    
	    return false;
    }
    
    /*
       Function: addClass
            Adds the passed in class to the Element, if the Element doesnt already have it.
       
       Parameters:
            $classname  - class name
            
       Returns:
            void
    */
    function addClass($classname){
        if(!$this->hasClass($classname)) $this->add2attribute('class',$classname,' ');
        
        return $this;
    }
    
    /*
       Function: removeClass
            Works like Element:addClass, but removes the class from the Element.
       
       Parameters:
            $classname  - class name
            
       Returns:
            void
    */
    function removeClass($classname){
	    if($this->hasClass($classname)){
	        
	        $classes = $this->_attributes['class'];
	        $classes = explode(" ", $classes);
	        
	        $this->_attributes['class'] = '';
	        
            $classname = strtolower($classname);
            
    	    foreach($classes as $class){
    	        if($classname!==strtolower($class)) $this->addClass($class);
    	    }
	    }
        
        return $this;
    }

    /*
       Function: findIndexOfChild
            Return a well-formed XML string based on SimpleXML element.
       
       Parameters:
            $whitespace  - output with whitespaces     
            
       Returns:
            String
    */
	function toString($whitespace=true,$level=0){
		//Start a new line, indent by the number indicated in $this->level, add a <, and add the name of the tag
		if ($whitespace) {
			$out = "\n".str_repeat("\t", $level).'<'.$this->_name;
		} else {
			$out = '<'.$this->_name;
		}

		//For each attribute, add attr="value"
		foreach($this->_attributes as $attr => $value) {
			$out .= ' '.$attr.'="'.htmlspecialchars($value).'"';
		}

		//If there are no children and it contains no data, end it off with a />
		if (empty($this->_children) && empty($this->_data)) {
			$out .= "></".$this->_name.">";
		}
		else //Otherwise...
		{
			//If there are children
			if(!empty($this->_children))
			{
				//Close off the start tag
				$out .= '>';

				//For each child, call the asXML function (this will ensure that all children are added recursively)
				foreach($this->_children as $child)
					$out .= $child->toString($whitespace,$level+1);

				//Add the newline and indentation to go along with the close tag
				if ($whitespace) {
					$out .= "\n".str_repeat("\t", $level);
				}
			}

			//If there is data, close off the start tag and add the data
			elseif(!empty($this->_data))
				$out .= '>'.htmlspecialchars($this->_data);

			//Add the end tag
			$out .= '</'.$this->_name.'>';
		}

		//Return the final output
		return $out;
	}   
}