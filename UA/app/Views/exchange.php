<?= $this->extend('main/admin_main'); ?>

<?= $this->section('content') ?>

    <div class="my-5">
        <div class="bg-white p-4 rounded shadow-sm text-secondary">

            <?php if (!empty(session()->getFlashdata('fail-AddProduct'))):?>
                <div class="alert alert-danger"><?= session()->getFlashdata('fail-AddProduct');?></div>
            <?php endif ?>
            <?php if (!empty(session()->getFlashdata('success-AddProduct'))):?>
                <div class="alert alert-success"><?= session()->getFlashdata('success-AddProduct');?></div>
            <?php endif ?>

            <div class="row" style="margin-top:25px;">     
                <div class="col-md-4">
                    <div class="card"> 
                        <h3 style="margin:10px;">Redeem Voucher</h3>
                        <div class="card-body">
                            <form id="voucherForm" action="javascript:void(0);">
                                <div class="form-group">
                                    <label for="live_search">Enter Voucher Code Here</label>
                                    <input type="text" class="form-control" name="voucher" id="voucher" autocomplete="off">
                                </div>
                                <div class="modal-footer" style="margin-top:25px;">
                                    <button type="submit" class="btn btn-primary">Search Rewards</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="cards">
                        <div class="card-body">
                            <form id="rewardForm" action="/ClaimRedeem" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="exchangeId" id="exchangeId">
                            <div class="mb-3">
                                    <label>Redeemer's Name</label>
                                    <input type="text" name="account_name" id="account_name" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label>Rewards Name</label>
                                    <input type="text" name="reward_name" id="reward_name" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <img id="current_image" src="<?=base_url()?>/assets/images/gift.png" style="margin: 30px; max-width: 100px;" alt="Current Image">
                                </div>
                                <div class="mb-3">
                                    <label>Points Required</label>
                                    <input type="number" name="points" id="points" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea class="form-control" name="reward_description" id="reward_description" readonly style="resize: none;" rows="3"></textarea>
                                </div>
                                <div class="modal-footer" style="margin:25px;">
                                    <button type="submit" class="btn btn-primary" style="margin-right:10px;">Approve Exchange</button>
                                    <button type="button" class="btn btn-secondary" style="margin-left:10px;">Cancel</button>
                                </div>
                            </form>
                        </div> 
                    </div> 
                </div>
            </div> 
        </div>
    </div>


    <!-- Voucher Modal -->
<div class="modal fade" id="ClaimModal" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="voucherModalLabel">Notice!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="claimtext"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascripts') ?>
    <script>
       $(document).ready(function() {
            $('#voucherForm').on('submit', function(e) {
                e.preventDefault();
                var voucherCode = $('#voucher').val();

                $.ajax({
                    url: '/getRewardDetails',
                    method: 'POST',
                    data: { voucher: voucherCode },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            var rewardDetails = response.data;
                            $('#exchangeId').val(rewardDetails.exchange_id);
                            $('#account_name').val(rewardDetails.Accountname);
                            $('#reward_name').val(rewardDetails.rewards_name);
                            $('#current_image').attr('src', rewardDetails.image_url);
                            $('#points').val(rewardDetails.points_used);
                            $('#reward_description').val(rewardDetails.rewards_description);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Failed to fetch reward details: ' + xhr.responseText);
                    }
                });
            });
        });
        <?php if (session()->getFlashdata('claimed')): ?>
        $(document).ready(function() {
            $('#claimtext').text("<?= session()->getFlashdata('claimed') ?>");
            $('#ClaimModal').modal('show');
        });
    <?php endif; ?>
    </script>
<?= $this->endSection() ?>
