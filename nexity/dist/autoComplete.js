$(function ()
{
    
    $("#postal_code").autocomplete({
        source: function (request, response)
        {
            var objData = {};
            if ($(this.element).attr('id') == 'postal_code'){
                objData = {codePostal: request.term, pays: 'FR', maxRows: 5};
            } else{
                objData = {ville: request.term, pays: 'FR', maxRows: 5};
            }
            //teste format du CP 
            if (objData.codePostal.match(/^\d+$/)) {
                $.ajax({
                    url: "http://localhost:8000/postalcode", //modifier url en fonction de votre local host
                    dataType: "json",
                    data: objData,
                    type: 'POST',
                    success: function (data)
                    {
                        if (data.isSuccess === true) {
                            response($.map(data.value, function (item)
                            {
                                $('#postal_code').css("border", 'white 1px solid');
                                return {
                                    label: item.cp + ", " + item.ville,
                                    value: function ()
                                    {
                                        if ($(this).attr('id') == 'postal_code')
                                        {
                                            return item.cp;
                                        } else
                                        {
                                            $('#postal_code').val(item.cp);
                                            return item.ville;
                                        }
                                    }
                                };
                            }));
                        } else {
                            // si aucun CP est trouvé coté serveur
                            $('#postal_code').css("border", 'red 1px solid');
                        }
                    }
                });
            } else {
                $('#postal_code').css("border", 'red 1px solid');
            }
        },
        minLength: 3,
        delay: 600
    });


});

