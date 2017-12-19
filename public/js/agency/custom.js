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
      var href = $(this).attr('href');
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
         unit_type:
            {
               required: true
            },
         capacity:
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
         "season[]":
            {
               required: true
            },
         "days[]":
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

   $.validator.addMethod('filesize', function (value, element, param) {
      console.log(element.files[0].size);
      return this.optional(element) || (element.files[0].size <= param)
   });

   $('#upload-images-form').validate({
      errorElement: 'span', //default input error message container
      errorClass: 'help-block', // default input error message class
      focusInvalid: true, // do not focus the last invalid input
      ignore: "",
      rules: {
         "activityImages[]":
            {
               required: true,
               extension: "jpg|jpeg|png",
               filesize: 31457280,
            },
	  },
	  messages: {
		"activityImages[]":
		   {
			  filesize: "File must be JPEG or PNG, less than 3 MB"
		   }
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

   $('#upload-videos-form').validate({
      errorElement: 'span', //default input error message container
      errorClass: 'help-block', // default input error message class
      focusInvalid: true, // do not focus the last invalid input
      ignore: "",
      rules: {
         "activityVideos[]":
            {
               required: true,
               extension: "mp4",
               filesize: 10485760,
            },
      },
      messages: {
         "activityVideos[]":
            {
               filesize: "File must be MP4, less than 10 MB"
            }
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

   $('#upload-terms-form').validate({
	errorElement: 'span', //default input error message container
	errorClass: 'help-block', // default input error message class
	focusInvalid: true, // do not focus the last invalid input
	ignore: "",
	rules: {
	   "terms[]":
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

 $('#upload-notes-form').validate({
	errorElement: 'span', //default input error message container
	errorClass: 'help-block', // default input error message class
	focusInvalid: true, // do not focus the last invalid input
	ignore: "",
	rules: {
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
});