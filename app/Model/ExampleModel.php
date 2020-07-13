<?php
class Example extends AppModel
{
	var $name = 'Example';
	
 	public function update($example_data)
	{
		$example = $this->find('first', array('conditions' => array('example_id' => $example_data['example_id'])));
		if($example) {
			$example_data['id'] = $example['Example']['id'];
		}
		$this->create();
		$this->save(Array("Example" => $example_data));
	}
}