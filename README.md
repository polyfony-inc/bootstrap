## Bootstrap Helpers

...

#### Bootstrap\Alert

* You can use from different types of bootstrap alerts (previously called Notice) to suit your needs

```php
Bootstrap\Alert(
	$message={info,danger,primary,secondary,dark,light,info}, 
	$title=null, 
	$message=null, 
	$footer=null
)
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
$this->alert = $has_error ? 
	new Bootstrap\Alert('warning','Error!','Cache directory has not been emptied') :
	new Bootstrap\Alert('success','Success!','Cache directory has been emptied');

// this uses the magic __toString() methods of alerts objects to generate html code on the fly
echo $this->alert;

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

