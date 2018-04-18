jQuery.ajaxSetup({
   headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
   }
});

$(document).ready(function () {
   $("select[name='status']").change(function () {
      $("#search_frm").submit();
   });
   $.validator.addMethod('filesize', function (value, element, param) {
      return this.optional(element) || (element.files[0].size <= param)
   });
   $('#camping-form').validate({
      errorElement: 'span', //default input error message container
      errorClass: 'help-block', // default input error message class
      focusInvalid: true, // do not focus the last invalid input
      ignore: "",
      rules: {
         camping_name: {
            required: true
         },
         camping_location: {
            required: true,
         },
         days: {
            required: true,
         },
         night: {
            required: true,
         },
         triple_sharing: {
            required: true,
            number: true
         },
         double_sharing: {
            required: true,
            number: true
         },
         'itinerary[]': {
            required: true,
         },
      },
      invalidHandler: function (event, validator) { //display error alert on form submit   

      },
      highlight: function (element) { // hightlight error inputs
         $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
      },
      success: function (label) {
         label.closest('.form-group').removeClass('has-error');
         label.remove();
      },
      submitHandler: function (form) {
         var len = $(".input_fields_wrap_terms").find("textarea[name='terms[]']").length;
         if (len > 0) {
            form.submit();
         } else {
            swal("Cancelled", "Please enter at least one terms & condition :)", "error");
         }
      }
   });

   $('#addActivity').validate({
      errorElement: 'span', //default input error message container
      errorClass: 'help-block', // default input error message class
      focusInvalid: true, // do not focus the last invalid input
      ignore: "",
      rules: {
         name: {
            required: true
         },
         activity_image:{
            extension: "jpg|jpeg|png",
            filesize: 31457280,
         },
      },
      invalidHandler: function (event, validator) { //display error alert on form submit   

      },
      highlight: function (element) { // hightlight error inputs
         $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
      },
      success: function (label) {
         label.closest('.form-group').removeClass('has-error');
         label.remove();
      },
      submitHandler: function (form) {
         form.submit();
      }
   });

   $('#update-profile-form').validate({
      errorElement: 'span', //default input error message container
      errorClass: 'help-block', // default input error message class
      focusInvalid: true, // do not focus the last invalid input
      ignore: "",
      rules: {
         name: {
            required: true
         },
         mobile: {
            required: true,
            number:true
         },
         email: {
            required: true,
            email: true,
         },
         address: {
            required: true
         },
         company: {
            required: true
         },
         latitude: {
            required: true
         },
         longitude: {
            required: true
         },
         agency_image: {
            extension: "jpg|jpeg|png",
            filesize: 31457280,
         },
      },
      invalidHandler: function (event, validator) { //display error alert on form submit   

      },
      highlight: function (element) { // hightlight error inputs
         $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
      },
      success: function (label) {
         label.closest('.form-group').removeClass('has-error');
         label.remove();
      },
      submitHandler: function (form) {
         form.submit();
      }
   });

   $('#combo-form').validate({
      errorElement: 'span', //default input error message container
      errorClass: 'help-block', // default input error message class
      focusInvalid: true, // do not focus the last invalid input
      ignore: "",
      rules: {
         combo_name: {
            required: true
         },
         combo_title: {
            required: true
         },
         combo_description: {
            required: true,
         },
         combo_location: {
            required: true
         },
         price: {
            required: true,
            number: true
         },
         triple_sharing: {
            required: true,
            number: true
         },
         double_sharing: {
            required: true,
            number: true
         },
         'itinerary[]': {
            required: true,
         },
         days: {
            required: true,
         },
         night: {
            required: true,
         },
         camp_description: {
            required: true,
         },
      },
      invalidHandler: function (event, validator) { //display error alert on form submit   

      },
      highlight: function (element) { // hightlight error inputs
         $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
      },
      success: function (label) {
         label.closest('.form-group').removeClass('has-error');
         label.remove();
      },
      submitHandler: function (form) {
         var len = $(".input_fields_wrap_terms").find("textarea[name='terms[]']").length;
         if (len > 0) {
            form.submit();
         } else {
            swal("Cancelled", "Please enter at least one terms & condition :)", "error");
         }
      }
   });




   var max_fields = 10; //maximum input boxes allowed
   var wrapper = $(".input_fields_wrap"); //Fields wrapper
   var add_button = $(".add_field_button"); //Add button ID
   var x = $(".img_gallery img").length; //initlal text box count
   if (x == 0) {
      x = 1;
   } else {
      x = x + 1;
   }
   $(add_button).click(function (e) { //on add input button click

      e.preventDefault();
      console.log(x, max_fields);
      if (x <= max_fields) {


         var html = '<label class="upload_img"><input type="file" data-number="' + x + '" id="file-upload-' + x + '" name="activityImages[]" class="abc"><img src="http://placehold.it/50x50" id="blah' + x + '" alt="your image" width="50" height="50" /> <button type="button" class="remove_img btn-remove remove_field"> x </button></label>';

         $(wrapper).append(html); //add input box
         x++;
      }
   });
   $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
      e.preventDefault();
      $(this).parent('label.upload_img').remove();
      x--;
   });

   var video_wrapper = $(".input_fields_wrap_video"); //Fields wrapper
   var add_video_button = $(".add_video_button"); //Add button ID
   var y = $(".video_gallery video").length; //initlal text box count
   if (y == 0) {
      y = 1;
   } else {
      y = y + 1;
   }
   $(add_video_button).click(function (e) { //on add input button click
      console.log(y);
      e.preventDefault();
      if (y <= max_fields) {
         var html = '<label class="upload_img"><input type="file" id="file-upload-' + y + '" name="activityVideos[]"><button type="button" class="remove_img btn-remove remove_video_field">x</button></label>';
         $(video_wrapper).append(html); //add input box
         y++;
      }
   });

   $(video_wrapper).on("click", ".remove_video_field", function (e) { //user click on remove text
      e.preventDefault();
      $(this).parent('label.upload_img').remove();
      x--;
   });


   var terms_wrapper = $(".input_fields_wrap_terms"); //Fields wrapper
   var add_terms_button = $(".add_terms_button"); //Add button ID

   $(add_terms_button).click(function (e) { //on add input button click
      var z = $(".input_fields_wrap_terms>div").length; //initlal text box count
      if (z == 0) {
         z = 1;
      }
      e.preventDefault();
      if (z < max_fields) {
         z++;
         var html = '<div class=""><div class="form-group"><div class="col-md-10"><textarea class="form-control" id="terms-' + z + '" name="terms[]" value="" placeholder="Terms & Condition" ></textarea></div><div class="col-md-2"><button type="button" class="btn pull-right btn-danger btn-remove remove_terms_field">Remove</button> </div> </div></div>';
         $(terms_wrapper).append(html); //add input box
      }
   });
   $(terms_wrapper).on("click", ".remove_terms_field", function (e) { //user click on remove text
      e.preventDefault();
      $(this).parent('div').parent('div').remove();
      x--;
   });

   var notes_wrapper = $(".input_fields_wrap_notes"); //Fields wrapper
   var add_notes_button = $(".add_notes_button"); //Add button ID
   $(add_notes_button).click(function (e) { //on add input button click
      var h = $(".input_fields_wrap_notes>div").length; //initlal text box count
      if (h == 0) {
         h = 1;
      }
      e.preventDefault();
      if (h < max_fields) {
         h++;
         var html = '<div class=""><div class="form-group"><div class="col-md-10"><textarea class="form-control" id="notes-' + h + '" name="notes[]" value="" placeholder="Special Notes" ></textarea></div><div class="col-md-2"><button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_notes_field">Remove </button></div></div>';
         $(notes_wrapper).append(html); //add input box
      }
   });
   $(notes_wrapper).on("click", ".remove_notes_field", function (e) { //user click on remove text
      e.preventDefault();
      $(this).parent('div').parent('div').remove();
      x--;
   });

   var meal_wrapper = $(".input_fields_wrap_meal"); //Fields wrapper
   var add_field_button_meal = $(".add_field_button_meal"); //Add button ID
   $(add_field_button_meal).click(function (e) { //on add input button click
      var k = $(".input_fields_wrap_meal>div").length; //initlal text box count
      if (k == 0) {
         k = 1;
      }
      e.preventDefault();
      if (k < max_fields) {
         k++;
         var html = '<div class="form-group"><div class="col-md-10"><textarea class="form-control" id="meal-' + k + '" name="meal[]" value="" placeholder="Add Meal" rows="3"></textarea></div> <div class="col-md-2"><button type="button" class="btn pull-right btn-danger btn-remove remove_field_button_meal">Remove </button></div> </div>';
         $(meal_wrapper).append(html); //add input box
      }
   });
   $(meal_wrapper).on("click", ".remove_field_button_meal", function (e) { //user click on remove text
      e.preventDefault();
      $(this).parent('div').parent('div').remove();
      x--;
   });

   var inclusion_wrapper = $(".input_fields_wrap_inclusion"); //Fields wrapper
   var add_field_button_inclusion = $(".add_field_button_inclusion"); //Add button ID
   $(add_field_button_inclusion).click(function (e) { //on add input button click
      var n = $(".input_fields_wrap_inclusion>div").length; //initlal text box count
      if (n == 0) {
         n = 1;
      }
      e.preventDefault();
      if (n < max_fields) {
         n++;
         var html = '<div class="form-group"><div class="col-md-10"><textarea class="form-control" id="inclusion-' + n + '" name="inclusion[]" value="" placeholder="Add Inclusion Detail" rows="3"></textarea></div><div class="col-md-2"><button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_field_button_inclusion">Remove</button></div></div>';
         $(inclusion_wrapper).append(html); //add input box
      }
   });
   $(inclusion_wrapper).on("click", ".remove_field_button_inclusion", function (e) { //user click on remove text
      e.preventDefault();
      $(this).parent('div').parent('div').remove();
      x--;
   });


   var exclusion_wrapper = $(".input_fields_wrap_exclusion"); //Fields wrapper
   var add_field_button_exclusion = $(".add_field_button_exclusion"); //Add button ID
   $(add_field_button_exclusion).click(function (e) { //on add input button click
      var m = $(".input_fields_wrap_exclusion>div").length; //initlal text box count
      if (m == 0) {
         m = 1;
      }
      e.preventDefault();
      if (m < max_fields) {
         m++;
         var html = '<div class="form-group"><div class="col-md-10"><textarea class="form-control" id="exclusion-' + m + '" name="exclusion[]" value="" placeholder="Add Exclusion Detail" rows="3"></textarea></div><div class="col-md-2"><button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_field_button_exclusion">Remove</button></div> </div> ';
         $(exclusion_wrapper).append(html); //add input box
      }
   });
   $(exclusion_wrapper).on("click", ".remove_field_button_exclusion", function (e) { //user click on remove text
      e.preventDefault();
      $(this).parent('div').parent('div').remove();
      x--;
   });



   $("#days").change(function () {
      var days = $(this).val();
      var length = $(".input_fields_wrap_itenory>div").length;
      if (days > length) {
         var k = parseInt(length) + 1;
         for (var r = k; r <= days; r++) {
            var html = '<div class="col-md-12"><div class="form-group row"><label class="control-label col-md-3">Day ' + r + '</label><div class="col-md-9"><textarea class="form-control" id="itinerary-' + r + '" name="itinerary[]" value="" placeholder="Itinerary" rows="3"></textarea></div></div></div>';
            $(".input_fields_wrap_itenory").append(html); //add input box
         }
      } else if (days < length) {
         remove_div = parseInt(length) - parseInt(days);
         $('.input_fields_wrap_itenory > div').slice(-remove_div).remove();
      }
   });

   $(".services").click(function () {
      var service = $(this).attr("data-service");
      if ($(this).is(":checked")) {
         $("." + service).find('input[type="text"],select,textarea').prop("disabled", false);

         if (service == "camping") {
            $("#camItenary").show();
            $("#camItenary").find('textarea').prop("disabled", false);
            $("#camping").show();
            $("#camping").find('input[type="text"]').prop("disabled", false);
            $("#combo").hide();
            $("#combo").find('input[type="text"]').prop("disabled", true);
         }
      } else {
         $("." + service).find('input[type="text"],select,textarea').prop("disabled", true);

         if (service == "camping") {
            $("#camItenary").hide();
            $("#camItenary").find('textarea').prop("disabled", true);
            $("#camping").hide();
            $("#camping").find('input[type="text"]').prop("disabled", true);
            $("#combo").show();
            $("#combo").find('input[type="text"]').prop("disabled", false);
         }
      }
   });

   $("#days").change(function(){
      $('#night>option').removeAttr("disabled");
      var current_value=parseInt($(this).val())+1;
      $('#night option').filter(function() {
         return $(this).val() >current_value;
      }).prop('disabled', true);
   });

   $('#activity-form').validate({
      errorElement: 'span', //default input error message container
      errorClass: 'help-block', // default input error message class
      focusInvalid: true, // do not focus the last invalid input
      ignore: "",
      rules: {
            activity_id:
            {
                  required: true
            },
            title:
            {
                  required: true
            },
            location:
            {
                  required: true
            },
            "unit_type[]":
            {
                  required: true
            },
            price_per_person:
            {
                  required: true,
                  number: true
            },
            "activityImages[]":
            {
                  extension: "jpg|jpeg|png",
                  filesize: 31457280,
            },
            "activityVideos[]":
            {
                  required: true,
                  extension: "mp4",
                  filesize: 10485760,
            },
            "terms[]":
            {
                  required: true
            }
      },
      errorPlacement: function (error, element) {
            $(element).closest('.col-md-9').append(error);
      },
      invalidHandler: function (event, validator) { //display error alert on form submit   

      },
      highlight: function (element) { // hightlight error inputs
            $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
      },
      success: function (label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
      },
      submitHandler: function (form) {
            var len=$(".input_fields_wrap_terms").find("textarea[name='terms[]']").length;
            if(len>0)
            {
                  form.submit();
            }
            else
            {
                  swal("Cancelled", "Please enter at least one terms & condition :)", "error");
            }
            
      }
   });

   $('.unit_type_value').each(function(e) {
         $(this).rules('add', {
               required: true
         });
   });

   $(".confirm_button").click(function (e) {
      var href = $(this).attr('data-href');
      e.preventDefault();
      swal({
            title: "",
            text: "Are you sure want to delete?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
      },
      function (isConfirm) {
      if (isConfirm) {
            window.location = href; // if you need redirect page 
      }
      else {
            swal("Cancelled", "Your data is safe :)", "error");
      }
      })
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
});

function setModel(str)
{
	$('#uploadType').val(str);
}