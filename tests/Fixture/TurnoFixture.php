<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TurnoFixture
 *
 */
class TurnoFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'turno';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'id_empleado' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_horario' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'turno_empleado_idx' => ['type' => 'index', 'columns' => ['id_empleado'], 'length' => []],
            'turno_horario_idx' => ['type' => 'index', 'columns' => ['id_horario'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'turno_empleado' => ['type' => 'foreign', 'columns' => ['id_empleado'], 'references' => ['empleados', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'turno_horario' => ['type' => 'foreign', 'columns' => ['id_horario'], 'references' => ['horario', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'id_empleado' => 1,
                'id_horario' => 1
            ],
        ];
        parent::init();
    }
}
