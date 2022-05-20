( function( api ) {

	// Extends our custom "car-service" section.
	api.sectionConstructor['car-service'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );