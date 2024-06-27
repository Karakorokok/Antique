<?= $this->extend('default/main'); ?>


<?= $this->section('content') ?>

    <?= $this->include('shared/navbar') ?>

    <div class="container">
        <div class="my-4">
            <div>

                <div class="m-3">
                    <a href="/barbaza-menro/home" class="btn btn-dark"><i class="fa-solid fa-arrow-left me-2"></i>Home</a>
                </div>

                <div class="bg-custom-yellow mx-3 p-2 rounded">
                    <div class="h5">
                        Points: <span>1000</span>
                    </div>
                </div>

                <!-- table -->
                 <div></div>
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
                <!-- end table -->
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