//   allCities = [];

  jQuery.getJSON("https://gist.githubusercontent.com/ahmu83/38865147cf3727d221941a2ef8c22a77/raw/c647f74643c0b3f8407c28ddbb599e9f594365ca/US_States_and_Cities.json", function(result){
    //   console.log(result);
      New_York = result['New York'];
      California = result['California'];
      allCities = jQuery.merge(New_York,California);
      console.log(allCities);
      jQuery( function() {
        // var availableTags = [
        //   "ActionScript",
        //   "AppleScript",
        //   "Asp",
        //   "BASIC",
        //   "C",
        //   "C++",
        //   "Clojure",
        //   "COBOL",
        //   "ColdFusion",
        //   "Erlang",
        //   "Fortran",
        //   "Groovy",
        //   "Haskell",
        //   "Java",
        //   "JavaScript",
        //   "Lisp",
        //   "Perl",
        //   "PHP",
        //   "Python",
        //   "Ruby",
        //   "Scala",
        //   "Scheme"
        // ];
        jQuery( "#phterm" ).autocomplete({
          source: allCities
        });
      } );
  });

// jQuery( function() {
//     var availableTags = [
//       "ActionScript",
//       "AppleScript",
//       "Asp",
//       "BASIC",
//       "C",
//       "C++",
//       "Clojure",
//       "COBOL",
//       "ColdFusion",
//       "Erlang",
//       "Fortran",
//       "Groovy",
//       "Haskell",
//       "Java",
//       "JavaScript",
//       "Lisp",
//       "Perl",
//       "PHP",
//       "Python",
//       "Ruby",
//       "Scala",
//       "Scheme"
//     ];
//     jQuery( "#phterm" ).autocomplete({
//       source: allCities
//     });
//   } );


  function validateForm() {
    var x = document.forms["phterm_form"]["phterm"].value;
    if (x == "" || x == null) {
      alert("Name must be filled out");
      return false;
    }
  }

//   jQuery(function(){
//     var x = document.forms["myForm"]["fname"].value;
//     if (x == "" || x == null) {
//       alert("Name must be filled out");
//       return false;
//     }
//   })


//   jQuery( "#submit" ).click(function() {
//     var locationInput = jQuery("#phterm").val();
//       if (locationInput == ""){
//           alert('Please enter a location first');
//       }

//       return false;
//   });

