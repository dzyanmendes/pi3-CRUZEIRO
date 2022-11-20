  <main class="container mt-4">
    <div class="bg-light p-5 rounded">
      <h1>Cadastro de Localidades</h1>
      <div class="container px-5 my-5">
        <form id="contactForm" action="<?php echo base_url().'/Localidades'; ?>" method="post">
          <div class="mb-3">
            <label class="form-label" for="codigo">Codigo</label>
            <input class="form-control" id="codigo" name="codigo" type="text" placeholder="Codigo" data-sb-validations="" value="<?php if ($selecionado!=NULL) { echo $selecionado[0]->codigo; } else {echo '0'; } ?>"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="cep">CEP</label>
            <input class="form-control" id="cep" name="cep" type="text" placeholder="CEP" data-sb-validations="" value="<?php if ($selecionado!=NULL) { echo $selecionado[0]->cep; } else {echo ''; } ?>"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="nome">nome</label>
            <input class="form-control" id="nome" name="nome" type="text" placeholder="nome" data-sb-validations="" value="<?php if ($selecionado!=NULL) { echo $selecionado[0]->nome; } else {echo ''; } ?>"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="bairro">bairro</label>
            <input class="form-control" id="bairro" name="bairro" type="text" placeholder="bairro" data-sb-validations="" value="<?php if ($selecionado!=NULL) { echo $selecionado[0]->bairro; } else {echo ''; } ?>"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="cidade">cidade</label>
            <input class="form-control" id="cidade" name="cidade" type="text" placeholder="cidade" data-sb-validations="" value="<?php if ($selecionado!=NULL) { echo $selecionado[0]->cidade; } else {echo ''; } ?>"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="estado">estado</label>
            <input class="form-control" id="estado" name="estado" type="text" placeholder="estado" data-sb-validations="" value="<?php if ($selecionado!=NULL) { echo $selecionado[0]->estado; } else {echo ''; } ?>"/>
          </div>
          <a href="#" onclick="javascript:load_data()" class="btn btn-sm btn-warning m-4" >Atualizar Latitude Longitude</a>
          <div class="mb-3">
            <label class="form-label" for="latitude">latitude</label>
            <input class="form-control" id="latitude" name="latitude" type="text" placeholder="latitude" data-sb-validations="" value="<?php if ($selecionado!=NULL) { echo $selecionado[0]->latitude; } else {echo ''; } ?>"/>
          </div>
          <div class="mb-3">
            <label class="form-label" for="longitude">longitude</label>
            <input class="form-control" id="longitude" name="longitude" type="text" placeholder="longitude" data-sb-validations="" value="<?php if ($selecionado!=NULL) { echo $selecionado[0]->longitude; } else {echo ''; } ?>"/>
          </div>
          <div class="d-none" id="submitSuccessMessage">
            <div class="text-center mb-3">
              <div class="fw-bolder">Form submission successful!</div>
              <p>To activate this form, sign up at</p>
              <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
            </div>
          </div>
          <div class="d-none" id="submitErrorMessage">
            <div class="text-center text-danger mb-3">Error sending message!</div>
          </div>
          <div class="d-grid">
            <button class="btn btn-primary btn-lg" id="submitButton" type="submit">Cadastrar!</button>
          </div>
        </form>
      </div>
    </div>

    <div class="bg-light p-5 rounded">
      <h1>Localidades Cadastradas</h1>
      <div class="container px-5 my-5">
        <table class="table table-hover table-sm">
          <tr>
                <th>Codigo</th>
                <th>Cep</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <!--<th>Nome</th>-->
                <th>Bairro</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Modificar</th>
                <th>Excluir</th>
          </tr>
          <?php foreach ($result as $row) {?>
          <tr>
                <td><?php echo $row->codigo; ?></td>
                <td><?php echo $row->cep; ?></td>
                <td><?php echo $row->latitude; ?></td>
                <td><?php echo $row->longitude; ?></td>
                <!--<td>Nome</td>-->
                <td><?php echo $row->bairro; ?></td>
                <td><?php echo $row->cidade; ?></td>
                <td><?php echo $row->estado; ?></td>
                <td><a class="btn btn-success btn-sm" href="<?php echo base_url()."/Localidades/index/".$row->codigo; ?>">Alterar</a></td>
                <td><a class="btn btn-warning btn-sm" href="<?php echo base_url()."/Localidades/index/".$row->codigo.'/delete'; ?>">Excluir</a></td>
          
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>

    <script>

function carregar_baixa(obj){
    element=document.getElementById(obj.id);
    tr=element.closest('tr');
    
    document.getElementById('A2_COD').value=tr.children[0].innerHTML;
    document.getElementById('E5_BENEF').value=tr.children[1].innerHTML;
    document.getElementById('E5_NUMERO').value=tr.children[7].innerHTML;
    document.getElementById('E5_PARCELA').value=tr.children[8].innerHTML;
    document.getElementById('E5_PREFIXO').value=tr.children[9].innerHTML;
    document.getElementById('E5_TIPO').value=tr.children[10].innerHTML;
    document.getElementById('E5_DATA').value=tr.children[2].innerHTML;
    document.getElementById('E5_VALOR').value=tr.children[11].innerHTML;
    
}

function carregar_baixa2(obj){
    element=document.getElementById(obj.id);
    tr=element.closest('tr');
    
    document.getElementById('A2_COD').value=tr.children[0].innerHTML;
    document.getElementById('E5_BENEF').value=tr.children[1].innerHTML;
    document.getElementById('E5_NUMERO').value=tr.children[7].innerHTML;
    document.getElementById('E5_PARCELA').value=tr.children[8].innerHTML;
    document.getElementById('E5_PREFIXO').value=tr.children[9].innerHTML;
    document.getElementById('E5_TIPO').value=tr.children[10].innerHTML;
    document.getElementById('E5_DATA').value=tr.children[2].innerHTML;
    document.getElementById('E5_VALOR').value=tr.children[11].innerHTML;
    
    document.getElementById('natureza').value=obj.innerHTML;
    
}



function load_search_history()
{
        var search_query = document.getElementsByName('natureza')[0].value;
        if(search_query == '')
        {
                fetch("process_data.php", {
                        method: "POST",
                        body: JSON.stringify({
                                action:'fetch'
                        }),
                        headers:{
                                'Content-type' : 'application/json; charset=UTF-8'
                        }

                }).then(function(response){
                        return response.json();
                }).then(function(responseData){
                        if(responseData.length > 0)
                        {
                                var html = '<ul class="list-group">';
                                html += '<li class="list-group-item d-flex justify-content-between align-items-center"><b class="text-primary"><i>Your Recent Searches</i></b></li>';
                                for(var count = 0; count < responseData.length; count++)
                                {
                                        html += '<li class="list-group-item text-muted" style="cursor:pointer"><i class="fas fa-history mr-3"></i><span onclick="get_text(this)">'+responseData[count].search_query+'</span> <i class="far fa-trash-alt float-right mt-1" onclick="delete_search_history('+responseData[count].id+')"></i></li>';
                                }
                                html += '</ul>';
                                document.getElementById('search_result').innerHTML = html;
                        }
                });
        }
}

function get_text(event)
{
        var string = event.textContent;
                document.getElementsByName('natureza')[0].value = string;
                document.getElementById('search_result').innerHTML = '';
        
}

function load_data()
{
                var query = encodeURIComponent(document.getElementById('bairro').value +' , '+ document.getElementById('cidade').value +' , '+document.getElementById('estado').value);
                var form_data = new FormData();
                form_data.append('query', query);
                var ajax_request = new XMLHttpRequest();
                var url='https://nominatim.openstreetmap.org/search?q='+query+'&format=json';
                //var url='https://www.google.com/maps/search/'+query;
                //iframe = document.getElementById('myiframe');
                //iframe.src=url;
                console.log(url);
                ajax_request.open('POST', url);
                ajax_request.send(form_data);
                ajax_request.onreadystatechange = function()
                {
                        if(ajax_request.readyState == 4 && ajax_request.status == 200)
                        {
                                var response = JSON.parse(ajax_request.responseText);
                                var html = '<div class="list-group">';
                                console.log(response);
                                if(response.length > 0)
                                {
                                  document.getElementById('latitude').value=response[0].lat;
                                  document.getElementById('longitude').value=response[0].lon;  
                                }

                                
                        }
                }
        }


</script>