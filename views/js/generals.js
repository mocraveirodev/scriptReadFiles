function fillChoose(){
    $('.card .card-body').html(`
        <h5 class='mb-4'>Informe o tipo de Ingestão: </h5>
        <button type="button" class="btn btn-mex" id='btnAudio'>Áudio</button>
        <button type="button" class="btn btn-mex" id='btnChat'>Chat</button>
    `);
}

function fillFormChat(){
    $('.card .card-body').html(`
        <div class="input-group mb-3">
            <input type="text" id='pathChat' name='pathChat' class="form-control" placeholder="Informe o Caminho da pasta:" aria-label="Informe o Caminho da pasta:" aria-describedby="btnChat">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="btnChat">Ver Conteúdo</button>
            </div>
        </div>
    `);
}