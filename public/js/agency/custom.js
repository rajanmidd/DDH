jQuery.ajaxSetup({
   headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
   }
});

$(document).ready(function () {
      $(".filestyle").filestyle();
      
      if ($(".shop .timings").length > 0) {
            var y = $(".shop .timings").length;
      }
      else {
            var y = 1;
      }

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

      $('.change-password-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
            old_password:
                  {
                  required: true
                  },
            new_password:
                  {
                  required: true
                  },
            confirm_new_password:
                  {
                  required: true,
                  equalTo: "#new_password"
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

      $.validator.addMethod('filesize', function (value, element, param) {
            console.log(element.files[0].size);
            return this.optional(element) || (element.files[0].size <= param)
      });

      $.validator.addMethod("mytst", function (value, element) {
            var flag = true;
            $("[name^=unit_type_value]").each(function (i, j) {
                  alert();
                  $(this).parent('p').find('label.error').remove();
                  $(this).parent('p').find('label.error').remove();                        
                  if ($.trim($(this).val()) == '') {
                        flag = false;

                        $(this).parent('p').append('<label  id="id_ct'+i+'-error" class="error">This field is required.</label>');
                  }
            });
            return flag;
      }, "");

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
                  total_cost_after_discount:
                  {
                        required: true,
                        number: true
                  },
                  difficult_level:
                  {
                        required: true
                  },
                  minimum_amount_percent:
                  {
                        required: true,
                        number: true
                  },
                  price_per_person:
                  {
                        required: true,
                        number: true
                  },
                  open_time:
                  {
                        required: true
                  },
                  close_time:
                  {
                        required: true
                  },
                  description:
                  {
                        required: true
                  },
                  "activityImages[]":
                  {
                        required: true,
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
                  },
                  "notes[]":
                  {
                        required: true
                  },
            },
            errorPlacement: function (error, element) {
            $(element).closest('.form-group').append(error);
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

      $('.unit_type_value').each(function(e) {
            $(this).rules('add', {
                  required: true,
                  number: true
            });
      });


      $('.update-profile-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                  owner_name: 
                  {
                        required: true
                  },
                  address: 
                  {
                        required: true
                  },
                  email: 
                  {
                        required: true,
                        email: true,
                        remote: {
                              url: base_url+"/agency/check-email",
                              type: "post"
                        }
                  },
                  password: 
                  {
                        required: true
                  },
                  confirm_password: 
                  {
                        required: true,
                        equalTo: "#password"
                  },
                  mobile: 
                  {
                        required: true,
                        number:true,
                  },          
                  certificate_image: {
                        extension: "png|jpeg|gif|PNG|JPEG|GIF|JPG|jpg"
                  },
                  id_proof: {
                        extension: "png|jpeg|gif|PNG|JPEG|GIF|JPG|jpg"
                  },
            
            },
            messages: {
                  email: {
                        remote: "Email is already exists."
                  },
            },
            errorPlacement: function (error, element) {
                  $(element).closest('.form-group .col-md-9').append(error);
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



      $('#camping-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                  camping_name:
                  {
                        required: true
                  },
                  camping_title:
                  {
                        required: true
                  },
                  camping_description:
                  {
                        required: true,
                  },
                  camping_location:
                  {
                        required: true,
                  },
                  days:
                  {
                        required: true,
                  },
                  night:
                  {
                        required: true,
                  },
                  triple_sharing:
                  {
                        required: true,
                        number:true
                  },
                  double_sharing:
                  {
                        required: true,
                        number:true
                  },
                  'itinerary[]':
                  {
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
                  form.submit();
            }
      });


      $('#combo-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                  combo_name:
                  {
                        required: true
                  },
                  combo_title:
                  {
                        required: true
                  },
                  combo_description:
                  {
                        required: true,
                  },
                  combo_location:
                  {
                        required: true
                  },
                  price:
                  {
                        required: true,
                        number:true
                  },
                  triple_sharing:
                  {
                        required: true,
                        number:true
                  },
                  double_sharing:
                  {
                        required: true,
                        number:true
                  },
                  'itinerary[]':
                  {
                        required: true,
                  },
                  days:
                  {
                        required: true,
                  },
                  night:
                  {
                        required: true,
                  },
                  camp_description:
                  {
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
                  form.submit();
            }
      });




      var max_fields      = 10; //maximum input boxes allowed
      var wrapper         = $(".input_fields_wrap"); //Fields wrapper
      var add_button      = $(".add_field_button"); //Add button ID
      var x = $(".img_gallery img").length; //initlal text box count
      if(x==0)
      {
            x=1;
      }
      else
      {
            x=x+1;
      }
      $(add_button).click(function(e){ //on add input button click
            
            e.preventDefault();
            console.log(x , max_fields);
            if(x <= max_fields)
            {
                  
                  var html='<div><div class="col-md-12"><div class="form-group"><label class="control-label">File input</label><div class="form-group"><input type="file" data-number="'+x+'" id="file-upload-'+x+'" name="activityImages[]" class="abc"><img src="http://placehold.it/50x50" id="blah'+x+'" alt="your image" width="50" height="50" /><button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_field"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div></div></div>';
                  $(wrapper).append(html); //add input box
                  x++;
            }
      });
      $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); 
            $(this).parent('div').parent('div').remove(); x--;
      });

      var video_wrapper         = $(".input_fields_wrap_video"); //Fields wrapper
      var add_video_button      = $(".add_video_button"); //Add button ID
      var y = $(".video_gallery video").length; //initlal text box count
      if(y==0)
      {
            y=1;
      }
      else
      {
            y=y+1;
      }
      $(add_video_button).click(function(e){ //on add input button click
            console.log(y);
            e.preventDefault();
            if(y <= max_fields)
            {                  
                  var html='<div><div class="col-md-12"><div class="form-group"><label class="control-label">File input</label><div class="form-group"><input type="file" id="file-upload-'+y+'" name="activityVideos[]"></div></div><button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_video_field"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div>';
                  $(video_wrapper).append(html); //add input box
                  y++;
            }
      });

      $(video_wrapper).on("click",".remove_video_field", function(e){ //user click on remove text
            e.preventDefault(); 
            $(this).parent('div').parent('div').remove(); x--;
      });


      var terms_wrapper         = $(".input_fields_wrap_terms"); //Fields wrapper
      var add_terms_button      = $(".add_terms_button"); //Add button ID
      
      $(add_terms_button).click(function(e){ //on add input button click
            var z = $(".input_fields_wrap_terms>div").length; //initlal text box count
            if(z==0)
            {
                  z=1;
            }
            e.preventDefault();
            if(z < max_fields)
            {
                  z++;
                  var html='<div><div class="col-md-12"><div class="form-group"><label class="control-label">Terms & Conditions</label><div class="form-group"><textarea class="form-control" id="terms-'+z+'" name="terms[]" value="" placeholder="Terms & Condition" rows="3"></textarea></div></div><button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_terms_field"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div>';
                  $(terms_wrapper).append(html); //add input box
            }
      });
      $(terms_wrapper).on("click",".remove_terms_field", function(e){ //user click on remove text
            e.preventDefault(); 
            $(this).parent('div').parent('div').remove(); x--;
      });

      var notes_wrapper         = $(".input_fields_wrap_notes"); //Fields wrapper
      var add_notes_button      = $(".add_notes_button"); //Add button ID
      $(add_notes_button).click(function(e){ //on add input button click
            var h = $(".input_fields_wrap_notes>div").length; //initlal text box count
            if(h==0)
            {
                  h=1;
            }
            e.preventDefault();
            if(h < max_fields)
            {
                  h++;
                  var html='<div><div class="col-md-12"><div class="form-group"><label class="control-label">Special Notes</label><div class="form-group"><textarea class="form-control" id="notes-'+h+'" name="notes[]" value="" placeholder="Special Notes" rows="3"></textarea></div></div><button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_notes_field"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div>';
                  $(notes_wrapper).append(html); //add input box
            }
      });
      $(notes_wrapper).on("click",".remove_notes_field", function(e){ //user click on remove text
            e.preventDefault(); 
            $(this).parent('div').parent('div').remove(); x--;
      });

      var meal_wrapper         = $(".input_fields_wrap_meal"); //Fields wrapper
      var add_field_button_meal      = $(".add_field_button_meal"); //Add button ID
      $(add_field_button_meal).click(function(e){ //on add input button click
            var k = $(".input_fields_wrap_meal>div").length; //initlal text box count
            if(k==0)
            {
                  k=1;
            }
            e.preventDefault();
            if(k < max_fields)
            {
                  k++;
                  var html='<div><div class="col-md-12"><div class="form-group"><label class="control-label">Add Meal</label><div class="form-group"><textarea class="form-control" id="meal-'+k+'" name="meal[]" value="" placeholder="Add Meal" rows="3"></textarea></div></div><button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_field_button_meal"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div>';
                  $(meal_wrapper).append(html); //add input box
            }
      });
      $(meal_wrapper).on("click",".remove_field_button_meal", function(e){ //user click on remove text
            e.preventDefault(); 
            $(this).parent('div').parent('div').remove(); x--;
      });

      var inclusion_wrapper         = $(".input_fields_wrap_inclusion"); //Fields wrapper
      var add_field_button_inclusion      = $(".add_field_button_inclusion"); //Add button ID
      $(add_field_button_inclusion).click(function(e){ //on add input button click
            var n = $(".input_fields_wrap_inclusion>div").length; //initlal text box count
            if(n==0)
            {
                  n=1;
            }
            e.preventDefault();
            if(n < max_fields)
            {
                  n++;
                  var html='<div><div class="col-md-12"><div class="form-group"><label class="control-label">Add Inclusion Detail</label><div class="form-group"><textarea class="form-control" id="inclusion-'+n+'" name="inclusion[]" value="" placeholder="Add Inclusion Detail" rows="3"></textarea></div></div><button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_field_button_inclusion"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div>';
                  $(inclusion_wrapper).append(html); //add input box
            }
      });
      $(inclusion_wrapper).on("click",".remove_field_button_inclusion", function(e){ //user click on remove text
            e.preventDefault(); 
            $(this).parent('div').parent('div').remove(); x--;
      });


      var exclusion_wrapper         = $(".input_fields_wrap_exclusion"); //Fields wrapper
      var add_field_button_exclusion      = $(".add_field_button_exclusion"); //Add button ID
      $(add_field_button_exclusion).click(function(e){ //on add input button click
            var m = $(".input_fields_wrap_exclusion>div").length; //initlal text box count
            if(m==0)
            {
                  m=1;
            }
            e.preventDefault();
            if(m < max_fields)
            {
                  m++;
                  var html='<div><div class="col-md-12"><div class="form-group"><label class="control-label">Add Exclusion Detail</label><div class="form-group"><textarea class="form-control" id="exclusion-'+m+'" name="exclusion[]" value="" placeholder="Add Exclusion Detail" rows="3"></textarea></div></div><button type="button" class="btn btn-success pull-right btn-danger btn-remove remove_field_button_exclusion"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div>';
                  $(exclusion_wrapper).append(html); //add input box
            }
      });
      $(exclusion_wrapper).on("click",".remove_field_button_exclusion", function(e){ //user click on remove text
            e.preventDefault(); 
            $(this).parent('div').parent('div').remove(); x--;
      });

      
      
      $("#days").change(function(){
            var days=$(this).val();
            var length=$(".input_fields_wrap_itenory>div").length;
            if(days >length)
            {
                  var k=parseInt(length)+1;
                  for(var r=k;r<=days;r++)
                  {
                        var html='<div><div class="col-md-12"><div class="form-group"><label class="control-label">Day '+r+'</label><div class="form-group"><textarea class="form-control" id="itinerary-'+r+'" name="itinerary[]" value="" placeholder="Itinerary" rows="3"></textarea></div></div></div></div>';
                        $(".input_fields_wrap_itenory").append(html); //add input box
                  }
            }
            else if(days <length)
            {
                  remove_div=parseInt(length)-parseInt(days);
                  $('.input_fields_wrap_itenory > div').slice(-remove_div).remove();
            }          
      });

      $(".services").click(function(){
            var service=$(this).attr("data-service");
            if($(this).is(":checked"))
            {
                  $("."+service).find('input[type="text"],select,textarea').prop("disabled",false);
                  $("#camItenary").show();
                  $("#camItenary").find('textarea').prop("disabled",false);
                  if(service=="camping")
                  {
                        $("#camping").show();
                        $("#camping").find('input[type="text"]').prop("disabled",false);
                        $("#combo").hide();
                        $("#combo").find('input[type="text"]').prop("disabled",true);
                  }
            }
            else
            {
                  $("."+service).find('input[type="text"],select,textarea').prop("disabled",true);
                  $("#camItenary").hide();
                  $("#camItenary").find('textarea').prop("disabled",true);
                  if(service=="camping")
                  {
                        $("#camping").hide();
                        $("#camping").find('input[type="text"]').prop("disabled",true);
                        $("#combo").show();
                        $("#combo").find('input[type="text"]').prop("disabled",false);
                  }
            }
      });

});