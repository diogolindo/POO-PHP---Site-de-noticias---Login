<main>
    <form action="<?php echo HOME_URI;?>usuario/update" method="POST">
        <fieldset>
            <legend>Editar usuário</legend>
            <div class="row">
                <input type="text" name="nome" placeholder="nome"/>
            </div>
            <div class="row">
                <input type="text" name="email" placeholder="Email"/>
            </div>
            <div class="row">
                <input type="text" name="senha" placeholder="senha"/>
            </div>
            <div class="row">
                <input type="submit" name="enviar" value="Enviar" />
            </div>
        </fieldset>
    </form>

</main>