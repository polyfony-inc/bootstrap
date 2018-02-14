<?php
/**
 * PHP Version 5
 * Provide an object to easily store an alert for the enduser
 * This notice can be rendered nicely as a string or you can get
 * the title and message separately to format them your way
 * @package Polyfony
 * @link https://github.com/SIB-FRANCE/Polyfony
 * @license http://www.gnu.org/licenses/lgpl.txt GNU General Public License
 * @note This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */

namespace Bootstrap;

class Alert {
	
	const FLASH_KEY 		= 'BootstrapAlert'; // unlikely that anyone would want to change that, so... const.
	const DEFAULT_CLASS 	= 'info';			// the default class of an alert
	const AVAILABLE_CLASSES = [					// list of all available alerts, based on bootstrap 4
		'primary',
		'secondary',
		'success',
		'danger',
		'warning',
		'info',
		'light',
		'dark'
	];

	private $message;	// the message/body of the alert
	private $title;		// the title/heading of the alert
	private $footer;	// the footer of the alert (optional)
	private $class;		// the class of the alert, based on bootstrap 4

	public function __construct(
		$class   =null,
		$title   =null, 
		$message =null,
		$footer  =null
	) {
		$this->setClass($class);
		$this->setTitle($title);
		$this->setMessage($message);
		$this->setFooter($footer);
	}

	// setters

	public function setClass($class=null) :self  {
		// make sure that class is allowed and supported by bootstrap
		$this->class = in_array($class, self::AVAILABLE_CLASSES) ? 
			$class : self::DEFAULT_CLASS;
		return $this;
	}

	public function setTitle($title=null) :self  {
		$this->title = $title;
		return $this;
	}

	public function setMessage($message=null) :self  {
		$this->message = $message;
		return $this;
	}

	public function setFooter($footer=null) :self {
		$this->footer = $footer;
		return $this;
	}

	// getter

	public function getClass() {
		return $this->class;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getMessage() {
		return $this->message;
	}

	public function getFooter() {
		return $this->footer;
	}

	// magic goes here

	public function getHtml() {
		
		// create a bootstrap alert
		$alert = new \Polyfony\Element('div',[
			'class'	=>"alert alert-{$this->getClass()}",
			'role'	=>'alert'
		]);

		// add a title
		if($this->title) {
			$alert->adopt(new \Polyfony\Element('h2',[
				'class'	=>'alert-heading',
				'text'	=>$this->getTitle()
			]));
		}

		if($this->message) {
			$alert->adopt(new \Polyfony\Element('p',[
				'text'	=>$this->getMessage()
			]));
		}

		if($this->footer) {
			$alert->adopt(new \Polyfony\Element('hr'));
			$alert->adopt(new \Polyfony\Element('p',[
				'text'	=>$this->getFooter()
			]));
		}

		return $alert->__toString();
	}

	// magic convertion of the object to text
	public function __toString() {
		// convert to html
		return $this->getHtml();
	}
	
	// save the alert, to allow for a "one time only" flash
	public function save() :bool {

		// store the alert in the session
		return \Polyfony\Store\Session::put(self::FLASH_KEY, $this, true);

	}

	// flashes any previously stored alerts
	public static function flash(bool $delete_after_flashing = true) {

		// code here
		if(\Polyfony\Store\Session::has(self::FLASH_KEY)) {

			// get the alert
			$alert = \Polyfony\Store\Session::get(self::FLASH_KEY);

			// delete it from the store, unless it is explicitely prevented
			!$delete_after_flashing ?: \Polyfony\Store\Session::remove(self::FLASH_KEY);

			// and return it, for display purposes
			return $alert;

		}

	}

}

?>
