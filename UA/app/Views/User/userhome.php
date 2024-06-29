<?= $this->extend('User/default/main'); ?>


<?= $this->section('content') ?>

    <?= $this->include('User/shared/navbar') ?>

    <div class="container">
        <div class="my-4">
            <div>

                <!-- redeem / history btn -->
                <div class="m-3">
                <a href="/User/Redeem" class="btn btn-dark me-2">Redeem</a>
                    <a href="/User/RedeemHistory" class="btn btn-dark">History</a>
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
                                    <?=$UserFullName;?>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 p-2">
                            <div class="bg-custom-yellow rounded p-2">
                                <div class="h6">Real Time Points:</div>
                                <div class="h5">
                                    <?= ($UserDetails['real_timepoints'] == null) ? 0 : $UserDetails['real_timepoints']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 p-2">
                            <div class="bg-custom-yellow rounded p-2">
                                <div class="h6">Total Accumulated Points:</div>
                                <div class="h5">
                                    <?= ($UserDetails['accumulated_points'] == null) ? 0 : $UserDetails['accumulated_points']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <!-- end name / points -->
                <!-- transaction table -->

                <div class="d-flex justify-content-between align-items-center mx-3 mt-5 mb-3">
                    <div class="h5">Latest Transaction</div>
                    <div class="h5"><a href="/User/RedeemHistory" class="text-decoration-none">View All</a></div>
                </div>

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
                <!-- end transaction table -->
            </div>
        </div> 
    </div>



<?= $this->endSection() ?>

<?= $this->section('javascripts') ?>
<script>
    $(document).ready(function() {
        $('#homePageTable').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            "pageLength": 5
        });
    });
</script>

<?= $this->endSection() ?>