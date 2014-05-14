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

		$aResult=$this->Geo_GetTargets(array($oCountry->getId(),'target_type'=>'user'),1,30);
		$aUsersId=array();
		foreach($aResult['collection'] as $oTarget) {
			echo array_keys($aResult)	
			$aUsersId[]=$oTarget->getTargetId();
		}

		
		$aResult = array();
		$aUsers=$this->User_GetUsersByArrayId($aUsersId);
		foreach($aUsers as $k => $oUser) {
			$aResult[$k]=array('login' => $oUser->getLogin(),
							   'skill' => $oUser->getSkill(),
							   'rating' => $oUser->getRating(),
							   'name' => $oUser->getProfileName(),
							   'country' => $oUser->getProfileCountry(),
							   'region' => $oUser->getProfileRegion(),
							   'city' => $oUser->getProfileCity(),
							   'webpath' => $oUser->getUserWebPath()
							   );
		}


		return array('collection'=>$aResult,'count'=>count($aResult));
	}


}