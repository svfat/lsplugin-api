<?php
class PluginApi_ModuleApi_Geo extends PluginApi_ModuleApi_Module {
	protected $_aActions = array(
		'hello' => 'ActionHello',
	);

	protected function ActionShow()	{
		echo 'Hello';  

	}
}