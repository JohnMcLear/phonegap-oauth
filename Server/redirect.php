<?php
	/*
	 *	OAuth for PhoneGap.
	 *	
	 *  https://github.com/jor3l/phonegap-oauth
	 *  MIT 2008 License.
	 *	
	 *	Developed by StarBite <jose@starbite.co>
	 *  Bogota, Colombia @ 2012.
	 */
	$callback = (isset($_GET['cb']) && !empty($_GET['cb'])) ? $_GET['cb'] : 'oauthLoginToken';
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<style>
		body {
			font-family: Helvetica, Arial, san-serif;
			font-size: 1em;
			padding: .2em;
			width: 100%;
			height: 100%;
		}
	</style>
</head>
<body>
	<h3>Loggin in, please wait...</h3>
	<script>
		(function(){
			function broadcastMessage(eventName, data) {
				var event = new Event(eventName);
					fix(event);
					event.data = data;
				// Trigger on opener if available and here (childBrowser) by default
				if(typeof window.opener != 'undefined' && typeof window.opener.document == 'object') {
					window.opener.document.dispatchEvent(event)
				}
				
				window.close()
			}
			
			// From Zepto
			
			function fix(event) {
				if (!('defaultPrevented' in event)) {
					event.defaultPrevented = false
					var prevent = event.preventDefault
					event.preventDefault = function() {
						this.defaultPrevented = true
						prevent.call(this)
					}
				}
			}
			
			var specialEvents = {}
				specialEvents.click = specialEvents.mousedown = specialEvents.mouseup = specialEvents.mousemove = 'MouseEvents'
			var Event = function(type, props) {
				var event = document.createEvent(specialEvents[type] || 'Events'), bubbles = true
				if (props) for (var name in props) (name == 'bubbles') ? (bubbles = !!props[name]) : (event[name] = props[name])
				event.initEvent(type, bubbles, true, null, null, null, null, null, null, null, null, null, null, null, null)
				return event
			}
			
			var parseQueryString = function (qs) {
				var e,
					a = /\+/g,  // Regex for replacing addition symbol with a space
					r = /([^&;=]+)=?([^&;]*)/g,
					d = function (s) { return decodeURIComponent(s.replace(a, " ")); },
					q = qs,
					urlParams = {};

				while (e = r.exec(q))
				   urlParams[d(e[1])] = d(e[2]);

				return urlParams;
			};
			
			var data = parseQueryString(window.location.hash.substring(1));
			// Send the message and close this window.
			try	{
				broadcastMessage('<?php echo $callback ?>', data);
			} catch(e) {}				
		})();
	</script>
	
</body>
</html>