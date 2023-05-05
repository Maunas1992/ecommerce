<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
         <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>Electro - HTML Ecommerce Template</title>

        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>

        <!-- Slick -->
        <link type="text/css" rel="stylesheet" href="{{asset('css/slick.css')}}"/>
        <link type="text/css" rel="stylesheet" href="{{asset('css/slick-theme.css')}}"/>

        <!-- nouislider -->
        <link type="text/css" rel="stylesheet" href="{{asset('css/nouislider.min.css')}}"/>

        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}"/>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
            
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/slick.min.js')}}"></script>
        <script src="{{asset('js/nouislider.min.js')}}"></script>
        <script src="{{asset('js/jquery.zoom.min.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript">
        function tempwish(e) {
        console.log('tempwish line1')
         
        let ahref = $(e).attr('data-attr');
        console.log(ahref)
        let url = "{{ route('addwishlist', ['id' => ":ahref"]) }}";
        url = url.replace(":ahref", ahref);
        // let smessage = $(e).attr('#message');
        $.ajax({
            url: url,
            type: "POST",
            dataType : "json",
            data: ahref,

            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
              
            
            success: function(data) {
                console.log(data.message)
                if (data.status == true) {
                    $(e).html('<i class="fa fa-heart" aria-hidden="true"></i>');
                    $("#message").html('<div class="alert alert-success alert-dismissible" id="message"><strong>Your product has been added to your Wishlist.</strong></div>');
                    if(data.wishcount != 0){
                        $("#wishcount").html(data.wishcount);
                    }else{
                        $("#wishcount").html('0');
                    }
                } else {
                    
                    $(e).html('<i class="fa fa-heart-o"></i>');
                   
                    
                    $("#message").html('<div class="alert alert-success alert-dismissible" id="message"><strong>Your product is removed from Wishlist.</strong></div>');
                    if(data.wishcount != 0){
                        $("#wishcount").html(data.wishcount);
                    }else{
                        $("#wishcount").html('0');
                    }
                }
                console.log(data.message)
            }
        });
    
    }
</script>
    </head>
    <body>
        @include('applayout.appheader')
        @yield('content')
        @include('applayout.appfooter')
    

    </body>
</html>