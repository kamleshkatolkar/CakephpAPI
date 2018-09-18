<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Cache\Cache;
class TopicsController extends AppController
{

public function initialize()
    {

        parent::initialize();
		$this->loadComponent('RequestHandler');
				
    }


public function index()
    {
		// find('all') get all records from Topics model
		// We uses set() to pass data to view 
		$topics = $this->Topics->find('all');
		$this->set([
					'topics'=>$topics,
					'_serialize'=>['topics']
					]);
		
    }

public function view($id)
    {
		// get() method get only one topic record using 
		// the $id paraameter is received from the requested url
		// if request is /topics/view/5   the $id parameter value is 5
		// if request is /topics/view/5.json   the $id parameter value is 5
        $topic = $this->Topics->get($id);

		$this->set([
			'topic'=>$topic,
			'_serialize'=>['topic']
			]);
    }

public function add()
    {
        $topic = $this->Topics->newEntity();
		//if the user topics data to your application, the POST request  informations are registered in $this->request   
if ($this->request->is('post')) { // 
            $topic = $this->Topics->patchEntity($topic, $this->request->data);
			$topic->user_id = $this->Auth->user('id');
if ($this->Topics->save($topic)) {

				$message = 'Topic saved';
}else{
				$message = 'Error1';
			}
        }
		$this->set([
			'message' => $message,
			'topic' => $topic,
			'_serialize' => ['message', 'topic']
		]);
    }
	public function edit($id = null)
	{
		$topic = $this->Topics->get($id);
		if ($this->request->is(['post', 'put'])) {
			$this->Topics->patchEntity($topic, $this->request->data);
			if ($this->Topics->save($topic)) {
				$message = "Topic updated";
			}else{
				$message = "Error2";
			}
		}
	
		$this->set([
				'message'=>$message,
				'topic'=>$topic,
				'_serialize'=>['message','topic']
				]);
	}
	public function delete($id)
	{
		//if user wants to delete a record by a GET request ,allowMethod() method give an Exception as the only available request for deleting is POST or delete for Rest http request
		$this->request->allowMethod(['post', 'delete']);
	
		$topic = $this->Topics->get($id);
		if ($this->Topics->delete($topic)) {

			$message = 'Topic deleted';
		}else{
			$message = 'Error3';	
		}
		$this->set([
			'message'=>$message,
			'_serialize'=>['message']
		]);
	}
}
?>