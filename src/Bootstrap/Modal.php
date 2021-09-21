<?php

namespace Bootstrap;
use Polyfony\{ Element };

class Modal {

	const DEFAULT_SIZE 			= 'medium';
	const AVAILABLE_SIZES 		= [
		'medium'	=>'',
		'large'		=>'modal-lg',
		'small'		=>'modal-sm',
		'xxl'		=>'' // dirty tweak to oversize a modal
	];

	const DEFAULT_POSITION 		= 'top';
	const AVAILABLE_POSITIONS 	= [
		'top'		=>'',
		'centered'	=>'modal-dialog-centered'
	];

	// generic attributes
	private $modalId 				= null;
	private $modalSize 				= self::DEFAULT_SIZE;
	private $modalPosition 			= self::DEFAULT_POSITION;

	// the modal itself
	private $titleAttributes 		= [];
	private $titleIcon 				= '';

	// the body
	private $bodyAttributes 		= [];

	// the footer
	private $footerAttributes		= [];

	// the trigger button
	private $triggerAttributes		= [];
	private $triggerIcon			= '';


	// main constructor with some global options
	public function __construct($size=null, $position=null, $id=null) {

		return $this
			->setSize($size)
			->setPosition($position)
			->setId($id);
	}

	// force a specific id
	public function setId($id) {
		$this->modalId = $id;
	}

	// where to align the modal
	public function setPosition($position) {
		$this->modalPosition = array_key_exists($position, self::AVAILABLE_POSITIONS) ? 
			$position : self::DEFAULT_POSITION;

		return $this;
	}

	// what size is that modal
	public function setSize($size) {
		$this->modalSize = array_key_exists($size, self::AVAILABLE_SIZES) ? 
			$size : self::DEFAULT_SIZE;

		return $this;
	}

	// set the title of the modal
	public function setTitle($attributes, $icon=null) {

		$this->titleAttributes 	= $attributes;
		$this->titleIcon 		= $icon;

		return $this;

	}

	// set the content of the modal
	public function setBody($attributes) {

		$this->bodyAttributes = $attributes;
		return $this;
	}

	// set the footer of the modal
	public function setFooter($attributes) {

		$this->footerAttributes = $attributes;
		return $this;
	}

	// set the button of the modal
	public function setTrigger(array $attributes, string $icon=null): self {

		$this->triggerAttributes 	= $attributes;
		$this->triggerIcon 			= $icon;

		return $this;

	}

	public function addOption($attributes, $icon=null) {

		// create a new option
		$option = new Element('a', $attributes);

		// push that option
		$this->footerButtons[] = $option;

		return $this;
	}

	// returns only the modal element
	public function getModal() {
		
	}

	// return only the modal trigger/button
	public function getTrigger() {
		// modal trigger
		$trigger 	= new Element('button', array_replace([
			'data-toggle'	=>'modal',
			'data-target'	=>'#modal-'.$this->modalId,
			'type'			=>'button',
		], $this->triggerAttributes));

		// if an icon is to be used
		if($this->triggerIcon) {
			$triggerIcon = new Element('span', ['class'=>$this->triggerIcon]);
			$trigger->adopt($triggerIcon, true);
		}
		return $trigger;
	}

	public function __toString() {

		// modal id generation in case none was provided
		$this->modalId = $this->modalId ? 
			$this->modalId : uniqid();

		// global container
		$container 	= new Element('span');

		// modal container itself
		$modal 		= new Element('div', [
			'class'			=>'modal fade',
			'tabindex'		=>'-1',
			'role'			=>'dialog',
			'aria-hidden'	=>'true',
			'id'			=>'modal-'.$this->modalId
		]);

		$modalDialog = new Element('div', [
			'class'			=>'modal-dialog modal-dialog-centered '.self::AVAILABLE_SIZES[$this->modalSize],
			'role'			=>'document',
			'style'			=> $this->modalSize == 'xxl' ? 'max-width:95%' : '' // dirty tweak to allow supersized modal (not normally offered by bootstrap4)
		]);

		$modalContent = new Element('div', [
			'class'			=>'modal-content'
		]);

		$modalHeader = new Element('div', [
			'class'			=>'modal-header'
		]);

		$modalTitle = new Element('div', array_replace([
			'class'			=>'modal-title'
		],$this->titleAttributes));

		$modalTitleIcon = new Element('span', [
			'class'			=>$this->titleIcon
		]);

		$modalTitleClose = new Element('button', [
			'class'			=>'close',
			'data-dismiss'	=>'modal',
			'aria-label'	=>'Close'
		]);
		$modalTitleCloseIcon = new Element('span', [
			'aria-hidden'	=>'true',
			'html'			=>'&times;'
		]);


		$modalBody = $this->bodyAttributes ? new Element('div', 
			array_merge(
				$this->bodyAttributes, 
				['class'=>'modal-body']
			)
		) : '';

		$modalFooter = $this->footerAttributes ? new Element('div', 
			array_merge(
				$this->footerAttributes, 
				['class'=>'modal-footer']
			)
		) : '';

		// assemble elements
		$container
		->adopt(
			$modal
			->adopt(
				$modalDialog
				->adopt(
					$modalContent
					->adopt(
						$modalHeader
						->adopt($modalTitleIcon)
						->adopt($modalTitle)
						->adopt(
							$modalTitleClose
							->adopt($modalTitleCloseIcon)
						)
					)
					->adopt($modalBody)
					->adopt($modalFooter)
				)
			)
		)
		->adopt($this->getTrigger());

		// return formatted html
		return (string) $container;

	}

}


?>