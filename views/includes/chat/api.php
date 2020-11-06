<h5 class="mb-4">Subimos <?= count($_SESSION['resultado']) ?> chats com sucesso. <a href="" data-toggle="modal" data-target="#modalResultado">Clique aqui pra ver o resultado</a></h5>
<h5 class="mb-4">Tivemos <?= count($_SESSION['erro']) ?> erros ao subir.  <a href="" data-toggle="modal" data-target="#modalErro">Clique aqui pra ver os erros</a></h5>
<a href="/mm" class="btn btn-secondary">Página Inicial</a>

<div class="modal fade" id="modalResultado" tabindex="-1" aria-labelledby="modalResultadoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalResultadoLabel">Resultados:</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                    <th scope="col">ID do Chat</th>
                    <th scope="col">CorrelationId</th>
                    <th scope="col">MiningId</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($_SESSION['resultado'] as $id => $resultado): ?>
                        <tr>
                            <th scope="row"><?= $id ?></th>
                            <td><?= $resultado['CorrelationId'] ?></td>
                            <td><?= $resultado['MiningId'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-mex" data-dismiss="modal">Fechar</button>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalErro" tabindex="-1" aria-labelledby="modalErroLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalErroLabel">Erros:</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <?php foreach($_SESSION['erro'] as $id => $resultado): ?>
                <button class="accordion"><?= $id ?></button>
                <div class="panel">
                    <pre><?= $resultado ?></pre>
                </div>
            <?php endforeach ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-mex" data-dismiss="modal">Fechar</button>
        </div>
        </div>
    </div>
</div>

<script>
    let acc = document.getElementsByClassName("accordion");
    let i;

    for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        let panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
        } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
    }
</script>