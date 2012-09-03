# PhoneGap Oauth
==============
This is a Zepto and jQuery plugin to create OAuth buttons.

The idea is to provide an easy, fast and reliable OAuth authentication for HTML5 / PhoneGap apps with ChildBrowser and windows popups (offline development without the need of a phone/emulator). You still need to upload the app files somewhere or use a local server since the browser have security limitations when running the app on file://.

*requires zepto.min.js or jquery.min.js.*

Is also bootstrap compatible <;) (the demo layout actually)

## License
Some of the code is based on JSO (portions of it has been used), its license and info are here:
	http://github.com/andreassolberg/jso/
The plugin is licensed under MIT License (2008). See http://opensource.org/licenses/alphabetical for full text.


## Usage
The plugin comes with pre-defined oauth services such as Facebook, Instagram, LinkedIn and Google, you can add more by simply defining its parameters when you set up a button.

For Facebook you can just do:
```javascript
	$('.facebook-login').oauthLogin({
		service: 'facebook', // Automagically uses facebook login data
		client_id: 'YOUR_FACEBOOK_APP_ID',
		permissions: ["read_stream"], // What you need to access from user..
		callback: 'oauthLoginToken'
	});	
```
You also need to setup a callback to receive the data from the server, just bind the callback you passed before to your document like this
```javascript
	$(document).bind('oauthLoginToken', function(event) {
		console.log(event.data);
		alert('Logged in!');
	});
```
You'll need to store the data wich contains the accessToken and expiration date. (future release will auto-save this)

## Demo
Test our demo located here: http://starbite.co/oauth
Or download our demo app (wich uses the same code) here:
	<<Soon>>

## About
Developed by StarBite, Bogota - Colombia @ 2012.
* @jor3l / <jose@starbite.co>
