export const BASE_URL =
    window.location.host.includes('localhost')
        ? ""
        : "https://REPLACE_WITH_THE_VALUE_ON_THE_ENV_VAR_APP_URL";

const route = window.location.pathname.split("/")[1];
export const URL_ROUTE = `/${route}/`;
export const UPDATE_ITEM_ROUTE = "/items/update/status/";
export const UPDATE_ORDER_ROUTE = "/orders/update/status/";
