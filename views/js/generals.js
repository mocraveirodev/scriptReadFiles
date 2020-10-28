function fillChoose(){
    $(".card .card-body").html(`
        <h5 class="mb-4">Informe o tipo de Ingestão: </h5>
        <button type="button" class="btn btn-mex" id="btnAudio">Áudio</button>
        <button type="button" class="btn btn-mex" id="btnChat">Chat</button>
    `);
}

function fillFormChat(){
    $(".card .card-body").html(`
        <form action="/mm/path" method="post">
            <div class="input-group mb-3">
                <input type="text" id="path" name="path" class="form-control" placeholder="Informe o Caminho da pasta:" aria-label="Informe o Caminho da pasta:" aria-describedby="btnChat">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary">Ver Conteúdo</button>
                </div>
            </div>
        </form>
    `);
}