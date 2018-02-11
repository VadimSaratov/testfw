<div class="container">
    <div class="jumbotron">
            <div class="flexslider">
                <div class="slides">
					<? foreach ( $banners as $value ): ?>
                        <div class="slide">
                            <img src="/images/<?= $value['image'] ?>" height="50" alt="<?= $value['name'] ?>">
                            <p class="flex-caption">
                                <a href="<?= $value['url'] ?>"><?= $value['name'] ?></a>
                            </p>
                        </div>
					<? endforeach; ?>
                </div>
            </div>
        </div>
</div>
<script>
    $(document).ready(function () {
        $('.flexslider').flexslider({
            animation: "slide",
            slideshow: true,
            selector: ".slides > div.slide"

        });
    });
</script>

