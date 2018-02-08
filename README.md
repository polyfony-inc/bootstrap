## Bootstrap Helpers

...

#### Bootstrap\Alert

* Generate an alert element

```php

$alert = new Bootstrap\Alert(
	'success',	// class
	'Awesome!',	// title
	'A description of the message', // body
	'And even a footer'	// footer
);

echo $alert;

```

#### Bootstrap\Modal

* generate a modal element
```php

$modal = new Bootstrap\Modal();

$modal
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

echo $modal;

```

#### Bootstrap\Progress

* generate a progress bar element
```php

```

