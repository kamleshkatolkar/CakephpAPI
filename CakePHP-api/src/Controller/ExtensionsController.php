<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class ExtensionsController extends AppController
{
use \Crud\Controller\ControllerTrait;
// public $paginate = [
//        'page' => 1,
//        'limit' => 10,
//        'maxLimit' => 10,
//    ];
//
public function index()
    {
    $action = $this->Crud->action();
    $action->setConfig('scaffold.site_title', 'CRUD task');
    $action->setConfig('scaffold.fields_blacklist', ['created', 'modified']);
    $action->setConfig('scaffold.fields', [
    'extension_no',
    'active' => [
        'formatter' => function ($name, $value, $entity) {
             return $value == 'Y' ? $value : 'N';
        }
    ],
]);
        return $this->Crud->execute();
    }
    
    public function add()
    {
//        $this->Crud->on('beforePaginate', function(Event $event) {
//        $event->subject->query = $event->subject->query->find('search', $this->request->getQuery());
//        });
    $action = $this->Crud->action();
     $action->setConfig('scaffold.fields', [
    'extension_no' => [
        'type' => 'text'
    ],
    'active' => [
        'checked' => '',
        'value'=> 'Y'
    ]
    ]);
    $action->setConfig('scaffold.fields_blacklist', ['created', 'modified']);
        return $this->Crud->execute();
    }
    
    public function edit($id)
    {
//        $this->Crud->on('beforePaginate', function(Event $event) {
//        $event->subject->query = $event->subject->query->find('search', $this->request->getQuery());
//        });
    $extensionsTable = TableRegistry::get('Extensions');
    $extensionsData = $extensionsTable->find('all', array('fields' => array('id', 'extension_no', 'active'), 'conditions' => array('id' => $id)))->first()->toArray();
    $checked =  $extensionsData['active'] == 'Y' ? 'checked' : "";
    $action = $this->Crud->action();
    $action->setConfig('scaffold.fields', [
    'extension_no' => [
        'type' => 'text'
    ],
    'active' => [
        'checked' =>  $checked,
        'value'=> 'Y'
    ]
    ]);
    $action->setConfig('scaffold.fields_blacklist', ['created', 'modified']);
        return $this->Crud->execute();
    }
 
//public function lookup()
//{
//	$this->Crud->action()->enabled();	
//    $this->Crud->on('afterLookup', function(\Cake\Event\Event $event) {
//        foreach ($event->getSubject()->entities as $entity) {
//            // $entity is an entity
//        }
//    });
//
//    return $this->Crud->execute();
//}

 
}

?>
