<?php

namespace yii2lab\db\domain\helpers;

use Yii;
use yii2lab\console\helpers\Output;
use yii2lab\helpers\Helper;

class CallbackHelper {
	
	const BASE_NAMESPACE = 'yii2lab\db\domain\filters\\';
	
	public static function run($classList) {
		$classList = self::normalizeConfig($classList);
		foreach($classList as $className => $config) {
			self::runClass($className, $config);
		}
	}
	
	private static function normalizeConfig($classList) {
		$new = [];
		foreach($classList as $className => $config) {
			if(is_integer($className)) {
				$className = $config;
				$config = [];
			}
			if(!Helper::isClass($className)) {
				$className = self::BASE_NAMESPACE . $className;
			}
			$new[$className] = $config;
		}
		return $new;
	}
	
	private static function runClass($className, $config) {
		Output::block("Start " . $className);
		$class = Yii::createObject($className);
		Yii::configure($class, $config);
		$class->run();
		Output::block("End " . $className);
	}
	
}