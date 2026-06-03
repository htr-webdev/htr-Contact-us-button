/*
 * This is the admin JavaScript file for HTR Contact Us Button plugin.
 */
(function ($) {
  "use strict";

  $(function () {
    // Initialize color picker
    function initializeColorPicker() {
      $(".htr-cub-color-picker").wpColorPicker();
    }
    initializeColorPicker();

    // Sub Buttons Repeater
    var subButtonIndex = $(".htr-cub-sub-button-item").length;

    $("#htr-cub-add-sub-button").on("click", function () {
      var newSubButton =
        '<div class="htr-cub-sub-button-item">' +
        "<p>" +
        '<label for="htr_cub_sub_buttons_' +
        subButtonIndex +
        '_name">' +
        htr_cub_admin.name_label +
        "</label>" +
        '<input type="text" id="htr_cub_sub_buttons_' +
        subButtonIndex +
        '_name" name="htr_cub_options[htr_cub_sub_buttons][' +
        subButtonIndex +
        '][name]" value="" class="regular-text" />' +
        "</p>" +
        "<p>" +
        '<label for="htr_cub_sub_buttons_' +
        subButtonIndex +
        '_icon">' +
        htr_cub_admin.icon_label +
        "</label>" +
        '<input type="text" id="htr_cub_sub_buttons_' +
        subButtonIndex +
        '_icon" name="htr_cub_options[htr_cub_sub_buttons][' +
        subButtonIndex +
        '][icon]" value="" class="regular-text" />' +
        "</p>" +
        "<p>" +
        '<label for="htr_cub_sub_buttons_' +
        subButtonIndex +
        '_link">' +
        htr_cub_admin.link_label +
        "</label>" +
        '<input type="url" id="htr_cub_sub_buttons_' +
        subButtonIndex +
        '_link" name="htr_cub_options[htr_cub_sub_buttons][' +
        subButtonIndex +
        '][link]" value="" class="regular-text" />' +
        "</p>" +
        "<p>" +
        '<label for="htr_cub_sub_buttons_' +
        subButtonIndex +
        '_target">' +
        htr_cub_admin.target_label +
        "</label>" +
        '<select id="htr_cub_sub_buttons_' +
        subButtonIndex +
        '_target" name="htr_cub_options[htr_cub_sub_buttons][' +
        subButtonIndex +
        '][target]">' +
        '<option value="_self">' +
        htr_cub_admin.same_tab_label +
        "</option>" +
        '<option value="_blank">' +
        htr_cub_admin.new_tab_label +
        "</option>" +
        "</select>" +
        "</p>" +
        '<button type="button" class="button htr-cub-remove-sub-button">' +
        htr_cub_admin.remove_button_label +
        "</button>" +
        "<hr />" +
        "</div>";

      $("#htr-cub-sub-buttons-repeater .htr-cub-sub-buttons-list").append(
        newSubButton,
      );
      subButtonIndex++;
      initializeColorPicker(); // Re-initialize color pickers for new elements
    });

    $("#htr-cub-sub-buttons-repeater").on(
      "click",
      ".htr-cub-remove-sub-button",
      function () {
        $(this).closest(".htr-cub-sub-button-item").remove();
      },
    );
  });
})(jQuery);
