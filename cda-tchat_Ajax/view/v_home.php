<section class="container">
    <div class="container__chat">
        <?php if (isset($arr_message)) :
            foreach ($arr_message as $values) :   ?>
                <p><?= $values['pseudo_conversation']. " : ". $values['message_conversation'] ?></p>
            <?php endforeach ?>
        <?php endif; ?>
    </div>
<div class="alert"></div>
    <form class="container__form">
        <div class="form">
            <label for="">Veuillez renseigner votre pseudo :</label>
            <input id="pseudo" name="pseudo" type="text" placeholder="Pseudo...">
        </div>
        <div class="form">
            <label for="">Votre message :</label>
            <textarea id="message" name="message" id="" cols="50" rows="10" placeholder="Votre message..."></textarea>
        </div>
        <div class="form__button">
            <button type="submit">Envoyer</button>
        </div>
    </form>

</section>