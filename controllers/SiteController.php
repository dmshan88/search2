<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\data\ArrayDataProvider;

/**
 * PanelErrController implements the CRUD actions for PanelErr model.
 */
class SiteController extends Controller
{

    public function actionTest($modelflag = '')
    {

    }
    /**
     * Lists all PanelErr models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        return $this->render('index', [
        ]);
    }
    public function actionResult($modelflag = '')
    {
        if ($modelflag == 'Celercare') {
            $modelname = 'app\models\CPanelResultSearch';
        } else if ($modelflag == 'APP') {
            $modelname = 'app\models\APanelResultSearch';
        } else {
            $modelname = 'app\models\PPanelResultSearch';
            $modelflag = 'Pointcare';
        }
        
        $searchModel = new $modelname();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('result', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelflag' => $modelflag,
        ]);
    }
    public function actionError($modelflag = '')
    {
        if ($modelflag == 'Celercare') {
            $modelname = 'app\models\CPanelErrSearch';
        } else if ($modelflag == 'APP') {
            $modelname = 'app\models\APanelErrSearch';
        } else {
            $modelname = 'app\models\PPanelErrSearch';
            $modelflag = 'Pointcare';
        }
        
        $searchModel = new $modelname();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('error', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelflag' => $modelflag,
        ]);
    }
    public function actionMachineErr($modelflag = '')
    {
        if ($modelflag == 'Celercare') {
            $modelname = 'app\models\CMachineErrSearch';
        } else if ($modelflag == 'APP') {
            $modelname = 'app\models\AMachineErrSearch';
        } else {
            $modelname = 'app\models\PMachineErrSearch';
            $modelflag = 'Pointcare';
        }
        $searchModel = new $modelname();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('machine-err', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelflag' => $modelflag,
        ]);
    }
    public function actionQcresult($modelflag = '')
    {
        if ($modelflag == 'Celercare') {
            $modelname = 'app\models\CPanelQcresultSearch';
        } else if ($modelflag == 'APP') {
            $modelname = 'app\models\APanelQcresultSearch';
        } else {
            $modelname = 'app\models\PPanelQcresultSearch';
            $modelflag = 'Pointcare';
        }
        $searchModel = new $modelname();
        // var_dump($searchModel);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('panel-qcresult', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelflag' => $modelflag,
        ]);
    }
    public function actionAbsbimage($modelflag = '', $name = '')
    {
        // var_dump($modelflag);
        // var_dump($name);
        if ($modelflag == 'Celercare') {
            $modelname = 'app\models\CAbsbFile';
        } else if ($modelflag == 'APP') {
            $modelname = 'app\models\AAbsbFile';
        } else {
            $modelname = 'app\models\PAbsbFile';
            $modelflag = 'Pointcare';
        }
        $absbfile = (new $modelname())->getRecord($name);
        if ($absbfile) {
            $absbfile->generateImage();
            $dataProvider = new ArrayDataProvider([
                'allModels' => $absbfile->getAbsbdata(),
                // 'pagination' => [
                //     'pageSize' => 10,
                // ],
                // 'sort' => [
                //     'attributes' => ['id', 'name'],
                // ],
            ]);
            return $this->render('absbimage',[
                'dataProvider' => $dataProvider,
                'imagepath' => $absbfile->getImagePath(),
            ]);
        } else {

        }
    }
}
