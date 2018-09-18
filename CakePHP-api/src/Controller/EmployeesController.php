<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Cache\Cache;


class EmployeesController extends AppController {
use \Crud\Controller\ControllerTrait;
// public $paginate = [
//        'page' => 1,
//        'limit' => 10,
//        'maxLimit' => 10,
//    ];
    


public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Crud->on('relatedModel', function(\Cake\Event\Event $event) {
            if ($event->getSubject()->association->getName() === 'Departments') {
                $event->getSubject()->query->where(['active' => 'Y']);
            }
            if ($event->getSubject()->association->getName() === 'Extensions') {
                $event->getSubject()->query->where(['active' => 'Y']);
            }
        });

    }
    public function index() {
//        $this->Crud->on('beforePaginate', function(Event $event) {
//        $event->subject->query = $event->subject->query->find('search', $this->request->getQuery());
//        });
        $action = $this->Crud->action();
        $action->setConfig('scaffold.fields_blacklist', ['DOB', 'DOJ', 'created', 'modified']);
        $action->setConfig('scaffold.relations', ['Departments', 'Extensions']);
        // only show the id, title, and created fields for csv output
        if ($this->request->getParam('_ext') === 'csv') {
            $employeesTable = TableRegistry::get('Employees');
                $query = $employeesTable->find('all',array(
                                                    'fields' => array('Employees.id','Employees.first_name','Employees.last_name','Extensions.extension_no','Departments.title')
                    ))
                ->contain(['Extensions', 'Departments']);
               
                $data_arr = $query->toArray();
                $index = 0;
                $data =  array();
                foreach($data_arr as $row){
                    $d =  array();
                    array_push($d, $row->id);
                    array_push($d, $row->first_name);
                    array_push($d, $row->last_name);
                    array_push($d, $row->department->title);
                    array_push($d, $row->extension->extension_no);
                    array_push($data, $d);
                }
                $_serialize = 'data';
                $_header = array('Employee ID', 'First Name', 'Last Name', 'Department' , 'Extension');
   		$this->set(compact('data', '_serialize','_header'));
                
            }

        $this->Crud->action()->setConfig('scaffold.index_formats', [
            [
                'title' => 'CSV',
                'url' => ['_ext' => 'csv', '?' => $this->request->getQueryParams()]
            ],
        ]); 
        return $this->Crud->execute();
    }
    
    public function add() {

//        $this->Crud->on('beforePaginate', function(Event $event) {
//        $event->subject->query = $event->subject->query->find('search', $this->request->getQuery());
//        });

        $action = $this->Crud->action();
        $action->setConfig('scaffold.fields_blacklist', ['created', 'modified']);
        $action->setConfig('scaffold.relations', ['Departments', 'Extensions']);
        $this->Crud->on('beforeSave', function(\Cake\Event\Event $event) {
                  $data = $this->request->getData();
                  $event->getSubject()->entity->departments_id = $data['departments_id'];
                  $event->getSubject()->entity->extensions_id = $data['extensions_id'];
             });
        $action->setConfig('scaffold.field_settings', [
            'active' => [
                'type' => 'checkbox',
            ],
            'gender' => [
                'type' => 'select',
                'options'=>array('Male'=>'Male','Female'=>'Female'),
            ]
        ]);

        return $this->Crud->execute();
    }

    public function edit($id) {
//        $this->Crud->on('beforePaginate', function(Event $event) {
//        $event->subject->query = $event->subject->query->find('search', $this->request->getQuery());
//        });
        $employeesTable = TableRegistry::get('Employees');
        $employeesData = $employeesTable->find('all', array('fields' => array('active','gender'), 'conditions' => array('id' => $id)))->first()->toArray();
        $checked =  $employeesData['active'] == 'Y' ? 'checked' : "";
        $selected =  $employeesData['gender'];
        $action = $this->Crud->action();
         
        $action->setConfig('scaffold.field_settings', [
            'active' => [
                'type' => 'checkbox',
                'checked'=>$checked
            ],
            'gender' => [
                'type' => 'select',
                'options'=>array('Male'=>'Male','Female'=>'Female'),
                'selected'=>$selected,
            ]
        ]);
        
        $action->setConfig('scaffold.relations', ['Departments', 'Extensions']);
        $action->setConfig('scaffold.fields_blacklist', ['created', 'modified']);
        
         $this->Crud->on('beforeSave', function(\Cake\Event\Event $event) {
                  $data = $this->request->getData();
                  $event->getSubject()->entity->departments_id = $data['departments_id'];
                  $event->getSubject()->entity->extensions_id = $data['extensions_id'];
             });
          
        return $this->Crud->execute();
    }

 
public function lookup()
{
	$this->Crud->action()->enabled();	
    $this->Crud->on('afterLookup', function(\Cake\Event\Event $event) {
        foreach ($event->getSubject()->entities as $entity) {
            // $entity is an entity
        }
    });

    return $this->Crud->execute();
}
}

?>
