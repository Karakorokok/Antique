<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" href="/assets/images/logo.png" type="image/x-icon">

    <!-- css -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/bootstrap_override.css">
    <link rel="stylesheet" href="/css/datatable_override.css">
    <link rel="stylesheet" href="/css/sidebar.css">
    <!-- bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bona+Nova&display=swap">
    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.bootstrap5.css">
</head>
<body>


    <div class="container-fluid">
        <div class="row">
            <div id="sidebar" class="col-auto">
                <?= $this->include('shared/admin_sidebar') ?>
            </div>
            <!----------------------------------------->
            <div id="main" class="col">
                <?= $this->include('shared/admin_topbar') ?>
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>
    <!-- bootstrap 5.3.3 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- jquery 3.7.1 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- font-awesome -->
    <script src="https://kit.fontawesome.com/5d8b225433.js" crossorigin="anonymous"></script>
    <!-- datatable -->
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.bootstrap5.js"></script>
    <!-- custom js -->
    <script src="/js/sidebar.js"></script>
    <script src="/js/datatable.js"></script>
    <?= $this->renderSection('javascripts') ?>
</body>
</html>
