<h5 class="mb-4">Subimos <?= count($_SESSION['resultado']) ?> chats com sucesso.</h5>
<h5 class="mb-4">Tivemos <?= count($_SESSION['erro']) ?> erros ao subir.</h5>
<p>Tentar subir novamente os erros para API?</p>
<a href="/mm" class="btn btn-secondary">Não</a>
<a href="/mm/?erro" class="btn btn-mex">Sim</a>