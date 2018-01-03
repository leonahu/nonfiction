(function($) {

  $.fn.editor = function() {

    return this.each(function() {

      var textarea = $(this).autosize();
      var buttons  = textarea.parent().find('.field-buttons');

      // Allow tabs
      enableTabs(textarea[0]);

      buttons.find('.btn').on('click', function(e) {

        textarea.focus();
        var button = $(this);

        if(button.data('action')) {

          EditorController[button.data('action')](textarea, button);

        } else {

          var sel  = textarea.getSelection();
          var tpl  = button.data('tpl');
          var text = button.data('text');

          if(sel.length > 0) text = sel;

          var tag = tpl.replace('{text}', text);

          textarea.insertAtCursor(tag);
          textarea.trigger('autosize.resize');

        }

        return false;

      });

      textarea.bind('keydown', 'meta+return', function() {
        textarea.parents('.form').trigger('submit');
      });

      buttons.find('[data-editor-shortcut]').each(function(i, el) {
        var key = $(this).data('editor-shortcut');
        textarea.bind('keydown', key, function(e) {
          $(el).trigger('click');
          return false;
        });

      });

    });

  };


  // allow tabs
  function enableTabs(el) {
    //var el = document.getElementById(el);

    el.onkeydown = function(e) {
      if (e.keyCode === 9) { // tab was pressed

        // get caret position/selection
        var val = this.value,
          start = this.selectionStart,
          end   = this.selectionEnd,
          event = document.createEvent('TextEvent');

        // What to insert
        var newval = '\t';

        // Add history if supported.
        if (event.initTextEvent) {
          event.initTextEvent('textInput', true, true, null, newval);
          this.dispatchEvent(event);
        } else {
          // New value: text before caret + tab + text after caret
          this.value = val.substring(0, start) + newval + val.substring(end);
        }

        // put caret at right position again
        this.selectionStart = this.selectionEnd = start + 1;

        // prevent the focus lose
        return false;
      }
    };
  }

})(jQuery);