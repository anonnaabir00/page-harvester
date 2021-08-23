//   allCities = [];

console.log(phform_post);
allCities = phform_post;

  // jQuery.getJSON("/data.json", function(result){
  //   //   console.log(result);
  //     New_York = result['New York'];
  //     California = result['California'];
  //     allCities = jQuery.merge(New_York,California);
  //     // console.log(allCities);
  //     jQuery( function() {
  //       // var availableTags = [
  //       //   "ActionScript",
  //       //   "AppleScript",
  //       //   "Asp",
  //       //   "BASIC",
  //       //   "C",
  //       //   "C++",
  //       //   "Clojure",
  //       //   "COBOL",
  //       //   "ColdFusion",
  //       //   "Erlang",
  //       //   "Fortran",
  //       //   "Groovy",
  //       //   "Haskell",
  //       //   "Java",
  //       //   "JavaScript",
  //       //   "Lisp",
  //       //   "Perl",
  //       //   "PHP",
  //       //   "Python",
  //       //   "Ruby",
  //       //   "Scala",
  //       //   "Scheme"
  //       // ];
  //       jQuery( "#phterm" ).autocomplete({
  //         source: allCities,
  //         minLength: 2,
  //         autoFocus: true
  //       });
  //     } );
  // });

jQuery( function() {
    jQuery( "#phterm" ).autocomplete({
      source: allCities,
      minLength: 2,
      autoFocus: true
    });
  } );


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

