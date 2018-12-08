    <script src="<?php echo URLROOT;?>/js/jquery.min.js"></script>
    <script>
        $('.delete').on("click", function (e) {
            e.preventDefault();

            var choice = confirm($(this).attr('data-confirm'));

            if (choice) {
                window.location.href = $(this).attr('href');
            }
        });
    </script>
    <script src="<?php echo URLROOT;?>/js/popper.min.js"></script>
    <script src="<?php echo URLROOT;?>/js/bootstrap.min.js"></script>
    <script src="<?php echo URLROOT;?>/js/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('kon');
    </script>
    <script src="<?php echo URLROOT;?>/js/main.js"></script>
</body>
</html>
