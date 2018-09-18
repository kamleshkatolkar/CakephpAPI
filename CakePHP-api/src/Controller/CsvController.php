<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class CsvController extends AppController
{
     
     public function index() {
		$this->response->withDownload('export.csv');
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
                echo "<pre>"; print_r($data); die('test');
                $_serialize = 'data';
                $_header = array('Employee ID', 'First Name', 'Last Name', 'Department' , 'Extension');
   		$this->set(compact('data', '_serialize','_header'));
		$this->viewBuilder()->setClassName('CsvView.Csv');
		return;
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
