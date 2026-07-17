export function formatLongDate(date) {
    const d = new Date(date);

    if (isNaN(d.getTime())) return date;

    return d.toLocaleDateString(undefined, {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
    });
}
