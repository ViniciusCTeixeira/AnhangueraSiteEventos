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

        $events = [];
        $speeches = [];
        $this->set(['events' => $events, 'speeches' => $speeches]);
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
