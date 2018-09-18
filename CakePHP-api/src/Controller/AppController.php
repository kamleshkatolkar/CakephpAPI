<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler', [
            'viewClassMap' => ['csv' => 'CsvView.Csv'],
             'enableBeforeRedirect' => false,
        ]);
        
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->viewClass = 'CrudView\View\CrudView';
        $this->loadComponent('Crud.Crud', [
            'actions' => [
                'Crud.Index',
                'Crud.View',
                'Crud.Add',
                'Crud.Edit',
                'Crud.Delete',
                'Crud.Lookup',
            ],
            'listeners' => [
                'CrudView.View',
                'Crud.Redirect',
                'Crud.RelatedModels',
                'Crud.Search',
                'CrudView.ViewSearch',
                'Crud.Api',
                'Crud.ApiQueryLog',
            ]
        ]);
        $this->loadComponent('Search.Prg', [
            'actions' => ['index', 'lookup']
        ]);
    }

    public function beforeFilter(Event $event) {
        $this->Crud->action()->setConfig('scaffold.tables_blacklist', [
            'cities', 'locals', 'states'
        ]);
         $this->Crud->action()->setConfig('scaffold.utility_navigation', false);
        return parent::beforeFilter($event);
    }

}
