/*!
* Duplicate / Remove: a jQuery Plugin
* @author: Trevor Morris (trovster)
* @url: http://www.trovster.com/lab/code/plugins/jquery.duplicate-remove.js
* @documentation: http://www.trovster.com/lab/plugins/duplicate-remove/
* @published: 06/10/2008
* @updated: 02/06/2009
* @license Creative Commons Attribution Non-Commercial Share Alike 3.0 Licence
*		   http://creativecommons.org/licenses/by-nc-sa/3.0/
*
*/
if(typeof jQuery != 'undefined') {
	jQuery(function($) {
		$.fn.extend({
			duplicate_remove: function(options) {
				var settings = $.extend({}, $.fn.duplicate_remove.defaults, options);

				return this.each(
					function() {
						var $$, o, $basic, $parent, total,
							$duplicate, $remove;
						
						$$ 		= $(this);
						o		= $.metadata ? $.extend({}, settings, $$.metadata()) : settings;
						$basic	= $$.clone();
						$parent	= $$.parent();
						total	= $parent.find($basic).length;
						
						$duplicate	= $('<a></a>').attr('href',o['duplicate']['href']).text(o['duplicate']['text']).addClass('duplicate').addClass('phark');
						$remove		= $('<a></a>').attr('href',o['remove']['href']).text(o['remove']['text']).addClass('remove').addClass('phark');
						
						$$.append($remove).append($duplicate);
		
						$$.find('a.duplicate').bind('click.duplicate', function(e){
							var $a;
							$a = $(this);
							if($a.is(':not(.forbidden)')) {
								$basic.clone().duplicate_remove(o).hide().insertAfter($$).slideDown(o['duplicate']['speed'], function(){
									$parent = $(this).parent();
									
									$remove_items 		= $parent.find('a[href='+o['remove']['href']+']');
									$duplicate_items 	= $parent.find('a[href='+o['duplicate']['href']+']');
									remove_total 		= $remove_items.length;
									duplicate_total 	= $duplicate_items.length;
									
									if(remove_total==1) {
										$remove_items.addClass('forbidden').addClass('remove-forbidden').attr('title', 'Disabled');
									}
									else {
										$remove_items.removeClass('forbidden').removeClass('remove-forbidden').attr('title', o['remove']['text']);
									}
									
									if(typeof o['limit'] != 'undefined' && o['limit']!==false && is_numeric(o['limit']) && duplicate_total>=o['limit']) {
										$duplicate_items.addClass('forbidden').addClass('duplicate-forbidden').attr('title', 'Disabled');
									}
									else {
										$duplicate_items.removeClass('forbidden').removeClass('duplicate-forbidden').attr('title', o['duplicate']['text']);
									}
									$(this).find('input').focus();
								});
							}
							
							$a.blur();
							return false;
						})
						$$.find('a.remove').bind('click.remove', function(e) {
							var $a;
							$a = $(this);
							if($a.is(':not(.forbidden)')) {
								$$.slideUp(o['remove']['speed'], function() {
									$parent = $(this).parent();
									$(this).remove();
									
									$remove_items 		= $parent.find('a[href='+o['remove']['href']+']');
									$duplicate_items 	= $parent.find('a[href='+o['duplicate']['href']+']');
									remove_total 		= $remove_items.length;
									duplicate_total 	= $duplicate_items.length;
									
									if(remove_total==1) {
										$remove_items.addClass('forbidden').addClass('remove-forbidden').attr('title','Disabled');
									}
									else {
										$remove_items.removeClass('forbidden').removeClass('remove-forbidden').attr('title',o['remove']['text']);
									}
									
									if(typeof o['limit'] != 'undefined' && o['limit']!==false && is_numeric(o['limit']) && duplicate_total>=o['limit']) {
										$duplicate_items.addClass('forbidden').addClass('duplicate-forbidden').attr('title','Disabled');
									}
									else {
										$duplicate_items.removeClass('forbidden').removeClass('duplicate-forbidden').attr('title',o['duplicate']['text']);
									}
								});
							}
							$a.blur();
							return false;
						});
						
						if(total < 2) {
							$$.find('a.remove').addClass('forbidden').addClass('remove-forbidden').attr('title','Disabled');
						}
						else {
							$$.find('a.remove.forbidden').removeClass('remove-forbidden').removeClass('forbidden').attr('title',o['remove']['text']);
						}
						
						if(typeof o['limit'] != 'undefined' && o['limit']!==false && is_numeric(o['limit']) && total>=o['limit']) {
							$$.find('a.duplicate').addClass('forbidden').addClass('duplicate-forbidden').attr('title','Disabled');
						}
						else {
							$$.find('a.duplicate').removeClass('forbidden').removeClass('duplicate-forbidden').attr('title',o['duplicate']['text']);
						}
					}
				);
			}
		});
		
		/**
		* Private Function
		* Checks whether a string is numeric
		*/
		function is_numeric(str) {
			var nums = '0123456789';
			if(str.length==0) return false;
			for(var n=0; n < str.length; n++) {
				if(nums.indexOf(str.charAt(n))==-1) return false;
			}
			return true;
		}
		
		/**
		* Plugin Defaults
		*/
		$.fn.duplicate_remove.defaults = {
			'duplicate' : {
				'text'	: 'Duplicate',
				'href'	: '#duplicate',
				'speed'	: 200
			},
			'remove'	: {
				'text'	: 'Remove',
				'href'	: '#remove',
				'speed'	: 200
			},
			'limit' : false
		};
	});
}
