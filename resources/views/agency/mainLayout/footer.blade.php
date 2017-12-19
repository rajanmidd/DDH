<!-- BEGIN FOOTER -->
<!--<div class="page-footer">
	<div class="page-footer-inner">
		{{date("Y")}} &copy; Metronic by keenthemes
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>-->
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{{asset('assets/global/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/fancybox/source/jquery.fancybox.pack.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/global/scripts/metronic.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/layout/scripts/layout.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/layout/scripts/quick-sidebar.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/layout/scripts/demo.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/pages/scripts/components-pickers.js')}}" type="text/javascript"></script>
<script src="{{asset('js/agency/bootstrap-filestyle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/agency/custom.js')}}" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   QuickSidebar.init(); // init quick sidebar
   Demo.init(); // init demo features
   ComponentsPickers.init();
});

$(document).ready(function() {
//   function disableBack() { 
//      alert('disableBack');
//      window.history.forward() 
//   }
//   window.onload = disableBack();
//   window.onpageshow = function(evt) { 
//      alert('onpageshow');
//      if (evt.persisted) {
//         disableBack() 
//      }
//   }
});
</script>
<!-- END JAVASCRIPTS -->

<script>
$(document).ready(function(){
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields)
        {
            x++;
            var html='<div><div class="col-md-6"><div class="form-group"><label class="control-label">File input</label><div class="form-group"><input type="file" id="file-upload-'+x+'" name="activityImages[]"></div></div><button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_field"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div>';
            $(wrapper).append(html); //add input box
        }
    });
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
    });

    var video_wrapper         = $(".input_fields_wrap_video"); //Fields wrapper
    var add_video_button      = $(".add_video_button"); //Add button ID
    var y = 1; //initlal text box count
    $(add_video_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(y < max_fields)
        {
            y++;
            var html='<div><div class="col-md-6"><div class="form-group"><label class="control-label">File input</label><div class="form-group"><input type="file" id="file-upload-'+y+'" name="activityVideos[]"></div></div><button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_video_field"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div>';
            $(video_wrapper).append(html); //add input box
        }
    });
    $(video_wrapper).on("click",".remove_video_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
    });


    var terms_wrapper         = $(".input_fields_wrap_terms"); //Fields wrapper
    var add_terms_button      = $(".add_terms_button"); //Add button ID
    var z = 1; //initlal text box count
    $(add_terms_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(z < max_fields)
        {
            z++;
            var html='<div><div class="col-md-6"><div class="form-group"><label class="control-label">Terms & Conditions</label><div class="form-group"><input type="text" id="terms-'+z+'" class="form-control" name="terms[]"></div></div><button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_terms_field"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div>';
            $(terms_wrapper).append(html); //add input box
        }
    });
    $(terms_wrapper).on("click",".remove_terms_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
    });


    var notes_wrapper         = $(".input_fields_wrap_notes"); //Fields wrapper
    var add_notes_button      = $(".add_notes_button"); //Add button ID
    var h = 1; //initlal text box count
    $(add_notes_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(h < max_fields)
        {
            h++;
            var html='<div><div class="col-md-6"><div class="form-group"><label class="control-label">Special Notes</label><div class="form-group"><input type="text" id="notes-'+h+'" class="form-control" name="notes[]"></div></div><button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_notes_field"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div>';
            $(notes_wrapper).append(html); //add input box
        }
    });
    $(notes_wrapper).on("click",".remove_notes_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
    });
    
});
</script>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAndRE4jOIvk10Gi2J-5MhSNoVhM7lBDLQ&libraries=places"></script>
<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('location'));
        google.maps.event.addListener(places, 'place_changed', function () {
            var place = places.getPlace();
            var address = place.formatted_address; 
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;
            /*  var mesg = "Address: " + address;
            mesg += "\nLatitude: " + latitude;
            mesg += "\nLongitude: " + longitude;
            alert(mesg);  */
        });
    });
</script>
<script>
   $(document).ready(function(){
       $('[data-toggle="tooltip"]').tooltip(); 
   });
</script>
</body>
<!-- END BODY -->
</html>