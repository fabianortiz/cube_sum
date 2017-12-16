<!DOCTYPE html>
<html lang='es'>
    <head>
        <title>Backend test</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--    CSS     -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    </head>
    
    <body>
        
        <div class="container">
            <div class="col-md-12">
                <legend class="text-right text-info">PHP Backend Developer Test</legend>
                <h4>Cube Summation</h4>
                <h5 class="text-muted">por: Fabian Camilo Ortiz</h5>
                <hr>
                <p>Detalles del ejercicio <a href="https://www.hackerrank.com/challenges/cube-summation/problem" target="_blank">aqu&iacute;</a></p>
            </div>
            <div class="col-md-6">
                
                <div class="form-group">
                    <label for="entrada">Entrada para el programa:</label>
                    <textarea class="form-control" rows="15" name="entrada" id="entrada" ></textarea>
                </div>
                <div class="form-group text-right">
                    <button id="procesar" class="btn-sm btn-primary">Procesar &gt;&gt;</button>
                </div>
                
            </div>
            
            <div class="col-md-6">
                <label>Respuesta:</label>
                <div class="well well-lg" id="div_response" style="overflow:scroll; height: 314px;"></div>
            </div>
            
        </div>
        
        <!--    SCRIPTS    -->
        <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
        
        <script>
            
            $("#procesar").click(function(){
                var input_entrada = document.getElementById("entrada").value;
                
                $.ajax({
                        type : 'POST',
                        url : "./summation",
                        data : {
                                entrada : input_entrada,
                                _token : "{!! csrf_token() !!}"
                        },
                        dataType : 'json',
                        timeout: 1000,
                        success : function(data) {
                            
                            if(data.error){
                                $("#div_response").removeClass("text-success");
                                $("#div_response").addClass("text-success");
                            }else{
                                $("#div_response").addClass("text-success");
                                $("#div_response").removeClass("text-success");
                            }
                            $("#div_response").html(data.output);
                            
                        },
                        error: function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            alert(err.Message);
                        }
                });
                
            });
            
        </script>
        
    </body>
</html>
