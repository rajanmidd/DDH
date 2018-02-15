/*** Ajax form submit ***/	
jQuery.ajaxSetup({
   headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
   }
});

var loginValidator="";
var forgetPassowrdValidator="";
var registerValidator="";
var Login = function () {

   var handleLogin = function () {

      loginValidator = $('.login-form').validate({
         errorElement: 'span', //default input error message container
         errorClass: 'help-block', // default input error message class
         focusInvalid: false, // do not focus the last invalid input
         rules: {
            email: {
               required: true,
               email: true,
            },
            password: {
               required: true
            },
            remember: {
               required: false
            }
         },
         messages: {
            email: {
               required: "Email is required."
            },
            password: {
               required: "Password is required."
            }
         },
         invalidHandler: function (event, validator) { //display error alert on form submit   
         },
         highlight: function (element) { // hightlight error inputs
            $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
         },
         success: function (label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
         },
         submitHandler: function (form) {
            form.submit(); // form validation success, call ajax form submit
         }
      });

      $('.login-form input').keypress(function (e) {
         if (e.which == 13) {
            if ($('.login-form').validate().form()) {
               $('.login-form').submit(); //form validation success, call ajax form submit
            }
            return false;
         }
      });
   }

   var handleForgetPassword = function () {
      forgetPassowrdValidator=$('.forget-form').validate({
         errorElement: 'span', //default input error message container
         errorClass: 'help-block', // default input error message class
         focusInvalid: false, // do not focus the last invalid input
         ignore: "",
         rules: {
            email: {
               required: true,
               email: true,
               remote: {
                  url: base_url+"/agency/check-email-exists",
                  type: "post"
               }
            }
         },
         messages: {
            email: {
               remote: "Sorry,Your account doesn't exists with this email."
            }
         },
         invalidHandler: function (event, validator) { //display error alert on form submit   

         },
         highlight: function (element) { // hightlight error inputs
            $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
         },
         success: function (label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
         },
         submitHandler: function (form) {
            form.submit();
         }
      });

      $('.forget-form input').keypress(function (e) {
         if (e.which == 13) {
            if ($('.forget-form').validate().form()) {
               $('.forget-form').submit();
            }
            return false;
         }
      });

      jQuery('#forget-password').click(function () {
         jQuery('.login-form').hide();
         jQuery('.forget-form').show();
         console.log(loginValidator);
         registerValidator.resetForm();
         loginValidator.resetForm();
         forgetPassowrdValidator.resetForm();
      });

      jQuery('#back-btn').click(function () {
         jQuery('.login-form').show();
         jQuery('.forget-form').hide();
         registerValidator.resetForm();
         loginValidator.resetForm();
         forgetPassowrdValidator.resetForm();
      });

   }

   var handleRegister = function () {

      function format(state) {
         if (!state.id)
            return state.text; // optgroup
         return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
      }

      if (jQuery().select2) {
         $("#select2_sample4").select2({
            placeholder: '<i class="fa fa-map-marker"></i>&nbsp;Select a Country',
            allowClear: true,
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function (m) {
               return m;
            }
         });


         $('#select2_sample4').change(function () {
            $('.register-form').validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
         });
      }
      
      $.validator.addMethod("time24", function(value, element) { 
         if (!/^\d{2}:\d{2}$/.test(value)) return false;
         var parts = value.split(':');

         if (parts[0] > 23 || parts[1] > 59) return false;
         return true;
      }, "Invalid time format.");

      registerValidator=$('.register-form').validate({
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
            company: 
            {
               required: true
            }, 
            terms_condition: 
            {
               required: true
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

      $('.register-form input').keypress(function (e) {
         if (e.which == 13) {
            if ($('.register-form').validate().form()) {
               $('.register-form').submit();
            }
            return false;
         }
      });

      jQuery('#register-btn').click(function () {
         jQuery('.login-form').hide();
         jQuery('.register-form').show();
         registerValidator.resetForm();
         loginValidator.resetForm();
         forgetPassowrdValidator.resetForm();
         
      });

      jQuery('#register-back-btn').click(function () {
         jQuery('.login-form').show();
         jQuery('.register-form').hide();
         registerValidator.resetForm();
         loginValidator.resetForm();
         forgetPassowrdValidator.resetForm();
      });
   }
   
   
   var handleChangePassword = function () {

      $('.forget-password-form').validate({
         errorElement: 'span', //default input error message container
         errorClass: 'help-block', // default input error message class
         focusInvalid: false, // do not focus the last invalid input
         rules: {
            password: 
            {
               required: true
            },
            confirm_password: 
            {
               required: true,
               equalTo: "#password"
            },
         },
         invalidHandler: function (event, validator) { //display error alert on form submit   
         },
         highlight: function (element) { // hightlight error inputs
            $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
         },
         success: function (label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
         },
         submitHandler: function (form) {
            form.submit(); // form validation success, call ajax form submit
         }
      });

      $('.forget-password-form').keypress(function (e) {
         if (e.which == 13) {
            if ($('.login-form').validate().form()) {
               $('.login-form').submit(); //form validation success, call ajax form submit
            }
            return false;
         }
      });
   }

   return {
      //main function to initiate the module
      init: function () {

         handleLogin();
         handleForgetPassword();
         handleRegister();
         handleChangePassword();

      }

   };

}();