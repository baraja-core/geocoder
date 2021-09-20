Simple PHP Geocoder
===================

Rewrite real address to geo coordinates.

Idea
----

The task of the address geocoding process is to rewrite a real address (which we get from the user or from another API) into real GPS coordinates. If the address is too general and represents a large area, we return the middle point in that area.

The process of transcribing an address to GPS is not always reliable and accurate. Data from many sources is used, but in some cases the transcription may fail or return an incorrect result.

When using a geocoder, always validate the output coordinates against a preset area in your application.

How to use
----------

Simple create instance and call method:

```php
$geocoder = new \Baraja\Geocoder\Geocoder();
$coordinates = new $geocoder->decode('Náměstí Míru Praha');

echo $coordinates->getLatitude(); // 50.075075836281066
echo $coordinates->getLongitude(); // 14.437529917970826
```
