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
        $query = $this->PhoneNumbers->find()
            ->contain(['Users']);
        $phoneNumbers = $this->paginate($query);

        $this->set(compact('phoneNumbers'));
    }

    /**
     * Add method
     */
    public function add($user_id = null)
    {
        $phoneNumber = $this->PhoneNumbers->newEmptyEntity();
        $phoneNumber->user_id = $user_id;
        $this->Authorization->authorize($phoneNumber);
        if ($this->request->is('post')) {
            $phoneNumber = $this->PhoneNumbers->patchEntity($phoneNumber, $this->request->getData());
            if ($this->PhoneNumbers->save($phoneNumber)) {
                $this->Flash->success(__('The phone number has been saved.'));
                $user = $this->PhoneNumbers->Users->get($user_id);
                return $this->redirect(['controller' => 'users', 'action' => 'view', $user->slug]);
            }
            $this->Flash->error(__('The phone number could not be saved. Please, try again.'));
        }
        if ($user_id) {
            $users = $this->PhoneNumbers->Users->find('list')->where(['id' => $user_id])->all();
        } else {
            $users = $this->PhoneNumbers->Users->find('list', ['limit' => 200, 'order' => ['first_name', 'last_name']])->all();
        }
        $types = $this->types;
        $this->set(compact('phoneNumber', 'types', 'users'));
    }

    /**
     * Edit method
     */
    public function edit($id = null)
    {
        $phoneNumber = $this->PhoneNumbers->get($id, ['contain' => ['Users']]);
        $this->Authorization->authorize($phoneNumber);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $phoneNumber = $this->PhoneNumbers->patchEntity($phoneNumber, $this->request->getData());
            if ($this->PhoneNumbers->save($phoneNumber)) {
                $this->Flash->success(__('The phone number has been saved.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'view', $phoneNumber->user->slug]);
            }
            $this->Flash->error(__('The phone number could not be saved. Please, try again.'));
        }
        $users = $this->PhoneNumbers->Users->find('list')->where(['id' => $phoneNumber->user_id])->all();
        $types = $this->types;
        $this->set(compact('phoneNumber', 'users', 'types'));
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $phoneNumber = $this->PhoneNumbers->get($id, [
            'contain' => ['Users'],
        ]);
        $this->Authorization->authorize($phoneNumber);
        if ($this->PhoneNumbers->delete($phoneNumber)) {
            $this->Flash->success(__('The phone number has been deleted.'));
        } else {
            $this->Flash->error(__('The phone number could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller' => 'Users', 'action' => 'view', $phoneNumber->user->slug]);
    }
}
