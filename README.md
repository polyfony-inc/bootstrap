# Introduction

This class helps in building Bootstrap Modals, Dropdowns and Alerts.
It currently support Bootstrap 5, other branches may support bootstrap5-alpha or bootstrap 4.

## Alert

* You can use from different types of bootstrap alerts (previously called Notice) to suit your needs

```php
Bootstrap\Alert([
	'class'			=>null,
	'message'		=>null,
	'title'			=>null,
	'footer'		=>null,
	'dismissible'	=>true
])
```
All will be converted to HTML automatically using bootstrap 4 friendly classes.


### Typical example using the "flashbag"

```php
// set an alert depending on the presence of errors
$foobar->doSomething() ? 
	new Bootstrap\Alert([
		'class'=>'danger',
		'message'=>'Cache directory has not been emptied'
	)->save() :
	new Bootstrap\Alert([
		'class'=>'success',
		'message'=>'cache directory has been empties'
	])->save();

// maybe you want to redirect somewhere
Response::setRedirect('/admin/');

```

### Or using shortcuts
These will build alerts of class `success` or `danger`. With the Locale *Operation succeeded* or *Operation failed*.

```php

use Bootstrap\Alert\{ 
	Success as OK,
	Failure as KO
};

// [...]
 
// set an alert depending on the presence of errors
$foobar->doSomething() ? (new OK) : (new KO);

// [...]

// maybe you want to redirect somewhere
Response::setRedirect('/admin/');

```


Then in a shared view, available everywhere

```html
<?= Bootstrap\Alert::flash(); ?>
```

**You can ask the Logger engine to log your alert by applying ->log() to the alert object.**
* Alert of class danger will map to a Polyfony/Log event of type critical
* Alert of class warning will map to a Polyfony/Log event of type warning
* Any other class will map to a Polyfony/Log event of type info

### Manually getting back notice text
```php
$alert->getMessage()
$alert->getTitle()
$alert->getFooter()
```

## Modal

* generate a modal element
```php


echo (new Bootstrap\Modal)
	->setTitle(
		['text'=>'Hey!'],
		'fa fa-car'
	)
	->setBody([
		'text'=>'Here is the content'
	])
	->setTrigger(
		[
			'text'=>'Open the modal',
			'class'=>'btn btn-link'
		],
		'fa fa-send'
	)
	->addOption(
		[
			'text'=>'To this',
			'class'=>'btn btn-success'
		],
		'fa fa-car'
	)
	->addOption(
		[
			'text'=>'To that',
			'class'=>'btn btn-warning'
		],
		'fa fa-car'
	);


```

## Dropdown

* generate a dropdown element
```php

echo (new Bootstrap\Dropdown)
	->setTrigger(
		[
			'text'=>'Click this nice looking modal',
			'class'=>'btn btn-primary'
		],
		'fa fa-send'
	)
	->addItem([
		'text'=>'To this',
		//'class'=>'some-cool-class'
		//'html'=>'Non protected text'
		
	])
	->addDivider()
	->addHeader([
		'text'=>'Pretty Header'
	]);


```

