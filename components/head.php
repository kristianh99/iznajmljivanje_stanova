<?php
$root = 'https://'.getenv('HTTP_HOST');
if(strpos($_SERVER['PHP_SELF'],basename(__FILE__))){
    header("Location:$root");
}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Comatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RH</title>

    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> 
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/332a215f17.js" crossorigin="anonymous"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="<?php echo $root.'/main.js' ?>"></script>


    <link rel="stylesheet" href="<?php echo $root.'/css/main.css' ?>">
    <script type="text/javascript" src="<?php echo $root.'/js/jquery.fullpage.js' ?>"></script>


    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript">
                $(document).ready(function (){
                    $(".menu-icon").on("click", function (){
                        $("nav ul").toggleClass("showing");
                    });
                });
    </script>

    <script>
            $(".container").on("click", function (){
                $(".card").toggleClass("flipping");
            });
    </script>


        
</head>