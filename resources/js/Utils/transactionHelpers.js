export const getTypeColor = (type) => {
    if (type === "income") {
        return "text-emerald-600 dark:text-emerald-400";
    }

    if (type === "transfer") {
        return "text-slate-600 dark:text-slate-400";
    }

    return "text-rose-600 dark:text-rose-400";
};

export const getStatusClasses = (status) => {
    if (status === "reviewed") {
        return "bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300";
    }

    return "bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300";
};

export const getTypeLabel = (type) => {
    switch (type) {
        case "income":
            return "Income";
        case "expense":
            return "Expense";
        case "transfer":
            return "Transfer";
        default:
            return "";
    }
};
