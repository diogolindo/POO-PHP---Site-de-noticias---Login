<main>
    <form action="<?php echo HOME_URI;?>usuario/entrar" method="POST">
        <fieldset>
            <legend>Login de usuário</legend>
            <div class="row">
                <input type="text" name="email" placeholder="Email"/>
            </div>
            <div class="row">
                <input type="text" name="nome" placeholder="nome"/>
            </div>
            <div class="row">
                <input type="submit" name="enviar" value="Enviar" />
            </div>
        </fieldset>
    </form>
    <p>Não possui conta?<a href="<?php echo HOME_URI;?>usuario/criar" class="btn">Crie uma aqui</a></p>

</main>