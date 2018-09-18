<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class PostsController extends AppController
{

 public $paginate = [
        'page' => 1,
        'limit' => 10,
        'maxLimit' => 10,
    ];

public function index()
    {
        $this->Crud->on('beforePaginate', function(Event $event) {
        $event->subject->query = $event->subject->query->find('search', $this->request->getQuery());
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
