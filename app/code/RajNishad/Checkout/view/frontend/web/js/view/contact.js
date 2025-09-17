define([
    "ko",
    "uiComponent",
    "underscore",
    "Magento_Checkout/js/model/step-navigator",
    "mage/translate",
    "Magento_Checkout/js/model/quote",
    "jquery",
], function (ko, Component, _, stepNavigator, $t, quote, $) {
    "use strict";

    return Component.extend({
        defaults: {
            template: "RajNishad_Checkout/contact",
        },

        // isVisible is used for the step title indicator
        isVisible: ko.observable(false),

        /**
         * @inheritdoc
         */
        initialize: function () {
            this._super();

            // Register our step with the step navigator
            stepNavigator.registerStep(
                "contact-step",
                null,
                $t("Contact Information"),
                this.isVisible,
                _.bind(this.navigate, this),
                10 // A sort order between shipping (0) and payment (20)
            );

            return this;
        },

        /**
         * This is called when the step is activated
         */
        navigate: function () {
            this.isVisible(true);
        },

        /**
         * The function called when the "Next" button is clicked.
         */
        navigateToNextStep: function () {
            // Here we are simply validating the form.
            // You can add logic here to save the data via an AJAX call if you need to.
            if (this.validate()) {
                stepNavigator.next();
            }
        },

        /**
         * A simple validation function.
         * It triggers validation on all fields within our custom data scope.
         * @returns {boolean}
         */
        validate: function () {
            // The 'contact.data' scope is what we set in the LayoutProcessor
            this.source.set("params.invalid", false);
            this.source.trigger("contact.data.validate");

            return !this.source.get("params.invalid");
        },
    });
});
