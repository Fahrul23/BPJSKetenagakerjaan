$('.img-upload').click(function() {
    let file;
    const uploader = $(this).find('.uploader');
    const img = $(this).find('.img').eq(0);
    const txt = $(img).find('.text').eq(0);

    uploader.each(function(i, el) {
        el.click();
        $(el).change(function() {
            let file = new FileReader;

            file.onload = function(e) {
                if ( !$(txt).hasClass('current') ) $(txt).addClass('current');
                $(img).attr('style', `background-image: url(${e.target.result}); background-size: contain; background-position: center; background-clip: border-box; background-repeat: no-repeat;`);
            }

            file.readAsDataURL(el.files[0]);
        })
    })

})