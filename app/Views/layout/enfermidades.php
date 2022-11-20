
  <main class="container mt-4">
    <div class="bg-light p-5 rounded">
      <h1>Cadastro de Enfermidades</h1>
      <div class="container px-5 my-5">
        <form id="contactForm" action="<?php echo base_url().'/Enfermidades' ;?>" method="POST">
          <div class="form-floating mb-3">
            <input class="form-control" id="codigo" name="codigo" type="text" disabled placeholder="codigo" data-sb-validations="required" value="<?php if ($selecionado!=NULL) { echo $selecionado[0]->codigo; } else {echo '0'; } ?>"/>
            <label for="codigo">codigo</label>
            <div class="invalid-feedback" data-sb-feedback="codigo:required">codigo is required.</div>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" id="descricao" name="descricao" type="text" placeholder="descricao" data-sb-validations="required" value="<?php if ($selecionado!=NULL) { echo $selecionado[0]->descricao; } else {echo '0'; } ?>">
            <label for="descricao">descricao</label>
            <div class="invalid-feedback" data-sb-feedback="descricao:required">descricao is required.</div>
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
      <h1>Enfermidades Cadastradas</h1>
      <div class="container px-5 my-5">
        <table class="table table-hover table-sm">
          <tr>
                <th>Codigo</th>
                <th>Enfermidade</th>
                <th>Modificar</th>
          </tr>
          <?php foreach ($result as $row) {?>
          <tr>
                <td><?php echo $row->codigo; ?></td>
                <td><?php echo $row->descricao; ?></td>
                <td><a href="<?php echo base_url().'/Enfermidades/index/'.$row->codigo; ?>" class="btn btn-sm btn-success">Alterar</a></td>
          </tr>
          <?php } ?>
        </table>
      </div>

