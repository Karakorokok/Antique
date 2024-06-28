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
                <div class="list-wrapper row mt-5">
                    <?php for($i = 0;$i < 10; $i++) { ?>
                        <div class="col-md-3 col-6 list-item mb-3">
                            <div class="card h-100">
                                <img src="https://i3.wp.com/assets.tiltify.com/uploads/media_type/image/203025/blob-09636982-a21a-494b-bbe4-3692c2720ae3.jpeg" class="card-img-top object-fit-scale w-100 mt-2" height="100">
                                <div class="card-body">
                                    <h6 class="card-title"></h6>
                                    <h6 class="card-title"></h6>
                                    <a href="" class="btn btn-outline-danger w-100 mb-2">jollibee</a>
                                    <a href="" class="btn btn-info w-100">amen</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="float-end">
                    <div id="pagination-container" class=""></div>
                </div>
               
                <!-- end table -->
            </div>
        </div> 
    </div>



<?= $this->endSection() ?>

<?= $this->section('javascripts') ?>

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