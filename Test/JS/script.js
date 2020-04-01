$(document).ready(function() {
    $('#add').click(function() { 
        var nom = $('#nom').val();
        var pnom = $('#pnom').val();
        if(nom == "" || pnom == ""){
            $('#texte').html('Veuillez remplir le formulaire');
        }else{     
            $.get('user.php', {
                nom: $('#nom').val(),
                pnom: $('#pnom').val(),
            }, function(data) {
                $('#texte').html(data);
                $('#nom').val('');
                $('#pnom').val('');
                $.get('select_user.php',{                            
                }, function(data) {
                    $('#user').html(data);
                }
                )
            });
            
        }
    });
    
    $('.close').click(function() {
        $('#text').html('');
        $('#texte').html('');
        $('#user').val('');
        $('#date').val('');
        $('#heure').val('');
        $('#poste').val('');
        $('#nom').val('');
        $('#pnom').val('');
    });
    $('#new').click(function() { 
        var user = $('#user').val();
        var date = $('#date').val();
        var heure = $('#heure').val();
        var poste = $('#poste').val();
        if(user == "" || date == "" || heure == "" || poste == ""){
            $('#text').html('Veuillez remplir le formulaire');
        }else{     
            $.get('poste.php', {
                user : $('#user').val(),
                date : $('#date').val(),
                heure : $('#heure').val(),
                poste : $('#poste').val(),
            }, function(data) {
                $('#text').html(data);
                $('#user').val('');
                $('#date').val('');
                $('#heure').val('');
                $('#poste').val('');
                $.get('tableau.php',{                            
                }, function(data) {
                    $('#tab').html(data);
                }
                )
            });
            
        }
    });
    $('#user').change(function() { 
        var user = $('#user').val();
        var date = $('#date').val();
        var heure = $('#heure').val();
        if(user == "" || date == ""){
            $('#heure').prop('disabled', 'disabled');
            $('#heure').val('');
            $('#poste').val('');
        }else{
            $('#heure').prop('disabled', false);
            if(heure != ""){
                $.get('select_poste.php', {
                    date: $('#date').val(),
                    heure: $('#heure').val(),
                    user: $('#user').val(),
                }, function(data) {
                    $('#poste').html(data);
                });
            } 
        }
    });
    $('#date').change(function() { 
        var user = $('#user').val();
        var date = $('#date').val();
        var heure = $('#heure').val();
        if(user == "" || date == ""){
            $('#heure').prop('disabled', 'disabled');
            $('#heure').val('');
            $('#poste').val('');
        }else{
            $('#heure').prop('disabled', false);
            if(heure != ""){
                $.get('select_poste.php', {
                    date: $('#date').val(),
                    heure: $('#heure').val(),
                    user: $('#user').val(),
                }, function(data) {
                    $('#poste').html(data);
                });
            } 
        }
    });
    $('#heure').change(function() { 
        var user = $('#user').val();
        var date = $('#date').val();
        var heure = $('#heure').val();
        if(user == "" || date == "" || heure == ""){
            $('#poste').prop('disabled', 'disabled');
            $('#poste').val('');
        }else{
            $('#poste').prop('disabled', false);
            $.get('select_poste.php', {
                date: $('#date').val(),
                heure: $('#heure').val(),
                user: $('#user').val(),
            }, function(data) {
                $('#poste').html(data);
            });
        }
    });
    $('#date').change(function() { 
        var user = $('#user').val();
        var date = $('#date').val();
        var heure = $('#heure').val();
        if(user == "" || date == "" || heure == ""){
            $('#poste').prop('disabled', 'disabled');
            $('#poste').val('');
        }else{
            $('#poste').prop('disabled', false);
        }
    });
    $('#user').change(function() { 
        var user = $('#user').val();
        var date = $('#date').val();
        var heure = $('#heure').val();
        if(user == "" || date == "" || heure == ""){
            $('#poste').prop('disabled', 'disabled');
            $('#poste').val('');
        }else{
            $('#poste').prop('disabled', false);
        }
    });
});
function sup(id) {
     
        $.get('delete.php', {
            id: id,
        }, function(data) {
            $('#tab').html(data);
        });
   
}