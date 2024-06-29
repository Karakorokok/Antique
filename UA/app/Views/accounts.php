<?= $this->extend('main/admin_main'); ?>

<?= $this->section('content') ?>

    <div class="my-5">
        <div class="bg-white p-4 rounded shadow-sm text-secondary table-responsive">

            <div class="mb-5 myFloatEnd">
                <button class="btn btn-primary" id = "Addaccounts"> <i class="fas fa-plus"> </i>&nbsp Add Accounts</button>
            </div>
            <?php if (!empty(session()->getFlashdata('fail-accounts'))):?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('fail-accounts');?></div>
            <?php endif ?>
            <?php if (!empty(session()->getFlashdata('success-accounts'))):?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success-accounts');?></div>
            <?php endif ?>
            <!-- sidebar item 1 table -->
            <table class="table table-striped border-start border-top" id="sidebarItem1Table">
                <thead>
                    <th>#</th>
                    <th>Account Name</th>
                    <th>Real Time Points</th>
                    <th>Accumulated Points</th>
              
                    <th>Action</th>
                </thead>
                <tbody>
                <?php $x=0;?>
                <?php foreach($Persons as $Person): ?>
                    <tr>
                        <?php $x = $x+1; ?>
                        <td><?php echo $x; ?></td>
                        <td><?=$Person['PersonName'];?></td>
                        <td><?= $Person['real_timepoints'] === null ? "0" : $Person['real_timepoints']; ?></td>
                        <td><?= $Person['accumulated_points'] === null ? "0" : $Person['accumulated_points']; ?></td>
                        <td>
                            <button class="btn bg-info" id="EditAccount"  data-account_id = "<?=$Person['person_id'];?>"
                                                                          data-fname = "<?=$Person['fname'];?>"
                                                                          data-mname = "<?=$Person['mname'];?>"
                                                                          data-lname = "<?=$Person['lname'];?>"
                            >Edit </button>
                            <button class="btn btn-danger"  id="DeleteAccount" data-account_id = "<?=$Person['person_id'];?>">Delete</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
        
                </tbody>
            </table>
             <!-- end sidebar item 1 table -->
        </div>
    </div>
    <!-- Add Account Modal -->
    <div class="modal fade" id="AddAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Accounts</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="/AddAccount" method="POST">
                <div class="mb-3">
                    <label>First Name</label>
                    <input type="text" name="fname" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Middle Name</label>
                    <input type="text" name="mname" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Last Name</label>
                    <input type="text" name="lname" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add Account</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
            </form>
            </div>
        </div>
    </div>
    <!-- End Add Account Modal -->
         <!-- Edit Account Modal -->
    <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Accounts</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="/EditAccount" method="POST">
                <div class="mb-3">
                    <input type="hidden" name="account_id" id="account_id">
                    <label>First Name</label>
                    <input type="text" name="editfname" id="editfname" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Middle Name</label>
                    <input type="text" name="editmname" id="editmname"class="form-control">
                </div>
                <div class="mb-3">
                    <label>Last Name</label>
                    <input type="text" name="editlname" id="editlname"class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Edit Account</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
            </form>
            </div>
        </div>
    </div>
    <!-- End Edit Account Modal -->



     <!-- Delte Category Modal -->
     <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Account</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/DeleteAccount" method ="POST">
                <div class="modal-body">
                <div class="mb-3">
                    <input type="hidden" name="deleteId" id="deleteId">
                </div>
            
                <div class="mb-3">
                    <label>Are you Sure you want to delete this Account?</label>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete Account</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- End Edit Product Modal -->
   
<?= $this->endSection() ?>


<?= $this->section('javascripts') ?>

    <script>

        $(document).ready(function() 
        {
           initDataTable('sidebarItem1Table');
        });

        
        $("#Addaccounts").click(function()
        { 
            $('#AddAccount').modal('show');
        });
        $('tbody').on('click', '#EditAccount', function() 
        {  
            var account_id = $(this).data('account_id');
            var fname = $(this).data('fname');
            var mname = $(this).data('mname');
            var lname = $(this).data('lname');

            
            $('#account_id').val(account_id);
            $('#editfname').val(fname);
            $('#editmname').val(mname);
            $('#editlname').val(lname);
   

            $('#EditModal').modal('show');
        });

        $('tbody').on('click', '#DeleteAccount', function() 
        {   
            var account_id = $(this).data('account_id');
            $('#deleteId').val(account_id);
            
            $('#DeleteModal').modal('show');
        });

        
    </script>

<?= $this->endSection() ?>