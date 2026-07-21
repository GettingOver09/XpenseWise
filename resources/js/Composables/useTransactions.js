import { computed } from "vue";

export function useTransactions({
    transactions,
    transactionsPeriod,
    transactionTypeIndex,
    selectedAccount,
    searchQuery,
    selectedCategories,
    selectedDateFrom,
    selectedDateTo,
}) {
    const periodOptions = [
        { label: "Today", value: "today" },
        { label: "This Week", value: "this_week" },
        { label: "This Month", value: "this_month" },
        { label: "Last Month", value: "last_month" },
        { label: "Last 3 Months", value: "last_3_months" },
        { label: "This Year", value: "this_year" },
        { label: "Custom Range", value: "custom" },
    ];

    const transactionTypes = ["All", "Income", "Expense", "Transfer"];
    const viewTabs = ["List", "Activity"];

    const categories = computed(() => {
        const activeType = selectedType.value?.toLowerCase();
        const uniqueCategories = new Set();

        transactions.value.forEach((transaction) => {
            if (!transaction.category) return;

            if (transaction.type === "transfer") return;

            if (
                selectedType.value.toLowerCase() !== "all" &&
                transaction.type !== activeType
            ) {
                return;
            }

            uniqueCategories.add(transaction.category.name);
        });

        return Array.from(uniqueCategories).sort();
    });

    const accounts = computed(() => {
        const uniqueAccounts = new Set(["All accounts"]);

        transactions.value.forEach((transaction) => {
            if (transaction.account) {
                uniqueAccounts.add(transaction.account.name);
            }
        });

        return Array.from(uniqueAccounts);
    });

    const selectedType = computed(
        () => transactionTypes[transactionTypeIndex.value],
    );

    const selectedPeriodLabel = computed(() => {
        return periodOptions.find(
            (option) => option.value === transactionsPeriod.value,
        )?.label;
    });

    const rangeForPeriod = (period) => {
        const today = new Date();
        const start = new Date(today);
        const end = new Date(today);

        switch (period) {
            case "today":
                break;
            case "this_week": {
                const weekday = (today.getDay() + 6) % 7;
                start.setDate(today.getDate() - weekday);
                break;
            }
            case "this_month":
                start.setDate(1);
                break;
            case "last_month":
                start.setDate(1);
                start.setMonth(today.getMonth() - 1);
                end.setDate(1);
                end.setMonth(today.getMonth());
                end.setDate(0);
                break;
            case "last_3_months":
                start.setDate(1);
                start.setMonth(today.getMonth() - 2);
                break;
            case "this_year":
                start.setMonth(0, 1);
                break;
            default:
                return { from: null, to: null };
        }

        return { from: start, to: end };
    };

    const periodRange = computed(() => {
        if (transactionsPeriod.value === "custom") {
            const from = selectedDateFrom.value
                ? new Date(selectedDateFrom.value)
                : null;
            const to = selectedDateTo.value
                ? new Date(selectedDateTo.value)
                : null;

            return { from, to };
        }

        return rangeForPeriod(transactionsPeriod.value);
    });

    const filteredTransactions = computed(() => {
        const query = searchQuery.value.trim().toLowerCase();
        const dateFrom = periodRange.value.from;
        const dateTo = periodRange.value.to;

        return transactions.value.filter((transaction) => {
            const typeFilter = selectedType.value.toLowerCase();
            const matchesType =
                typeFilter === "all" || transaction.type === typeFilter;

            const matchesAccount =
                selectedAccount.value === "All accounts" ||
                transaction.account?.name === selectedAccount.value;

            const matchesCategories =
                !selectedCategories.value.length ||
                selectedCategories.value.includes(transaction.category?.name);

            const matchesQuery =
                !query ||
                [
                    transaction.payee,
                    transaction.category?.name,
                    transaction.account?.name,
                ].some((field) => (field ?? "").toLowerCase().includes(query));

            let matchesDate = true;
            if (transaction.transaction_date) {
                const transactionDate = new Date(transaction.transaction_date);

                if (dateFrom && transactionDate < dateFrom) {
                    matchesDate = false;
                }
                if (dateTo && transactionDate > dateTo) {
                    matchesDate = false;
                }
            }

            return (
                matchesType &&
                matchesAccount &&
                matchesCategories &&
                matchesQuery &&
                matchesDate
            );
        });
    });

    return {
        periodOptions,
        transactionTypes,
        viewTabs,
        accounts,
        categories,
        selectedType,
        selectedPeriodLabel,
        filteredTransactions,
    };
}
