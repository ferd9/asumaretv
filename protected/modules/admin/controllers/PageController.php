<?php

class PageController extends AdminController {

    public function actionAdd() {
        $this->addEdit();
    }

    public function actionEdit($id) {
        $id = (int) $id;
        $this->addEdit($id);
    }

    private function addEdit($id = 0) {
        $model = empty($id) ? new Page() : $this->loadModel($id);
        $mode = empty($id) ? 'add' : 'edit';

        // collect user input data
        if (isset($_POST['Page'])) {
            $model->attributes = $_POST['Page'];
            $model->is_active = 1;
            // validate user input and redirect to the previous page if valid
            if ($model->validate()) {
                $model->save();
                Utility::setFlash('page ' . $mode . 'ed successfully.', 'success');
                $this->redirect($this->createUrl('page/index'));
            }
        }

        $this->render('pageForm', array(
            'model' => $model,
            'mode' => $mode,
        ));
    }

    public function actionIndex() {
        $pages = Page::model()->findAll();

        $this->render('listing', array(
            'pages' => $pages,
        ));
    }

    public function actionActivate($id) {
        $page = $this->loadModel($id);
        $page->is_active = 1;
        $page->save(TRUE);
        Utility::setFlash('page activated successfully.' , 'success');
        $this->redirect($this->createUrl('page/index'));
    }

    public function actionDeactivate($id) {
        $page = $this->loadModel($id);
        $page->is_active = 0;
        $page->save(TRUE);
        Utility::setFlash('page deactivated successfully.' , 'success');
        $this->redirect($this->createUrl('page/index'));
    }

    public function actionDelete($id) {
        $page = $this->loadModel($id);
        $page->delete();
        Utility::setFlash('page deleted successfully.', 'success');
        $this->redirect($this->createUrl('page/index'));
    }

    public function loadModel($id) {
        $model = Page::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

}