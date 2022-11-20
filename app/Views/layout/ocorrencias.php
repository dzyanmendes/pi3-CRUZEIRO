
  <main class="container mt-4">
    <div class="bg-light p-5 rounded">
      <h1>Cadastro de Ocorrências</h1>
      <div class="container px-5 my-5">
        <form id="contactForm"  action="<?php

use CodeIgniter\Entity\Cast\IntegerCast;

 echo base_url().'/Ocorrencias'; ?>" method="post" >
          <div class="form-floating mb-3">
            <input class="form-control" id="codigo" name="codigo" readonly type="text" placeholder="codigo" data-sb-validations="" value="<?php if ($selecionado!=NULL) { echo $selecionado[0]->codigo; } else {echo '0'; } ?>"/>
            <label for="codigo">codigo</label>
          </div>
          <div class="form-floating mb-3">
            <select class="form-select" id="localidade" name="localidade_codigo" aria-label="Localidade">
              <?php foreach($localidades as $localidade){
                  $localidade_codigo='';
                  if ($selecionado!=NULL) { 
                    if ($localidade->codigo==$selecionado[0]->localidade_codigo){ $localidade_codigo='selected'; } 
                    }
                  echo '<option value="'.$localidade->codigo.'" '.$localidade_codigo.' >'.$localidade->nome.'</option>';
                }
              ?>
            </select>
            <label for="localidade">Localidade</label>
          </div>
          <div class="form-floating mb-3">
            <select class="form-select" id="enfermidade" name="enfermidade_codigo" aria-label="Enfermidade">
              <?php foreach($enfermidades as $enfermidade){
                  $enfermidade_codigo='';
                  if ($selecionado!=NULL) { 
                    if ($enfermidade->codigo==$selecionado[0]->enfermidade_codigo){ $enfermidade_codigo='selected'; } 
                  }
                  echo '<option value="'.$enfermidade->codigo.'" '.$enfermidade_codigo.' >'.$enfermidade->descricao.'</option>';
                }
              ?>
            </select>
            <label for="enfermidade">Enfermidade</label>
          </div>
          
          <div class="form-floating mb-3">
            
            <input class="form-control" id="dataOcorrencia" name="dataOcorrencia" type="date" placeholder="dataOcorrencia" data-sb-validations="" value="<?php if ($selecionado!=NULL) { echo date_format(date_create($selecionado[0]->dataOcorrencia),'Y-m-d'); } else {echo ''; } ?>"/>
            <label for="dataOcorrencia">dataOcorrencia</label>
          </div>
          <div class="mb-3">
            <label class="form-label d-block">Sexo</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" id="masculino" type="radio" name="sexo" value="M" data-sb-validations="" <?php if ($selecionado!=NULL) 
                                                                                                                        { 
                                                                                                                          if ($selecionado[0]->sexo=='M'){ 
                                                                                                                              echo "checked"; 
                                                                                                                          } else { echo ''; }
                                                                                                                        } else { 
                                                                                                                          echo ''; 
                                                                                                                        } 
                                                                                                              ?> 
                                                                                                              >
              <label class="form-check-label" for="masculino">Masculino</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" id="feminino" type="radio" name="sexo" value="F" data-sb-validations="" <?php 
                                                                                                                  if ($selecionado!=NULL) { 
                                                                                                                    if ($selecionado[0]->sexo=='F'){
                                                                                                                       echo "checked";
                                                                                                                    } else { 
                                                                                                                      echo ''; 
                                                                                                                    } 
                                                                                                                  } else {
                                                                                                                      echo ''; 
                                                                                                                  } 
                                                                                                            ?>>
              <label class="form-check-label" for="feminino">Feminino</label>
            </div>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" id="ano_nasc" name="ano_nasc" type="number" placeholder="idadeEnfermo" data-sb-validations="" value="<?php if ($selecionado!=NULL) { echo $selecionado[0]->ano_nasc; } else {echo ''; } ?>"/>
            <label for="ano_nasc">Ano Nascimento</label>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" id="observacao" name="observacao" type="text" placeholder="observacao" data-sb-validations="" value="<?php if ($selecionado!=NULL) { echo $selecionado[0]->observacao; } else {echo ''; } ?>"/>
            <label for="observacao">observacao</label>
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
      <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </div>

    <div class="bg-light p-5 rounded">
      <h1>Localidades Cadastradas</h1>
      <div class="container px-5 my-5">
        <table class="table table-hover table-sm">
          <tr>
                <th>Codigo</th>
                <th>Localidade</th>
                <th>Enfermidade</th>
                <th>Data</th>
                <!--<th>Nome</th>-->
                <th>Sexo</th>
                <th>Ano Nasc</th>
                <th>Idade</th>
                <th>Observação</th>
                <th>Modificar</th>
                <th>Excluir</th>
          </tr>
          <?php foreach ($result as $row) { ?>
          <tr>
                <td><?php echo $row->codigo;?></td>
                <td><?php echo $row->localidade;?></td>
                <td><?php echo $row->enfermidade;?></td>
                <td><?php echo date_format(date_create($row->dataOcorrencia),'d/m/Y');?></td>
                <!--<td>Nome</td>-->
                <td><?php echo $row->sexo;?></td>
                <td><?php echo $row->ano_nasc;?></td>
                <td><?php echo (date("Y"))-($row->ano_nasc);?></td>
                <td><?php echo $row->observacao;?></td>
                <td><a class="btn btn-success btn-sm" href="<?php echo base_url().'/Ocorrencias/index/'.$row->codigo; ?>">Alterar</a></td>
                <td><a class="btn btn-warning btn-sm" href="<?php echo base_url().'/Ocorrencias/index/'.$row->codigo.'/delete'; ?>">Excluir</a></td>
          </tr>
          <?php } ?>
        </table>
      </div>
