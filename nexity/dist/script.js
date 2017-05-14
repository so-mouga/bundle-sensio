$(function () {
    var n, o, r, i;
    return n = $("#cover"), o = $("#cover .pin img"), i = 0, r = 0, $(window).on("mousemove", function (t) {
        var e, c, s;
        return t.clientX !== i ? (e = $(window).width(), e > 768 ? (i = t.clientX, r = 2 * i / e - 1) : (i = 0, r = 0), c = 10 * (r + 1) + 50 + "% 0%, center", s = 5 * r + "px", n.css("background-position", c), o.css("transform", "translateX(" + s + ")")) : void 0;
    });
});


function formSubmit() {

    var gender = $("[name='gender']").val();
    var name = $("[name='name']").val();
    var firstName = $("[name='firstName']").val();
    var mail = $("[name='mail']").val();
    var postalCode = $("[name='postal_code']").val();
    var phone = $("[name='phone']").val();
    var newsletterNexity = $("[name='actuality']:checked").val();
    var newsletterPartenaires = $("[name='offer']:checked").val();
    if(newsletterNexity == null){
        newsletterNexity = 0;
    }
    if(newsletterPartenaires == null){
        newsletterPartenaires = 0;
    }
    $.ajax({
        url: "http://localhost:8000/user", //modifier url en fonction de votre local host
        dataType: "json",
        data: {
            gender: gender,
            name: name,
            firstName: firstName,
            mail: mail,
            phone: phone,
            postalCode: postalCode,
            newsletterNexity: newsletterNexity,
            newsletterPartenaires: newsletterPartenaires
        },
        type: 'POST'

    }).done(function (response) {
        if (response.isSuccess === false) {
            alert(response.value);
        } else {
            $('.textChange').replaceWith('<p style="font-size: 1.5em;">L\'enregistrement a bien été pris en compte Nexity vous remercie de vous étre inscrit à l\'offre.</p>');
            $('form').css("display", 'none');
            $('.textChange1').css("display", 'none');
            alert(response.value);
        }

    });
    

    return false;
}





