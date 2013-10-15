<?php

class DefaultController extends Controller {

    public function init() {
        $this->actions['change_password'] = 'application.modules.meme.controllers.ChangePasswordAction';
        $this->actions['forgot_password'] = 'application.modules.meme.controllers.ForgotPasswordAction';
        $this->actions['captcha'] = array(
            'class' => 'CCaptchaAction',
        );
        $this->actions['page'] = array(
            'class' => 'CViewAction',
        );

        $this->accessRules[] = array('allow', 'actions' => array('delete', 'publish', 'update_profile', 'follow', 'unfollow', 'memelike', 'memeunlike', 'flag', 'mymemes'), 'users' => array('@'));
        $this->accessRules[] = array('allow', 'actions' => array('login', 'index', 'register', 'contact'), 'users' => array('*'));
        $this->accessRules[] = array('deny', 'actions' => array('change_password'), 'users' => array('?'));
        $this->accessRules[] = array('deny', 'actions' => array('delete', 'update_profile', 'follow', 'unfollow', 'memelike', 'memeunlike', 'flag'), 'users' => array('?'));


        parent::init();
    }

    public function filters() {
        return array('accessControl');
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $limit = 15;
        $page = Yii::app()->request->getQuery('page');
        $offset = (max($page, 1) - 1) * $limit;
        $action = Yii::app()->request->getParam('action');
        $id = Yii::app()->request->getParam('id');
        $pagination = true;

        $q = new CDbCriteria(array(
            'condition' => 't.is_active = 1 and t.is_published = 1 and w_usuario.activo = 1',
            'join' => 'INNER JOIN w_usuario ON t.user_fk = w_usuario.idusuario',
            'order' => 't.meme_id DESC',
            'limit' => $limit,
            'offset' => $offset,
        ));

        $trendingCriteria = clone $q;
        $trendingCriteria->select = 't.*, COUNT(ml.meme_fk) as meme_liked';
        $trendingCriteria->join .= ' INNER JOIN meme_like ml ON ml.meme_fk = t.meme_id';
        $trendingCriteria->condition .= ' AND DATE(ml.created_at) >= DATE_SUB(ml.created_at, INTERVAL 14 DAY) and DATE(ml.created_at) <= DATE_SUB(ml.created_at, INTERVAL 7 DAY)';
        $trendingCriteria->group = 'ml.meme_fk';
        $trendingCriteria->order = 'meme_liked DESC, t.created_at DESC';

        if ($id) {
            $q->condition .= ' AND t.meme_id = :id';
            $q->params = array(
                ':id' => $id,
            );
            $pagination = false;
        } else if ($action == 'popular') {
            $q->order = 't.likes_count DESC, t.created_at DESC';
        } else if ($action == 'featured') {
            $q->condition .= ' AND is_featured = 1';
            $q->order = 't.created_at DESC';
        } else if ($action == 'trending') {
            $q = $trendingCriteria;
        }

        $q->condition .= ' AND t.is_active = 1 AND t.is_published = 1';

        $memes = Meme::model()->findAll($q);

        $count = Meme::model()->count($q);
        $pages = new CPagination($count);

        // results per page
        $pages->pageSize = $limit;
        $pages->applyLimit($q);

        $this->registerSharrre();

        $has_featured_posts = Meme::model()->count('is_featured = 1 and is_active = 1 and is_published = 1');
        $trendingCriteria->limit = 1;
        $has_trending_posts = count(Meme::model()->find($trendingCriteria));
        $trendingCriteria->limit = 0;

        $this->render('index', array(
            'memes' => $memes,
            'pages' => $pages,
            'top_users' => Usuario::model()->top_users,
            'pagination' => $pagination,
            'has_featured_posts' => $has_featured_posts,
            'has_trending_posts' => $has_trending_posts,
            'single' => (bool) $id,
        ));
    }

