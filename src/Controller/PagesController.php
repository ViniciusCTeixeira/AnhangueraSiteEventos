<?php
declare(strict_types=1);

namespace App\Controller;

use App\View\Helper\ToolHelper;
use Cake\Event\EventInterface;

class PagesController extends AppController
{
    public function initialize(): void{
        parent::initialize();
    }

    public function beforeFilter(EventInterface $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['index', 'whatsapp']);
    }

    public function beforeRender(EventInterface $event){
        parent::beforeRender($event);

    }

    public function index()
    {
        $toolhelper = new ToolHelper(new \Cake\View\View());

        $events = [['name' => 'Teste', 'description' => 'Testando o sistema', 'icon' => 'feature-icon fad fa-photo-video', 'day' => '27/05/2022'],['name' => 'Teste', 'description' => 'Testando o sistema', 'icon' => 'feature-icon fad fa-photo-video', 'day' => '27/05/2022'],['name' => 'Teste', 'description' => 'Testando o sistema', 'icon' => 'feature-icon fad fa-photo-video', 'day' => '27/05/2022'],['name' => 'Teste', 'description' => 'Testando o sistema', 'icon' => 'feature-icon fad fa-photo-video', 'day' => '27/05/2022']];
        $oldEvents = [['name' => 'Teste', 'description' => 'Testando o sistema', 'icon' => 'feature-icon fad fa-photo-video'],['name' => 'Teste', 'description' => 'Testando o sistema', 'icon' => 'feature-icon fad fa-photo-video'],['name' => 'Teste', 'description' => 'Testando o sistema', 'icon' => 'feature-icon fad fa-photo-video'],['name' => 'Teste', 'description' => 'Testando o sistema', 'icon' => 'feature-icon fad fa-photo-video']];
        $speeches = [['name' => 'IA', 'description' => 'Paletra para falar de IA', 'speaker' => 'Vinicius Teixeira', 'img' => '', 'day' => '27/05/2022'],['name' => 'IA', 'description' => 'Paletra para falar de IA', 'speaker' => 'Vinicius Teixeira', 'img' => '', 'day' => '27/05/2022']];
        $oldSpeeches = [['name' => 'IA', 'description' => 'Paletra para falar de IA', 'speaker' => 'Vinicius Teixeira', 'img' => '', 'day' => '27/05/2022'],['name' => 'IA', 'description' => 'Paletra para falar de IA', 'speaker' => 'Vinicius Teixeira', 'img' => '', 'day' => '27/05/2022']];
        $this->set(['events' => $events,'oldEvents' => $oldEvents, 'speeches' => $speeches, 'oldSpeeches' => $oldSpeeches]);
        $this->page_title = $toolhelper->getSalutation() . "!";
    }

    public function whatsapp($phone = NULL)
    {
        $phone = ($phone ?? '5521969749717');

        if ($this->request->is('mobile')) {
            header("Location: https://api.whatsapp.com/send?phone=" . $phone);
        } else {
            header("Location: https://web.whatsapp.com/send?phone=" . $phone);
        }

        die();
    }

    public function dashboard()
    {
        $this->viewBuilder()->setLayout('default-dashboard');
        $this->page_title = "Dashboard";
    }
}
