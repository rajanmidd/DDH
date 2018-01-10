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
    $("a[rel=example_group]").fancybox({
        'transitionIn'		: 'none',
        'transitionOut'		: 'none',
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
    
    function readURL(input,number) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#blah"+number).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('change', '.abc', function (){
        var number=$(this).attr('data-number');
        readURL(this,number);
    });
    $(document).on('click', '.unit_type_check', function (){
        var value=$(this).val();
        if ($(this).is(':checked')) 
        {
            $("#unit_type_value_div_"+value).show();
            $("#unit_type_value_"+value).prop("disabled",false);
        } 
        else 
        {
            $("#unit_type_value_"+value).val("")
            $("#unit_type_value_div_"+value).hide();
            $("#unit_type_value_"+value).prop("disabled",true);
        }
    });
});
</script>
</body>
<!-- END BODY -->
</html>