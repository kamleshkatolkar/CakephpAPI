<?php
namespace App\Model\Table;
use App\Model\Entity\Extension;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Extensions Model
 *
 * @method \App\Model\Entity\Extension get($primaryKey, $options = [])
 * @method \App\Model\Entity\Extension newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Extension[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Extension|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Extension|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Extension patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Extension[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Extension findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ExtensionsTable extends Table
{
   
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('extensions');
        $this->setDisplayField('extension_no');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Search');
        $this->belongsTo('Employees', [
            'foreignKey' => 'id'
        ]);
        
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('extension_no')
            ->requirePresence('extension_no', 'create')
            ->notEmpty('extension_no');

        return $validator;
    }
}
