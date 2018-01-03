/**
 * Medium Editor Field for Kirby Panel
 *
 * @version  0.6
 * @author   Ricky Boyce
 * @link     https://github.com/boycce/kirby-medium
 */

var Medium = (function($, $field) {

  var self = this;

  this.$field        = $field;
  this.$editor       = $(this.$field.data('editor'));
  this.$storage      = $('#' + this.$editor.data('storage'));
  this.$draggable    = $('.sidebar').find('.draggable');
  this.firstHeader   = this.$editor.data('first-header');
  this.secondHeader  = this.$editor.data('second-header');
  this.doubleReturns = this.$editor.is("[data-double-returns]");
  this.buttons       = this.$editor.data('buttons').split(',');
  this.editor        = null;

  /**
   * Initialize editor field
   *
   * @since 1.0.0
   */
  this.init = function() {


    // Create MediumEditor instance

    self.editor = new MediumEditor(self.$editor.get(0), {

      cleanPastedHTML:     true,
      forcePlainText:      true,
      buttonLabels:        'fontawesome',
      disableDoubleReturn: !self.doubleReturns,
      firstHeader:         self.firstHeader,
      secondHeader:        self.secondHeader,
      buttons:             self.buttons,
      anchorTarget:        true,
      imageDragging:       false,
      anchorPreviewHideDelay: 700,
      extensions: {
        'del': new MediumButton({
          label: '<i class="fa fa-strikethrough"></i>',
          start: '<del>',
          end:   '</del>'
        }),
        'ins': new MediumButton({
          label: 'INS',
          start: '<ins>',
          end:   '</ins>'
        }),
        'mark': new MediumButton({
          label: 'MARK',
          start: '<mark>',
          end:   '</mark>'
        }),
      }
    });

    /**
     * Make the editor field accept Kirby typical
     * file/page drag and drop events.
     */
    self.$editor.droppable({
      hoverClass: 'over',
      accept: self.draggable,

      drop: function(event, element) {
        self.insertAtCaret(element.draggable.data('text'));
      }
    });

    /**
     * Observe changes to editor fields and update storage <textarea>
     * element accordingly.
     */
    self.$editor.on('DOMSubtreeModified', function(event) {
      self.$storage.text(self.$editor.html());
    });

    /**
     * Observe when the field element is destroyed (=the user leaves the
     * current view) and deactivate MediumEditor accordingly.
     */
    self.$field.bind('destroyed', function() {
      self.editor.deactivate();
    });

  };

  /**
   * Insert HTML (or plaintext) content at the curent caret position
   *
   * @param string html
   */
  this.insertAtCaret = function(html) {
    var sel, range;


    if (window.getSelection) {

      // IE9 and non-IE
      sel = window.getSelection();
      if (sel.getRangeAt && sel.rangeCount) {

        range = sel.getRangeAt(0);
        range.deleteContents();

        var el = document.createElement("div");
        el.innerHTML = html;
        var frag = document.createDocumentFragment(),
          node,
          lastNode;

        while ((node = el.firstChild)) 
          lastNode = frag.appendChild(node);
        
        range.insertNode(frag);

        // Preserve the selection
        if (lastNode) {
          range = range.cloneRange();
          range.setStartAfter(lastNode);
          range.collapse(true);
          sel.removeAllRanges();
          sel.addRange(range);
        }
      }

    } else if (document.selection && document.selection.type != "Control") {
      // IE < 9
      document.selection.createRange().pasteHTML(html);
    }
  };


  // Run initialization

  return this.init();

});


(function($) {

    // Set up special "destroyed" event.

    $.event.special.destroyed = {
      remove: function(event) {
        if (event.handler) 
          event.handler.apply(this,arguments);
      }
    };

    /**
     * Tell the Panel to run our initialization.
     *
     * This callback will fire for every Medium Editor Field 
     * on the current panel page.
     *
     * @see https://github.com/getkirby/panel/issues/228#issuecomment-58379016
     */
    $.fn.mediumeditorfield = function() {
      return new Medium($, this);
    };

})(jQuery);