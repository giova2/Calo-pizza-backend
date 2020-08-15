import axios from "axios";
import { UPDATE_ITEM_ROUTE, UPDATE_ORDER_ROUTE, BASE_URL } from "./routes.js";

export const postMethods = {
    changeOrderStatus(id, status) {
        axios.put(
            `${BASE_URL}${UPDATE_ORDER_ROUTE}${id}`,
            { status: status },
            {
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content
                }
            }
        );
    },
    changeItemStatus(id, status) {
        axios.put(
            `${BASE_URL}${UPDATE_ITEM_ROUTE}${id}`,
            { status: status },
            {
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content
                }
            }
        );
    }
};
