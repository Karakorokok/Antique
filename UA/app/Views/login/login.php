<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scantrash </title>
    <link rel="shortcut icon" href="/assets/images/logo.png" type="image/x-icon">

    <!-- css -->
    <link rel="stylesheet" href="/css/style.css">
        <!-- css -->
    <link rel="stylesheet" href="/css/bootstrap_override.css">
    <link rel="stylesheet" href="/css/datatable_override.css">
    <!-- bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- fonts -->
  
 
    <!-- pagination -->
    <link type="text/css" rel="stylesheet" href="css/simplePagination.css"/>
</head>
<body>

 


    <?php

        function display_error($validation,$field)
            {
                if($validation->hasError($field))
                {
                    return $validation->getError($field);
                }
                else 
                {
                    return false;
                }
            }

    ?>

    <div class="row container-fluid center my-3">
        <div class="col-md-6 col-12 bg-white p-4 rounded mt-5 center">
            <img src="/assets/images/logo.png" height="75" class="center mb-3">
            <div class="h5 text-center">Login</div>
            <form action ="/VerifyLogin" method ="POST">
            <?php if (!empty(session()->getFlashdata('login-fail'))):?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('login-fail');?></div>
            <?php endif ?>
            <?php if (!empty(session()->getFlashdata('login-success'))):?>
                            <div class="alert alert-success"><?= session()->getFlashdata('login-success');?></div>
            <?php endif ?>
                <div class="mb-3">
                <p  style="color:red;"><?= isset($validation) ? display_error($validation,'username'):''?></p>
                    <label class="form-label">Username</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user text-secondary"></i></span>
                        <input type="text" name ="username"class="form-control">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock text-secondary"></i></span>
                        <input type="password" name="password" class="form-control password">
                    </div>
                </div>
                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input togglePass">
                    <small class="form-check-label">Show Password</small>
                </div>
                <button class="btn  w-100 mb-3" style ="background-color: #2fa8ed;">Login</button>
                

            </form>
        </div>
        <div class="text-center my-4"><small>© 2024, Barbaza Antique Scantrash to Cash </small></div>
    </div>
   
    
   

    <!-- bootstrap 5.3.3 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- jquery 3.7.1 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- font-awesome -->
    <script src="https://kit.fontawesome.com/5d8b225433.js" crossorigin="anonymous"></script>

  

</body>
<script>
        $(document).ready(function() {

            $('.togglePass').click(function() {
                var toggle = $('.password');
                toggle = (toggle.prop('type') == 'password') ? 
                toggle.attr('type','text') : toggle.attr('type','password');
            });

        });
    </script>
</html>