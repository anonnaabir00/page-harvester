//   allCities = [];

console.log(phform_post);
allCities = phform_post;

  
jQuery( function() {
    jQuery( "#phterm" ).autocomplete({
      source: allCities,
      minLength: 2,
      autoFocus: true
    });
  } );