<?php
declare(strict_types=1);

namespace App\Controller;

use App\View\Helper\ToolHelper;
use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use Cake\Routing\Router;

class AppController extends Controller
{
    public $og_url = '';
    public $og_type = '';
    public $og_site_name = '';
    public $og_title = '';
    public $og_description = '';
    public $og_image = '';

    public $page_title = '';
    public $page_description = '';
    public $page_icon = '';

    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => FALSE
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginRedirect' => ['controller' => 'Pages', 'action' => 'myUser'],
            'logoutRedirect' => ['controller' => 'Pages', 'action' => 'index'],
            'loginAction' => ['controller' => 'Users', 'action' => 'login'],
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email', 'password' => 'password'],
                    'userModel' => 'Users'
                ]
            ],
            'authError' => 'Efetue o login para acessar está área.',
            'authorize' => ['Controller'],
        ]);

        $this->og_url = SITE_URL;
        $this->og_type = 'website';
        $this->og_site_name = 'Anhanguera - Eventos';
        $this->og_title = 'Anhanguera - Eventos';
        $this->og_description = 'Eventos, Palestras.';
        $this->og_image = $this->og_url . 'img/logo-share.png';
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        if (SITE_ENVIRONMENT === NULL) {
            header("location: https://eventos-anhanguera.tk");
            exit;
        }
    }

    public function isAuthorized($user): bool
    {
        return true;
    }

    public function beforeRender(EventInterface $event)
    {
        parent::beforeRender($event);

        $this->set(
            [
                'urlReferer' => $this->referer(),
                'urlProject' => Router::url([], TRUE),
                'og_url' => $this->og_url,
                'og_type' => $this->og_type,
                'og_site_name' => $this->og_site_name,
                'og_title' => $this->og_title,
                'page_title' => $this->page_title,
                'page_description' => $this->page_description,
                'page_icon' => $this->page_icon,
            ]
        );
    }

    public function onlyAdmin($redirect = ['controller' => 'Pages', 'action' => 'myUser'])
    {
        if ($this->getRequest()->getSession()->check('Auth.User.id') && $this->getRequest()->getSession()->read('Auth.User.role') !== 1) {

            $msg = 'Acesso indisponível para o seu usuário.';

            if ($this->request->is(['ajax'])) {

                $params = ['success' => FALSE, 'msg' => $msg];

                header('Content-type: application/json');
                echo json_encode($params);
                exit;
            } else {
                $this->Flash->error($msg);

                return $this->redirect(Router::url($redirect, TRUE));
            }
        }

        return TRUE;
    }

    public function getColor($start = 0x000000, $end = 0xFFFFFF)
    {
        $toolhelper = new ToolHelper(new \Cake\View\View());

        return $toolhelper->getColor($start, $end);
    }
}
