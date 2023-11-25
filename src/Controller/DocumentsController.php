<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\BadRequestException;

/**
 * Documents Controller
 *
 * @property \App\Model\Table\DocumentsTable $Documents
 */
class DocumentsController extends AppController
{
    /**
     * Index method
     */
    public function index()
    {
        $query = $this->Documents->find()
            ->contain(['Users']);
        $documents = $this->paginate($query);

        $this->set(compact('documents'));
    }

    /**
     * Add method
     */
    public function add($user_id = null)
    {
        if (is_null($user_id)) { // Documents MUST be attached to a user 
            $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }
        $document = $this->Documents->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $file = $this->request->getUploadedFile('file');
            if ($file->getError() == 0) {
                $fileExtension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);
                // Only allow gif, png, or jpgs
                if (!in_array($fileExtension, ['gif', 'png', 'jpg', 'jpeg', 'jfif'])) {
                    $this->Flash->error('Invalid file type. Only upload JPG, PNG, or GIF files.');
                    return $this->redirect(['action' => 'add', $user_id]);
                }               
                // timestamp files to prevent clobber, replace spaces
                $filename = time() . '-' . str_replace(' ', '_', $file->getClientFilename());
                $destination = WWW_ROOT . 'files' . DS . $filename; 
                $file->moveTo($destination);
                $data['filename'] = $filename;
                $this->request = $this->request->withParsedBody($data);
                $document = $this->Documents->patchEntity($document, $this->request->getData());
                if ($this->Documents->save($document)) {
                    $this->Flash->success(__('The document has been saved.'));
                    $user = $this->Documents->Users->get($user_id);
                    return $this->redirect(['controller' => 'Users', 'action' => 'view', $user->slug]);
                } else {
                    $this->Flash->error(__('The document could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error('Error uploading file. Please try again.');
            }
        }
        $this->set(compact('document', 'user_id'));
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $document = $this->Documents->get($id, ['contain' => 'Users']);
        // Delete the file
        $filePath = WWW_ROOT . 'files' . DS . $document->filename;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        if ($this->Documents->delete($document)) {
            $this->Flash->success(__('The document has been deleted.'));
        } else {
            $this->Flash->error(__('The document could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller' => 'Users', 'action' => 'view', $document->user->slug]);
    }
}
