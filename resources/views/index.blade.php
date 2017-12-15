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
            
            <div class="col-md-4 col-md-offset-4">
                
                <h4 class="text-right">Cube Summation</h4>
                <h5 class="text-right text-muted">por: Fabian Camilo Ortiz</h5>
                <p>Detalles del ejercicio <a href="https://www.hackerrank.com/challenges/cube-summation/problem" target="_blank">aqu&iacute;</a></p>
                
                {!! Form::open(['route'=>['summation'],'method'=>'POST']) !!}
                
                    <div class="form-group">
                        <label for="entrada">Entrada para el programa:</label>
                        <textarea class="form-control" rows="15" name="entrada" id="entrada" ></textarea>
                    </div>
                    <div class="form-group text-right col">
                        <button class="btn btn-sm btn-primary btn-block" type="submit">Procesar</button>
                    </div>
                
                {!! Form::close() !!}
                
                </form>
            </div>
            
        </div>
        
        <!--    SCRIPTS    -->
        <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
        
    </body>
</html>
