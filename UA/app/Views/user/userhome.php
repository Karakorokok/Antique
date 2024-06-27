<?= $this->extend('default/main'); ?>


<?= $this->section('content') ?>

    <?= $this->include('shared/navbar') ?>

    <div class="container">
        <div class="my-4">
            <div>

                <!-- redeem / history btn -->
                <div class="m-3">
                    <button class="btn btn-dark me-2">Redeem</button>
                    <a href="/barbaza-menro/history" class="btn btn-dark">History</a>
                </div>
                <!-- end redeem / history btn -->

                <!-- header logo -->
                <div class="bg-custom-yellow m-3 rounded p-2">
                    <img src="/assets/images/logo.png" height="80" class="center">
                    <div class="my-3">
                        <div class="text-center h4">Scan Trash to Cash</div>
                        <div class="text-center h5">Municipality of Barbaza, Antique</div>
                    </div>
                </div>
                <!-- end header logo -->

                <!-- name / points -->
                <div class="bg-custom-dark rounded py-2 px-3 mx-3">
                    <div class="row">
                        <div class="col-6 p-2">
                            <div class="bg-custom-yellow rounded p-2">
                                <div class="h6">Name:</div>
                                <div class="h5">
                                    José Protacio Rizal Mercado y Alonso Realonda
                                </div>
                            </div>
                        </div>
                        <div class="col-6 p-2">
                            <div class="bg-custom-yellow rounded p-2">
                                <div class="h6">Points:</div>
                                <div class="h5">
                                    1000
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <!-- end name / points -->

                <!-- transaction table -->

                <div class="h5 mx-3 mt-5 mb-3">Latest Transaction</div>

                <div class="container table-responsive m-3">
                    <table class="table table-striped" id="homePageTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- end transaction table -->
            </div>
        </div> 
    </div>



<?= $this->endSection() ?>

<?= $this->section('javascripts') ?>

    <script>
        $(document).ready(function(){

            	
            new DataTable('#homePageTable');

        });
    </script>

<?= $this->endSection() ?>