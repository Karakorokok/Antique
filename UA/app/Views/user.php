<?= $this->extend('main/admin_main'); ?>

<?= $this->section('content') ?>

    <div class="my-5">
        <div class="bg-white p-4 rounded shadow-sm text-secondary table-responsive">

            <div class="mb-5 myFloatEnd">
                <button class="btn btn-primary" id ="AddAdmin"> <i class="fas fa-plus"> </i>&nbsp Add Administrator</button>
               
            </div>
            <?php if (!empty(session()->getFlashdata('fail-AddProduct'))):?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('fail-AddProduct');?></div>
            <?php endif ?>
            <?php if (!empty(session()->getFlashdata('success-AddProduct'))):?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success-AddProduct');?></div>
            <?php endif ?>
            <!-- sidebar item 1 table -->
            <table class="table table-striped border-start border-top" id="sidebarItem1Table">
                <thead>
                    <th>#</th>
                    <th>Account name</th>
                    <th>Username</th>
                    <th>Last Login</th>
                    <th>Last Password Change</th>
                    <th>Role</th>
                    <th>Action</th>
                </thead>
                <tbody>
                <?php $x = 0;?>
                <?php foreach($Accounts as $Account): ?>
              
                    <tr>
                        <?php $x = $x+1; ?>
                        <td><?php echo $x; ?></td>
                        <td><?=$Account['Accountname'];?></td>
                        <td><?=$Account['username'];?></td>
                        <td>
                        <?php echo $Account['last_login'] ? $Account['last_login'] : 'Not Yet Logged in'; ?>
                        </td>
                        <td><?php echo $Account['updated_at'] ? $Account['updated_at'] : 'Not Yet Logged in'; ?></td>
                        <td><?php echo $Account['role'] == 1 ? 'Admin' : 'Supervisor'; ?></td>
                        <td>
                            <button class="btn bg-info" id="EditAccount" data-account_id = "<?=$Account['user_id'];?>"
                                                                         data-account_fname = "<?=$Account['fname'];?>"
                                                                         data-account_lname = "<?=$Account['lname'];?>"
                                                                         data-account_mname = "<?=$Account['mname'];?>"
                                                                         data-account_role = "<?=$Account['role'];?>"
                                                                         


                            >Edit </button>
                            <button class="btn btn-danger" id="DeleteAccount"  data-deleteaccount_id = "<?=$Account['user_id'];?>">Delete</button>
                        </td>
                 
                    </tr>
                    <?php endforeach; ?>
                  
                </tbody>
            </table>
             <!-- end sidebar item 1 table -->
        </div>
    </div>
 <!-- Add Account Modal -->
 <div class="modal fade" id="AddAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Accounts</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="/AddAdminAcc" method="POST">
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
                <div class="mb-3">
                    <label>Role</label>
                   <select  class="form-control" name="role">
                   <option value="" disabled selected>Select a role</option>
                     <option value="1">Admin</option>
                     <option value="2">Adviser</option>
                   </select>
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
            <form action="/EditAdminAcc" method="POST">
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
                <div class="mb-3">
                    <label>Role</label>
                   <select  class="form-control" name="editrole" id="editrole">
                   <option value="" disabled selected>Select a role</option>
                     <option value="1">Admin</option>
                     <option value="2">Adviser</option>
                   </select>
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
            <form action="/DeleteAdminAcc" method ="POST">
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

        $("#AddAdmin").click(function()
        { 
            $('#AddAdminModal').modal('show');
        });
        $('tbody').on('click', '#EditAccount', function() 
        {  
            var account_id = $(this).data('account_id');
            var account_fname = $(this).data('account_fname');
            var account_lname = $(this).data('account_lname');
            var account_mname = $(this).data('account_mname');
            var account_role = $(this).data('account_role');
            
            $('#account_id').val(account_id);
            $('#editfname').val(account_fname);
            $('#editmname').val(account_mname);
            $('#editlname').val(account_lname);
            $('#editrole').val(account_role);


            $('#EditModal').modal('show');
        });

        $('tbody').on('click', '#DeleteAccount', function() 
        {   
            var deleteaccount_id = $(this).data('deleteaccount_id');
            $('#deleteId').val(deleteaccount_id);
            
            $('#DeleteModal').modal('show');
        });

        
    </script>

<?= $this->endSection() ?>