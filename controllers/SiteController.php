<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\data\ArrayDataProvider;
use app\models\User;
use app\models\LoginForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\TotalSearch;
/**
 * PanelErrController implements the CRUD actions for PanelErr model.
 */
class SiteController extends Controller
{

    public function actionTest($modelflag = '')
    {
        echo "string";
        // $tmp = Yii::$app->mongodb_p->createCommand()->count('position', ['machineid' => ' 42030']);
        // $tmp = Yii::$app->mongodb_p->getCollection('position')->count(['machineid' => ' 42030']);
        $tmp = Yii::$app->mongodb_p->createCommand();
            // ->aggregate('panel_result', [
            //     [
            //         '$group' => [
            //             '_id' => '$machineid',
            //             'result' => ['$sum' => 1],
            //             'soft' => ['$max' => '$softversion'],
            //             'type' => ['$max' => '$panelid'], 
            //         ]
            //     ]
            // ]);
        var_dump($tmp);
        // return $this->render('test');
    }
        /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
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

    public function actionMachineTotal($modelflag = '', $name = '')
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        if ($modelflag == 'Celercare') {
            $connection = Yii::$app->mongodb_c;
        } else if ($modelflag == 'APP') {
            $connection = Yii::$app->mongodb_a;
        } else {
            $connection = Yii::$app->mongodb_p;
            $modelflag = 'Pointcare';
        }
        $searchModel = new TotalSearch();
        $data = $searchModel->search($connection, Yii::$app->request->queryParams);
        return $this->render('machine-total', [
            'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
            'data' => $data,
            'modelflag' => $modelflag,
        ]);
    }

    public function actionAbsbimage($modelflag = '', $name = '')
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
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
        /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword()
    {
        $model = new ResetPasswordForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
