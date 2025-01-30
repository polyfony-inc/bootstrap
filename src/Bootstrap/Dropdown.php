<?php

namespace Bootstrap;
use Polyfony\{ Element };

class Dropdown {

	// generic attributes
	private $id 					= null;

	// the items
	private $items 					= [];

	// the dropbown button itself
	private $triggerAttributes		= [];
	private $triggerIcon			= '';


	// main constructor with some global options
	public function __construct($id=null) {

		return $this;
	}

	// force a specific id
	public function setId($id) :self {
		$this->id = $id;
		return $this;
	}

	// set the button of the modal
	public function setTrigger(
		array $attributes, 
		?string $icon=null
	): self {

		$this->triggerAttributes 	= $attributes;
		$this->triggerIcon 			= $icon;

		return $this;

	}

	public function addItem(
		array $attributes, 
		?string $icon=null
	) :self {

		// create a new option
		$item = new Element(
			'span', 
			array_merge(
				$attributes, 
				['class'=>'dropdown-item']
			)
		);

		// push that option
		$this->items[] = $item;

		return $this;
	}

	public function addHeader(
		array $attributes, 
		?string $icon=null
	) :self {

		// create a new option
		$item = new Element(
			'span', 
			array_merge(
				$attributes, 
				['class'=>'dropdown-header']
			)
		);

		// push that option
		$this->items[] = $item;

		return $this;

	}

	public function addDivider() :self {

		// create a new option
		$item = new Element(
			'div', 
			['class'=>'dropdown-divider']
		);

		// push that option
		$this->items[] = $item;

		return $this;

	}

	// return only the modal trigger/button
	private function getTrigger() {
		
		// modal id generation in case none was provided
		$this->id = $this->id ? 
			$this->id : uniqid();

		// modal trigger
		$trigger = new Element('button', array_replace([
			'id'				=>$this->id,
			'data-bs-toggle'	=>'dropdown',
			'aria-expanded'		=>'false',
			'type'				=>'button',
		], $this->triggerAttributes));

		// if an icon is to be used
		if($this->triggerIcon) {
			$triggerIcon = new Element('span', ['class'=>$this->triggerIcon]);
			$trigger->adopt($triggerIcon, true);
		}
		return $trigger;
	}

	public function __toString() {

		

		// global container
		$container 	= new Element('span', [
			'class'=>'dropdown'
		]);

		$menu = new Element('div', [
			'class'				=>'dropdown-menu',
			'aria-labelledby'	=>$this->id
		]);

		// for each items
		foreach($this->items as $item) {
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