    public function actionDelete() {
        $id = Yii::app()->request->getParam('id');
        $meme = Meme::model()->findByPk($id);
        if ($meme) {
            if (Yii::app()->user->checkAccess('ownMeme', array('meme' => $meme))) {
                $meme->delete();
                Yii::app()->plugin->onMemeDelete(new CEvent($meme));
                Utility::setFlash(Yii::t('yii', 'Meme deleted!'), 'success');
            } else {
                Utility::setFlash(Yii::t('yii', 'You are not allowed to delete this meme!'), 'error');
            }
        }

        Yii::app()->request->redirect(Yii::app()->createUrl('site/mymemes'));
    }

    public function actionPublish() {
        $id = Yii::app()->request->getParam('id');
        $meme = Meme::model()->findByPk($id);
        if ($meme) {
            if (Yii::app()->user->checkAccess('ownMeme', array('meme' => $meme))) {
                Utility::setFlash(Yii::t('yii', 'Meme ' . ($meme->is_published ? 'UnPublished' : 'Published') . '!'), 'success');
                $meme->saveAttributes(array('is_published' => !$meme->is_published));
                Yii::app()->plugin->onMemePublished(new CEvent($meme));
            } else {
                Utility::setFlash(Yii::t('yii', 'You are not allowed to that!'), 'error');
            }
        }

        Yii::app()->request->redirect(Yii::app()->createUrl('site/mymemes'));
    }

    public function actionDownload() {
        $id = Yii::app()->request->getParam('id');
        $meme = Meme::model()->findByPk($id);
        if ($meme) {
            if (Yii::app()->user->checkAccess('ownMeme', array('meme' => $meme))) {
                Yii::app()->plugin->onMemeDownload(new CEvent($meme));
                return Yii::app()->getRequest()->sendFile(basename($meme->absolute_path), @file_get_contents($meme->absolute_path));
            } else {
                Utility::setFlash(Yii::t('yii', 'You are not allowed to that!'), 'error');
            }
        }

        Yii::app()->request->redirect(Yii::app()->createUrl('site/mymemes'));
    }

