<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

class UsersController extends AppController
{
  private $roles = ['User' => 'User', 'Admin' => 'Admin', 'Disabled' => 'Disabled'];
  protected array $paginate = [
    'limit' => 30,
    'order' => ['first_name' => 'ASC', 'last_name' => 'ASC']
  ];

  /**
   * Display a list of records
   */
  public function index()
  {
    $query = $this->Users->find();
    $users = $this->paginate($query);
    $this->set(compact('users'));
  }

  /**
   * View a single record
   */    
  public function view($slug = null)
  {
    $query = $this->Users->findBySlug($slug);
    $user = $query->first();
    $this->set(compact('user'));
  }
  
  /**
   * Add a new record
   */
  public function add()
  {
    $user = $this->Users->newEmptyEntity();
    if ($this->request->is('post')) {
      $user = $this->Users->patchEntity($user, $this->request->getData());
      if ($this->Users->save($user)) {
        $this->Flash->success(__('The user has been saved.'));
        return $this->redirect(['action' => 'index']);
      } else {
        $this->Flash->error(__('The user could not be saved. Please, try again.'));
      }
    }
    $roles = $this->roles;
    $this->set(compact('user', 'roles'));
  }
  
  /**
   * Edit an existing record
   */  
  public function edit($id = null)
  {
    $user = $this->Users->get($id);
    if ($this->request->is(['patch', 'post', 'put'])) {
      if (empty($this->request->getData('password'))) {
        // if password is empty, unset password
        $data = $this->request->getData();
        unset($data['password']);
        $this->request = $this->request->withParsedBody($data);            
      }
      $user = $this->Users->patchEntity($user, $this->request->getData());
      if ($this->Users->save($user)) {
        $this->Flash->success(__('The user has been saved.'));
        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The user could not be saved. Please, try again.'));
    }
    $roles = $this->roles;
    $this->set(compact('user', 'roles'));
  }
  
  /**
   * Delete a record
   */  
  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $user = $this->Users->get($id);
    if ($this->Users->delete($user)) {
      $this->Flash->success(__('The user has been deleted.'));
    } else {
      $this->Flash->error(__('The user could not be deleted. Please, try again.'));
    }
    return $this->redirect(['action' => 'index']);
  }
}