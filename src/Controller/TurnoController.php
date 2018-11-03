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

        $this->set('turno', $turno);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
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
            }
            $this->set([
                'message' => $message,
                'turno' => $finalTurnos,
                '_serialize' => ['message', 'turno']
            ]);
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
        $turno = $this->Turno->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $turno = $this->Turno->patchEntity($turno, $this->request->getData());
            if ($this->Turno->save($turno)) {
                $this->Flash->success(__('The turno has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The turno could not be saved. Please, try again.'));
        }
        $empleados = $this->Turno->Empleados->find('list', ['limit' => 200]);
        $horario = $this->Turno->Horario->find('list', ['limit' => 200]);
        $this->set(compact('turno', 'empleados', 'horario'));
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
        $this->request->allowMethod(['post', 'delete']);
        $turno = $this->Turno->get($id);
        if ($this->Turno->delete($turno)) {
            $this->Flash->success(__('The turno has been deleted.'));
        } else {
            $this->Flash->error(__('The turno could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