    protected function registerSharrre() {

        $baseUrl = Yii::app()->theme->baseUrl;
        $twitterUser = Yii::app()->params['hauth']['config']['providers']['Twitter']['username'];
        $js = <<<JS
        $('.social-share').sharrre({
               urlCurl: '{$baseUrl}/js/sharrre/sharrre.php',
               share: {
                   googlePlus: true,
                   facebook: true,
                   twitter: true
               },
               buttons: {
                   googlePlus: {size: 'tall', annotation: 'bubble'},
                   facebook: {layout: 'box_count'},
                   twitter: {count: 'vertical', via: '$twitterUser'}
               },
               hover: function(api, options) {
                   $(api.element).find('.buttons').show();
               },
               hide: function(api, options) {
                   $(api.element).find('.buttons').hide();
               },
               enableTracking: true
           });
JS;

        Yii::app()->clientScript
                ->registerScriptFile($baseUrl . '/js/sharrre/jquery.sharrre-1.3.4.js')
                ->registerScript('sharrre-init', $js, CClientScript::POS_END);
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', Yii::t('yii', 'Thank you for contacting us. We will respond to you as soon as possible.'));
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLoginNormal() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                Yii::app()->plugin->onUserLogin(new CEvent($model));
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        // display the login form

        if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('login', array('model' => $model));
        } else {
            $this->render('login', array('model' => $model));
        }
    }

    public function loadUserLikes() {
        $likes = MemeLike::model()->findByAttributes(array('user_fk' => Yii::app()->user->getId()));
        $user_likes = array();
        foreach ($likes as $like) {
            $user_likes[] = $like->meme_fk;
        }
        Yii::app()->session[Meme::LIKE_KEY] = $user_likes;
    }

    //action only for the login from third-party authentication providers, such as Google, Facebook etc. Not for direct login using username/password
    public function actionLogin() {
        if (!isset($_GET['provider'])) {
            $this->forward('site/loginNormal');
            return;
        }

        try {
            Yii::import('application.components.HybridAuthIdentity');
            $haComp = new HybridAuthIdentity();
            if (!$haComp->validateProviderName($_GET['provider']))
                throw new CHttpException('500', Yii::t('yii', 'Invalid Action. Please try again.'));

            $haComp->adapter = $haComp->hybridAuth->authenticate($_GET['provider']);
            $haComp->userProfile = $haComp->adapter->getUserProfile();
            $haComp->provider = strtolower($_GET['provider']);
            $haComp->login();
            if (Yii::app()->user->returnUrl) {
                Yii::app()->plugin->onUserLogin(new CEvent($haComp));
                $this->redirect(Yii::app()->user->returnUrl);
            }

            $haComp->processLogin();  //further action based on successful login or re-direct user to the required url
        } catch (Exception $e) {
            //process error message as required or as mentioned in the HybridAuth 'Simple Sign-in script' documentation
            $this->redirect('/site/index');
            return;
        }
    }

    public function actionMemeLike() {
        $out = array('error' => true);
        $id = Yii::app()->request->getParam('id');

        if (!Yii::app()->user->isGuest && ($meme = Meme::model()->findByPk($id))) {
            $out['error'] = !Meme::like($meme);
        }

        echo json_encode($out);
    }

    public function actionMemeUnlike() {
        $out = array('error' => true);
        $id = Yii::app()->request->getParam('id');

        if (!Yii::app()->user->isGuest && ($meme = Meme::model()->findByPk($id))) {
            $out['error'] = !Meme::unlike($meme);
        }

        echo json_encode($out);
    }

    public function actionSocialLogin() {
        Yii::import('application.components.HybridAuthIdentity');
        $path = Yii::getPathOfAlias('ext.HybridAuth');
        require_once $path . '/hybridauth-' . HybridAuthIdentity::VERSION . '/hybridauth/index.php';
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Displays the registeration page
     */
    public function actionRegister() {
        $model = new RegisterForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'register-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['RegisterForm'])) {
            $model->attributes = $_POST['RegisterForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate()) {
                $user = new User();
                $user->attributes = $_POST['RegisterForm'];
                $user->password = md5($user->password);
                $user->token = md5(uniqid());
                $user->is_admin = 0;
                $user->created_at = new CDbExpression('NOW()');
                if ($user->save()) {

                    $message = new MyYiiMailMessage();
                    $message->view = 'registeration';

                    //userModel is passed to the view
                    $message->setBody(array(
                        'model' => $user,
                        'verify_url' => $this->createAbsoluteUrl('site/email_verify', array('code' => $user->token,))
                            ), 'text/html');

                    $message->addTo($user->email);
                    $message->setFrom(array(Yii::app()->params['adminEmail'] => Yii::app()->name));
                    $message->setSubject(Yii::t('yii', 'Verify your email address.'));
                    Yii::app()->mail->send($message);
                    Utility::setFlash(Yii::t('yii', 'Successfully registerd! Please check your mailbox to verify your email address.'), 'success');

                    Yii::app()->plugin->onUserRegister(new CEvent($user));

                    $this->redirect(Yii::app()->homeUrl);
//                    echo $message->getBody();exit;
                }
            }
        }
        // display the registeration form
        $this->render('register', array('model' => $model));
    }

    public function actionEmail_verify() {
        $code = trim(Yii::app()->request->getQuery('code'));
        if ($code) {
            $user = User::model()->findByAttributes(array('token' => $code));
            if ($user) {
                $user->is_active = 1;
                $user->token = md5(uniqid());
                $user->save();
                Utility::setFlash(Yii::t('yii', 'Your email has been verified. Please login below.'), 'success');
                Yii::app()->request->redirect('login');
            }
        }
        echo Yii::t('yii', 'invalid code');
        Yii::app()->end();
    }

    public function actionUpdate_profile() {
        $model = new UserProfileForm();
        $user = User::model()->findByPk(Yii::app()->user->id);
        $model->first_name = $user->first_name;
        $model->last_name = $user->last_name;

        if (isset($_POST['UserProfileForm'])) {
            $model->attributes = $_POST['UserProfileForm'];

            if ($model->validate()) {
                $model->attributes = $_POST['UserProfileForm'];

                $user->first_name = $model->first_name;
                $user->last_name = $model->last_name;
                $user->save();

                $file = basename($model->avatar);
                $uploaded_avatar_thumb = Yii::getPathOfAlias('webroot.' . Yii::app()->params['upload_dir']) . DIRECTORY_SEPARATOR . 'thumbnail' . DIRECTORY_SEPARATOR . $file;
                $uploaded_avatar_medium = Yii::getPathOfAlias('webroot.' . Yii::app()->params['upload_dir']) . DIRECTORY_SEPARATOR . 'medium' . DIRECTORY_SEPARATOR . $file;
                $uploaded_avatar_large = Yii::getPathOfAlias('webroot.' . Yii::app()->params['upload_dir']) . DIRECTORY_SEPARATOR . $file;

                if ($file && file_exists($uploaded_avatar_thumb)) {
                    $avatar = Yii::getPathOfAlias('webroot.' . Yii::app()->params['avatar_dir']) . DIRECTORY_SEPARATOR . Yii::app()->user->avatar;

                    $img = imagecreatefromstring(file_get_contents($uploaded_avatar_thumb));
                    imagesavealpha($img, true);
                    imagepng($img, $avatar);

                    @unlink($uploaded_avatar_large);
                    @unlink($uploaded_avatar_medium);
                    @unlink($uploaded_avatar_thumb);
                }

                Utility::setFlash(Yii::t('yii', 'Your profile has been updated successfully.'), 'success');
            }
        }

        $this->render('update_profile', array(
            'model' => $model,
            'user' => $user,
        ));
    }

    public function actionProfile() {
        $username = Yii::app()->request->getParam('profile');

        if ($user = Usuario::model()->findByAttributes(array('username' => $username))) {
            $q = new CDbCriteria(array(
                'condition' => 't.is_active = 1 AND t.is_published = 1 AND t.user_fk = :user_id',
                'params' => array(':user_id' => $user->idusuario),
                'order' => 't.meme_id DESC',
            ));

            $memes = Meme::model()->findAll($q);

            $this->registerSharrre();

            $this->render('user_profile', array(
                'user' => $user,
                'memes' => $memes,
                'total_posts' => $count = Meme::model()->count($q),
            ));
        } else {
            throw new CHttpException(404, Yii::t('yii', 'User profile not found!'));
        }
    }

    public function actionFollow() {
        $user_fk = Yii::app()->request->getParam('id');
        if ($user_fk && !Yii::app()->user->checkAccess('ownId', $user_fk)) {
            $user = User::follow($user_fk);
            if ($user) {
                Utility::setFlash(Yii::t('yii', 'You are now following' . ' "' . $user->username . '"'), 'success');
            }
        } else {
            Utility::setFlash(Yii::t('yii', 'You can not follow yourself!'), 'error');
        }
        Yii::app()->request->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionUnfollow() {
        $user_fk = Yii::app()->request->getParam('id');
        if ($user_fk && !Yii::app()->user->checkAccess('ownId', $user_fk)) {
            $user = User::unfollow($user_fk);
            if ($user) {
                Utility::setFlash(Yii::t('yii', 'You have unfollowed' . ' "' . $user->username . '"'), 'success');
            }
        } else {
            Utility::setFlash(Yii::t('yii', 'You can not unfollow yourself!'), 'error');
        }
        Yii::app()->request->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionFlag() {
        $id = Yii::app()->request->getParam('id');
        if (!Meme::hasFlagged($id)) {
            $memeFlag = new MemeFlag();
            $memeFlag->user_fk = Yii::app()->user->getState('pk');
            $memeFlag->meme_fk = $id;
            $memeFlag->created_at = new CDbExpression('NOW()');
            $memeFlag->save();
        }
    }

    public function actionCms() {
        $slug = Yii::app()->request->getParam('slug');
        if ($page = Page::model()->active()->findByAttributes(array('slug' => $slug))) {
            $this->render('cms', array('page' => $page));
        } else {
            throw new CHttpException(404, Yii::t('yii', 'Page not found!'));
        }
    }

    public function actionMymemes() {
        $memes = Meme::model()->current_user()->findAll(array(
            'order' => 'meme_id desc'
        ));
        $this->render('my_memes', array(
            'memes' => $memes,
        ));
    }

}