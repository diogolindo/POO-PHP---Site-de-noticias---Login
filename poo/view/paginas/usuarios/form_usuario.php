<main>
    <form action="<?php echo HOME_URI;?>usuario/salvar" method="POST">
        <fieldset>
            <legend>Cadastro de usuários</legend>
            <input type="hidden" name="id" />
            <div class="row">
                <input type="text" name="nome" placeholder="Nome do usuário"/>
            </div>
            <div class="row">
                <input type="text" name="email" placeholder="Email"/>
            </div>
            <div class="row">
                <input type="submit" name="enviar" value="Enviar" />
            </div>
        </fieldset>
    </form>
    <p>Já possui conta?<a href="<?php echo HOME_URI;?>usuario/login" class="btn">Logue-se aqui</a></p>

</main>