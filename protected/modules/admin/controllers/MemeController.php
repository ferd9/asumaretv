<?php

class MemeController extends AdminController {

    public function actionIndex() {
        $limit = 20;
        $mode = Yii::app()->request->getParam('mode');

        $q = new CDbCriteria(array(
            'select' => 'meme.*, w_usuario.username',
            'join' => 'INNER JOIN w_usuario ON meme.user_fk = w_usuario.idusuario',
//                    'condition' => 'user.user_id <> 1',
            'alias' => 'meme',
        ));

        $this->addDefaultCriteria($q, array('limit' => $limit, 'order' => 'meme.created_at', 'sort' => 'DESC',
            'holders' => array(
                '{remix_order}' => '(select count(*) from meme m where m.remix_id = meme.meme_id)',
                '{flagged_order}' => '(select count(*) from meme_flag mf where mf.meme_fk = meme.meme_id)',
            )
        ));

        switch ($mode) {
            case 'inactive':
                $q->condition = 'meme.is_active = 0';
                break;
        }

        $memes = Meme::model()->findAll($q);

        $count = Meme::model()->count($q);
        $pages = new CPagination($count);

        // results per page
        $pages->pageSize = $limit;
        $pages->applyLimit($q);

        $this->render('index', array(
            'memes' => $memes,
            'pages' => $pages,
        ));
    }

    public function actionDelete() {
        $id = Yii::app()->request->getParam('id');
        if ($meme = Meme::model()->findByPk($id)) {
            $file = Yii::getPathOfAlias('webroot.memes') . DIRECTORY_SEPARATOR . $meme->file;
            $file_thumb = substr($file, 0, -4) . '_thumb' . substr($file, -4);
            if ($meme->delete()) {
                @unlink($file);
                @unlink($file_thumb);
            }
            Yii::app()->plugin->onMemeDelete(new CEvent($meme));
            Utility::setFlash('Meme deleted successfully', 'success');
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    public function actionActivate() {
        $id = Yii::app()->request->getParam('id');
        $value = (boolean) Yii::app()->request->getParam('value');
        if ($meme = Meme::model()->findByPk($id)) {
            $meme->saveAttributes(array('is_active' => (int) $value));
            Yii::app()->plugin->onMemeActivated(new CEvent($meme));
            Utility::setFlash(sprintf('Meme %s successfully!', $meme->is_active ? 'activated' : 'inactivated'), 'success');
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    public function actionPublish() {
        $id = Yii::app()->request->getParam('id');
        $value = (boolean) Yii::app()->request->getParam('value');
        if ($meme = Meme::model()->findByPk($id)) {
            $meme->is_published = (int) $value;
            $also_activated = false;
            if ($meme->is_published && $meme->is_active == 0) {
                $meme->is_active = 1;
                $also_activated = true;
            }
            $meme->save(false);
            Yii::app()->plugin->onMemePublished(new CEvent($meme));
            Utility::setFlash(sprintf('Meme %s successfully!', $meme->is_published ? (($also_activated ? 'activated and ' : '') . 'published') : 'unpublished'), 'success');
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    public function actionFeatured() {
        $id = Yii::app()->request->getParam('id');
        $value = (boolean) Yii::app()->request->getParam('value');
        if ($meme = Meme::model()->findByPk($id)) {
            $meme->is_featured = (int) $value;
            $also_activated = false;
            if ($meme->is_featured && $meme->is_active == 0) {
                $meme->is_active = 1;
                $also_activated = true;
            }
            $meme->save(false);
            Yii::app()->plugin->onMemeFeatured(new CEvent($meme));
            Utility::setFlash(sprintf('Meme %s successfully!', $meme->is_featured ? (($also_activated ? 'activated and ' : '') . 'featured') : 'unfeatured'), 'success');
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

}