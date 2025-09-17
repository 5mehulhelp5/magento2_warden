define(["jquery"], function ($) {
    "use strict";

    return function (config) {
        console.log("Magento Store Config Values:");
        console.log("Sales Email Config:", config.configData.sales_email);
        console.log(
            "Payment Methods Config:",
            config.configData.payment_methods
        );
    };
});
