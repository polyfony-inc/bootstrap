<?php

namespace Bootstrap;
use Polyfony as pf;

class Dropdown {

	// generic attributes
	private $dropdownId 	= null;

	// the items
	private $dropdownItems 		= [];

	// the dropbown button itself
	private $triggerAttributes		= [];
	private $triggerIcon			= '';


	// main constructor with some global options
	public function __construct($id=null) {

		return $this;
	}

	// force a specific id
	public function setId($id) :self {
		$this->dropdownId = $id;
		return $this;
	}

	// set the button of the modal
	public function setTrigger(array $attributes, string $icon=null): self {

		$this->triggerAttributes 	= $attributes;
		$this->triggerIcon 			= $icon;

		return $this;

	}

	public function addItem(array $attributes, string $icon=null) :self {

		// create a new option
		$item = new pf\Element('span', array_merge($attributes, ['class'=>'dropdown-item']));

		// push that option
		$this->dropdownItems[] = $item;

		return $this;
	}

	public function addHeader(array $attributes, string $icon=null) :self {

		// create a new option
		$item = new pf\Element('span', array_merge($attributes, ['class'=>'dropdown-header']));

		// push that option
		$this->dropdownItems[] = $item;

		return $this;

	}

	public function addDivider() :self {

		// create a new option
		$item = new pf\Element('div', ['class'=>'dropdown-divider']);

		// push that option
		$this->dropdownItems[] = $item;

		return $this;

	}

	// return only the modal trigger/button
	private function getTrigger() {
		
		// modal id generation in case none was provided
		$this->dropdownId = $this->dropdownId ? 
			$this->dropdownId : uniqid();

		// modal trigger
		$trigger = new pf\Element('button', array_replace([
			'id'			=>$this->dropdownId,
			'data-bs-toggle'	=>'dropdown',
			'aria-bs-expanded'	=>'false',
			'type'			=>'button',
		], $this->triggerAttributes));

		// if an icon is to be used
		if($this->triggerIcon) {
			$triggerIcon = new pf\Element('span', ['class'=>$this->triggerIcon]);
			$trigger->adopt($triggerIcon, true);
		}
		return $trigger;
	}

	public function __toString() {

		

		// global container
		$container 	= new pf\Element('span', [
			'class'=>'dropdown'
		]);

		$menu = new pf\Element('div', [
			'class'				=>'dropdown-menu',
			'aria-labelledby'	=>$this->dropdownId
		]);

		// for each items
		foreach($this->dropdownItems as $item) {
			// add item
			$menu->adopt($item);
		}

		$container
			->adopt($this->getTrigger())
			->adopt($menu);

		// return formatted html
		return (string) $container;

	}

}


?>
