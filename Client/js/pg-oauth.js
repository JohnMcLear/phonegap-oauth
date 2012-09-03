/*
 *	OAuth for PhoneGap.
 *	
 *  https://github.com/jor3l/phonegap-oauth
 *  MIT 2008 License.
 *	
 *	Developed by StarBite <jose@starbite.co>
 *  Bogota, Colombia @ 2012.
 */
 
(function($) {
	$.extend($.fn, {
        oauthLogin: function(options) {
			var getAutorizationDefault = function(service) {
				var defaults = {'facebook': "https://www.facebook.com/dialog/oauth",
								'linkedin': "https://www.linkedin.com/oauth",
								'google': "https://accounts.google.com/o/oauth2/auth",
								'instagram': "https://instagram.com/oauth/authorize/" };								
				return (service in defaults || typeof defaults[service] != '') ? defaults[service] : false;
			};
			
            var defaults = {
                client_id: false,
                redirect_uri : 'http://starbite.co/oauth/redirect.php',
				autorization: getAutorizationDefault(options.service),
				permissions: false,
				frame: ['width=900px', 'height=400px', 'resizable=0', 'fullscreen=yes']
            };
			
			var uuid = function() {
				return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
					var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
					return v.toString(16);
				});
			};
			
			var popupWins = {};
			var windowOpener = function(url, name, args) {
				if ( typeof( popupWins[name] ) != "object" ) {
					popupWins[name] = window.open(url,name,args.join(','));
				} else {
					if (!popupWins[name].closed){
						popupWins[name].location.href = url;
					} else {
						popupWins[name] = window.open(url, name,args.join(','));
					}
				}
				popupWins[name].focus();
			};
	
            var options =  $.extend(defaults, options),
				accessTokenUri = function() {
					var params = {state: uuid(), response_type: 'token', 'cb': options.callback};
						if(options.permissions !== false)
							params.scope = options.permissions.join(',');
						params = $.extend(options, params);
					return options.autorization + '?' + $.param(params);
				};
				
			// Get the access uri
			var oauth_uri = accessTokenUri();
				
            //Iterate over the current set of matched elements
            return this.each(function() {
				$(this).click(function() {
				
					if('plugins' in window && window.plugins.childBrowser) {
					
					} else {
						// Fallback to popup
						windowOpener(oauth_uri, 'facebook', options.frame);
					}
				});
            });
        }
    });	
})(window.Zepto || window.jQuery);  