<?php

namespace yii2lab\db\console\controllers;

use yii2lab\console\helpers\input\Enter;
use yii2lab\console\helpers\Output;
use yii2lab\console\yii\console\Controller;
use yii2lab\db\domain\helpers\MigrationHelper;

/**
 * Migration tools
 */
class MigrationController extends Controller
{
	
	/**
	 * Generate migration with columns and foreign keys
	 */
	public function actionGenerate()
	{
		$tableName = Enter::display('Enter table name');
		$className = MigrationHelper::generateByTableName($tableName);
		Output::block($className, 'Migration created!');
	}
	
}
