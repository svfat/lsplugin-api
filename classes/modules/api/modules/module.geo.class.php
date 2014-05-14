<?php
class PluginApi_ModuleApi_Geo extends PluginApi_ModuleApi_Module {
	protected $_aActions = array(
		'country' => 'ActionCountry',
		'region' => 'ActionRegion',
		'city' => 'ActionCity',
	);

	protected function ActionCountry() {
		if (!($iParamId=$this->getParam('id'))) {
			throw new ExceptionApiRequestError($this->Lang_Get('system_error'));
		}
		if (!($oCountry=$this->Geo_GetCountryById($iParamId))) {
			throw new ExceptionApiRequestError($this->Lang_Get('system_error'));
		}


		$aResult=$this->Geo_GetTargets(array('country_id'=>$oCountry->getId(),'target_type'=>'user'),1,30);
		$aUsersId=array();
		foreach($aResult['collection'] as $oTarget) {
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

	protected function ActionRegion() {
		if (!($iParamId=$this->getParam('id'))) {
			throw new ExceptionApiRequestError($this->Lang_Get('system_error'));
		}
		if (!($oRegion=$this->Geo_GetRegionById($iParamId))) {
			throw new ExceptionApiRequestError($this->Lang_Get('system_error'));
		}


		$aResult=$this->Geo_GetTargets(array('region_id'=>$oRegion->getId(),'target_type'=>'user'),1,30);
		$aUsersId=array();
		foreach($aResult['collection'] as $oTarget) {
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


	protected function ActionCity() {
		if (!($iParamId=$this->getParam('id'))) {
			throw new ExceptionApiRequestError($this->Lang_Get('system_error'));
		}
		if (!($oCity=$this->Geo_GetCityById($iParamId))) {
			throw new ExceptionApiRequestError($this->Lang_Get('system_error'));
		}


		$aResult=$this->Geo_GetTargets(array('city_id'=>$oCity->getId(),'target_type'=>'user'),1,30);
		$aUsersId=array();
		foreach($aResult['collection'] as $oTarget) {
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