(function() {
	tinymce.create('tinymce.plugins.YourAccordion', {
		init : function(ed, url) {
			ed.addCommand('tinyAccordion', function() {
				ed.windowManager.open({
					file : url + '/accordion.html',
					width : 450 + parseInt(ed.getLang('accordion.delta_width', 0)),
					height : 650 + parseInt(ed.getLang('accordion.delta_height', 0)),
					inline : 1
				}, {
					plugin_url : url
				});
			});
			ed.addButton('youraccordion', {
				title : 'Add an accordion',
				cmd: 'tinyAccordion',
				image : url+'/img/easy-accordion.png'
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : "WordPress Accordion",
				author : 'Cresencio Cantu',
				authorurl : 'http://www.cresenciocantu.com/',
				infourl : 'http://www.cresenciocantu.com/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('youraccordion', tinymce.plugins.YourAccordion);
})();
