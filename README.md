#### Bootstrap\Alert

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

Manually getting back notice text
```php
$alert->getMessage()
$alert->getTitle()
$alert->getFooter()
```

Typical example using the "flashbag"

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

Then in a shared view, available everywhere

```html
<?= Bootstrap\Alert::flash(); ?>
```

**You can ask the Logger engine to log your alert by applying ->log() to the alert object.**
* Alert of class danger will map to a Polyfony/Log event of type critical
* Alert of class warning will map to a Polyfony/Log event of type warning
* Any other class will map to a Polyfony/Log event of type info

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

#### Bootstrap\Dropdown

* generate a dropdown element
```php

$dropdown = new Bootstrap\Dropdown();

$dropdown
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

echo $dropdown;

```

