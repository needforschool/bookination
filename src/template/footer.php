    <footer id="footer">
        <div class="wrap-fluid">
            <ul>
                <li><a href="./legal.php">Mentions légales</a></li>
                <hr>
                <li>© Tous droits réservés</li>
            </ul>
        </div>
    </footer>
    <?php if (!empty($errors) && count($errors) > 0) : ?>
        <div class="errors-wrapper">
            <div class="wrap-fluid">
                <div class="errors-container">
                    <?php foreach ($errors as $e => $item) : ?>
                        <div class="error-item" id="error-item-<?= $e ?>">
                            <h6>Une erreur est survenue</h6>
                            <p><span><?= $e ?></span>: <?= $item ?></p>
                            <div class="btn btn-purple" onclick="document.getElementById('error-item-<?= $e ?>').remove()">Fermer</div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</body>