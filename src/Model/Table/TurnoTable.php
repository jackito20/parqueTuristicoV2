<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Turno Model
 *
 * @method \App\Model\Entity\Turno get($primaryKey, $options = [])
 * @method \App\Model\Entity\Turno newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Turno[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Turno|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Turno|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Turno patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Turno[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Turno findOrCreate($search, callable $callback = null, $options = [])
 */
class TurnoTable extends Table
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

        $this->setTable('turno');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Empleados', [
            'foreignKey' => 'id_empleado',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Horario', [
            'foreignKey' => 'id_horario',
            'joinType' => 'INNER'
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
            ->nonNegativeInteger('id')
            ->allowEmpty('id', 'create');

        $validator
            ->nonNegativeInteger('id_empleado')
            ->requirePresence('id_empleado', 'create')
            ->notEmpty('id_empleado');

        $validator
            ->nonNegativeInteger('id_horario')
            ->requirePresence('id_horario', 'create')
            ->notEmpty('id_horario');

        return $validator;
    }
}
