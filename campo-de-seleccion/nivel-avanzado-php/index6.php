<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <title>Nivel Avanzado</title>
	<meta name="Author" content=""/>
	<style>
        select { width: 300px; }
        
    
    </style>
</head>
<body>

<h1>Nivel Avanzado</h1>
<form>
<p> Pueblos 1: 
    <select id="pueblos-1" onchange="selectPueblos()"></select>
</p>
<p>Pueblos 2:
    <select id="barrios"></select>
</p>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    
    $('document').ready(function(){
        
        getCountries();
        
    });
    
    function selectPueblos() {
        var pueblo = $('#pueblos-1');
        //console.log('Seleccionaste: '+pueblo.value);
        
        var results = getBarrios(pueblo.val());
        
        if (results.length > 0 && results != undefined) {  
            console.log(results);
            $('#barrios').html( results );
        } else {
            console.log('No hay nada');
        }
    }
    
    function getBarrios(param) {
        var results = '';
        $('#barrios').empty();
        $.get('cities.json',  function(data) {
            
            //console.log(data);
            
            //Filter the returned json by "filter"
            
            /*posts = posts.filter(function(item){
                if(item.title.match(q) || item.url.match(q)){
                    return item;
                }
            });*/
            
            var filteredJson = $(data).filter(function (i, cities) {
                //console.log(cities.city_id + ' '+cities.country_id);
                if(cities.country_id.match(param) || cities.country_id.match(param)){
                    //return cities.country_id;
                    results = '<option value="'+cities.country_id+'">'+cities.city+'</option>';
                    $('#barrios').append( results );
                }
            });
            
            /*$(data).each(function(row) {
                var city_id = data[row].city_id;
                var country_id = data[row].country_id;
                var city = data[row].city;
            
                if (param == country_id) {
                    results = '<option value="'+city_id+'">'+city+'</option>';
        
                    $('#barrios').append( results );
                }
                console.log(results);
            });*/
        });
        
        return results; 
    }
    
    function getCountries() {
        var results = '';
        
        $.get('countries.json', function(data) {
            
            $(data).each(function(row) {
                var country_id = data[row].country_id;
                var country = data[row].country;
            
                results = '<option value="'+country_id+'">'+country+'</option>';
                //console.log(results);
        
                $('#pueblos-1').append( results );
            });
        });
                
    }
</script>
</body>
</html>
