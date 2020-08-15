export const BASE_URL =
    window.location.host === "pizza-task.test"
        ? ""
        : "https://pizza-task-laravel.herokuapp.com";

const route = window.location.pathname.split("/")[1];
export const URL_ROUTE = `/${route}/`;
export const UPDATE_ITEM_ROUTE = "/items/update/status/";
export const UPDATE_ORDER_ROUTE = "/orders/update/status/";
