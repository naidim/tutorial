<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * PhoneNumbers Controller
 *
 * @property \App\Model\Table\PhoneNumbersTable $PhoneNumbers
 */
class PhoneNumbersController extends AppController
{
    private $types = ['C' => 'Cell', 'H' => 'Home', 'W' => 'Work'];
    protected array $paginate = [
      'limit' => 30,
    ];
  
    /**
     * Index method
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $query = $this->PhoneNumbers->find()
            ->contain(['Users']);
        $phoneNumbers = $this->paginate($query);

        $this->set(compact('phoneNumbers'));
    }

    /**
     * View method
     */
    public function view($id = null)
    {
        $phoneNumber = $this->PhoneNumbers->get($id);
        $this->set(compact('phoneNumber'));
    }

    /**
     * Add method
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        $phoneNumber = $this->PhoneNumbers->newEmptyEntity();
        if ($this->request->is('post')) {
            $phoneNumber = $this->PhoneNumbers->patchEntity($phoneNumber, $this->request->getData());
            if ($this->PhoneNumbers->save($phoneNumber)) {
                $this->Flash->success(__('The phone number has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The phone number could not be saved. Please, try again.'));
        }
        $types = $this->types;
        $this->set(compact('phoneNumber', 'types'));
    }

    /**
     * Edit method
     */
    public function edit($id = null)
    {
        $this->Authorization->skipAuthorization();
        $phoneNumber = $this->PhoneNumbers->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $phoneNumber = $this->PhoneNumbers->patchEntity($phoneNumber, $this->request->getData());
            if ($this->PhoneNumbers->save($phoneNumber)) {
                $this->Flash->success(__('The phone number has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The phone number could not be saved. Please, try again.'));
        }
        $this->set(compact('phoneNumber'));
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        $phoneNumber = $this->PhoneNumbers->get($id);
        if ($this->PhoneNumbers->delete($phoneNumber)) {
            $this->Flash->success(__('The phone number has been deleted.'));
        } else {
            $this->Flash->error(__('The phone number could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
