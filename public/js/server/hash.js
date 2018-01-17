
var server_url = "http://hash.zatana.net";
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
 

$("#checkoutform_user_details").on("submit",(e)=>{
       e.preventDefault();
  var phonenumber= $("#phone").val();
 $.ajax({
            url: '/checkoutform_user_details',
            type: 'POST',
            dataType: 'json',
            data: {
                '_token': CSRF_TOKEN,
                'phonenumber':phonenumber
               
            },
            success:function(data){
              console.log("phonenumber success");
              window.location.href = data.url;
            },
            error: function (request){
              console.log("post failure");
              },

     });
});

$("#checkoutform_verifyOTP").on("submit",(e)=>{
       e.preventDefault();
       var otp = $("#otp").val();
       $.ajax({
                url:'/checkoutform_verifyOTP',
                type: 'POST',
                dataType: 'json',
                data: {
                    '_token': CSRF_TOKEN,
                    'otp':otp
                },
                success: function(data) {
                    console.log("otp succes");
                    window.location.href = data.url;
                },
                error: function (request){
                  console.log("otp post failure");
                  },
                });
});

$("#checkoutform_password").on("submit",(e)=>{
       e.preventDefault();
           var otp = $("#password").val();
       $.ajax({
                url:'/checkoutform_password',
                type: 'POST',
                dataType: 'json',
                data: {
                    '_token': CSRF_TOKEN,
                    'otp':otp
                },
                success: function(data) {
                    console.log("password success");
                    window.location.href = data.url;
                },
                error: function (request){
                  console.log("password post failure");
                  },
                
                });
});







