jQuery(document).ready(function () {
    let nbOfReviews = jQuery("#get-content p.content").get();
    for (let i = 0; i < nbOfReviews.length; i++) {
        let lengthOfEachContent = nbOfReviews[i].innerHTML.length;
        if (lengthOfEachContent >= 100) {
            let eachStrings = nbOfReviews[i].innerHTML;
            let newStrings = eachStrings.substring(0, 100);
            let cutStrings = eachStrings.substring(100, jQuery.trim(lengthOfEachContent));
            jQuery(nbOfReviews[i]).empty().html(newStrings);
            jQuery(nbOfReviews[i]).append('<a href="javascript:void(0);" class="read-more"> ...voir plus</a>');
            jQuery(nbOfReviews[i]).append('<span class="more-text">' + cutStrings + '</span>');
        }
    }
    jQuery(".read-more").click(function () {
        jQuery(this).css("display", "none");
        jQuery(this).siblings('.more-text').contents().unwrap();
    });
});