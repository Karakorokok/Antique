<?= $this->extend('User/default/main'); ?>

<?= $this->section('content') ?>

<?= $this->include('User/shared/navbar') ?>

<div class="container">
    <div class="my-4">
        <div>

            <div class="m-3">
                <a href="/User/Home" class="btn btn-dark">Go back to Home</a>
            </div>

            <div class="bg-custom-yellow mx-3 p-3 rounded">
                <div class="h6">
                   Real Time Points: <span><?= ($UserDetails['real_timepoints'] == null) ? 0 : $UserDetails['real_timepoints']; ?></span>
                </div>
            </div>

            <!-- table -->
            <div class="list-wrapper row mt-5">
            <?php foreach($Rewards as $Reward): ?>
                <div class="col-md-3 col-6 list-item mb-3">
                    <div class="card h-100">
                        <img src="<?=$Reward['rewards_image_url'];?>" class="card-img-top object-fit-scale w-100 mt-2" height="100">
                        <div class="card-body">
                            <h6 class="card-title text-center"><?=$Reward['rewards_name'];?></h6>
                            <h6 class="card-title text-center text-info"><?=$Reward['points_required'];?> Points</h6>
                            <button type="button" class="btn bg-custom-yellow border border-secondary w-100 mb-2 mt-4" data-bs-toggle="modal" data-bs-target="#viewDetailsModal" 
                                data-rewards_id="<?=$Reward['rewards_id'];?>"
                                data-rewards_name="<?=$Reward['rewards_name'];?>"
                                data-rewards_description="<?=$Reward['rewards_description'];?>"
                                data-rewards_image_url="<?=$Reward['rewards_image_url'];?>"
                                data-points_required="<?=$Reward['points_required'];?>"
                            >Details</button>
                            <button type="button" class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#redeemModal" data-rewards_id="<?=$Reward['rewards_id'];?>"
                                <?php if($UserDetails['real_timepoints'] < $Reward['points_required']): ?>
                                    disabled
                                <?php endif; ?>
                            >Redeem</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>

            <div class="float-end">
                <div id="pagination-container" class=""></div>
            </div>
           
            <!-- end table -->
        </div>
    </div> 
</div>

<!-- View Details Modal -->
<div class="modal fade" id="viewDetailsModal" tabindex="-1" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDetailsModalLabel">Reward Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="hidden" name="rewards_id" id="rewards_id">
                    <label>Reward Name</label>
                    <input type="text" id="editRewards_name" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label>Points Required</label>
                    <input type="number" name="editRewardsPoints" id="editRewardsPoints" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <img id="current_image" src="" style="margin: 30px; max-width: 100px;" alt="Current Image">
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea class="form-control" name="EditRewardsDesc" id="EditRewardsDesc" style="resize: none;" rows="3" placeholder="Enter Rewards description here..." readonly></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Redeem Modal -->
<div class="modal fade" id="redeemModal" tabindex="-1" aria-labelledby="redeemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="redeemModalLabel">Redeem Reward</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/RedeemRewards" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="RedeemReward_id" id="RedeemReward_id">
                    <h4>Are you sure you want to redeem this reward?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm Redeem</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Voucher Modal -->
<div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="voucherModalLabel">Your Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Your voucher code is:</h4>
                <p id="voucherCode"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('javascripts') ?>

<script>
    $('#viewDetailsModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var rewards_id = button.data('rewards_id');
        var rewards_name = button.data('rewards_name');
        var rewards_description = button.data('rewards_description');
        var rewards_image_url = button.data('rewards_image_url');
        var points_required = button.data('points_required');

        var modal = $(this);

        $('#rewards_id').val(rewards_id);
        $('#editRewards_name').val(rewards_name);
        $('#editRewardsPoints').val(points_required);
        $('#current_image').attr('src', rewards_image_url);
        $('#EditRewardsDesc').val(rewards_description);
    });

    $('#redeemModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var rewardId = button.data('rewards_id');
        $('#RedeemReward_id').val(rewardId);
    });

    <?php if (session()->getFlashdata('voucher')): ?>
        $(document).ready(function() {
            $('#voucherCode').text("<?= session()->getFlashdata('voucher') ?>");
            $('#voucherModal').modal('show');
        });
    <?php endif; ?>
</script>

<script>
        var items = $(".list-wrapper .list-item");
        var numItems = items.length;
        var perPage = 8;

        items.slice(perPage).hide();

        $('#pagination-container').pagination({
            items: numItems,
            itemsOnPage: perPage,
            prevText: "&laquo;",
            nextText: "&raquo;",
            onPageClick: function (pageNumber) {
                var showFrom = perPage * (pageNumber - 1);
                var showTo = showFrom + perPage;
                items.hide().slice(showFrom, showTo).show();
            }
        });
    </script>
<?= $this->endSection() ?>
