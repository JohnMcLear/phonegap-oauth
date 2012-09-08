# PhoneGap Oauth
==============
This is a Zepto, jqMobi and jQuery plugin to create OAuth buttons.

The idea is to provide an easy, fast and reliable OAuth authentication for HTML5 / PhoneGap apps with ChildBrowser and windows popups (offline development without the need of a phone/emulator). You still need to upload the app files somewhere or use a local server since the browser have security limitations when running the app on file://.

*requires zepto, jqmobi or jquery lib.*

Is also bootstrap compatible <;) (the demo layout actually)

## License
Some of the code is based on JSO (portions of it has been used), its license and info are here:
	http://github.com/andreassolberg/jso/
The plugin is licensed under MIT License (2008). See http://opensource.org/licenses/alphabetical for full text.

## Demo
Online demo here: http://starbite.co/oauth

Download the mobile demo here:
	https://build.phonegap.com/apps/201087/share

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

You'll need to store the data wich contains the accessToken and expiration date. (future release will auto-save this).

Available settings are:

* service: Service name your're using (so each button is different from the other.
* callback: The name of the event to trigger with the login data, you need to bind or add an event listener to the document.
* client_id: This is used by OAuth to identify your app.
* redirect_uri: If you host your own redirect code you can set it here, put the full url to your redirect.php. We host one for free and we will never store any user data (is virtually impossible). Default: http://starbite.co/oauth/redirect.php.
* autorization: This is the OAuth autorization uri, if the plugin has info about your service (Facebook, Instagram, LinkedIn...) it will detect and use the default autorization uri, if not set it here.
* permissions: (also know as scope) Wich permissions you're requesting, use an array and separate each permission. E.g: ['permission1', 'permission2']
* frame: For the popup, set its parameters here. Default is: ['width=900px', 'height=400px', 'resizable=0', 'fullscreen=yes']
* childBrowserSettings: An associative array with the settings to your childBrowserWindow. Default: { showLocationBar: false, showAddress: false }
```

## PhoneGap
To use this in your PhoneGap app, check the phonegap demo in the Client folder. You only need to import the childbrowser.js, the plugin will identify it and automatically use it instead of a popup.

### PhoneGap Build
With PGB you need to specify the correct ChildBrowser plugin like this:
```
<gap:plugin name="ChildBrowser" /> <!-- latest release -->
<gap:plugin name="ChildBrowser" version="~3" /> <!-- for Cordova (1.9.0+) -->
<gap:plugin name="ChildBrowser" version="~2" /> <!-- for Cordova 1.5.0 - 1.8.1 -->
<gap:plugin name="ChildBrowser" version="~1" /> <!-- for PhoneGap <= 1.4.1 -->
```

## About
Developed by StarBite, Bogota - Colombia @ 2012.
* @jor3l / <jose@starbite.co>
