<script type="text/javascript">
    $(document).on('change keyup', '#color_1, #color_2', function (e) {
        e.preventDefault();

        let color1 = $('#color_1').val();
        let color2 = $('#color_2').val();

        let style = `background: linear-gradient(180deg, ${color1} 0%, ${color2} 100%)`;

        $('.box-card').attr('style', style);

    });

    let code = "{{ getLanguages('default')->code }}";

    $(document).on('change keyup', '#name-' + code, function () {

        $('#sub_category-card').text(this.value);

    });

    $(document).on('change keyup', '#title_card-' + code, function () {

        $('#title-card').text(this.value);

    });
</script>