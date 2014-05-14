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
		if (!($oCountry=$this->Geo_GetCountryById($iParamID))) {
			return 'Country not found';
		}
		/*$aResult=$this->Geo_GetTargets(array('id'=>$oCountry->getId(),'target_type'=>'user'),$iPage,Config::Get('module.user.per_page'));
		*/
		$aResult=$this->Geo_GetTargets(array($iParamID,'target_type'=>'user'),1,30);
		$aUsersId=array();
		foreach($aResult['collection'] as $oTarget) {
			$aUsersId[]=$oTarget->getTargetId();
		}

		
		$aResult = array();
		$aUsers=$this->User_GetUsersByArrayId($aUsersId);
		foreach($aUsers as $k => $oUser) {
			$aResult['user_id']=$k;
		}


		return array('collection'=>$aResult,'count'=>count($aResult));
	}


}