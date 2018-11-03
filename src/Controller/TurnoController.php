<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Turno Controller
 *
 * @property \App\Model\Table\TurnoTable $Turno
 *
 * @method \App\Model\Entity\Turno[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TurnoController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $turnos = $this->Turno->find('all', [
            'contain' => ['Empleados', 'Horario']
        ]);
        
        $this->set([
            'turnos' => $turnos,
            '_serialize' => ['turnos']
        ]);    
        $this->RequestHandler->renderAs($this, 'json');
    }

    /**
     * View method
     *
     * @param string|null $id Turno id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $turno = $this->Turno->get($id, [
            'contain' => ['Empleados', 'Horario']
        ]);

        $this->set([
            'turno' => $turno,
            '_serialize' => ['turno']
        ]);
        
        $this->RequestHandler->renderAs($this, 'json'); 
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
            
            $turnoEmpleado = $this->Turno->find()->where(['id_empleado =' => $this->request->getData('id_empleado')])->toArray();
            if(empty($turnoEmpleado)){
            
                $turnos=$this->request->getData('id_turno');
                
                $finalTurnos = array();
                if(sizeof($turnos)==5){
                    foreach ($turnos as $horario) {
                        $turno = $this->Turno->newEntity();
                        $arrayHorario = Array('id_empleado' => $this->request->getData('id_empleado'), 'id_horario' => $horario);
                        $turno = $this->Turno->patchEntity($turno, $arrayHorario);
                        if ($this->Turno->save($turno)) {
                            $message = 'Saved';
                            array_push($finalTurnos, $turno);
                        } else {
                            $message = 'Error';
                        }
                    }
                }else{
                    $message = 'El Empleado debe cumplir 5 turnos de 8 horas';
                }
                $this->set([
                    'message' => $message,
                    'turno' => $finalTurnos,
                    '_serialize' => ['message', 'turno']
                ]);
            }else{
                $this->set([
                    'message' => 'El empleado ya tiene turnos asignados',
                    '_serialize' => ['message', 'turno']
                ]);
            }
        $this->RequestHandler->renderAs($this, 'json');
    }

    /**
     * Edit method
     *
     * @param string|null $id Turno id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
            $turno = $this->Turno->findById($id)->firstOrFail();            ;
            if ($this->request->is(['post', 'put', 'patch'])) {
                $turno = $this->Turno->patchEntity($turno, $this->request->getData());
                
                //die(print_r($turno, true));
                if ($this->Turno->save($turno)) {
                    $message = 'Saved';
                } else {
                    $message = 'Error';
                }
            }
            $this->set([
                'message' => $message,
                'turno' => $turno,
                '_serialize' => ['message', 'turno']
            ]);
        $this->RequestHandler->renderAs($this, 'json');
    }

    /**
     * Delete method
     *
     * @param string|null $id Turno id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $turno = $this->Turno->get($id);
        
        $message = 'Deleted';
        if (!$this->Turno->delete($turno)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
        $this->RequestHandler->renderAs($this, 'json');
    }
}
