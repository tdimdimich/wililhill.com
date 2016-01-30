<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public function createPaginatorList($model, $attr, $page = 1){
		// count
		$count = $model->count($attr);
		$limit = $attr['limit'];
		$attr['offset'] = ($page - 1) * $limit;

		// items
		$items = $model->findAll($attr);
		return ['page' => $page, 'count' => $count, 'limit' => $limit, 'items' => $items];
	}	
	
	public function renderJson($data = []){
		header('Content-Type: application/json;');
		echo CJSON::encode($data);
		Yii::app()->end();
	}
	
	public function renderJsonError($err_code, $msg = '', $data = []){
		header('Content-Type: application/json; charset=utf-8;');
		header($_SERVER['SERVER_PROTOCOL'].' '.$err_code.' '.$msg, true, $err_code);
		echo CJSON::encode($data);
		Yii::app()->end();
	}
	
}