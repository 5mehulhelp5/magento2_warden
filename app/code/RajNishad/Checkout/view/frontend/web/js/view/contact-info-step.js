define([
    "uiComponent",
    "ko",
    "Magento_Checkout/js/model/step-navigator",
    "Magento_Checkout/js/model/quote",
], function (Component, ko, stepNavigator, quote) {
    "use strict";

    return Component.extend({
        defaults: {
            template: "RajNishad_Checkout/contact-info",
        },

        firstname: ko.observable(""),
        lastname: ko.observable(""),
        email: ko.observable(""),
        telephone: ko.observable(""),

        isVisible: ko.observable(true),

        initialize: function () {
            this._super();
            stepNavigator.registerStep(
                "contact-information",
                null,
                "Contact Information",
                this.isVisible,
                _.bind(this.navigate, this),
                0
            );
            return this;
        },

        navigate: function () {},

        validate: function () {
            return (
                this.firstname() &&
                this.lastname() &&
                this.email() &&
                this.telephone()
            );
        },

        navigateNext: function () {
            if (!this.validate()) {
                alert("Please fill all fields.");
                return;
            }

            // Save contact info to quote observable
            var shippingAddress = quote.shippingAddress() || {};
            var extAttr = shippingAddress["extension_attributes"] || {};
            extAttr.contact_firstname = this.firstname();
            extAttr.contact_lastname = this.lastname();
            extAttr.contact_email = this.email();
            extAttr.contact_telephone = this.telephone();
            shippingAddress["extension_attributes"] = extAttr;
            quote.shippingAddress(shippingAddress);

            // Find shipping step
            var shippingStep = stepNavigator.steps().find(function (step) {
                return step.code === "shipping";
            });

            if (shippingStep) {
                shippingStep.isVisible(true); // show shipping step
                stepNavigator.navigateTo("shipping"); // navigate to shipping
            } else {
                console.error("Shipping step not found!");
            }
        },
    });
});
