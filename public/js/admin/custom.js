jQuery.ajaxSetup({
   headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
   }
});

$(document).ready(function () {
   var x = 1;
   $(document).on('click','.btn-add', function (e) {
      x++;
      e.preventDefault();

      var controlForm = $('.controls:first');
      var currentEntry = '<div class="form-group row voca"><label class="control-label visible-ie8 visible-ie9">Open</label><div class="col-md-4"><select class="form-control" id="day_' + x + '" name="day[]"><option value="" selected="selected">Day</option><option value="monday">Monday</option><option value="tuesday">Tuesday</option><option value="wednesday">Wednesday</option><option value="thursday">Thursday</option><option value="friday">Friday</option><option value="saturday">Saturday</option><option value="sunday">Sunday</option></select></div><div class="col-md-3"><label class="control-label visible-ie8 visible-ie9">Open</label><input class="form-control placeholder-no-fix" id="open_time_' + x + '" type="text" placeholder="00:00" name="open_time[]"></div><div class="col-md-3"><label class="control-label visible-ie8 visible-ie9">Close</label><input class="form-control placeholder-no-fix" id="close_time_' + x + '" type="text" placeholder="23:59" name="close_time[]"></div><div class="col-md-1"><button type="button" class="btn btn-success pull-right btn-danger btn-remove"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div>';
      var newEntry = $(currentEntry).appendTo(controlForm);

      newEntry.find('input').val('');
      controlForm.find('.btn-add:not(:last)')
              .removeClass('btn-default').addClass('btn-danger')
              .removeClass('btn-add').addClass('btn-remove')
              .html('<span class="glyphicon glyphicon-minus" aria-hidden="true"></span> ');
   }).on('click', '.btn-remove', function (e)
   {
      $(this).parents('.voca:first').remove();
      x--;
      e.preventDefault();
      return false;
   });
   
   $("#import_excel").click(function(){
      $('input[name="excel_med_uplad"]').click();
   });
   
   $("input[name='excel_med_uplad']").change(function() { 
      var fileName = $(this).val();
      var ext = $(this).val().split('.').pop().toLowerCase();
      if($.inArray(ext, ['csv']) == -1) 
      {
         swal("Sorry", "You choose the invalid extension!. Please use csv format.", "error")
      }
      else
      {
         this.form.submit(); 
      }      
   });
   
   
   
   if($(".shop .timings").length>0)
   {
      var y = $(".shop .timings").length;
   }
   else
   {
      var y = 1;
   }
   
   $(document).on('click','.btn-add-2', function (e) {
      y++;
      e.preventDefault();

      var controlForm = $('.controls:first');
      var currentEntry = '<div class="form-group timings"><div class="col-md-4"><select class="form-control" id="day_' + y + '" name="day[]"><option value="" selected="selected">Day</option><option value="monday">Monday</option><option value="tuesday">Tuesday</option><option value="wednesday">Wednesday</option><option value="thursday">Thursday</option><option value="friday">Friday</option><option value="saturday">Saturday</option><option value="sunday">Sunday</option></select></div><div class="col-md-3"><input type="text" placeholder="00:00" class="form-control" id="open_time_' + y + '" name="open_time[]"  /></div><div class="col-md-3"><input type="text" placeholder="23:59" class="form-control" id="close_time_' + y + '" name="close_time[]"  /></div><div class="col-md-1"><button type="button" class="btn btn-success pull-right btn-danger btn-remove-2"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div>';
      var newEntry = $(currentEntry).appendTo(controlForm);

      newEntry.find('input').val('');
      controlForm.find('.btn-add-2:not(:last)')
              .removeClass('btn-default').addClass('btn-danger')
              .removeClass('btn-add-2').addClass('btn-remove-2')
              .html('<span class="glyphicon glyphicon-minus" aria-hidden="true"></span> ');
   }).on('click', '.btn-remove-2', function (e)
   {
      $(this).parents('.timings:first').remove();
      y--;
      e.preventDefault();
      return false;
   });
   if($(".controlss").length>0)
   {
      var z = $(".controlss").length;
   }
   else
   {
      var z = 0;
   }
   $(document).on('click','.add_more', function (e) {
      
      e.preventDefault();

      var controlForm = $('.controlss:first');
      var currentEntry = '<div class="form-group timingss"><div class="col-md-4"><input type="text" class="form-control" id="label_'+z+'" name="label[]" placeholder="label" /></div><div class="col-md-3"><input type="text" class="form-control" id="value_'+z+'" name="value[]" placeholder="value" /></div><div class="col-md-3"><select class="form-control" id="type_'+z+'" name="type[]"><option value="">Select Type</option><option value="1">Percentage</option><option value="2">Fixed</option></select></div><div class="col-md-2"><span><a href="javascript:void(0);" class="remove_more"> Remove</a></span></div></div>';
      var newEntry = $(currentEntry).appendTo(controlForm);
      z++;
      newEntry.find('input').val('');
   }).on('click', '.remove_more', function (e)
   {
      $(this).parents('.timingss:first').remove();
      z--;
      e.preventDefault();
      return false;
   });
     

      $.validator.addMethod("time24", function(value, element) { 
         if (!/^\d{2}:\d{2}$/.test(value)) return false;
         var parts = value.split(':');

         if (parts[0] > 23 || parts[1] > 59) return false;
         return true;
      }, "Invalid time format.");

      $('#addPharmacy').validate({
         errorElement: 'span', //default input error message container
         errorClass: 'help-block', // default input error message class
         focusInvalid: true, // do not focus the last invalid input
         ignore: "",
         rules: {
            name: 
            {
               required: true
            },
            description: 
            {
               required: true
            },
            email: 
            {
               required: true,
               email: true,
               remote: {
                  url: base_url+"/admin/pharmacy-exist",
                  type: "get"
               }
            },
            mobile: 
            {
               required: true,
               number:true,
            },
            address: 
            {
               required: true
            },            
            latitude: 
            {
               required: true
            },            
            longitude: 
            {
               required: true
            },            
            city: 
            {
               required: true
            },
            "day[]": 
            {
               required: true,
            },
            "open_time[]": 
            {
               required: true,
               time24:true
            },
            "close_time[]": 
            {
               required: true,
               time24:true
            },

            phar_image: {
               extension: "png|jpeg|gif|PNG|JPEG|GIF|JPG|jpg"
            },
            license_image: {
               extension: "png|jpeg|gif|PNG|JPEG|GIF|JPG|jpg"
            }
            
         },
         messages: {
            email: {
               remote: "Email is already exists."
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
      
      
      $('.set_commision').validate({
         errorElement: 'span', //default input error message container
         errorClass: 'help-block', // default input error message class
         focusInvalid: true, // do not focus the last invalid input
         ignore: "",
         rules: {
            admin_commision: 
            {
               number:true,
            },
            delivery_charges: 
            {
               number:true,
            },
            "label[]": 
            {
               required: true,
            },
            "value[]": 
            {
               required: true,
            },            
            "type[]": 
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

      $('.set_commision').keypress(function (e) {
         if (e.which == 13) {
            if ($('.update-profile-form').validate().form()) {
               $('.update-profile-form').submit();
            }
            return false;
         }
      });
      
      $('#addMedicine').validate({
         errorElement: 'span', //default input error message container
         errorClass: 'help-block', // default input error message class
         focusInvalid: true, // do not focus the last invalid input
         ignore: "",
         rules: {
            name: 
            {
               required:true,
            },
            description: 
            {
               required:true,
            },
            quantity_unit: 
            {
               required:true,
            },
            quantity: 
            {
               required:true,
               number: true,
            },
            "price": 
            {
               required: true,
               digits: true,
            },
            "prescription": 
            {
               required: true,
            },            
            med_image: {
               required: true,
               extension: "png|jpeg|gif|PNG|JPEG|GIF|JPG|jpg"
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
      
      
      
        $('#addQuantityUnit').validate({
         errorElement: 'span', //default input error message container
         errorClass: 'help-block', // default input error message class
         focusInvalid: true, // do not focus the last invalid input
         ignore: "",
         rules: {
            name: 
            {
               required:true,
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
      
      
      

      $('.set_commision').keypress(function (e) {
         if (e.which == 13) {
            if ($('.update-profile-form').validate().form()) {
               $('.update-profile-form').submit();
            }
            return false;
         }
      });

     
});

//$('#email').on('blur',function(){
//    var email = document.getElementById('email').value;
//   $.get('pharmacy-exist?mail='+email,function(data){
//       if(data==1){
//           $('#email_exist').html('email id already registered.');
//           return false;
//       }else{
//        $('#email_exist').html('');
//     
//       }
//   });
//});
     
     
     
 function checkMail(){
    alert();
       var email = document.getElementById('email').value;
      $.get('pharmacy-exist?mail='+email,function(data){
       if(data==1){
           $('#email_exist').html('email id already registered.');
           return false;
       }else{
        $('#email_exist').html('');
     
       }
   });   
 }  
 
 
// set value on model 
 function setModel(str)
{
	$('#uploadType').val(str);
}


// check upload docs

function checkUplaodDocs(str)
{
  var fuData = document.getElementById(str);
    var FileUploadPath = fuData.value;

//To check if user upload any file
        if (FileUploadPath == '') 
        {
            swal("","Please upload an image");
            return false;

        } else 
        {
            var Extension = FileUploadPath.substring(
                    FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

//The file uploaded is an image

if (Extension == "pdf" || Extension == "png" || Extension == "jpeg" || Extension == "jpg") {


  } 

//The file upload is NOT an image
else {
                swal("","Doc only allows file types of PDF, PNG, JPG and JPEG. ");
                return false;
            }
        }
	
              
	
}

      
 // accept pharmacy

 function acceptAgency(agency_id){
 $('#agency_id_field').val(agency_id);
 $('#agency_status').val(1);

 }
    
  // reject pharmacy  
function rejectAgency(agency_id){
  $('#agency_id_field').val(agency_id);
 $('#agency_status').val(2);   
    
}      
  
