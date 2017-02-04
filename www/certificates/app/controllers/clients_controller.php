<?php
class ClientsController extends AppController {

	var $name = 'Clients';
	//var $paginate = array("limit" => 10);
	var $components = array('Auth');
	
	function index() {
		$this->Client->recursive = 0;
		$this->set('clients', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Cliente inexistente.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('client', $this->Client->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Client->create();
			if ($this->Client->save($this->data)) {
				$this->Session->setFlash(__('O cliente foi salvo com sucesso!', true));
				$this->redirect(array('action' => '../clients/find'));
			} else {
				$this->Session->setFlash(__('Ocorreu algum problema ao tentar salvar o cliente. Tente novamente.', true));
			}
		}
		$courses = $this->Client->Course->find('list',array('fields' => array('nome')));
		$this->set(compact('courses'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid client', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Client->save($this->data)) {
				$this->Session->setFlash(__('O cliente foi salvo com sucesso!', true));
				//print_r($this->data);
				$this->redirect(array('action' => 'view/' . $this->data['Client']['id']));
			} else {
				$this->Session->setFlash(__('Ocorreu algum problema ao tentar salvar o cliente. Tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Client->read(null, $id);
		}
		$courses = $this->Client->Course->find('list');
		$this->set(compact('courses'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Cliente inexistente.', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Client->delete($id)) {
			$this->Session->setFlash(__('Cliente removido.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('O cliente nao pode ser removido.', true));
		$this->redirect(array('action' => 'index'));
	}
	

    function viewPdf($id, $id_course, $id_client) { 
        if (!$id) 
        {
            $this->Session->setFlash('Sorry, there was no property ID submitted.'); 
            $this->redirect(array('action'=>'index'), null, true); 
        }
        //Configure::write('debug',0); // Otherwise we cannot use this method while developing 

        $id = intval($id); 

        $property = $this->Client->Course->findById($id); // here the data is pulled from the database and set for the view
		
		//echo "<pre>";
		//print_r($property);
		//echo "</pre>";
		
		$this->set("dados",$property);

        if (empty($property)) 
        { 
            $this->Session->setFlash('Sorry, there is no property with the submitted ID.'); 
            $this->redirect(array('action'=>'index'), null, true); 
        } 

        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
        $this->render(); 
    }
	
	function find() {

		//if(!empty($this->data)) {
			//$this->set('dados',$this->Client->findByNome("%" . $this->data['Clients']['nome'] . "%"));
			$this->set('dados', $this->Client->query("SELECT * FROM clients WHERE nome LIKE '%".$this->data['Clients']['nome']."%'  ORDER BY id DESC LIMIT 10"));
		//}
	}
}
?>