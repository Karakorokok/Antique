<?= $this->extend('main/admin_main'); ?>

<?= $this->section('content') ?>

    <div class="my-5">
        <div class="bg-white p-4 rounded shadow-sm text-secondary table-responsive">

            <!-- sidebar item 1 table -->
            <table class="table table-striped border-start border-top" id="sidebarItem1Table">
                <thead>
                    <th>#</th>
                    <th>Redeemer's Name</th>
                    <th>Reward Name</th>
                    <th>Points Used</th>
                    <th>Processed By</th>
                    <th>Date Redeemed</th>
                    <th>Status</th>
                 
                </thead>
                <tbody>
                <?php $x = 0;?>
                        <?php foreach($Transactions as $Transaction): ?>
                            <tr>
                                <?php $x = $x+1; ?>
                                <td><?php echo $x; ?></td>
                                <td><?=$Transaction->Accountname;?></td>
                                <td><?=$Transaction->rewards_name;?></td>
                                <td><?=$Transaction->points_used?></td>
                                <td><?=$Transaction->admin?></td>
                                <td><?=$Transaction->created_at;?></td>
                                <td><?=$Transaction->status;?></td>
                              
                                
                            </tr>
                      
                        <?php endforeach; ?>
                        </tbody>
            </table>
             <!-- end sidebar item 1 table -->
        </div>
    </div>

   
<?= $this->endSection() ?>


<?= $this->section('javascripts') ?>


<?= $this->endSection() ?>