<?php

class UserController extends AdminController {

    public function actionExport() {
        Yii::import('ext.ECSVExport');
        $criteria = new CDbCriteria(array(
                    'condition' => 'idusuario <> 1',
                ));

        $output = array();
        $users = Usuario::model()->findAll($criteria);
        if ($users) {
            foreach ($users as $row) {
                $output[] = array(
                    'Username' => $row->username,
                    'First Name' => $row->apellido_p,
                    'Last Name' => $row->apellido_m,
                    'Email' => $row->email,
                    'Registered At' => $row->fechareg,
                );
            }
        }

        $csv = new ECSVExport($output);
        $content = $csv->toCSV();
        Yii::app()->getRequest()->sendFile('users-list.csv', $content, "text/csv", false);
        Yii::app()->end();
    }
    
    public function actionDelete() {
        $id = Yii::app()->request->getParam('id');
        if($user = Usuario::model()->findByPk($id)) {
            $user->delete();
            Yii::app()->plugin->onUserDelete(new CEvent($user));
            Utility::setFlash('User deleted successfully', 'success');
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }
    
    public function actionActivate() {
        $id = Yii::app()->request->getParam('id');
        $value = (boolean)Yii::app()->request->getParam('value');
        if($user = Usuario::model()->findByPk($id)) {
            $user->saveAttributes(array('activo' => (int)$value));
            Yii::app()->plugin->onUserActivated(new CEvent($user));
            Utility::setFlash(sprintf('User %s successfully!', $user->activo ? 'activated' : 'inactivated'), 'success');
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    public function actionIndex() {
        $limit = 20;

        $q = new CDbCriteria(array(
                    'condition' => 'user.idusuario <> 1',
                    'alias' => 'user',
                ));

        $this->addDefaultCriteria($q, array('limit' => $limit, 'order' => 'user.fechareg', 'sort' => 'DESC'));

        $users = Usuario::model()->findAll($q);

        $count = Usuario::model()->count($q);
        $pages = new CPagination($count);

        // results per page
        $pages->pageSize = $limit;
        $pages->applyLimit($q);

        $this->render('index', array(
            'users' => $users,
            'pages' => $pages,
        ));
    }

}