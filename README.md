## Bootstrap Helpers

...

#### Bootstrap\Alert

* You can use from different types of bootstrap alerts (previously called Notice) to suit your needs

```php
Bootstrap\Alert([
	'class'		=>{info,danger,primary,secondary,dark,light},
	'message'	=>null,
	'title'		=>null,
	'footer'	=>null
])
```
All will be converted to HTML automatically using bootstrap 4 friendly classes.

Manually getting back notice text
```php
$alert->getMessage()
$alert->getTitle()
$alert->getFooter()
```

Typical example

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

