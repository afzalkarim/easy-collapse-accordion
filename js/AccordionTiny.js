var AccordionTiny = {
	e: '',
	init: function(e) {
		AccordionTiny.e = e;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert: function createGalleryShortcode(e) {
		
		var accordionName = jQuery('#accordion-name').val();
		var accordionSectionCount = jQuery('#count').val();

		var output = '[accordion_wrapper name="'+accordionName+'"]';

			for (var i = 1; i <= accordionSectionCount; i++) {
				
				output += '[accordion_section count="'+i+'" name="'+accordionName+'"';

			 	output += ' title="'+jQuery("#accordion-fieldset-"+i+" .accordion-section-title").val()+'"';

			 	output += ' open="'+jQuery('#accordion-fieldset-'+i+' input[name=accordion-section-option-'+i+']:checked', '#accordion-form').val()+'"]';
			
				output += jQuery('#accordion-fieldset-'+i+' .accordion-section-content').val();
			
				output += '[/accordion_section]';

			};
		
		output += '[/accordion_wrapper]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		
		tinyMCEPopup.close();
		
	}
}
tinyMCEPopup.onInit.add(AccordionTiny.init, AccordionTiny);
