<?= $this->extend('User/default/main'); ?>


<?= $this->section('content') ?>

    <?= $this->include('User/shared/navbar') ?>

    <div class="container">
        <div class="my-4">
            <div>

                <div class="m-3">
                    <a href="/User/Home" class="btn btn-dark"><i class="fa-solid fa-arrow-left me-2"></i>Home</a>
                </div>

                <!-- <div class="bg-custom-yellow mx-3 p-2 rounded">
                    <div class="h5">
                    <a href="" class="btn btn-primary"><i class="fa-solid fa-arrow-left me-2"></i>Points Transaction History</a>
                    </div>
                </div> -->

                <!-- table -->
                 <div></div>
                <div class="container table-responsive m-3">
                    <table class="table table-striped" id="homePageTable">
                    <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Rewards Name</th>
                                <th scope="col">Points</th>
                                <th scope="col">Voucher</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                        </thead>
                        <tbody>
                        <?php $x = 0;?>
                        <?php foreach($Transactions as $Transaction): ?>
                            <tr>
                                <?php $x = $x+1; ?>
                                <td><?php echo $x; ?></td>
                                
                                <td><?=$Transaction->rewards_name;?></td>
                                <td><?=$Transaction->points_used?></td>
                                <td><?=$Transaction->voucher?></td>
                                <td><?=$Transaction->status;?></td>
                                <td><?=$Transaction->created_at;?></td>
                                
                            </tr>
                      
                        <?php endforeach; ?>
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