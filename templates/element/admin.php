<div class="content">
<?php
  $identity = $this->getRequest()->getAttribute('identity');
  if (empty($identity)) {
    echo $this->Html->link(__('Login'), ['controller' => 'users', 'action' => 'login']);
  } else {
    echo 'Welcome ' . $this->Html->link($identity->get('full_name'), ['controller' => 'Users', 'action' => 'view', $identity->get('slug')]) . ' : ' . $this->Html->link(__('logout'), ['controller' => 'users', 'action' => 'logout']);
  }
?></div>