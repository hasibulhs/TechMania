$('#regitration_form').validate(
  {
    errorClass:'invalid',
    validClass:'success',
    
    rules:
    {
     first_name:
     {
      required: true,
      minlength: 2,
      maxlength: 100
     },

     last_name:
     {
     	required: true,
     	minlength: 2,
     	maxlength: 100
     },

     email:
     {
     	required:true,
     	email:true,
      remote:
      {
        url: baseUrl+"/checkemail",
        type: "post",
        data:
        {
          email: function()
          {
            return $( "#email" ).val();
          },
          '_token':$('meta[name="csrf-token"]').attr('content')
        }
      }
     },

     password:
     {
     	required: true,
     	minlength: 6,
     	maxlength: 100
     },

     confirm_password:
     {
     	required: true,
     	equalTo: '#password'
     },

     terms:"required"
    },

	 messages:
   {
	    first_name:
      {
	  		required: "please enter your first name"
	    },

	    last_name:
      {
	  		required: "please enter your last name"
	    },

	    email:
      {
	      required: "we need your email address to contact you",
	      email: "your email address must be in the format of name@domain.com",
	      remote: "email already in use, please try with different email"
	    },

	    password:
      {
	    	required:"enter your password"
	    },

	    confirm_password:
      {
	    	required:"need to confirm your password"
	    },

	    terms:"please accept our terms and conditions",
	 },

	 errorPlacement:function(error,element)
   {
    if(element.attr('name')=='terms')
    {
      error.appendTo($('#terms_error'));
    }

    else if(element.attr('name')=='grecaptcha')
    {
        error.appendTo($('#hiddenRecaptchaRegisterError'));
    }

    else
    {
      error.insertAfter(element);
    }
	 },

   submitHandler:function(form)
   {
      $.LoadingOverlay("show");
      form.submit();
   }
});

$('#login_form').validate({
  errorClass:'invalid',
  validClass:'success',
  rules:{
   email:{
      required:true,
      email:true,  
   },
   password:{
      required:true,
      minlength:6,
      maxlength:100
   },

  },
   messages: {

      email: {
        required: "Please enter your email",
        email: "Your email address must be in the format of name@domain.com",

      },
      password:{
          required:"Please enter your password"
      },
   },
   
   submitHandler:function(form)
   {   
      $.LoadingOverlay("show");
      form.submit();
   }
});