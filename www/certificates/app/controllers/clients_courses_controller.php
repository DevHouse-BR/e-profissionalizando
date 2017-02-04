<?php
class ClientsCoursesController extends AppController {

	var $name = 'ClientsCourses';
	var $paginate = array('limit' => 10);
	var $helpers = array("Formatacao");
	var $uses = array('ClientsCourse','Client','Course');
	var $components = array('Auth','Email');

	function index() {
		$this->redirect(array('action' => '../clients/find'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Dado invalido.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('clientsCourse', $this->ClientsCourse->read(null, $id));
	}

	function add($id = null, $course = null) {
		if (!empty($this->data)) {
			$this->ClientsCourse->create();
			if ($this->ClientsCourse->save($this->data)) {
				$this->Session->setFlash(__('Salvo com sucesso!', true));
				$this->redirect(array('action' => 'viewPdf/' . $this->data['ClientsCourse']['client_id'] . "/" . $this->data['ClientsCourse']['course_id'] ));
			} else {
				$this->Session->setFlash(__('Erro ao tentar salvar. Tente novamente.', true));
			}
		}
		
		$courses = $this->ClientsCourse->Course->find('list',array('fields' => array('nome')));
		$clients = $this->ClientsCourse->Client->find('list',array('fields' => array('nome')));
		
		$this->set(compact('courses','clients'));
		
		$this->set('nome',$this->Client->findById($id));
	}
	
	function adding($id = null, $course = null) {
		if (!empty($id)) {
			$this->redirect(array('action' => 'viewPdf/' . $id . "/" . $course ));
		}
	}


	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Dados invalidos.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ClientsCourse->save($this->data)) {
				$this->Session->setFlash(__('Salvo com sucesso!', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Erro ao tentar alterar. Tente novamente', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ClientsCourse->read(null, $id);
		}
		$courses = $this->ClientsCourse->Course->find('list');
		$clients = $this->ClientsCourse->Client->find('list');
		$this->set(compact('courses', 'clients'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Dados invalidos.', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ClientsCourse->delete($id)) {
			$this->Session->setFlash(__('Removido com sucesso!', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Erro ao tentar remover. Tente novamente.', true));
		$this->redirect(array('action' => 'index'));
	}
	
    function viewPdf($id,$c_id) { 
        if (!$id) 
        {
            $this->Session->setFlash('Sorry, there was no property ID submitted.'); 
            $this->redirect(array('action'=>'index'), null, true); 
        }
        //Configure::write('debug',0); // Otherwise we cannot use this method while developing 

        $id = intval($id); 

        $property = $this->ClientsCourse->Client->findById($id); // here the data is pulled from the database and set for the view
		$this->set("ultimo", $this->ClientsCourse->query("SELECT * FROM clients_courses ORDER BY id DESC LIMIT 1"));
		$this->set("dados", $property);
		$this->set("course", $this->Course->findById($c_id));
		
		//$this->send("anderson.valongueiro@gmail.com");
		
        if (empty($property)) 
        { 
            $this->Session->setFlash('Sorry, there is no property with the submitted ID.'); 
            $this->redirect(array('action'=>'index'), null, true); 
        } 

        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
        $this->render(); 
    }
	
	function find(){
		if(isset($this->data)){
			$field = $this->data['Clients_courses']['field'];
			$str = $this->data['Clients_courses']['str'];
			
			$this->set('dados',$this->ClientsCourse->Client->query("SELECT * FROM clients WHERE $field LIKE '%$str%'"));
		
			//print_r($this->data['Clients_courses']['str']);
		} else {
			$this->set("dados",array());
		}
	}
	
	function report(){
		if(isset($this->data)){
			$de = $this->data['ClientsCourse']['de']['year'].'-'. $this->data['ClientsCourse']['de']['month'] . '-' . $this->data['ClientsCourse']['de']['day'];
			$ate = $this->data['ClientsCourse']['ate']['year'].'-'. $this->data['ClientsCourse']['ate']['month'] . '-' . $this->data['ClientsCourse']['ate']['day'];
			$sql = "SELECT * FROM clients_courses WHERE conclusao BETWEEN '$de' AND '$ate'";
			
			$arr = array();
			$i = 0;
			$valor = 0;
			
			foreach($this->ClientsCourse->query($sql) as $value){
				//array_push($arr,$value['clients_courses']['course_id']);
				array_push($arr,$this->Course->query("SELECT * FROM courses WHERE id = " . $value['clients_courses']['course_id']));
				
			}
			
			foreach($arr as $value){
				$valor = $valor + $value[0]['courses']['valor'];
				//echo $value[0]['courses']['valor']."<br>";
			}
			
			//echo $valor;

			$this->set('valor', $valor);
			$this->set('date', $this->data['ClientsCourse']['de']['day'] . '.' . $this->data['ClientsCourse']['de']['month'] . '.' . $this->data['ClientsCourse']['de']['year'] . ' a ' . $this->data['ClientsCourse']['ate']['day'] . '.' . $this->data['ClientsCourse']['ate']['month'] . '.' . $this->data['ClientsCourse']['ate']['year']);
			$this->set('qtdo', $this->ClientsCourse->query($sql));
		} else {
			//echo "nada";
		}
	}
	
	function consult() {
		
		$this->layout = "consult";
		
		if(isset($this->data['ClientsCourse']['codigo'])){
			$arr = explode("-",$this->data['ClientsCourse']['codigo']);
			$this->set("dados", $this->ClientsCourse->findById($arr[0]));
		}
	}
	
    function send($mail) {
            //$this->Email->template = 'email/confirm';
            // You can use customised thmls or the default ones you setup at the start
           
            //$this->set('data', $data);
            $this->Email->to = $mail;
            $this->Email->subject = 'Certificado de conclusão de curso';
           
           
            //$this->Email->attach($fully_qualified_filename, optionally $new_name_when_attached);
            // You can attach as many files as you like.
           
            $result = $this->Email->send();
 
        //the rest of the controller method...
      } 
}
?>