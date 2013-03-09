<?php

class Lib_Components
{
	function createComponent($type,$values,$att,$default=0)
	{
		if($type=="combobox")
		{
			if(is_array($values))
				return $this->createComboBox($values,$att,$default);
			else
				return false;	
		}
	}
	
	function createComboBox($values,$att,$default)
	{	
	
		$component = '<select '.$att.'>';
		foreach($values as $key=>$item)
		{		
			$component .= '<option value="'.$key.($key==$default  ? '"  selected' : '').'">'.$item.'</option>';
		}
		return $component .= '</select>';	
	}

}

?>