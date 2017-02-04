<?php
class CoursesController extends AppController {

	var $name = 'Courses';
	var $components = array('Auth');

	function index() {
		$this->Course->recursive = 0;
		$this->set('courses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Curso invalido.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('course', $this->Course->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Course->create();
			if ($this->Course->save($this->data)) {
				$this->Session->setFlash(__('O curso foi salvo com sucesso!', true));
				$this->redirect(array('action' => '../clients/find'));
			} else {
				$this->Session->setFlash(__('Ocorreu algum problema ao tentar salvar o curso. Tente novamente.', true));
			}
		}
		$clients = $this->Course->Client->find('list', array('fields' => array('nome')));
		$this->set(compact('clients'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid course', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Course->save($this->data)) {
				$this->Session->setFlash(__('O curso foi salvo com sucesso!', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Ocorreu algum problema ao tentar salvar o curso. Tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Course->read(null, $id);
		}
		$clients = $this->Course->Client->find('list');
		$this->set(compact('clients'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Curso inexistente.', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Course->delete($id)) {
			$this->Session->setFlash(__('Deletado com sucesso!', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Erro ao tentar remover o curso.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>