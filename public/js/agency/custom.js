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

});