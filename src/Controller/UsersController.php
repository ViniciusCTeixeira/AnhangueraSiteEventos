<?php
declare(strict_types=1);

namespace App\Controller;

use App\View\Helper\ToolHelper;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

class UsersController extends AppController
{
    public function initialize(): void{
        parent::initialize();
    }

    public function beforeFilter(EventInterface $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['logout', 'register']);
    }

    public function beforeRender(EventInterface $event){
        parent::beforeRender($event);

    }

    public function index()
    {
        $this->onlyAdmin();

        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    public function view($id = null)
    {
        $this->onlyAdmin();

        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
    }

    public function myUser()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    public function register()
    {
        if ($this->request->is('post')) {
            $toolhelper = new ToolHelper(new \Cake\View\View());
            $this->Participants = TableRegistry::getTableLocator()->get('Participants');

            $name = $this->request->getData('name');
            $email = $this->request->getData('email');
            $email = $toolhelper->strtolower(trim($email));
            $password = $this->request->getData('password');

            $cpf = $toolhelper->formatCPFCNPJ($this->request->getData('cpf'), false);
            $ra = $toolhelper->returnOnlyNumbers($this->request->getData('ra'));

            $isStudent = $this->request->getData('isStudent');

            //- ----------------------------------------------------------------------------------------------------
            //- Form validation

            if (empty($name)) {
                $validationForm = 'Informe seu nome.';
            }

            if (empty($email)) {
                $validationForm = 'Informe seu e-mail.';
            }

            if (empty($password)) {
                $validationForm = 'Informe uma senha.';
            }

            if (empty($cpf)) {
                $validationForm = 'Informe seu CPF.';
            }

            if (!empty($cpf) && !$toolhelper->validCPF($cpf)){
                $validationForm = 'Informe um CPF valido.';
            }

            if (empty($ra) && $isStudent) {
                $validationForm = 'Informe seu RA.';
            }

            if (!empty($validationForm)) {
                $returnRequest['success'] = FALSE;
                $returnRequest['title'] = 'Verifique o formulário';
                $returnRequest['msg'] = $validationForm;

                header('Content-type: application/json');
                echo json_encode($returnRequest);
                exit;
            }
            //- ----------------------------------------------------------------------------------------------------
            $existEmail = $this->Users->exists(['Users.email' => $email]);
            if ($existEmail) {

                $params = ['success' => FALSE, 'title' => 'Este e-mail já foi cadastrado', 'msg' => 'Se esqueceu a sua senha, utilize a opção esqueci minha senha.'];

                header('Content-type: application/json');
                echo json_encode($params);
                exit;
            }

            $existCPF = $this->Participants->exists(['Participants.cpf' => $cpf]);
            if ($existCPF) {

                $params = ['success' => FALSE, 'title' => 'Este CPF já foi cadastrado', 'msg' => 'Se esqueceu a sua senha, utilize a opção esqueci minha senha.'];

                header('Content-type: application/json');
                echo json_encode($params);
                exit;
            }

            $formUser = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role' => 0
            ];

            $user = $this->Users->newEmptyEntity();
            $this->Users->patchEntity($user, $formUser);
            if ($this->Users->save($user)) {
                $formParticipant = [
                    'name' => $name,
                    'email' => $email,
                    'cpf' => $cpf,
                    'ra' => ($isStudent) ? $ra : null,
                    'type' => (empty($ra)) ? 1 : 0,
                    'user_id' => $user->id
                ];

                $participant = $this->Participants->newEmptyEntity();
                $this->Participants->patchEntity($participant, $formParticipant);
                if($this->Participants->save($participant)){
                    $this->Auth->setUser($user);

                    $params = ['success' => TRUE, 'title' => 'Seja bem-vindo', 'msg' => 'Clique no Ok para começarmos.', 'redirect' => Router::url(['controller' => 'Pages', 'action' => 'dashboard'], TRUE)];
                }else{
                    $params = ['success' => FALSE, 'title' => 'Algo de errado aconteceu', 'msg' => 'Por favor, tente novamente.'];

                    $this->Users->delete($user);
                }
            } else {
                $params = ['success' => FALSE, 'title' => 'Algo de errado aconteceu', 'msg' => 'Por favor, tente novamente.'];
            }

            header('Content-type: application/json');
            echo json_encode($params);
            exit;
        }
    }

    public function edit()
    {
        $user = $this->Users->get($this->getRequest()->getSession()->check('Auth.User.id'));
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(['user' => $user]);
    }

    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($this->getRequest()->getSession()->check('Auth.User.id'));
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        //- se já estiver logado
        if ($this->getRequest()->getSession()->check('Auth.User.id')) {
            return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
        }

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {

                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->warning("Dados de acesso inválidos.");
            }
        }

        //- SEO
        $this->og_title = 'Login | ' . $this->og_title;
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}
