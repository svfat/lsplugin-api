<?php
class PluginApi_ModuleApi_Geo extends PluginApi_ModuleApi_Module {
	protected $_aActions = array(
		'hello' => 'ActionHello',
		'country' => 'ActionCountry',
	);

	protected function ActionHello()	{
		echo 'Hello';
     
	}

	protected function ActionCountry() {
	/*	if (!$this->getParam('id')) {
			throw new ExceptionApiRequestError($this->Lang_Get('system_error'));
		}
		$oTopic = $this->Topic_GetTopicById($this->getParam('id'));
		if (!$oTopic) {
			throw new ExceptionApiRequestError($this->Lang_Get('system_error'));
		}

		$aResult=$this->Geo_GetTargets(array('id'=>$oCountry->getId(),'target_type'=>'user'),$iPage,Config::Get('module.user.per_page'));
		*/
		return $this->getParam('id');
	}


}