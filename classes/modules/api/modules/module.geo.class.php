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
		if (!($iParamID=$this->getParam('id'))) {
			throw new ExceptionApiRequestError($this->Lang_Get('system_error'));
		}
	/*	$oTopic = $this->Topic_GetTopicById($this->getParam('id'));
		if (!$oTopic) {
			throw new ExceptionApiRequestError($this->Lang_Get('system_error'));
		}*/
		if (!($oCountry=$this->Geo_GetCountryById($this->$iParamID))) {
			return 'Country not found';
		}
		/*$aResult=$this->Geo_GetTargets(array('id'=>$oCountry->getId(),'target_type'=>'user'),$iPage,Config::Get('module.user.per_page'));
		*/
		$aResult=$this->Geo_GetTargets(array($iParamID,'target_type'=>'user'),1,9999);

		$aUsersId=array();
		foreach($aResult['collection'] as $oTarget) {
			$aUsersId[]=$oTarget->getTargetId();
		}

		$aUsersCountry=$this->User_GetUsersAdditionalData($aUsersId);

		return $aUsersCountry;
	}


}