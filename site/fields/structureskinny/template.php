<div class="structureskinny" data-field="structureskinny" data-page="<?php echo $field->page() ?>" data-sortable="true">

  <?php echo $field->headline() ?>

  <input type="hidden" name="<?php __($field->name()) ?>" value="<?php __(json_encode($field->value()), false) ?>">

  <script class="structureskinny-entries-template" type="text/x-handlebars-template">

    {{#unless entries}}
    <div class="structureskinny-empty">
      <?php _l('fields.structure.empty') ?> <a class="structureskinny-add-button" href="#"><?php _l('fields.structure.add.first') ?></a>
    </div>
    {{/unless}}

    {{#entries}}
    <div class="structureskinny-entry" id="structureskinny-entry-{{_id}}">
      <div class="structureskinny-entry-content text">
        <?php echo $field->entry() ?>
      </div>
      <nav class="structureskinny-entry-options">
        <ul class="cf">
          <li>
            <button type="button" data-structureskinny-id="{{_id}}" class="btn btn-with-icon structureskinny-edit-button">
              <?php i('pencil') ?>
            </button>
          </li>
          <li>
            <button type="button" data-structureskinny-id="{{_id}}" class="btn btn-with-icon structureskinny-delete-button">
              <?php i('trash-o') ?>
            </button>
          </li>
        </ul>
      </nav>
    </div>
    {{/entries}}
  </script>

</div>