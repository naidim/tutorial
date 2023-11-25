<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\View\JsonView;
use App\Controller\AppController;

class UsersController extends AppController
{
  private $roles = ['User' => 'User', 'Admin' => 'Admin', 'Disabled' => 'Disabled'];
  protected array $paginate = [
    'limit' => 30,
    'order' => ['first_name' => 'ASC', 'last_name' => 'ASC']
  ];

  public function viewClasses(): array
  {
    return [JsonView::class];
  }

  public function beforeFilter(\Cake\Event\EventInterface $event)
  {
    parent::beforeFilter($event);
    // Configure the login action to not require authentication,
    // preventing the infinite redirect loop issue
    $this->Authentication->addUnauthenticatedActions(['login', 'logout', 'password', 'resetPassword', 'fetch']);
  }

  public function login()
  {
    $this->Authorization->skipAuthorization();
    $this->request->allowMethod(['get', 'post']);
    $result = $this->Authentication->getResult();
    // regardless of POST or GET, redirect if user is logged in
    if ($result && $result->isValid()) {
      $user = $this->Authentication->getIdentity();
      if ($user->getOriginalData()->is_disabled) {
        $this->redirect([
          'controller' => 'Users',
          'action' => 'logout',
        ]);
      }
      $this->Flash->success('You are logged in as ' . $user->full_name);
      // redirect to /users after login success
      $redirect = $this->request->getQuery('redirect', [
        'controller' => 'Users',
        'action' => 'index',
      ]);
      return $this->redirect($redirect);
    }
    // display error if user submitted and authentication failed
    if ($this->request->is('post') && !$result->isValid()) {
      $this->Flash->error(__('Invalid username or password.'));
    }
  }

  public function logout()
  {
    $this->Authorization->skipAuthorization();
    $result = $this->Authentication->getResult();
    if ($result && $result->isValid()) {
      $this->Authentication->logout();
      $this->Flash->success('You are now logged out.');
      return $this->redirect(['controller' => 'Users', 'action' => 'login']);
  	}
    return $this->redirect(['action' => 'index']);
  }

  /**
   * Display a list of records
   */
  public function index()
  {
    $this->Authorization->skipAuthorization();
    $query = $this->Users->find();
    $users = $this->paginate($this->Authorization->applyScope($query));
//    $users = $this->paginate($query);
    $this->set(compact('users'));
  }

  /**
   * View a single record
   */    
  public function view($slug = null)
  {
    $this->Authorization->skipAuthorization();
    $query = $this->Users->findBySlug($slug)
      ->contain(['PhoneNumbers', 'Documents']); // Contains the related data
    $user = $query->first();
    $this->set(compact('user'));
  }

  /**
   * Fetch a user as JSON
   */
  public function fetch($id = null)
  {
    $this->Authorization->skipAuthorization();
    // If ajax request, use ajax layout
    if ($this->request->is('ajax')) {
      $this->viewBuilder()->setClassName('Ajax');
    }
    if (empty($id)) {
      $id = $this->request->getQuery('id');
    }
    $data = $this->Users->find()
      ->where(['id' => $id])
      ->select('dob')
      ->first();
    $this->set(compact('data'));
    // Serialize our data
    $this->viewBuilder()->setOption('serialize', ['data']);
  }
  
  /**
   * Add a new record
   */
  public function add()
  {
    $user = $this->Users->newEmptyEntity();
    $this->Authorization->authorize($user);
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
    $this->Authorization->authorize($user);
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
    $this->Authorization->authorize($user);
    if ($this->Users->delete($user)) {
      $this->Flash->success(__('The user has been deleted.'));
    } else {
      $this->Flash->error(__('The user could not be deleted. Please, try again.'));
    }
    return $this->redirect(['action' => 'index']);
  }
}