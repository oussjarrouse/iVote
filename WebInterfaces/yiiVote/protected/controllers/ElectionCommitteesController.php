<?php

class ElectionCommitteesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			/*
			 array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index', 'view', 'create', 'update', 'handover'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','deactivate'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ElectionCommittees;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ElectionCommittees']))
		{
			$model->attributes=$_POST['ElectionCommittees'];
			if($model->save())
			{
				//also add self to the many to many list 
				
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ElectionCommittees']))
		{
			$model->attributes=$_POST['ElectionCommittees'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deletedx	
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	
	public function actionDeactivate($id)
	{
		$model = $this->loadModel($id);
		$model->status = 0;
		$model->save();
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ElectionCommittees');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ElectionCommittees('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ElectionCommittees']))
			$model->attributes=$_GET['ElectionCommittees'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ElectionCommittees the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ElectionCommittees::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * invite users by email to be part of this election committee
	 * if users are not registered a ghost-registration process is initiated, 
	 * these new will get their notifications upon first login 
	 * @param integer $id the ID of the model  which owenership to be passed
	 * @param unknown $newOwnerID
	 */
	public function actionInvite($id)
	{
		$model = loadModel($id);
		if(isset($_POST['ElectionCommitteeInviteeEmail']))
		{
			//Get the new owner email from $_POST
			$emails = $_POST['ElectionCommitteeInviteeEmail'];
			
			//For $email in $emails do the following
			//{
				//Find emails in users list
				$invitees = Users::model()->getUserByEmail($email);
				if($invitee===null)
				{
					//Add this user the registrationInvitationList
				}
				else
				{
					$model->users_id = $invitee->user_id;
					$model->addUser($id);
					$model->save();
				}
			//}
			//
			//	SendEmailInvitations($shortEmailsList)
			//
			$this->redirect(array('view','id'=>$model->id));
		}
		
		$this->render('invite',array(
				'model'=>$model,
		));
	}
	
	/**
	 * Passes the owenership of the ElectionsCommittee to another user
	 * @param integer $id the ID of the model which owenership to be passed
	 */
	public function actionPassOwnership($id)
	{
		$model = loadModel($id);
		if(isset($_POST['ElectionCommitteeNewOwner']))
		{
			//Get the new owner id from $_POST
			$newOwnerId = $_POST['ElectionCommitteeNewOwner'];
			$model->users_id = $newOwnerId;
			//$model->addUser($id);
			if($model->save())
			{
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		$this->render('owner',array(
				'model'=>$model,
		));
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param ElectionCommittees $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='election-committees-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
