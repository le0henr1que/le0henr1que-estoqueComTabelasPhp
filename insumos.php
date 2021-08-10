<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/css.css" media="screen" />

    <title>Insumos</title>
  </head>
  <body>    

   <script>
        function duplicarCampos(){
        var clone = document.getElementById('origem').cloneNode(true);
        var destino = document.getElementById('destino');
        destino.appendChild (clone);
        
        var camposClonados = clone.getElementsByTagName('input');
        
        for(i=0; i<camposClonados.length;i++){
            camposClonados[i].value = '';
        }
        
        
        
    }

    function removerCampos(id){
        var node1 = document.getElementById('destino');
        node1.removeChild(node1.childNodes[0]);
    }
</script>
 

    <div class="container1">
    <center><h1 class="fw-light-light">Requisição de Insumos</h1></center>
                <div class="container" id="origem">
                    <div class="card" >
                        <div class="card-body">
                            <div class="row g-0">
                                <div class="col-xl-6 col-md-6">
                                <label for="formFileDisabled" class="form-label">Insumo</label>
                                    <select class="form-select" width="50px" aria-label="Default select example">
                                        <option selected>Selecionar insumo</option>
                                        <option value="1">Espuma Antichama </option>
                                        <option value="2">Abraçadeira</option>
                                        <option value="3">Blocklog</option>
                                        <option value="4">Safelog</option>
                                        <option value="5">Fita de Adesiva</option>
                                        <option value="6">Termo Retráril 30 cm</option>
                                        <option value="7">Termo Retráril 38 cm</option>
                                        <option value="8">Sensor Magnético</option>
                                        <option value="9">Saco Plástico</option>
                                        <option value="10">Fita Isolante</option>
                                        <option value="11">Adesivo Bloquador</option>
                                        <option value="12">Adesivo Anatel</option>
                                        <option value="13">Lenço antisséptico</option>
                                        <option value="14">Etiqueta Pimaco</option>
                                        <option value="15">Bateria</option>
                                        <option value="16">Chip</option>
                                        <option value="17">Caixa De papelão</option>
                                        <option value="18">Fita Pano</option>
                                    </select>
                                </div>
                               
                                <div class="col-xl-2 col-md-2">
                                <label for="formFileDisabled" class="form-label">Unidade</label>
                                    <input type="Number" class="form-control" placeholder="Quantidade" aria-label="First name">
                                </div>
                                <div class="col-xl-1 col-md-1">
                                </div>
                                <div class="col-xl-2 col-md-2">
                                <label for="formFileDisabled" class="form-label">Check</label><br>
                                    <img  src="img/quadrado.png" width="35" height="35" style="cursor: pointer;">
                                </div>
                                <div class="col-xl-1 col-md-1">
                                <label for="formFileDisabled" class="form-label">Adicionar</label><br>
                                    <img  src="img/adicionar.png" width="30" height="30" style="cursor: pointer;" onclick="duplicarCampos();">
                                    <img  src="img/menos.png" width="30" height="30" style="cursor: pointer;" onclick="removerCampos(this);"> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
    <div id="destino">
    </div>
    <div class="container" id="origem">
        <div class="row g-0">
           
            <div class="col-xl-10 col-md-10">
            
            </div>
            <div class="col-xl-2 col-md-2">
                <button type="button" class="btn btn-primary" onClick="window.print()">Finalizar</button>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

   
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    
  </body>
</html>