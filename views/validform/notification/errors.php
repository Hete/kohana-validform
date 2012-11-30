<strong><?php echo __("validform.formisinvalid") ?></strong>
<ul>
    <?php foreach ($errors as $field_name => $field_errors) : ?>

        <li><?php echo __("validform.errorforfield", array(":field" => $field_name)) ?></li>
      <ul>
            <?php foreach ($field_errors as $error) : ?>
                <li><?php echo $error ?></li>

            <?php endforeach; ?>
        </ul>

    <?php endforeach; ?>
</ul>

