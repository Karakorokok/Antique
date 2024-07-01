<?= $this->extend('main/admin_main'); ?>

<?= $this->section('content') ?>

    <div class="my-5">
        <div class="bg-white p-4 rounded shadow-sm text-secondary table-responsive">

            <div class="mb-5 myFloatEnd">
                <button class="btn btn-primary" id ="AddRewards"> <i class="fas fa-plus"> </i>&nbsp Add Rewards</button>
            </div>
            <?php if (!empty(session()->getFlashdata('fail-rewards'))):?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('fail-rewards');?></div>
            <?php endif ?>
            <?php if (!empty(session()->getFlashdata('success-rewards'))):?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success-rewards');?></div>
            <?php endif ?>
            <!-- sidebar item 1 table -->
            <table class="table table-striped border-start border-top" id="sidebarItem1Table">
                <thead>
                    <th>#</th>
                    <th>Rewards Name</th>
                    <th>Points Required</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Action</th>
                </thead>
                <tbody>
                <?php $x = 0;?>
              
                <?php foreach($Rewards as $Reward): ?>
                    <tr>
                        <?php $x = $x+1; ?>
                        <td><?php echo $x; ?></td>
                        <td><?=$Reward['rewards_name'];?></td>
                        <td><?=$Reward['points_required'];?></td>
                        <td>
                            <img src="<?=$Reward['rewards_image_url'];?>" alt="<?=$Reward['rewards_name'];?>" style="width: 100px; height: auto;">
                        </td>
                        <td><?=$Reward['rewards_description'];?></td>
                        <td>
                            <button class="btn btn-dark" id="EditRewards" data-rewards_id="<?=$Reward['rewards_id'];?>"
                                                                         data-rewards_name="<?=$Reward['rewards_name'];?>"
                                                                         data-rewards_points="<?=$Reward['points_required'];?>"
                                                                         data-rewards_image="<?=$Reward['rewards_image_url'];?>"
                                                                         data-rewards_desc="<?=$Reward['rewards_description'];?>"
                                                                         
                            >Edit </button>
                            <button class="btn btn-danger" id="DeleteRewards" data-rewards_id="<?=$Reward['rewards_id'];?>">Delete</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                  
                </tbody>
            </table>
             <!-- end sidebar item 1 table -->
        </div>
    </div>
    <!-- Add Rewards Modal -->
    <div class="modal fade" id="AddReward" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Products</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="/AddRewards" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Reward Name</label>
                    <input type="text" name="reward_name" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Points Required</label>
                    <input type="number" name="points" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Rewards Image</label>
                    <input type="file" class="form-control" name="rewards_image" id="rewards_image" accept=".png, .jpeg, .jpg">
                    <div id="file_error" style="color: red; display: none;">File size must be less than 5MB</div>
                </div>
                <div class="mb-3">
                    <label>Descirption</label>
                    <textarea class="form-control" name="reward_description" id="exampleFormControlTextarea1" style="resize: none;" rows="3" placeholder="Enter Rewards description here..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add Rewards</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
            </form>
            </div>
        </div>
    </div>
    <!-- End Add Rewards Modal -->

      <!-- Edit Rewards Modal -->
      <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Rewards</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="/EditRewards" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="hidden" name="rewards_id" id="rewards_id">
                    <label>Reward Name</label>
                    <input type="text" name="editRewards_name" id="editRewards_name" class="form-control">
                </div>
           
                <div class="mb-3">
                    <label>Points Required</label>
                    <input type="number" name="editRewardsPoints" id="editRewardsPoints"class="form-control">
                </div>
                <div class="mb-3">
                    <label>Rewards Image</label>
                    <img id="current_image" src="" style="margin: 30px; max-width: 100px;" alt="Current Image">
                   
                    <input type="file" class="form-control" name="editRewardsImage" id="editRewardsImage" accept=".png, .jpeg, .jpg">
                    <div id="editfile_error" style="color: red; display: none;">File size must be less than 5MB</div>
                </div>
                <div class="mb-3">
                    <label>Descirption</label>
                    <textarea class="form-control" name="EditRewardsDesc" id="EditRewardsDesc" style="resize: none;" rows="3" placeholder="Enter Rewards description here..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Edit Rewards</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
            </form>
            </div>
        </div>
    </div>
    <!-- End Edit Rewards Modal -->

     <!-- Delte Rewards Modal -->
     <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Rewards</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/DeleteRewards" method ="POST">
                <div class="modal-body">
                <div class="mb-3">
                    <input type="hidden" name="deleteRewardID" id="deleteRewardID">
                </div>
            
                <div class="mb-3">
                    <label>Are you sure you want to Delete this Rewards ?</label>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete Rewards</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- End Delete Rewards Modal -->
   
<?= $this->endSection() ?>


<?= $this->section('javascripts') ?>

    <script>

        $(document).ready(function() 
        {
           initDataTable('sidebarItem1Table');
        });
    document.getElementById('rewards_image').addEventListener('change', function() {
        
        var file = this.files[0];
        var errorElement = document.getElementById('file_error');
        
        if (file.size > 5242880) { // 5MB in bytes
            errorElement.style.display = 'block';
            this.value = ''; // Clear the input
        } else {
            errorElement.style.display = 'none';
        }
    });
    document.getElementById('editRewardsImage').addEventListener('change', function() {
        
        var file = this.files[0];
        var errorElement = document.getElementById('editfile_error');
        
        if (file.size > 5242880) { // 5MB in bytes
            errorElement.style.display = 'block';
            this.value = ''; // Clear the input
        } else {
            errorElement.style.display = 'none';
        }
    });
        
        $("#AddRewards").click(function()
        { 
            $('#AddReward').modal('show');
        });
        $('tbody').on('click', '#EditRewards', function() 
        {  
            var rewards_id = $(this).data('rewards_id');
            var rewards_name = $(this).data('rewards_name');
            var rewards_points = $(this).data('rewards_points');
            var rewards_image = $(this).data('rewards_image');
            var rewards_desc = $(this).data('rewards_desc');

            
            $('#rewards_id').val(rewards_id);
            $('#editRewards_name').val(rewards_name);
            $('#editRewardsPoints').val(rewards_points);
            $('#current_image').attr('src', rewards_image); 
            $('#EditRewardsDesc').val(rewards_desc);

            $('#EditModal').modal('show');
        });

        $('tbody').on('click', '#DeleteRewards', function() 
        {   
            var rewards_id = $(this).data('rewards_id');
            $('#deleteRewardID').val(rewards_id);
            
            $('#DeleteModal').modal('show');
        });

        
    </script>

<?= $this->endSection() ?>