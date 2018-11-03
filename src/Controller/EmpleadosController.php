<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Empleados Controller
 *
 * @property \App\Model\Table\EmpleadosTable $Empleados
 *
 * @method \App\Model\Entity\Empleado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmpleadosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        /*$empleados = $this->paginate($this->Empleados);

        $this->set(compact('empleados'));*/


        $empleados = $this->Empleados->find('all');
        $this->set([
            'empleados' => $empleados,
            '_serialize' => ['empleados']
        ]);    
        $this->RequestHandler->renderAs($this, 'json');    
    }

    /**
     * View method
     *
     * @param string|null $id Empleado id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $empleado = $this->Empleados->get($id, [
            'contain' => []
        ]);
        //$this->set('empleado', $empleado);
         $this->set([
                'empleado' => $empleado,
                '_serialize' => ['empleado']
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
            $empleado = $this->Empleados->newEntity();
            $empleado = $this->Empleados->patchEntity($empleado, $this->request->getData());
            if ($this->Empleados->save($empleado)) {
                $message = 'Saved';
            } else {
                $message = 'Error';
            }

            $this->set([
                'message' => $message,
                'empleado' => $empleado,
                '_serialize' => ['message', 'empleado']
            ]);

        $this->RequestHandler->renderAs($this, 'json');
    }

    /**
     * Edit method
     *
     * @param string|null $id Empleado id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {   
            $empleado = $this->Empleados->findById($id)->firstOrFail();            ;
            if ($this->request->is(['post', 'put', 'patch'])) {
                //die(print_r($this->request->getData(), true));
                //$empleado = $this->Users->patchEntity($empleado, $this->request->getData());
                $empleado->email = $this->request->getData('name');
  
                //die(print_r($empleado, true));
                if ($this->Empleados->save($empleado)) {
                    $message = 'Saved';
                } else {
                    $message = 'Error';
                }
            }
            $this->set([
                'message' => $message,
                'empleado' => $empleado,
                '_serialize' => ['message', 'empleado']
            ]);
        
        $this->RequestHandler->renderAs($this, 'json');
    }

    /**
     * Delete method
     *
     * @param string|null $id Empleado id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $empleado = $this->Empleados->get($id);
        
        $message = 'Deleted';
        if (!$this->Empleados->delete($empleado)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
        $this->RequestHandler->renderAs($this, 'json');
    }
}
