import { ref } from "vue";
import { formatDate } from "../Helpers/dateHelper";

export function useDateFormat(date) {
    const formattedDate = ref(
        formatDate(date, "es-ES", {
            year: "numeric",
            month: "long",
            day: "numeric",
        })
    );

    return { formattedDate };
}
